<?php
if (isset($_COOKIE["lastvisit"]))
    $lastvisit = $_COOKIE["lastvisit"];
else
    $lastvisit = "訪問記録はありません";

if (isset($_COOKIE["visits"]))
    $visits = (int)$_COOKIE["visits"];
else
    $visits = 0;

$visits += 1;
setcookie("lastvisit", date("Y/m/d(D) H:i:s"));
setcookie("visits", $visits);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
    <p>前回の訪問日時：<?php echo $lastvisit; ?></p>
    <p><?php echo $visits; ?>回目の訪問です．</p>
  </body>
</html>


