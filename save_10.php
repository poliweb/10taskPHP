<?php
    session_start();

    $text = $_POST['text'];
    $pdo = new PDO("mysql:host=localhost; dbname=assignments;", "root", "root");

    $sql = "SELECT * FROM my_table WHERE text=:text";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);
    $task = $statement->fetch(pdo::FETCH_ASSOC);

if(!empty($task)) {
    $massage="Введёная запись уже присудствует в таблице!";
    $_SESSION['danger'] = $massage;

    header("Location: /task_10.php");
    exit;
}

    $sql = "INSERT INTO my_table (text) VALUES (:text)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['text' => $text]);

    $massage="Запись добавлена!";
    $_SESSION['success'] = $massage;

    header("Location: /task_10.php");

?>
