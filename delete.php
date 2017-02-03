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
}

$st = "DELETE FROM weight WHERE id=" . $_SESSION['id'];
$result = $pdo->query($st);

echo '削除しました。';
