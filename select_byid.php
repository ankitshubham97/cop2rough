<?php
$user = 'root';
$pass = '';
try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=androiddb', $user, $pass);
    $sql = 'select * from user where id= :id';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_STR);
	$stmt ->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$row =json_encode($result);
	echo $row;
 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>