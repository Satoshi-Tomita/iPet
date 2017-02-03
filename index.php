<!DOCTYPE html>
<html lang="en">
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
  </head>
  <body>
    <div class="container">
      <h1>iPet アプリ</h1>

      <div class="row">
        <div class="col-sm-12">
          <a href="admin.php" class="pull-right">管理画面へ</a>
        </div>
      </div>

      <hr />

	<?php
    $param = 'mysql:dbname=test;host=localhost';
    $user = 'root';
    $pass = '';

    try{
      $pdo = new PDO($param,$user, $pass,
      array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8' ")
      );
    }catch(PDOException $e){
      die($e->getMessage());
    }

    $st = $pdo->query("SELECT * FROM pet");

	  while($row = $st->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id'];
        $name = $row['name'];
        $image_path = $row['image'];

        echo '<div class="row">
          <div class="col-sm-4 col-md-4">
            <a href="dog.php?id=' . $id . '" class="thumbnail">
              <img src="' . $image_path . '">
              <div class="caption">
              <h3>' . $name .'</h3>
              </div>
            </a>
          </div>
    </div>';
    }
	?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
