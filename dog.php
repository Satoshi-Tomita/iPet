<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Bootstrap 101 Template</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
</head>
<body>

<div class="container">

<?php
  $param = 'mysql:dbname=test;host=localhost';
  $user = 'root';
  $pass = '';

  session_name('pet');
  session_start();

  if(isset($_GET['id'])){
    $_SESSION['id'] = $_GET['id'];
  }

  if(isset($_SESSION['id'])){
    try{
      $pdo = new PDO($param,$user, $pass,
      array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8' ")
      );
    }catch(PDOException $e){
      die($e->getMessage());
    }

    $st = $pdo->query("SELECT * FROM pet WHERE id=" . $_SESSION['id']);

    while($row = $st->fetch(PDO::FETCH_ASSOC)){
      $name = htmlspecialchars($row['name']);
      echo '<div class="page-header"><h1>' . $name . '</h1></div>';
    }
  }
?>
    <div class="row">
        <div class="col-md-12">
            <canvas id="chart"></canvas>
        </div>
    </div>

    <hr />

<?php
  $st = $pdo->query("SELECT * FROM weight WHERE pet_id=" . $_SESSION['id']);

  while($row = $st->fetch(PDO::FETCH_ASSOC)){
    $image_path = $row['image'];
    $weight = $row['weight'];
    $day = $row['day'];

    echo '<div class="row">
    <div class="col-sm-4">
      <div class="thumbnail">
        <img src="' . $image_path . '">
        <div class="caption">
        <h4>' . $day . ' <small>' . $weight . 'kg</small></h4>
      </div>
    </div>
    </div>';
  }
?>

</div>
<?php
$data = $pdo->query("SELECT * FROM weight WHERE pet_id=" . $_SESSION['id']);
?>
<script>
var myLabels=[<?php
while($info = $data->fetch(PDO::FETCH_ASSOC)){
  echo '"' . $info['day'] . '",';
}
?>];
<?php
$data = $pdo->query("SELECT * FROM weight WHERE pet_id=" . $_SESSION['id']);
?>
var myData=[<?php
  while($info = $data->fetch(PDO::FETCH_ASSOC)){
    echo $info['weight'] . ',';
  }
?>];
var ctx = document.getElementById('chart');
var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels:myLabels,
        datasets: [{
            label: 'weight',
            fill: false,
            data:myData
        }]
    }
});
  // var chart = new Chart(ctx, {
  //     type: 'line',
  //     data: data
  // })";
</script>
</body>
</html>
