<?php
require_once 'cisco.cfg.php';

if (empty($_GET['mac']))
exit('CRITICAL (MAC not present)');

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
else if(($num_rows =  mysql_num_rows($result)) == 0) {
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

header("Content-Type: text/xml; charset=UTF-8");
echo <<<XML
<flat-profile>
//SYSTEM
//Web
  <Enable_Web_Server ua="na">Yes</Enable_Web_Server>
  <Web_Server_Port ua="na">80</Web_Server_Port>
  <Enable_Web_Admin_Access ua="na">Yes</Enable_Web_Admin_Access>
  <Admin_Passwd ua="na"></Admin_Passwd>
  <User_Password ua="rw"></User_Password>
//Network
  <Connection_Type ua="rw">DHCP</Connection_Type>
  <Use_Backup_IP ua="na">No</Use_Backup_IP>
  <Static_IP ua="rw"></Static_IP>
  <NetMask ua="rw"></NetMask>
  <Gateway ua="rw"></Gateway>
  <HostName ua="rw"></HostName>
  <Domain ua="rw"></Domain>
  <Enable_SSLv3 ua="na">No</Enable_SSLv3>
//VLAN
  <Enable_VLAN ua="na">No</Enable_VLAN>
  <VLAN_ID ua="na">1</VLAN_ID>
  <PC_Port_VLAN_Highest_Priority ua="na">No Limit</PC_Port_VLAN_Highest_Priority>
  <Enable_PC_Port_VLAN_Tagging ua="na">No</Enable_PC_Port_VLAN_Tagging>
  <PC_Port_VLAN_ID ua="na">1</PC_Port_VLAN_ID>
//CDP
  <Enable_CDP ua="na">Yes</Enable_CDP>
//NTP
  <NTP_Enable ua="na">Yes</NTP_Enable>
  <Primary_NTP_Server ua="na">$ntpprimary</Primary_NTP_Server>
  <Secondary_NTP_Server ua="na">$ntpsecondary</Secondary_NTP_Server>
//Syslog
  <Syslog_Server ua="na">$syslogserver</Syslog_Server>
  <Debug_Server ua="na"></Debug_Server>
  <Debug_Level ua="na">0</Debug_Level>
  <Layer_2_Logging ua="na">No</Layer_2_Logging>
//SIP
  <SIP_Reg_User_Agent_Name ua="na">$reg</SIP_Reg_User_Agent_Name>
//EXT2-4
//Disable 2-4 lines
  <Line_Enable_2_ ua="na">No</Line_Enable_2_>
  <Line_Enable_3_ ua="na">No</Line_Enable_3_>
  <Line_Enable_4_ ua="na">No</Line_Enable_4_>
//EXT1
//Enable 1st line
  <Line_Enable_1_ ua="na">Yes</Line_Enable_1_>
//Network
  <Proxy_1_ ua="na">$sipproxy</Proxy_1_>
  <SIP_Port_1_ ua="na">5060</SIP_Port_1_>
  <SIP_Transport_1_ ua="na">UDP</SIP_Transport_1_>
  <Register_Expires_1_ ua="na">300</Register_Expires_1_>
  <Auto_Register_When_Failover_1_ ua="na">Yes</Auto_Register_When_Failover_1_>
  <NAT_Keep_Alive_Enable_1_ ua="na">No</NAT_Keep_Alive_Enable_1_>
  <NAT_Keep_Alive_Msg_1_ ua="na">$notify</NAT_Keep_Alive_Msg_1_>
  <NAT_Keep_Alive_Dest_1_ ua="na">$proxy</NAT_Keep_Alive_Dest_1_>
  <SIP_TOS_DiffServ_Value_1_ ua="na">0x68</SIP_TOS_DiffServ_Value_1_>
  <SIP_CoS_Value_1_ ua="na">3</SIP_CoS_Value_1_>
  <RTP_TOS_DiffServ_Value_1_ ua="na">0xb8</RTP_TOS_DiffServ_Value_1_>
  <RTP_CoS_Value_1_ ua="na">6</RTP_CoS_Value_1_>
  <Network_Jitter_Level_1_ ua="na">high</Network_Jitter_Level_1_>
  <Jitter_Buffer_Adjustment_1_ ua="na">up and down</Jitter_Buffer_Adjustment_1_>
//Auth
  <User_ID_1_ ua="na">$channel</User_ID_1_>
  <Password_1_ ua="na">$pass</Password_1_>
//Settings
  <Default_Ring__1__ ua="rw">No Ring</Default_Ring__1__>
  <Dial_Plan_1_ ua="na">$dialplan</Dial_Plan_1_>
//Codecs
  <G711u_Enable_1_ ua="na">Yes</G711u_Enable_1_>
  <G711a_Enable_1_ ua="na">Yes</G711a_Enable_1_>
  <G729a_Enable_1_ ua="na">No</G729a_Enable_1_>
  <G723_Enable_1_ ua="na">No</G723_Enable_1_>
  <G722_Enable_1_ ua="na">No</G722_Enable_1_>
  <L16_Enable_1_ ua="na">No</L16_Enable_1_>
  <AMR-WB_Enable_1_ ua="na">No</AMR-WB_Enable_1_>
  <G726-16_Enable_1_ ua="na">No</G726-16_Enable_1_>
  <G726-24_Enable_1_ ua="na">No</G726-24_Enable_1_>
  <G726-32_Enable_1_ ua="na">No</G726-32_Enable_1_>
  <G726-40_Enable_1_ ua="na">No</G726-40_Enable_1_>
  <Preferred_Codec_1_ ua="na">G711a</Preferred_Codec_1_>
  <Use_Pref_Codec_Only_1_ ua="na">No</Use_Pref_Codec_Only_1_>
  <Second_Preferred_Codec_1_ ua="na">G711u</Second_Preferred_Codec_1_>
  <Third_Preferred_Codec_1_ ua="na">Unspecified</Third_Preferred_Codec_1_>
//PROVISION
  <Provision_Enable ua="na">Yes</Provision_Enable>
  <DHCP_Option_To_Use ua="na">66,160,159,150,60,43,125</DHCP_Option_To_Use>
  <Upgrade_Rule ua="na">$upgrade_rule</Upgrade_Rule>
  <Profile_Rule ua="na">$resync/cisco/cisco.php?mac=$mau</Profile_Rule>
  <Profile_Rule_B ua="na"/>
  <Profile_Rule_C ua="na"/>
  <Profile_Rule_D ua="na"/>
  <Resync_On_Reset ua="na">Yes</Resync_On_Reset>
  <Resync_Periodic ua="na">3600</Resync_Periodic>
  <Forced_Resync_Delay ua="na">1800</Forced_Resync_Delay>
  <Resync_Fails_On_FNF ua="na">Yes</Resync_Fails_On_FNF>
  <Resync_Error_Retry_Delay ua="na">60</Resync_Error_Retry_Delay>
//Regional
//Language
  <Dictionary_Server_Script ua="na">$dict</Dictionary_Server_Script>
  <Language_Selection ua="na">$deflanguage</Language_Selection>
  <Default_Character_Encoding ua="na">UTF-8</Default_Character_Encoding>
  <Locale ua="na">ru-RU</Locale>
//Time
  <Time_Zone ua="na">GMT</Time_Zone>
  <Ignore_DHCP_Time_Offset ua="na">No</Ignore_DHCP_Time_Offset>
//PHONE
//Line Keys
  <Extension_1_ ua="na">1</Extension_1_>
  <Short_Name_1_ ua="na">$state</Short_Name_1_>
  <Extension_2_ ua="na">Disabled</Extension_2_>
  <Extension_3_ ua="na">Disabled</Extension_3_>
  <Extension_4_ ua="na">Disabled</Extension_4_>
//Logo
  <Text_Logo ua="na">$textlogo</Text_Logo>
  <Select_Background_Picture ua="na">Text Logo</Select_Background_Picture>
  <Softkey_Labels_Font ua="na">Auto</Softkey_Labels_Font>
  <Screen_Saver_Enable ua="na">No</Screen_Saver_Enable>
//OpenLDAP
  <LDAP_Dir_Enable ua="na">Yes</LDAP_Dir_Enable>
  <LDAP_Corp_Dir_Name ua="na">$ldapname</LDAP_Corp_Dir_Name>
  <LDAP_Server ua="na">$ldapserver</LDAP_Server>
  <LDAP_Auth_Method ua="na">Simple</LDAP_Auth_Method>
  <LDAP_Client_DN ua="na">$ldapdn</LDAP_Client_DN>
  <LDAP_Username ua="na">$ldapuser</LDAP_Username>
  <LDAP_Password ua="na">$ldappwd</LDAP_Password>
  <LDAP_Search_Base ua="na">$ldapsearch</LDAP_Search_Base>
  <LDAP_Last_Name_Filter ua="na">$ldapsn</LDAP_Last_Name_Filter>
  <LDAP_First_Name_Filter ua="na">$ldapcn</LDAP_First_Name_Filter>
  <LDAP_Search_Item_3 ua="na">$ldapdisplay3</LDAP_Search_Item_3>
  <LDAP_Item_3_Filter ua="na">$ldapfilter3</LDAP_Item_3_Filter>
  <LDAP_Search_Item_4 ua="na">$ldapdisplay4</LDAP_Search_Item_4>
  <LDAP_item_4_Filter ua="na">$ldapfilter4</LDAP_item_4_Filter>
  <LDAP_Display_Attrs ua="na">$ldapdisplay</LDAP_Display_Attrs>
  <LDAP_Number_Mapping ua="na"/>
//USER
//Speed Dial
  <Speed_Dial_3 ua="na">20473</Speed_Dial_3>
  <Speed_Dial_4 ua="na">20474</Speed_Dial_4>
  <Speed_Dial_5 ua="na">20475</Speed_Dial_5>
  <Speed_Dial_6 ua="na">20666</Speed_Dial_6>
  <Speed_Dial_7 ua="na"/>
  <Speed_Dial_8 ua="na"/>
  <Speed_Dial_9 ua="na">20911</Speed_Dial_9>
//Call Waiting
  <CW_Setting ua="rw">No</CW_Setting>
  <Preferred_Audio_Device ua="na">Headset</Preferred_Audio_Device>
//Time
  <Time_Format ua="rw">24hr</Time_Format>
  <Date_Format ua="rw">day/month</Date_Format>
//LCD
  <LCD_Contrast ua="na">5</LCD_Contrast>
  <Back_Light_Timer ua="na">20 s</Back_Light_Timer>
</flat-profile>
XML;
?>
