<?php

function xss($get_data)
{
    return htmlentities($get_data, ENT_QUOTES, 'UTF-8');
}
