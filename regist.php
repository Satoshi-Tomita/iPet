<?php
$param = 'mysql:dbname=test;host=localhost';
$user = 'root';
$pass = '';

session_name('pet');
session_start();

if(isset($_SESSION['id'])){
  try{
    $pdo = new PDO($param,$user, $pass,
    array(
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET 'utf8' ")
    );
  }catch(PDOException $e){
    die($e->getMessage());
  }
}

if(is_uploaded_file($_FILES['upfile']['tmp_name'])){
  $id = $_SESSION['id'];
  $img_path = "images/" . $_FILES['upfile']['name'];
  $day = $_POST['day'];
  $weight = $_POST['weight'];

  $st = "INSERT INTO weight(pet_id, image, day, weight) VALUES('" . $id . "','" . $img_path . "','" . $day . "','" . $weight . "')";
  $result = $pdo->prepare($st);
  $result->execute();

  echo 'ファイルをアップロードしました。';
}else{
  echo 'ファイルが選択されていません。';
}
