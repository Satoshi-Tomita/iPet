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

if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
  $name = $_POST['name'];
  $img_path = "images/" . $_FILES['upfile']['name'];

  $st = "INSERT INTO pet(name, image) VALUES('" . $name . "','" . $img_path . "')";
  $result = $pdo->prepare($st);
  $result->execute();

  echo 'ファイルをアップロードしました。';
}else{
  echo 'ファイルが選択されていません。';
}
