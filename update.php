<?php
$user = 'root';
$pass = '';
try{
$conn = new PDO('mysql:host=localhost:3306;dbname=androiddb', $user, $pass);
$sql = 'update user set name = :name,password = :password, hostel = :hostel where id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
$stmt->bindParam(':name', $_GET['name'], PDO::PARAM_STR);
$stmt->bindParam(':hostel', $_GET['hostel'], PDO::PARAM_STR);
$stmt->bindParam(':password', $_GET['password'], PDO::PARAM_STR);
$stmt -> execute();
}
catch (PDOException $pe){
die("Could not connect to the database :" . $pe->getMessage());
}
?>