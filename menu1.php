<?php
$pdo = new PDO("sqlite:account.sqlite3");

$user = null;
if (isset($_POST["user"]) && isset($_POST["password"])) {
    $query = "SELECT sessionID FROM account WHERE user=? AND password=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_POST["user"], $_POST["password"]));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $user = $_POST["user"];
        $sessionID = $result["sessionID"];
    }
}

if (isset($_GET["sessionID"])) {
    $sessionID = $_GET["sessionID"];
    $query = "SELECT user FROM account WHERE sessionID=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($sessionID));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result)
        $user = $result["user"];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <h1>URL Rewritingでショッピング</h1>
<?php
if ($user) {
?>
    <p><?php echo $user; ?>さんログイン中</p>
    <h2>メニュー</h2>
    <ul>
      <li><a href="shopping1.php?sessionID=<?php echo $sessionID;?>">ショッピング</a></li>
      <li><a href="logout1.php?sessionID=<?php echo $sessionID;?>">ログアウト</a></li>
      <li><a href="referer.php">別サイト</a></li>
    </ul>
<?php
} else {
?>
    <p>ログインエラー</p>
    <a href="login.php">ログイン画面に戻る</a>

<?php  
}
?>
  </body>
</html>
