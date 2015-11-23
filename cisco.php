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

$link = mysql_connect($mysql_host, $mysql_user, $mysql_pwd);

if (!$link)
  exit('Error (' . mysql_errno() . '): ' . mysql_error(). "\n");
if (!mysql_select_db($mysql_db, $link))
  exit('Error (' . mysql_errno() . '): ' . mysql_error(). "\n");

mysql_query("SET NAMES 'utf8'");

$query = sprintf("
  SELECT
    spa.channel_def AS chan,
    spa.mac AS mac
  FROM
    cts_pbx_accounts spa
  WHERE spa.mac='%s'", mysql_real_escape_string($_GET['mac'], $link));

$result = mysql_query($query);

if($result == 0) {
  $channel = '0';
  $pass = '0';
  $state = 'WARNING (bad query)';
}
else if(($num_rows = mysql_num_rows($result)) == 0) {
  $channel = '0';
  $pass = '0';
  $state = 'CRITICAL (no chan found)';
}
else while($row = mysql_fetch_array($result)) {
  $channel = $row['chan'];
  $pass = $row['mac'];
  $state = 'OK (chan found)';
}

mysql_free_result($result);
mysql_close($link);

if($model == 'SPA514G') {
  $upgrade_rule = $upgrade_rule_SPA51x;
}
else {
  $upgrade_rule = $upgrade_rule_SPA50x_30x;
}

require_once 'cisco_settings.php';
?>
