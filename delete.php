<?php
$user = 'root';
$pass = '';
try{
$conn = new PDO('mysql:host=localhost:3306;dbname=androiddb', $user, $pass);
$sql = 'delete from user where id = :id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
$stmt -> execute();
}
catch (PDOException $pe){
die("Could not connect to the database :" . $pe->getMessage());
}
?>