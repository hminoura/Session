<?php
$pdo = new PDO("sqlite:account.sqlite3");

$user = null;
if (isset($_POST["sessionID"])) {
    $sessionID = $_POST["sessionID"];
    $query = "SELECT user,kart FROM account WHERE sessionID=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($sessionID));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $user = $result["user"];
        $kart = $result["kart"];
    }
}
    
if (isset($_POST["item"])) {
    $kart = $kart . " " . $_POST["item"];
    $query = "UPDATE account SET kart=? WHERE sessionID=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($kart, $sessionID));
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
    <h2>商品</h2>
    <form action="shopping2.php" method="POST">
        <input type="hidden" name="sessionID" value="<?php echo $sessionID;?>">
        <input type="radio" name="item" value="チョコ">チョコ<br>
        <input type="radio" name="item" value="ガム">ガム<br>
        <input type="submit" value="カートに追加">
    </form>

    <p>現在のカートの中身 : <?php echo $kart; ?></p>

    <form action="menu2.php" method="post">
        <input type="hidden" name="sessionID" value="<?php echo $sessionID;?>">
        <input type="submit" value="メニューに戻る">
    </form>
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
