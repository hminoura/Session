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

if (isset($_POST["sessionID"])) {
    $sessionID = $_POST["sessionID"];
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
    <h1>hidden attributeでショッピング</h1>
<?php
if ($user) {
?>
    <p><?php echo $user; ?>さんログイン中</p>
    <h2>メニュー</h2>
    <ul>
      <li><form action="shopping2.php" method="POST">
            <input type="hidden" name="sessionID" value="<?php echo $sessionID;?>">
            <input type="submit" value="ショッピング">
          </form>
      </li>
      <li>
        <form action="logout2.php" method="post">
          <input type="hidden" name="sessionID" value="<?php echo $sessionID;?>">
          <input type="submit" value="ログアウト">
        </form>
      </li>
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
