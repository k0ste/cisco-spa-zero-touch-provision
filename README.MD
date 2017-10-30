Zero Touch Provision Cisco SPA SIP phones
=============================================

What is it
------------

Automate Cisco SIP terminal configuration without actually touch of device.

Supported Devices
--------------------

* Cisco SPA303G
* Cisco SPA504G
* Cisco SPA508G
* Cisco SPA509G
* Cisco SPA514G

Requirements
---------------

* PHP 7;
* nginx;
* dhcpd;
* MySQL database (simply can be adapted to any database);

dhcpd configuration example
-------------------------------

```python
option opt66 code 66 = string;

class "CiscoSPA" {
  match if option vendor-class-identifier ~= "^(Cisco SPA)[0-9]+(G|)$";
  option opt66 "http://automation.company.local/cisco/cisco.php?mac=$MAU&model=$PN";
  option time-offset 25200;
}

# voice_vlan
subnet 10.10.10.0 netmask 255.255.255.192 {
  interface "vlan10";
  option routers 10.10.10.1;
  option domain-name-servers 10.10.10.1;
  option domain-name "voice.company.local";
  option ntp-servers pool.ntp.org;
  pool {
    allow members of "CiscoSPA";
    # in this example - all hosts have fixed_adderss, and pool is only need for class work
    range 10.10.10.1 10.10.10.1;
  }
}
```
