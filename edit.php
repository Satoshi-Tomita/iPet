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

      $st = "SELECT name FROM pet WHERE id=" . $_SESSION['id'];
      $result = $pdo->query($st);

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $name = $row['name'];

        echo '<div class="page-header"><h1>' . $name . '</h1></div>';
      }
    }
  ?>

        <div class="row">
          <div class="col-md-12">
            <form action="regist.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="image">画像</label>
                <input type="file" class="form-control" name="upfile" id="image">
              </div>
              <div class="form-group">
                <label for="date">日付</label>
                <input type="text" class="form-control" name="day" id="date" placeholder="日付">
              </div>
              <div class="form-group">
                <label for="weight">体重</label>
                <input type="text" class="form-control" name="weight" id="weight" placeholder="kg">
              </div>
              <button type="submit" class="btn btn-default">登録</button>
            </form>
          </div>
        </div>

        <hr />

  <?php
      $st = "SELECT * FROM weight WHERE pet_id=" . $_SESSION['id'];
      $result = $pdo->query($st);

      while($row = $result->fetch(PDO::FETCH_ASSOC)){
        $image_id = $row['id'];
        $image_path = $row['image'];
        $weight = $row['weight'];
        $day = $row['day'];

        echo '<div class="row">
          <div class="col-sm-4">
            <div class="thumbnail">
              <img src="' . $image_path . '">
              <div class="caption">
              <h4>' . $day . ' <small>' . $weight . 'kg</small></h4>
                <form action="delete.php?id=' . $image_id . '" method="post">
                <button class="btn btn-danger">削除</button>
                </form>
            </div>
          </div>
        </div>';
      }
  ?>
</div>

</body>
</html>
