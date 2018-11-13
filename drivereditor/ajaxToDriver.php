<?php

if (isset($_POST))
{
    require_once 'driverClass.php';
    
    $data = json_decode($_POST['json'], true);
    
    $driver = new CDriver();
    $driver->readDriver($driver->toCSV($data));
    echo $driver->toCSV($data);
}