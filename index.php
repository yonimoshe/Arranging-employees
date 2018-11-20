<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>restigo</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <style type "text/css">

  .blink {
    -webkit-animation: blink .75s linear infinite;
    -moz-animation: blink .75s linear infinite;
    -ms-animation: blink .75s linear infinite;
    -o-animation: blink .75s linear infinite;
    animation: blink .75s linear infinite;
  }
  @-webkit-keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 1; }
    50.01% { opacity: 0; }
    100% { opacity: 0; }
  }
  @-moz-keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 1; }
    50.01% { opacity: 0; }
    100% { opacity: 0; }
  }
  @-ms-keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 1; }
    50.01% { opacity: 0; }
    100% { opacity: 0; }
  }
  @-o-keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 1; }
    50.01% { opacity: 0; }
    100% { opacity: 0; }
  }
  @keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 1; }
    50.01% { opacity: 0; }
    100% { opacity: 0; }
  }

  </style>
</head>
<body>
  <div class="container">
    <div class="jumbotron">
        <center>
            <h1 class="display-4">Welcome to our shifts management app!!!</h1>
            <h3>We have received your employees shifts request file</h3>
                 <div class="mt-5">
                  <p class="lead text-center">For cheking out the results click on the button below</p>
                  <div class="blink"><h1><i class="fas fa-hand-point-down"></i></h1></div>
                 </div>
        </center>
        <center><a class="btn btn-info btn-lg center-block" href="action.php">Load Shifts</a></center>
    </div>
  </div>
</body>
</html>
