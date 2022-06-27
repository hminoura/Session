<?php
$pdo = new PDO("sqlite:account.sqlite3");

$user = null;
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
    <p><?php echo $user; ?>さんログアウトしました</p>
    <a href="login.php">ログインメニューへ</a>
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
