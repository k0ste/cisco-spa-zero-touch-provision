<?php
//MySQL
$mysql_host = 'database.company.local';
$mysql_user = 'user';
$mysql_pwd = 'passwd';
$mysql_db = 'www_asterisk';
//NTP
$ntpprimary = 'ru.pool.ntp.org';
$ntpsecondary = 'ntp1.stratum2.ru';
//SYSLOG
$syslogserver = 'syslog.company.local';
//SIP
$sipproxy = 'sip.company.local';
//LDAP
$ldapname = 'ldapname';
$ldapserver = 'ldap.company.local';
$ldapuser = 'ldapuser';
$ldappwd = 'ldappasswd';
$ldapsn = 'sn:(sn=*$VALUE*)';
$ldapcn = 'cn:(cn=*$VALUE*)';
$ldapdn = 'cn=ldapuser,ou=people,dc=company,dc=local';
$ldapsearch = 'ou=people,dc=company,dc=local';
$ldapfilter3 = 'telephonenumber:(telephonenumber=*$VALUE*)';
$ldapfilter4 = 'mobile:(mobile=*$VALUE*)';
$ldapdisplay3 = 'Exten';
$ldapdisplay4 = 'Mobile';
$ldapdisplay = 'a=givenName;a=telephoneNumber,n=Внутренний,t=p;a=mobile,n=Мобильный,t=p;';
//CISCO SPA
$admin_password = 'ciscoWEBpassword';
$textlogo = 'YouLogo';
$reg = '$VERSION ($MAU)';
$resync = 'http://cisco.company.local';
$mau = '$MAU';
$pn = '$PN';
$notify = '$NOTIFY';
$proxy = '$PROXY';
$upgrade_rule_SPA50x_30x = '( $SWVER lt 7.5.2b )? http://cisco.company.local/cisco/firmware/spa50x-30x-7-5-2b.bin | http://cisco.company.local/cisco/firmware/spa50x-30x-7-6-1.bin';
$upgrade_rule_SPA51x = 'http://cisco.company.local/cisco/firmware/spa51x-7-6-1.bin';
$dialplan = '(9xxxxxxxxxS0|8xxxxxxxxxxS0|7xxxxxxxxxxS0|xxxxxxxxxx)';
$dict = 'serv=http://cisco.company.local/cisco/dict/;d0=English;x0=spa50x_30x_en_v756.xml;d1=Russian;x1=spa50x_30x_ru_v756.xml;';
$deflanguage = 'Russian';
//SPEED DIAL
$speed_dial3 = '20473';
$speed_dial4 = '20474';
$speed_dial5 = '20475';
$speed_dial6 = '20666';
$speed_dial7 = '20777';
$speed_dial8 = '';
$speed_dial9 = '20911';
?>
