<?php

foreach($_FILES as $key => $file)
{
    $fp = fopen($_FILES[$key]['tmp_name'], 'rb');
    while (($line = fgets($fp)) !== false)
    {
        echo $line;
    }
}