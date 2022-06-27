<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>ログイン</h1>
    <h2>URL Rewritingでショッピング</h2>
    <form action="menu1.php" method="POST">
        <label>user:</label>
        <input type="text" name="user">
        <label>password:</label>
        <input type="password" name="password">
        <input type="submit" value="login">
    </form>

    <h2>hidden attributeでショッピング</h2>
    <form action="menu2.php" method="POST">
        <label>user:</label>
        <input type="text" name="user">
        <label>password:</label>
        <input type="password" name="password">
        <input type="submit" value="login">
    </form>

    <h2>HTTP cookieでショッピング</h2>
    <form action="menu3.php" method="POST">
        <label>user:</label>
        <input type="text" name="user">
        <label>password:</label>
        <input type="password" name="password">
        <input type="submit" value="login">
    </form>
    <hr>
    <h3>（データベースのユーザ情報）</h3>
<?php
$pdo = new PDO("sqlite:account.sqlite3");
$query = "SELECT * FROM account";
$stmt = $pdo->prepare($query);
if ($stmt) {
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
        printf("    <p>user: %s, password: %s, sessionID: %s, kart: %s</p>\n",
               $result["user"], $result["password"], $result["sessionID"], $result["kart"]);
} else
    print("    <p>データベースの初期化をしてください</p>\n");
?>
    <a href="setupDB.php">データベースの初期化</a>
  </body>
</html>
