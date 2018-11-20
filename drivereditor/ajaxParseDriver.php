<?php
if (isset($_POST))
{
    require_once 'driverClass.php';
    
    $data = $_POST['driver'];
    $dictionaryGen = str_replace(array('\t','\n'), '', $_POST['dictionaryGen']);
    $dictionarySpec = str_replace(array('\t','\n'), '', $_POST['dictionarySpec']);
    
    $driver = new CDriver();
    $driver->readDriver($data);
    $driver->addDictionary($dictionarySpec, 0);
    $driver->addDictionary($dictionaryGen, 1);
    
    echo $driver->printDriverTable();
}