<?php
require_once('functions.php');

//
$json_employees = file_get_contents('employees.json');
$json_employees_decoded = json_decode($json_employees);

$json_shifts = file_get_contents('shifts.json');
$json_shifts_decoded = json_decode($json_shifts);

// arrays for employees requests
$morning_array = [ [],[],[],[],[],[],[] ];
$noon_array = [ [],[],[],[],[],[],[] ];

// arrays for employees slots
$morning_array_slot = [ [],[],[],[],[],[],[] ];
$noon_array_slot = [ [],[],[],[],[],[],[] ];

// array for slot optimization, counting the employees shifts
$counter_array = [];

//CODE
//$num_of_employees deffine the amount of workers per shift
$num_of_employees_morning = morning_employees_per_shift($json_employees_decoded);
$num_of_employees_noon = noon_employees_per_shift($json_employees_decoded);

foreach ($json_employees_decoded->employees as $employ_number => $employ_obj) {
	$counter_array[$employ_number] = 0; // counter array for optimize (initialize)

	foreach ($employ_obj->request->morning as $value) {
		array_push($morning_array[$value], $employ_number);
	}//$morning_array contains the options for the morning shifts requested by the employees

	foreach ($employ_obj->request->noon as $value) {
		array_push($noon_array[$value], $employ_number);
	}//$noon_array contains the options for the noon shifts requested by the employees
}

// WHEN YOU DONT HAVE A CHOICE
// WHEN THE NUMBER OF REQUESTS IS LOWER OR EQUAL THEN THE DEMAND
for ($i=0; $i < 7 ; $i++) {
	//when you have no choice for morning slotting
	if(count($morning_array[$i]) <= $num_of_employees_morning){
		foreach ($morning_array[$i] as $key => $value) {
			push_increase_delete_for_morning($i,$value);
		}
		for ($j=0; $j <$num_of_employees_morning ; $j++) {
			if(isset($morning_array_slot[$i][$j])){
				continue;
			}else {
				$morning_array_slot[$i][$j] = 0;
			}
		}
	} // morning if

	if(count($noon_array[$i]) <= $num_of_employees_noon){
		//when you have no choice for noon slotting
		foreach ($noon_array[$i] as $key => $value) {
			push_increase_delete_for_noon($i,$value);
		}
		for ($j=0; $j <$num_of_employees_noon ; $j++) {
			if(isset($noon_array_slot[$i][$j])){
				continue;
			}else {
				$noon_array_slot[$i][$j] = 0;
			}
		}
	} // noon if
}// for

// WHEN YOU HAVE A CHOICE
//WHEN THE NUMBER OF REQUESTS IS HIGHER THEN THE DEMAND
for ($i=0; $i <7; $i++) {
	if (empty($morning_array_slot[$i])) {
		// if you have a choice do the while thing
		while (count($morning_array_slot[$i]) < $num_of_employees_morning) {
			$temp = sort_by_min_shifts($counter_array,$morning_array[$i]);

			if(in_array($temp, $morning_array[$i])){
				push_increase_delete_for_morning($i,$temp);
			}else{
				// not empty means you dont have a choice for that shift
				break;
			}
		}//while
	}// big if

	if (empty($noon_array_slot[$i])) {
		// if you have a choice do the while thing
		while (count($noon_array_slot[$i]) < $num_of_employees_noon) {
			$temp = sort_by_min_shifts($counter_array,$noon_array[$i]);

			if(in_array($temp, $noon_array[$i])){
				push_increase_delete_for_noon($i,$temp);
			}else{
				// not empty means dont have a choice for that shift
				break;
			}
		}//while
	}// big if
}//for

unset($morning_array);
unset($noon_array);

for($i=0; $i < $num_of_employees_morning; $i++){
	for ($j=0; $j < 7; $j++) {
		unset($json_shifts_decoded->shifts->morning->rows[$i][$j]->slot);
		$day = get_string_day($j);
		$json_shifts_decoded->shifts->morning->rows[$i][$j]->$day = get_employ_name($morning_array_slot[$j][$i]);
	}
}//set day name and employee number in the morning shifts decoded json

for($i=0; $i < $num_of_employees_noon; $i++){
	for ($j=0; $j < 7; $j++) {
		unset($json_shifts_decoded->shifts->noon->rows[$i][$j]->slot);
		$day = get_string_day($j);
		$json_shifts_decoded->shifts->noon->rows[$i][$j]->$day = get_employ_name($noon_array_slot[$j][$i]);
	}
}//set day name and employee number in the noon shifts decoded json

//morning shifts printing
echo "<h3><u>Morning shifts list</u></h3>";
for ($i=0; $i <$num_of_employees_morning ; $i++) {
	echo "</br>";
	for ($j=0; $j <7 ; $j++) {

		$day_morning_shift = $json_shifts_decoded->shifts->morning->rows[$i][$j];
		foreach ($day_morning_shift as $key => $value) {
			echo $key." : ".$value."</br>";
		}
	}
}

//noon shifts printing
echo "</br></br><h3><u>Noon shifts list</u></h3>";
for ($i=0; $i <$num_of_employees_noon ; $i++) {
	echo "</br>";
	for ($j=0; $j <7 ; $j++) {

		$day_noon_shift = $json_shifts_decoded->shifts->noon->rows[$i][$j];
		foreach ($day_noon_shift as $key => $value) {
			echo $key." : ".$value."</br>";
		}
	}
}

//VALIDATION
echo "<pre>";
// print_r($morning_array_slot);
// print_r($noon_array_slot);
print_r($counter_array);
echo "</pre>";

?>
