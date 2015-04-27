<?php
//MySQL
$mysql_host = 'mysqlcompany.local';
$mysql_user = 'user';
$mysql_pwd = 'passwd';
$mysql_db = 'www_asterisk';
//NTP
$ntpprimary = 'ru.pool.ntp.org';
$ntpsecondary = 'ntp1.stratum2.ru';
//SYSLOG
$syslogserver = 'syslog.company.local';
//SIP
$sipproxy = 'asterisk.company.local';
//LDAP
$ldapname = 'e2e4';
$ldapserver = 'ldap.company.local';
$ldapuser = 'cisco';
$ldappwd = 'cisco';
$ldapsn = 'sn:(sn=*$VALUE*)';
$ldapcn = 'cn:(cn=*$VALUE*)';
$ldapdn = 'cn=cisco,ou=people,dc=company,dc=local';
$ldapsearch = 'ou=people,dc=company,dc=local';
$ldapfilter3 = 'telephonenumber:(telephonenumber=*$VALUE*)';
$ldapfilter4 = 'mobile:(mobile=*$VALUE*)';
$ldapdisplay3 = 'Exten';
$ldapdisplay4 = 'Mobile';
$ldapdisplay = 'a=givenName;a=telephoneNumber,n=Exten,t=p;a=mobile,n=Mobile,t=p;';
//CISCO SPA
$textlogo = 'YouLogo';
$reg = '$VERSION ($MAU)';
$resync = 'http://asterisk.company.local';
$mau = '$MAU';
$notify = '$NOTIFY';
$proxy = '$PROXY';
$upgrade_rule = '( $SWVER lt 7.5.2b )? http://asterisk.company.local/cisco/firmware/spa50x-30x-7-5-2b.bin | http://asterisk.company.local/cisco/firmware/spa50x-30x-7-5-7s.bin';
$dialplan = '(9xxxxxxxxxS0|8xxxxxxxxxxS0|7xxxxxxxxxxS0|xxxxxxxxxx)';
$dict = 'serv=http://asterisk.company.local/cisco/dict/;d0=English;x0=spa50x_30x_en_v756.xml;d1=Russian;x1=spa50x_30x_ru_v756.xml;';
$deflanguage = 'Russian';
?>
