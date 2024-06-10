<?php

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$id = filter_input(INPUT_POST, 'id');

$sqlDeleteFavorites = "DELETE FROM page_favorites WHERE page_id = :page_id";
$statementDeleteFavorites = $pdo->prepare($sqlDeleteFavorites);
$statementDeleteFavorites->bindValue(':page_id', $id, PDO::PARAM_INT);
$statementDeleteFavorites->execute();

$sql = "DELETE FROM pages where id = $id";
$statement = $pdo->prepare($sql);
$statement->execute();

header('Location: ./index.php');
exit();
?>
