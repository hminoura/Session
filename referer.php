<?php
if (isset($_SERVER["HTTP_REFERER"])) {
    echo "あなたは";
    echo $_SERVER["HTTP_REFERER"];
    echo "から来ました。";
} else
    echo "refererがないのでどこから来たかわかりません。";
?>
    
