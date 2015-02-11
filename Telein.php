#!/usr/bin/php
<?php
require_once ('/usr/share/a2billing/common/lib/phpagi/phpagi.php');
$agi = new AGI();
$agi->verbose("CALLER ID: " . $agi->request[agi_callerid]);
$callerid = $agi->request["agi_callerid"];
$agi->verbose("EXTENSION: " . $agi->request[agi_extension]);
$extension = $agi->request[agi_extension];
$consulta = exec("php /var/lib/asterisk/agi-bin/consulta.php $extension");
$operadora = explode("#", $consulta);
$agi->exec('Dial', "Local/$operadora[0]$operadora[1]@from-internal");
$agi->verbose("Numero Consultado: " . $consulta);
$agi->hangup();
exit();
?>
