<?php

function placeholder_helper($text = '', $err_msg = '')
{
    if ($err_msg) {
        $message = $err_msg;
    } else {
        $message = $text;
    }
    $null = "''";
    echo 'placeholder="' . $message . '" onclick="this.placeholder=' . $null . '" onblur="this.placeholder=' . "'$message'" . '"';
}
