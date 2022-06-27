<?php
$pdo = new PDO("sqlite:account.sqlite3");

$user = null;
if (isset($_GET["sessionID"])) {
    $sessionID = $_GET["sessionID"];
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
    <h1>URL Rewritingでショッピング</h1>
<?php
if ($user) {
?>
    <p><?php echo $user; ?>さんログイン中</p>
    <h2>商品</h2>
    <form action="shopping1.php?sessionID=<?php echo $sessionID;?>" method="POST">
        <input type="radio" name="item" value="チョコ">チョコ<br>
        <input type="radio" name="item" value="ガム">ガム<br>
        <input type="submit" value="カートに追加">
    </form>

    <p>現在のカートの中身 : <?php echo $kart; ?></p>

    <a href="menu1.php?sessionID=<?php echo $sessionID;?>">メニューに戻る</a>
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
