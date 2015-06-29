<?php
include 'iotdb.php';
require(__DIR__ . '/spMQTT.class.php');
spMQTTDebug::Enable();
$mqtt = new spMQTT('tcp://localhost:1883/');
$connected = $mqtt->connect();
if (!$connected) {
    die("<span class='error'> Mosca MQTT Server is Offline\n</span>");
}

$mqtt->ping();



?>
