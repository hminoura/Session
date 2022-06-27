<?php
$pdo = new PDO("sqlite:account.sqlite3");
$query = "CREATE TABLE IF NOT EXISTS account (user TEXT, password TEXT, sessionID TEXT, kart TEXT)";
$pdo->exec($query);
$query = "DELETE FROM account";
$pdo->exec($query);

$messages = array(
    ["userA", "pass", "AAAAAA"],
    ["userB", "passpass", "BBBBBB"],
);

$query = "INSERT INTO account (user, password, sessionID) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($query);
foreach($messages as $message) {
    $stmt->execute($message);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <p>データベースを初期化しました．</p>
    <a href="login.php">ログインページに戻る</a>
  </body>
</html>
