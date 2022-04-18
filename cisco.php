<?php
require_once 'cisco.cfg.php';

if (empty($_GET['mac']))
exit('CRITICAL (MAC not present)');
if (empty($_GET['model'])) {
  $model = '';
}
else {
  $model = $_GET['model'];
}

$link = mysqli_connect($mysql_host, $mysql_user, $mysql_pwd, $mysql_db);

if (!$link)
  exit('Connection error: ' . mysqli_connect_error() . "\n");

mysqli_query($link, "SET NAMES 'utf8'");

$query = sprintf("
  SELECT
    spa.channel_def AS chan,
    spa.mac AS mac,
    spa.exten AS callerid
  FROM
    cts_pbx_accounts spa
  WHERE spa.mac='%s'", mysqli_real_escape_string($link, $_GET['mac']));

$result = mysqli_query($link, $query);

if($result == false) {
  $channel = '0';
  $pass = '0';
  $callerid = '';
  $state = 'WARNING (bad query)';
}
else if(($num_rows = mysqli_num_rows($result)) == 0) {
  $channel = '0';
  $pass = '0';
  $callerid = '';
  $state = 'CRITICAL (no chan found)';
}
else while($row = mysqli_fetch_array($result)) {
  $channel = $row['chan'];
  $pass = $row['mac'];
  $callerid = $row['callerid'];
  $state = 'OK (chan found)';
}

mysqli_free_result($result);
mysqli_close($link);

if($model == 'SPA514G') {
  $upgrade_rule = $upgrade_rule_SPA51x;
}
else {
  $upgrade_rule = $upgrade_rule_SPA50x_30x;
}

require_once 'cisco_settings.php';
?>
