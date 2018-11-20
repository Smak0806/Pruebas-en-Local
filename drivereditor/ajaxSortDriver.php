<?php

if (isset($_POST))
{
    require_once 'driverClass.php';
    
    $data = json_decode($_POST['json'], true);
    $dictionaryGen = str_replace(array('\t','\n'), '', $_POST['dictionaryGen']);
    $dictionarySpec = str_replace(array('\t','\n'), '', $_POST['dictionarySpec']);
    $driver = new CDriver();
    $driver->readDriver($driver->toCSV($data));
    $driver->readDriver($driver->toCSV($data));
    $driver->addDictionary($dictionarySpec, 0);
    $driver->addDictionary($dictionaryGen, 1);
    $driver->sortDriver();
    echo $driver->printDriverTable();
}