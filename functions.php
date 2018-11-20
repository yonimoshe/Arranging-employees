<?php

function sort_by_min_shifts($counter_arr,$requests_arr){
  // retrun the employee number with the least number of shifts
  asort($counter_arr);
  foreach ($counter_arr as $key => $value) {
    if(in_array($key,$requests_arr)){
      return $key;
    }

  }
}

function push_increase_delete_for_morning($day,$employ_number){
  //adding new slots
  //increase the employee counter
  //delete employee request from $morning_array

  global $morning_array_slot;
  global $counter_array;
  global $morning_array;

  array_push($morning_array_slot[$day],$employ_number);
  $counter_array[$employ_number]++;
  unset($morning_array[$day][array_search($employ_number,$morning_array[$day])]);
}

function push_increase_delete_for_noon($day,$employ_number){
  //adding new slots
  //increase the employee counter
  //delete employee request from $noon_array
  global $noon_array_slot;
  global $counter_array;
  global $noon_array;

  array_push($noon_array_slot[$day],$employ_number);
  $counter_array[$employ_number]++;
  unset($noon_array[$day][array_search($employ_number,$noon_array[$day])]);
}

function get_string_day($day){
  //get day number and convert it to a string
  $day_str = "";
  switch ($day) {
    case 0:
    $day_str = "Sunday";
    break;
    case 1:
    $day_str = "Monday";
    break;
    case 2:
    $day_str = "Tuesday";
    break;
    case 3:
    $day_str = "Wednesday";
    break;
    case 4:
    $day_str = "Thursday";
    break;
    case 5:
    $day_str = "Friday";
    break;
    case 6:
    $day_str = "Saturday";
    break;
    default:
    return;
    break;
  }
  return $day_str;
}

function get_employ_name($num){
  //convert employee number to his full name
  global $json_employees_decoded;
  if($num !== 0)
  return $json_employees_decoded->employees->{$num}->name;
  else{
    return "MISSING!!";
  }
}

function morning_employees_per_shift($json){
  //return the amount of the workers in the morning shift
  global $json_shifts_decoded;
  $employees=0;
  foreach ($json_shifts_decoded->shifts->morning->rows as $key) {
       $employees++;
  }
       return $employees;
}

function noon_employees_per_shift($json){
  //return the amount of the workers in the noon shift
  global $json_shifts_decoded;
  $employees=0;
  foreach ($json_shifts_decoded->shifts->noon->rows as $key) {
       $employees++;
  }
       return $employees;
}

?>
