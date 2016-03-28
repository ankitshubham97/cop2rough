<?php
$user = 'root';
$pass = '';
try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=androiddb', $user, $pass);
    $sql = 'select * from user';
	$result = $conn->prepare($sql);
	$result ->execute();
	$results = $result->fetchAll(PDO::FETCH_ASSOC);
	$row =json_encode($results);
	echo $row;
 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>