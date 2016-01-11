<?php

define("BACKUP_PATH", "/var/www/html/");

$server_name   = "localhost";
$username      = "root";
$password      = "1234";
$database_name = "presupuestooaf";
$date_string   = date("d-m-Y");

$cmd = "mysqldump --hex-blob --routines --skip-lock-tables --log-error=mysqldump_error.log -h {$server_name} -u {$username} -p{$password} {$database_name} > " . BACKUP_PATH . "Backup-{$date_string}_{$database_name}.sql";

$arr_out = array();
unset($return);

exec($cmd, $arr_out, $return);

if($return !== 0) {
    echo "mysqldump for {$server_name} : {$database_name} failed with a return code of {$return}\n\n";
    echo "Descripcion del error:\n";
    $file = escapeshellarg("mysqldump_error.log");
    $message = `tail -n 1 $file`;
    echo "- $message\n\n";
}else{

	echo "Se completo correctamente el respaldo de ".$database_name;
}
?>