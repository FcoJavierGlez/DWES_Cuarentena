<?php
    $fileName=$_GET['src'];

    if (!empty($fileName)) {
        highlight_file($fileName);
    }
?>