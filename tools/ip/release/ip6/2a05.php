<?php

/**
 * @Project NUKEVIET 4.x
 * @This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com
 * @Createdate Fri, 08 Jun 2018 08:58:59 GMT
 */

$ranges = array('2a05::/29'=>'BE','2a05:40::/29'=>'IT','2a05:80::/29'=>'CH','2a05:c0::/29'=>'DK','2a05:100::/29'=>'GB','2a05:140::/29'=>'DE','2a05:1c0::/29'=>'GB','2a05:200::/29'=>'BE','2a05:240::/29'=>'NL','2a05:2c0::/29'=>'CZ','2a05:300::/29'=>'TR','2a05:340::/29'=>'ES','2a05:380::/29'=>'DE','2a05:3c0::/29'=>'BE','2a05:400::/29'=>'DE','2a05:440::/29'=>'PL','2a05:480::/29'=>'UA','2a05:4c0::/29'=>'IQ','2a05:500::/29'=>'UA','2a05:540::/29'=>'RU','2a05:580::/29'=>'AE','2a05:5c0::/29'=>'ES','2a05:640::/29'=>'DE','2a05:680::/29'=>'NL','2a05:6c0::/29'=>'DE','2a05:700::/29'=>'LU','2a05:740::/29'=>'BE','2a05:780::/29'=>'FR','2a05:7c0::/29'=>'DE','2a05:800::/29'=>'TR','2a05:840::/30'=>'NL','2a05:860::/30'=>'RU','2a05:880::/29'=>'DE','2a05:8c0::/29'=>'ES','2a05:900::/29'=>'DE','2a05:940::/29'=>'GB','2a05:980::/29'=>'SK','2a05:9c0::/29'=>'FR','2a05:a00::/29'=>'PL','2a05:a40::/29'=>'IR','2a05:a80::/29'=>'IR','2a05:ac0::/29'=>'IR','2a05:b00::/29'=>'UA','2a05:b40::/29'=>'NL','2a05:b80::/29'=>'RU','2a05:bc0::/29'=>'DE','2a05:c00::/29'=>'NO','2a05:c80::/29'=>'ES','2a05:cc0::/29'=>'GB','2a05:d00::/29'=>'CH','2a05:d40::/29'=>'FR','2a05:d80::/29'=>'FR','2a05:dc0::/29'=>'ES','2a05:e00::/29'=>'FR','2a05:e40::/29'=>'AT','2a05:e80::/29'=>'TR','2a05:ec0::/29'=>'NO','2a05:f00::/29'=>'DE','2a05:f40::/29'=>'FR','2a05:f80::/29'=>'GB','2a05:1000::/29'=>'FR','2a05:1040::/29'=>'GB','2a05:10c0::/29'=>'IT','2a05:1100::/29'=>'RU','2a05:1140::/29'=>'AT','2a05:1180::/29'=>'NL','2a05:11c0::/29'=>'GB','2a05:1200::/30'=>'CZ','2a05:1220::/30'=>'CZ','2a05:1240::/29'=>'DE','2a05:1280::/29'=>'CH','2a05:12c0::/29'=>'ES','2a05:1300::/29'=>'GB','2a05:1340::/29'=>'IR','2a05:13c0::/29'=>'GB','2a05:1400::/29'=>'AT','2a05:1440::/29'=>'IR','2a05:1480::/29'=>'PL','2a05:14c0::/29'=>'CH','2a05:1500::/29'=>'DE','2a05:1540::/29'=>'PL','2a05:1580::/29'=>'LT','2a05:15c0::/29'=>'DE','2a05:1600::/29'=>'LU','2a05:1640::/29'=>'CH','2a05:1680::/29'=>'GB','2a05:16c0::/29'=>'NL','2a05:1700::/29'=>'RU','2a05:1740::/29'=>'GB','2a05:17c0::/29'=>'NL','2a05:1800::/29'=>'FR','2a05:1840::/29'=>'HR','2a05:1880::/29'=>'IT','2a05:18c0::/29'=>'IT','2a05:1900::/29'=>'RU','2a05:1940::/29'=>'DK','2a05:1980::/29'=>'NO','2a05:19c0::/29'=>'NL','2a05:1a00::/26'=>'IR','2a05:1c00::/29'=>'RO','2a05:1c40::/29'=>'CZ','2a05:1c80::/29'=>'GB','2a05:1cc0::/29'=>'EE','2a05:1d00::/29'=>'GB','2a05:1d40::/30'=>'CZ','2a05:1d80::/29'=>'TR','2a05:1dc0::/29'=>'IE','2a05:1e00::/29'=>'CH','2a05:1e40::/29'=>'FR','2a05:1e80::/29'=>'NL','2a05:1ec0::/29'=>'FR','2a05:1f00::/29'=>'GB','2a05:1f40::/29'=>'FI','2a05:1f80::/29'=>'BA','2a05:1fc0::/29'=>'RO','2a05:2000::/29'=>'SE','2a05:2040::/29'=>'ES','2a05:2080::/29'=>'GB','2a05:20c0::/29'=>'DE','2a05:2100::/29'=>'CZ','2a05:2140::/29'=>'SK','2a05:2180::/29'=>'TM','2a05:21c0::/29'=>'SE','2a05:2200::/29'=>'NL','2a05:2240::/29'=>'SE','2a05:2280::/29'=>'SI','2a05:22c0::/29'=>'NL','2a05:2300::/29'=>'NL','2a05:2340::/29'=>'DE','2a05:2380::/29'=>'BE','2a05:23c0::/29'=>'IT','2a05:2400::/29'=>'PL','2a05:2440::/29'=>'SE','2a05:2480::/29'=>'AE','2a05:24c0::/29'=>'NL','2a05:2500::/29'=>'NL','2a05:2540::/29'=>'IE','2a05:2580::/29'=>'UA','2a05:25c0::/29'=>'KW','2a05:2600::/29'=>'BE','2a05:2640::/29'=>'FR','2a05:2680::/29'=>'GB','2a05:26c0::/29'=>'GB','2a05:2700::/29'=>'CH','2a05:2740::/29'=>'CH','2a05:2780::/29'=>'IT','2a05:2800::/29'=>'IE','2a05:2840::/29'=>'NO','2a05:2880::/29'=>'BE','2a05:28c0::/29'=>'BG','2a05:2900::/29'=>'NL','2a05:2940::/29'=>'RU','2a05:2980::/29'=>'DE','2a05:29c0::/29'=>'UA','2a05:2a00::/29'=>'GB','2a05:2a40::/29'=>'TR','2a05:2a80::/29'=>'DE','2a05:2ac0::/29'=>'ES','2a05:2b00::/29'=>'GB','2a05:2b40::/29'=>'GB','2a05:2bc0::/29'=>'GB','2a05:2c00::/30'=>'CZ','2a05:2c20::/30'=>'CZ','2a05:2c40::/29'=>'DE','2a05:2c80::/29'=>'LB','2a05:2cc0::/29'=>'NL','2a05:2d00::/32'=>'GB','2a05:2d01::/48'=>'US','2a05:2d01:1::/48'=>'NL','2a05:2d01:2::/47'=>'NL','2a05:2d01:4::/46'=>'NL','2a05:2d01:8::/45'=>'NL','2a05:2d01:10::/44'=>'NL','2a05:2d01:20::/43'=>'NL','2a05:2d01:40::/42'=>'NL','2a05:2d01:80::/41'=>'NL','2a05:2d01:100::/40'=>'NL','2a05:2d01:200::/39'=>'NL','2a05:2d01:400::/38'=>'NL','2a05:2d01:800::/37'=>'NL','2a05:2d01:1000::/36'=>'NL','2a05:2d01:2000::/44'=>'NL','2a05:2d01:2010::/46'=>'NL','2a05:2d01:2014::/47'=>'NL','2a05:2d01:2016::/48'=>'NL','2a05:2d01:2017::/49'=>'NO','2a05:2d01:2017:8000::/49'=>'NL','2a05:2d01:2018::/45'=>'NL','2a05:2d01:2020::/43'=>'NL','2a05:2d01:2040::/42'=>'NL','2a05:2d01:2080::/41'=>'NL','2a05:2d01:2100::/40'=>'NL','2a05:2d01:2200::/39'=>'NL','2a05:2d01:2400::/38'=>'NL','2a05:2d01:2800::/37'=>'NL','2a05:2d01:3000::/36'=>'NL','2a05:2d01:4000::/34'=>'NL','2a05:2d01:8000::/36'=>'NL','2a05:2d01:9000::/48'=>'GB','2a05:2d01:9001::/48'=>'NL','2a05:2d01:9002::/47'=>'NL','2a05:2d01:9004::/46'=>'NL','2a05:2d01:9008::/45'=>'NL','2a05:2d01:9010::/44'=>'NL','2a05:2d01:9020::/43'=>'NL','2a05:2d01:9040::/42'=>'NL','2a05:2d01:9080::/41'=>'NL','2a05:2d01:9100::/40'=>'NL','2a05:2d01:9200::/39'=>'NL','2a05:2d01:9400::/38'=>'NL','2a05:2d01:9800::/37'=>'NL','2a05:2d01:a000::/35'=>'NL','2a05:2d01:c000::/34'=>'NL','2a05:2d02::/31'=>'NL','2a05:2d04::/31'=>'NL','2a05:2d06::/32'=>'NL','2a05:2d07::/32'=>'FR','2a05:2d40::/29'=>'CH','2a05:2d80::/29'=>'US','2a05:2dc0::/29'=>'RU','2a05:2e40::/29'=>'UA','2a05:2e80::/29'=>'DE','2a05:2ec0::/29'=>'RU','2a05:2f00::/29'=>'DE','2a05:2f40::/29'=>'PS','2a05:2f80::/29'=>'IT','2a05:2fc0::/29'=>'DE','2a05:3000::/29'=>'TR','2a05:3040::/29'=>'TR','2a05:3080::/29'=>'HU','2a05:30c0::/29'=>'DE','2a05:3140::/29'=>'GB','2a05:3180::/29'=>'RU','2a05:31c0::/29'=>'GB','2a05:3200::/29'=>'NL','2a05:3240::/29'=>'DE','2a05:3280::/29'=>'SA','2a05:32c0::/29'=>'DE','2a05:3300::/29'=>'FR','2a05:3340::/29'=>'GB','2a05:3380::/29'=>'YE','2a05:33c0::/29'=>'SI','2a05:3400::/29'=>'SE','2a05:3440::/29'=>'IT','2a05:3480::/29'=>'FR','2a05:34c0::/29'=>'AT','2a05:3500::/29'=>'IE','2a05:3540::/29'=>'GB','2a05:3580::/29'=>'RU','2a05:35c0::/29'=>'NL','2a05:3600::/29'=>'NL','2a05:3640::/29'=>'PL','2a05:3680::/29'=>'IT','2a05:36c0::/29'=>'FR','2a05:3700::/29'=>'FR','2a05:3740::/29'=>'RU','2a05:37c0::/29'=>'CZ','2a05:3800::/29'=>'IR','2a05:3840::/29'=>'DK','2a05:3880::/29'=>'IT','2a05:38c0::/29'=>'UA','2a05:3900::/29'=>'ES','2a05:3940::/31'=>'GB','2a05:3950::/31'=>'DK','2a05:3980::/29'=>'NL','2a05:39c0::/29'=>'ES','2a05:3a00::/29'=>'PL','2a05:3a40::/29'=>'RO','2a05:3a80::/29'=>'RU','2a05:3ac0::/29'=>'GR','2a05:3b00::/29'=>'US','2a05:3b40::/29'=>'RU','2a05:3b80::/29'=>'NL','2a05:3bc0::/29'=>'DE','2a05:3c00::/29'=>'DK','2a05:3c40::/29'=>'RU','2a05:3c80::/29'=>'CZ','2a05:3d00::/29'=>'BE','2a05:3d80::/29'=>'CH','2a05:3dc0::/29'=>'ES','2a05:3e00::/29'=>'DE','2a05:3e40::/29'=>'IR','2a05:3e80::/29'=>'RU','2a05:3ec0::/29'=>'IT','2a05:3f00::/29'=>'NO','2a05:3f40::/29'=>'NL','2a05:3f80::/29'=>'GR','2a05:3fc0::/29'=>'DE','2a05:4000::/29'=>'GB','2a05:4040::/29'=>'GB','2a05:4080::/29'=>'EE','2a05:40c0::/29'=>'PL','2a05:4100::/29'=>'RU','2a05:4180::/29'=>'CH','2a05:41c0::/29'=>'CH','2a05:4200::/29'=>'GB','2a05:4240::/29'=>'TR','2a05:4280::/29'=>'EE','2a05:42c0::/29'=>'IT','2a05:4340::/29'=>'GB','2a05:43c0::/29'=>'CZ','2a05:4400::/29'=>'DK','2a05:4440::/29'=>'ES','2a05:4480::/29'=>'PL','2a05:44c0::/29'=>'NL','2a05:4500::/29'=>'CZ','2a05:4540::/29'=>'SE','2a05:4580::/29'=>'IR','2a05:45c0::/29'=>'UZ','2a05:4600::/29'=>'DK','2a05:4640::/29'=>'TR','2a05:4680::/29'=>'FR','2a05:46c0::/29'=>'FR','2a05:4700::/29'=>'ES','2a05:4740::/29'=>'CH','2a05:4780::/29'=>'FR','2a05:47c0::/29'=>'FR','2a05:4800::/29'=>'RU','2a05:4840::/29'=>'DE','2a05:4880::/29'=>'CH','2a05:48c0::/29'=>'IT','2a05:4900::/29'=>'PL','2a05:4940::/29'=>'SI','2a05:4980::/29'=>'RS','2a05:49c0::/29'=>'IR','2a05:4a00::/29'=>'IT','2a05:4a40::/29'=>'CZ','2a05:4ac0::/29'=>'ES','2a05:4b00::/29'=>'UA','2a05:4b80::/29'=>'GB','2a05:4bc0::/29'=>'GB','2a05:4c00::/29'=>'BG','2a05:4c40::/29'=>'GB','2a05:4c80::/29'=>'IR','2a05:4cc0::/29'=>'RU','2a05:4d00::/29'=>'CZ','2a05:4d40::/29'=>'ES','2a05:4d80::/29'=>'ES','2a05:4dc0::/29'=>'AT','2a05:4e00::/29'=>'PL','2a05:4e40::/29'=>'AT','2a05:4e80::/29'=>'FR','2a05:4ec0::/29'=>'RU','2a05:4f00::/29'=>'RU','2a05:4f40::/29'=>'HR','2a05:4fc0::/29'=>'RU','2a05:5000::/29'=>'FR','2a05:5040::/29'=>'NL','2a05:5080::/32'=>'RU','2a05:50a0::/30'=>'RO','2a05:50c0::/29'=>'IQ','2a05:5100::/29'=>'DE','2a05:5140::/29'=>'NL','2a05:5180::/29'=>'NL','2a05:51c0::/29'=>'CH','2a05:5200::/29'=>'GB','2a05:5240::/29'=>'GB','2a05:5280::/30'=>'ES','2a05:52a0::/30'=>'NL','2a05:52c0::/29'=>'RU','2a05:5300::/29'=>'IE','2a05:5340::/29'=>'NL','2a05:5380::/29'=>'PL','2a05:53c0::/29'=>'RU','2a05:5400::/29'=>'IR','2a05:5440::/29'=>'IR','2a05:5480::/29'=>'NL','2a05:54c0::/29'=>'RU','2a05:5500::/29'=>'AT','2a05:5540::/29'=>'LV','2a05:5580::/29'=>'SE','2a05:55c0::/29'=>'IQ','2a05:5600::/29'=>'FR','2a05:5640::/29'=>'FR','2a05:5680::/29'=>'RO','2a05:56c0::/29'=>'GB','2a05:5700::/29'=>'RO','2a05:5740::/29'=>'UA','2a05:5780::/29'=>'TR','2a05:57c0::/29'=>'DE','2a05:5800::/29'=>'DE','2a05:5840::/29'=>'RU','2a05:5880::/29'=>'NO','2a05:58c0::/29'=>'FR','2a05:5900::/29'=>'DE','2a05:5940::/29'=>'DE','2a05:5980::/29'=>'IR','2a05:59c0::/29'=>'FR','2a05:5a00::/29'=>'GB','2a05:5a40::/29'=>'DE','2a05:5a80::/29'=>'DE','2a05:5ac0::/29'=>'NL','2a05:5b00::/29'=>'GB','2a05:5b40::/29'=>'DE','2a05:5b80::/29'=>'LB','2a05:5bc0::/29'=>'MK','2a05:5c00::/29'=>'FR','2a05:5c40::/29'=>'RU','2a05:5c80::/29'=>'ES','2a05:5cc0::/29'=>'ES','2a05:5d00::/29'=>'RU','2a05:5d40::/29'=>'ES','2a05:5d80::/29'=>'MK','2a05:5dc0::/29'=>'RU','2a05:5e00::/29'=>'AE','2a05:5e40::/29'=>'BG','2a05:5e80::/29'=>'IE','2a05:5ec0::/29'=>'TR','2a05:5f00::/29'=>'NL','2a05:5f40::/29'=>'BE','2a05:5f80::/29'=>'GB','2a05:5fc0::/29'=>'CZ','2a05:6000::/29'=>'GE','2a05:6040::/29'=>'GB','2a05:6080::/29'=>'IT','2a05:60c0::/29'=>'TR','2a05:6100::/29'=>'TR','2a05:6180::/29'=>'IT','2a05:61c0::/29'=>'CH','2a05:6200::/29'=>'NL','2a05:6240::/29'=>'DE','2a05:6280::/29'=>'LT','2a05:62c0::/29'=>'DE','2a05:6300::/29'=>'LT','2a05:6340::/29'=>'FR','2a05:6380::/29'=>'NO','2a05:63c0::/29'=>'RU','2a05:6400::/29'=>'BE','2a05:6440::/29'=>'NL','2a05:6480::/29'=>'IR','2a05:64c0::/29'=>'TR','2a05:6500::/29'=>'ES','2a05:6540::/29'=>'RU','2a05:6580::/29'=>'ES','2a05:65c0::/29'=>'ES','2a05:6600::/29'=>'IR','2a05:6640::/29'=>'VA','2a05:6680::/29'=>'IT','2a05:6700::/29'=>'RO','2a05:6740::/29'=>'AT','2a05:6780::/29'=>'RU','2a05:67c0::/29'=>'IT','2a05:6800::/29'=>'IT','2a05:6840::/29'=>'RU','2a05:6880::/29'=>'GB','2a05:68c0::/29'=>'DE','2a05:6900::/29'=>'RU','2a05:6940::/29'=>'ES','2a05:6980::/29'=>'RU','2a05:69c0::/29'=>'RU','2a05:6a00::/29'=>'CH','2a05:6a40::/29'=>'RU','2a05:6a80::/29'=>'BE','2a05:6ac0::/29'=>'CH','2a05:6b00::/29'=>'GB','2a05:6b40::/29'=>'ES','2a05:6b80::/29'=>'PL','2a05:6bc0::/29'=>'DE','2a05:6c00::/29'=>'GB','2a05:6c40::/29'=>'GB','2a05:6c80::/29'=>'NL','2a05:6cc0::/29'=>'NL','2a05:6d40::/29'=>'NO','2a05:6d80::/29'=>'RU','2a05:6dc0::/29'=>'NO','2a05:6e00::/29'=>'FR','2a05:6e40::/29'=>'GB','2a05:6e80::/29'=>'RU','2a05:6ec0::/29'=>'PL','2a05:6f00::/29'=>'IS','2a05:6f40::/29'=>'AE','2a05:6f80::/29'=>'TR','2a05:6fc0::/29'=>'TR','2a05:7000::/29'=>'CH','2a05:7040::/29'=>'GB','2a05:7080::/29'=>'ES','2a05:70c0::/29'=>'HR','2a05:7100::/29'=>'PL','2a05:7140::/29'=>'MD','2a05:7180::/29'=>'DE','2a05:7200::/29'=>'IR','2a05:7240::/29'=>'DE','2a05:7280::/29'=>'RU','2a05:72c0::/29'=>'GB','2a05:7340::/29'=>'LU','2a05:7380::/29'=>'DE','2a05:73c0::/29'=>'BG','2a05:7400::/29'=>'RU','2a05:7440::/29'=>'ES','2a05:7480::/29'=>'CH','2a05:74c0::/29'=>'JO','2a05:7500::/29'=>'JO','2a05:7540::/29'=>'PT','2a05:7580::/29'=>'IR','2a05:75c0::/29'=>'DE','2a05:7600::/29'=>'GB','2a05:7640::/29'=>'NL','2a05:7680::/29'=>'FR','2a05:76c0::/29'=>'GB','2a05:7700::/29'=>'SE','2a05:7740::/29'=>'SI','2a05:7780::/29'=>'DE','2a05:77c0::/29'=>'PL','2a05:7800::/29'=>'PT','2a05:7840::/29'=>'RS','2a05:78c0::/29'=>'SA','2a05:7900::/29'=>'ES','2a05:7940::/29'=>'GB','2a05:7980::/29'=>'FR','2a05:79c0::/29'=>'NL','2a05:7a00::/29'=>'IQ','2a05:7a40::/29'=>'YE','2a05:7a80::/29'=>'GB','2a05:7ac0::/29'=>'DE','2a05:7b00::/29'=>'NO','2a05:7b40::/29'=>'ME','2a05:7b80::/29'=>'GB','2a05:7bc0::/29'=>'GB','2a05:7c00::/29'=>'RS','2a05:7c40::/29'=>'LU','2a05:7c80::/29'=>'GB','2a05:7cc0::/29'=>'LT','2a05:7d00::/29'=>'GB','2a05:7d40::/29'=>'TR','2a05:7d80::/29'=>'YE','2a05:7dc0::/29'=>'DE','2a05:7de0::/30'=>'IR','2a05:7e00::/29'=>'CH','2a05:7e40::/29'=>'DE','2a05:7e80::/29'=>'RU','2a05:7ec0::/29'=>'CZ','2a05:7f00::/29'=>'AT','2a05:7f40::/29'=>'PL','2a05:7f80::/29'=>'DE','2a05:8000::/29'=>'CH','2a05:8040::/29'=>'IR','2a05:8080::/29'=>'IE','2a05:80c0::/29'=>'GB','2a05:8100::/29'=>'DE','2a05:8140::/29'=>'CH','2a05:8180::/29'=>'SE','2a05:81c0::/29'=>'RU','2a05:8200::/29'=>'AZ','2a05:8240::/29'=>'DE','2a05:8280::/29'=>'DE','2a05:82c0::/29'=>'AZ','2a05:8300::/29'=>'AL','2a05:8340::/29'=>'AZ','2a05:8380::/29'=>'SE','2a05:83c0::/29'=>'AT','2a05:8400::/29'=>'NL','2a05:8440::/29'=>'GB','2a05:8480::/29'=>'HU','2a05:84c0::/29'=>'RO','2a05:8500::/29'=>'CY','2a05:8540::/29'=>'IR','2a05:8580::/29'=>'FI','2a05:85c0::/29'=>'IE','2a05:8600::/29'=>'ES','2a05:8640::/29'=>'IR','2a05:86c0::/29'=>'GE','2a05:8700::/29'=>'LV','2a05:8740::/29'=>'ES','2a05:8780::/29'=>'DE','2a05:87c0::/29'=>'GB','2a05:8800::/29'=>'LB','2a05:8840::/29'=>'DK','2a05:8880::/30'=>'RO','2a05:88a0::/30'=>'CH','2a05:88c0::/29'=>'TR','2a05:8900::/29'=>'AT','2a05:8940::/29'=>'GB','2a05:8980::/29'=>'RU','2a05:8a00::/29'=>'TR','2a05:8a80::/29'=>'GB','2a05:8ac0::/29'=>'RU','2a05:8b00::/29'=>'LB','2a05:8b40::/29'=>'IL','2a05:8b80::/29'=>'DE','2a05:8c00::/29'=>'GI','2a05:8c40::/29'=>'FI','2a05:8c80::/29'=>'IE','2a05:8cc0::/29'=>'BG','2a05:8d00::/29'=>'GB','2a05:8d40::/29'=>'IL','2a05:8d80::/29'=>'IE','2a05:8dc0::/29'=>'GB','2a05:8e00::/29'=>'ES','2a05:8e40::/29'=>'DE','2a05:8e80::/29'=>'GB','2a05:8ec0::/29'=>'LB','2a05:8f00::/29'=>'CH','2a05:8f80::/29'=>'IT','2a05:8fc0::/29'=>'RS','2a05:9000::/29'=>'SA','2a05:9040::/29'=>'CH','2a05:9080::/29'=>'IR','2a05:90c0::/29'=>'NL','2a05:9100::/29'=>'FI','2a05:9140::/29'=>'DE','2a05:9180::/29'=>'NL','2a05:91c0::/29'=>'RO','2a05:9200::/29'=>'RU','2a05:9240::/29'=>'IR','2a05:9280::/29'=>'NL','2a05:92c0::/29'=>'NL','2a05:9340::/29'=>'NL','2a05:93c0::/29'=>'NL','2a05:9400::/29'=>'BG','2a05:9440::/29'=>'IR','2a05:94c0::/29'=>'IR','2a05:9500::/29'=>'TR','2a05:9540::/29'=>'IT','2a05:9580::/29'=>'HU','2a05:95c0::/29'=>'TR','2a05:9600::/29'=>'IE','2a05:9680::/29'=>'PL','2a05:96c0::/29'=>'NL','2a05:9700::/29'=>'FR','2a05:9740::/29'=>'LB','2a05:9780::/29'=>'GB','2a05:97c0::/29'=>'GE','2a05:9800::/29'=>'GB','2a05:9840::/29'=>'BE','2a05:9880::/29'=>'GB','2a05:98c0::/29'=>'GB','2a05:9900::/29'=>'LT','2a05:9940::/29'=>'IR','2a05:9980::/29'=>'ES','2a05:99c0::/29'=>'IR','2a05:9a00::/29'=>'IR','2a05:9a80::/29'=>'CH','2a05:9ac0::/29'=>'NO','2a05:9b00::/29'=>'ES','2a05:9b40::/29'=>'AZ','2a05:9b80::/29'=>'BE','2a05:9bc0::/29'=>'TR','2a05:9c40::/29'=>'GB','2a05:9c80::/29'=>'US','2a05:9cc0::/29'=>'NO','2a05:9d00::/29'=>'GB','2a05:9d40::/29'=>'IT','2a05:9d80::/29'=>'IR','2a05:9dc0::/29'=>'IT','2a05:9e00::/29'=>'IL','2a05:9e40::/29'=>'IR','2a05:9e80::/29'=>'FI','2a05:9ec0::/29'=>'TR','2a05:9f00::/29'=>'PT','2a05:9f80::/29'=>'DE','2a05:9fc0::/29'=>'IR','2a05:a000::/29'=>'RU','2a05:a040::/29'=>'PT','2a05:a080::/29'=>'RU','2a05:a0c0::/29'=>'DE','2a05:a100::/29'=>'MK','2a05:a140::/29'=>'SE','2a05:a180::/29'=>'NL','2a05:a1c0::/29'=>'DE','2a05:a200::/29'=>'RU','2a05:a240::/29'=>'ES','2a05:a280::/29'=>'NL','2a05:a2c0::/29'=>'SA','2a05:a300::/29'=>'GB','2a05:a340::/29'=>'GB','2a05:a380::/29'=>'IR','2a05:a3c0::/29'=>'IT','2a05:a400::/29'=>'RU','2a05:a440::/29'=>'IT','2a05:a480::/29'=>'FR','2a05:a4c0::/29'=>'ES','2a05:a500::/29'=>'FR','2a05:a540::/29'=>'IT','2a05:a580::/29'=>'IT','2a05:a5c0::/29'=>'GR','2a05:a600::/29'=>'DK','2a05:a640::/29'=>'NL','2a05:a680::/29'=>'RU','2a05:a6c0::/29'=>'IR','2a05:a700::/29'=>'RU','2a05:a740::/29'=>'TR','2a05:a780::/29'=>'GB','2a05:a7c0::/29'=>'RU','2a05:a800::/29'=>'ES','2a05:a840::/29'=>'CH','2a05:a880::/29'=>'DE','2a05:a8c0::/29'=>'SY','2a05:a900::/29'=>'DK','2a05:a940::/29'=>'DE','2a05:a980::/29'=>'IE','2a05:aa00::/29'=>'SK','2a05:aa40::/29'=>'GB','2a05:aa80::/29'=>'FI','2a05:aac0::/29'=>'NO','2a05:ab00::/29'=>'GB','2a05:ab40::/29'=>'GB','2a05:ab80::/29'=>'IR','2a05:abc0::/29'=>'TR','2a05:ac00::/29'=>'GB','2a05:ac40::/29'=>'CH','2a05:ac80::/29'=>'TR','2a05:acc0::/29'=>'SI','2a05:ad00::/29'=>'CH','2a05:ad40::/29'=>'CH','2a05:ad80::/29'=>'SE','2a05:adc0::/29'=>'RU','2a05:ae00::/29'=>'IT','2a05:ae40::/29'=>'DE','2a05:ae80::/29'=>'CH','2a05:aec0::/29'=>'DE','2a05:af00::/29'=>'ES','2a05:af40::/29'=>'TR','2a05:afc0::/29'=>'FR','2a05:b000::/29'=>'BE','2a05:b040::/29'=>'CH','2a05:b080::/29'=>'FI','2a05:b0c0::/30'=>'GB','2a05:b0c4::/31'=>'GB','2a05:b0c6::/39'=>'GB','2a05:b0c6:200::/40'=>'US','2a05:b0c6:300::/40'=>'GB','2a05:b0c6:400::/40'=>'GB','2a05:b0c6:500::/40'=>'DE','2a05:b0c6:600::/40'=>'GB','2a05:b0c6:700::/40'=>'AT','2a05:b0c6:800::/37'=>'GB','2a05:b0c6:1000::/38'=>'GB','2a05:b0c6:1400::/40'=>'AT','2a05:b0c6:1500::/40'=>'GB','2a05:b0c6:1600::/39'=>'GB','2a05:b0c6:1800::/37'=>'GB','2a05:b0c6:2000::/35'=>'GB','2a05:b0c6:4000::/34'=>'GB','2a05:b0c6:8000::/33'=>'GB','2a05:b0c7::/32'=>'GB','2a05:b100::/29'=>'GB','2a05:b140::/29'=>'TR','2a05:b180::/29'=>'GI','2a05:b200::/29'=>'RU','2a05:b240::/29'=>'IT','2a05:b280::/29'=>'GB','2a05:b2c0::/29'=>'TR','2a05:b300::/29'=>'SC','2a05:b340::/29'=>'UA','2a05:b380::/29'=>'TR','2a05:b3c0::/29'=>'FR','2a05:b440::/29'=>'TR','2a05:b480::/29'=>'GB','2a05:b4c0::/29'=>'IL','2a05:b500::/29'=>'FR','2a05:b540::/29'=>'DE','2a05:b580::/29'=>'IT','2a05:b5c0::/29'=>'UA','2a05:b600::/29'=>'SM','2a05:b640::/29'=>'FR','2a05:b680::/29'=>'RO','2a05:b700::/29'=>'TR','2a05:b740::/29'=>'IT','2a05:b780::/29'=>'FR','2a05:b7c0::/29'=>'RU','2a05:b800::/29'=>'CZ','2a05:b840::/29'=>'DE','2a05:b880::/29'=>'SE','2a05:b8c0::/29'=>'NL','2a05:b900::/29'=>'TR','2a05:b940::/29'=>'DE','2a05:b980::/29'=>'LB','2a05:b9c0::/29'=>'FI','2a05:ba00::/29'=>'TR','2a05:ba40::/29'=>'IR','2a05:ba80::/29'=>'IT','2a05:bac0::/29'=>'TR','2a05:bb00::/29'=>'IT','2a05:bb40::/29'=>'FR','2a05:bb80::/29'=>'IL','2a05:bbc0::/29'=>'NL','2a05:bc00::/29'=>'DK','2a05:bcc0::/29'=>'ES','2a05:bd00::/29'=>'DE','2a05:bd40::/29'=>'FR','2a05:bd80::/29'=>'GB','2a05:bdc0::/29'=>'IT','2a05:be00::/29'=>'BE','2a05:be40::/29'=>'NO','2a05:bec0::/29'=>'DE','2a05:bf00::/29'=>'TR','2a05:bf40::/29'=>'GB','2a05:bf80::/29'=>'IT','2a05:bfc0::/29'=>'IT','2a05:c040::/29'=>'CH','2a05:c080::/29'=>'NL','2a05:c0c0::/29'=>'FR','2a05:c100::/29'=>'FR','2a05:c140::/29'=>'RU','2a05:c180::/29'=>'GB','2a05:c200::/29'=>'BE','2a05:c280::/29'=>'DE','2a05:c2c0::/29'=>'SE','2a05:c300::/29'=>'LB','2a05:c340::/29'=>'DE','2a05:c3c0::/29'=>'PL','2a05:c480::/29'=>'GB','2a05:c4c0::/29'=>'NL','2a05:c500::/29'=>'RU','2a05:c540::/29'=>'GB','2a05:c580::/29'=>'NL','2a05:c5c0::/29'=>'RO','2a05:c600::/29'=>'NL','2a05:c640::/29'=>'TR','2a05:c680::/29'=>'AT','2a05:c6c0::/29'=>'IT','2a05:c700::/29'=>'DE','2a05:c740::/29'=>'SE','2a05:c7c0::/29'=>'ES','2a05:c800::/29'=>'PT','2a05:c840::/29'=>'GR','2a05:c880::/29'=>'KG','2a05:c8c0::/29'=>'RU','2a05:c900::/29'=>'IT','2a05:c940::/29'=>'NO','2a05:c980::/29'=>'GB','2a05:c9c0::/29'=>'NL','2a05:ca00::/29'=>'IT','2a05:ca40::/29'=>'CH','2a05:ca80::/29'=>'DE','2a05:cac0::/29'=>'CZ','2a05:cb00::/29'=>'NL','2a05:cb40::/29'=>'RO','2a05:cb80::/29'=>'NL','2a05:cbc0::/29'=>'RU','2a05:cc00::/29'=>'DE','2a05:cc40::/29'=>'RU','2a05:cc80::/29'=>'RU','2a05:ccc0::/29'=>'TR','2a05:cd00::/29'=>'IR','2a05:cd80::/29'=>'NL','2a05:cdc0::/29'=>'FR','2a05:ce00::/29'=>'ES','2a05:ce40::/29'=>'FI','2a05:ce80::/29'=>'RU','2a05:cec0::/29'=>'DE','2a05:cf00::/29'=>'DE','2a05:cf40::/29'=>'DE','2a05:cf80::/29'=>'RU','2a05:cfc0::/29'=>'NL','2a05:d000::/35'=>'IE','2a05:d000:2000::/40'=>'FR','2a05:d000:2100::/40'=>'IE','2a05:d000:2200::/39'=>'IE','2a05:d000:2400::/38'=>'IE','2a05:d000:2800::/37'=>'IE','2a05:d000:3000::/36'=>'IE','2a05:d000:4000::/40'=>'DE','2a05:d000:4100::/40'=>'IE','2a05:d000:4200::/39'=>'IE','2a05:d000:4400::/38'=>'IE','2a05:d000:4800::/37'=>'IE','2a05:d000:5000::/36'=>'IE','2a05:d000:6000::/35'=>'IE','2a05:d000:8000::/34'=>'IE','2a05:d000:c000::/40'=>'GB','2a05:d000:c100::/40'=>'IE','2a05:d000:c200::/39'=>'IE','2a05:d000:c400::/38'=>'IE','2a05:d000:c800::/37'=>'IE','2a05:d000:d000::/36'=>'IE','2a05:d000:e000::/35'=>'IE','2a05:d001::/32'=>'IE','2a05:d002::/31'=>'IE','2a05:d004::/30'=>'IE','2a05:d008::/29'=>'IE','2a05:d010::/31'=>'IE','2a05:d012::/36'=>'FR','2a05:d012:1000::/36'=>'IE','2a05:d012:2000::/35'=>'IE','2a05:d012:4000::/34'=>'IE','2a05:d012:8000::/33'=>'IE','2a05:d013::/32'=>'IE','2a05:d014::/36'=>'DE','2a05:d014:1000::/36'=>'IE','2a05:d014:2000::/35'=>'IE','2a05:d014:4000::/34'=>'IE','2a05:d014:8000::/33'=>'IE','2a05:d015::/32'=>'IE','2a05:d016::/31'=>'IE','2a05:d018::/30'=>'IE','2a05:d01c::/36'=>'GB','2a05:d01c:1000::/36'=>'IE','2a05:d01c:2000::/35'=>'IE','2a05:d01c:4000::/34'=>'IE','2a05:d01c:8000::/33'=>'IE','2a05:d01d::/32'=>'IE','2a05:d01e::/31'=>'IE','2a05:d020::/27'=>'IE','2a05:d040::/28'=>'IE','2a05:d050::/35'=>'IE','2a05:d050:2000::/40'=>'FR','2a05:d050:2100::/40'=>'IE','2a05:d050:2200::/39'=>'IE','2a05:d050:2400::/38'=>'IE','2a05:d050:2800::/37'=>'IE','2a05:d050:3000::/36'=>'IE','2a05:d050:4000::/40'=>'DE','2a05:d050:4100::/40'=>'IE','2a05:d050:4200::/39'=>'IE','2a05:d050:4400::/38'=>'IE','2a05:d050:4800::/37'=>'IE','2a05:d050:5000::/36'=>'IE','2a05:d050:6000::/35'=>'IE','2a05:d050:8000::/34'=>'IE','2a05:d050:c000::/40'=>'GB','2a05:d050:c100::/40'=>'IE','2a05:d050:c200::/39'=>'IE','2a05:d050:c400::/38'=>'IE','2a05:d050:c800::/37'=>'IE','2a05:d050:d000::/36'=>'IE','2a05:d050:e000::/35'=>'IE','2a05:d051::/32'=>'IE','2a05:d052::/31'=>'IE','2a05:d054::/30'=>'IE','2a05:d058::/29'=>'IE','2a05:d060::/28'=>'IE','2a05:d070::/29'=>'IE','2a05:d078::/35'=>'IE','2a05:d078:2000::/40'=>'FR','2a05:d078:2100::/40'=>'IE','2a05:d078:2200::/39'=>'IE','2a05:d078:2400::/38'=>'IE','2a05:d078:2800::/37'=>'IE','2a05:d078:3000::/36'=>'IE','2a05:d078:4000::/40'=>'DE','2a05:d078:4100::/40'=>'IE','2a05:d078:4200::/39'=>'IE','2a05:d078:4400::/38'=>'IE','2a05:d078:4800::/37'=>'IE','2a05:d078:5000::/36'=>'IE','2a05:d078:6000::/35'=>'IE','2a05:d078:8000::/34'=>'IE','2a05:d078:c000::/40'=>'GB','2a05:d078:c100::/40'=>'IE','2a05:d078:c200::/39'=>'IE','2a05:d078:c400::/38'=>'IE','2a05:d078:c800::/37'=>'IE','2a05:d078:d000::/36'=>'IE','2a05:d078:e000::/35'=>'IE','2a05:d079::/35'=>'IE','2a05:d079:2000::/40'=>'FR','2a05:d079:2100::/40'=>'IE','2a05:d079:2200::/39'=>'IE','2a05:d079:2400::/38'=>'IE','2a05:d079:2800::/37'=>'IE','2a05:d079:3000::/36'=>'IE','2a05:d079:4000::/40'=>'DE','2a05:d079:4100::/40'=>'IE','2a05:d079:4200::/39'=>'IE','2a05:d079:4400::/38'=>'IE','2a05:d079:4800::/37'=>'IE','2a05:d079:5000::/36'=>'IE','2a05:d079:6000::/35'=>'IE','2a05:d079:8000::/34'=>'IE','2a05:d079:c000::/40'=>'GB','2a05:d079:c100::/40'=>'IE','2a05:d079:c200::/39'=>'IE','2a05:d079:c400::/38'=>'IE','2a05:d079:c800::/37'=>'IE','2a05:d079:d000::/36'=>'IE','2a05:d079:e000::/35'=>'IE','2a05:d07a::/35'=>'IE','2a05:d07a:2000::/40'=>'FR','2a05:d07a:2100::/40'=>'IE','2a05:d07a:2200::/39'=>'IE','2a05:d07a:2400::/38'=>'IE','2a05:d07a:2800::/37'=>'IE','2a05:d07a:3000::/36'=>'IE','2a05:d07a:4000::/40'=>'DE','2a05:d07a:4100::/40'=>'IE','2a05:d07a:4200::/39'=>'IE','2a05:d07a:4400::/38'=>'IE','2a05:d07a:4800::/37'=>'IE','2a05:d07a:5000::/36'=>'IE','2a05:d07a:6000::/35'=>'IE','2a05:d07a:8000::/34'=>'IE','2a05:d07a:c000::/40'=>'GB','2a05:d07a:c100::/40'=>'IE','2a05:d07a:c200::/39'=>'IE','2a05:d07a:c400::/38'=>'IE','2a05:d07a:c800::/37'=>'IE','2a05:d07a:d000::/36'=>'IE','2a05:d07a:e000::/35'=>'IE','2a05:d07b::/32'=>'IE','2a05:d07c::/35'=>'IE','2a05:d07c:2000::/40'=>'FR','2a05:d07c:2100::/40'=>'IE','2a05:d07c:2200::/39'=>'IE','2a05:d07c:2400::/38'=>'IE','2a05:d07c:2800::/37'=>'IE','2a05:d07c:3000::/36'=>'IE','2a05:d07c:4000::/40'=>'DE','2a05:d07c:4100::/40'=>'IE','2a05:d07c:4200::/39'=>'IE','2a05:d07c:4400::/38'=>'IE','2a05:d07c:4800::/37'=>'IE','2a05:d07c:5000::/36'=>'IE','2a05:d07c:6000::/35'=>'IE','2a05:d07c:8000::/34'=>'IE','2a05:d07c:c000::/40'=>'GB','2a05:d07c:c100::/40'=>'IE','2a05:d07c:c200::/39'=>'IE','2a05:d07c:c400::/38'=>'IE','2a05:d07c:c800::/37'=>'IE','2a05:d07c:d000::/36'=>'IE','2a05:d07c:e000::/35'=>'IE','2a05:d07d::/32'=>'IE','2a05:d07e::/35'=>'IE','2a05:d07e:2000::/40'=>'FR','2a05:d07e:2100::/40'=>'IE','2a05:d07e:2200::/39'=>'IE','2a05:d07e:2400::/38'=>'IE','2a05:d07e:2800::/37'=>'IE','2a05:d07e:3000::/36'=>'IE','2a05:d07e:4000::/40'=>'DE','2a05:d07e:4100::/40'=>'IE','2a05:d07e:4200::/39'=>'IE','2a05:d07e:4400::/38'=>'IE','2a05:d07e:4800::/37'=>'IE','2a05:d07e:5000::/36'=>'IE','2a05:d07e:6000::/35'=>'IE','2a05:d07e:8000::/34'=>'IE','2a05:d07e:c000::/40'=>'GB','2a05:d07e:c100::/40'=>'IE','2a05:d07e:c200::/39'=>'IE','2a05:d07e:c400::/38'=>'IE','2a05:d07e:c800::/37'=>'IE','2a05:d07e:d000::/36'=>'IE','2a05:d07e:e000::/35'=>'IE','2a05:d07f::/35'=>'IE','2a05:d07f:2000::/40'=>'FR','2a05:d07f:2100::/40'=>'IE','2a05:d07f:2200::/39'=>'IE','2a05:d07f:2400::/38'=>'IE','2a05:d07f:2800::/37'=>'IE','2a05:d07f:3000::/36'=>'IE','2a05:d07f:4000::/40'=>'DE','2a05:d07f:4100::/40'=>'IE','2a05:d07f:4200::/39'=>'IE','2a05:d07f:4400::/38'=>'IE','2a05:d07f:4800::/37'=>'IE','2a05:d07f:5000::/36'=>'IE','2a05:d07f:6000::/35'=>'IE','2a05:d07f:8000::/34'=>'IE','2a05:d07f:c000::/40'=>'GB','2a05:d07f:c100::/40'=>'IE','2a05:d07f:c200::/39'=>'IE','2a05:d07f:c400::/38'=>'IE','2a05:d07f:c800::/37'=>'IE','2a05:d07f:d000::/36'=>'IE','2a05:d07f:e000::/35'=>'IE','2a05:d400::/29'=>'RU','2a05:d440::/29'=>'RU','2a05:d480::/29'=>'NL','2a05:d4c0::/29'=>'DE','2a05:d500::/29'=>'DE','2a05:d540::/29'=>'CZ','2a05:d580::/29'=>'DE','2a05:d5c0::/29'=>'GE','2a05:d600::/29'=>'LB','2a05:d640::/29'=>'IQ','2a05:d680::/29'=>'PL','2a05:d6c0::/29'=>'PL','2a05:d740::/29'=>'IR','2a05:d780::/29'=>'UA','2a05:d7c0::/29'=>'SA','2a05:d800::/29'=>'MK','2a05:d840::/29'=>'GB','2a05:d880::/29'=>'DE','2a05:d900::/29'=>'NL','2a05:d940::/29'=>'CH','2a05:d980::/29'=>'DE','2a05:d9c0::/29'=>'AT','2a05:da00::/29'=>'IT','2a05:da40::/29'=>'AT','2a05:da80::/29'=>'RO','2a05:dac0::/29'=>'CH','2a05:db00::/29'=>'NL','2a05:db40::/29'=>'GB','2a05:db80::/29'=>'IT','2a05:dbc0::/29'=>'HR','2a05:dc00::/29'=>'FR','2a05:dc40::/29'=>'DE','2a05:dc80::/29'=>'GB','2a05:dcc0::/29'=>'CH','2a05:dd00::/29'=>'TR','2a05:dd40::/29'=>'FR','2a05:dd80::/29'=>'AT','2a05:ddc0::/29'=>'RU','2a05:de00::/29'=>'RU','2a05:de40::/29'=>'GB','2a05:de80::/29'=>'FR','2a05:dec0::/29'=>'GR','2a05:df00::/29'=>'FR','2a05:df40::/29'=>'PT','2a05:df80::/29'=>'HU','2a05:dfc0::/36'=>'GB','2a05:dfc0:1000::/37'=>'GB','2a05:dfc0:1800::/38'=>'GB','2a05:dfc0:1c00::/39'=>'GB','2a05:dfc0:1e00::/41'=>'GB','2a05:dfc0:1e80::/42'=>'GB','2a05:dfc0:1ec0::/43'=>'GB','2a05:dfc0:1ee0::/46'=>'GB','2a05:dfc0:1ee4::/48'=>'CA','2a05:dfc0:1ee5::/48'=>'GB','2a05:dfc0:1ee6::/47'=>'GB','2a05:dfc0:1ee8::/45'=>'GB','2a05:dfc0:1ef0::/44'=>'GB','2a05:dfc0:1f00::/40'=>'GB','2a05:dfc0:2000::/35'=>'GB','2a05:dfc0:4000::/35'=>'GB','2a05:dfc0:6000::/37'=>'GB','2a05:dfc0:6800::/40'=>'GB','2a05:dfc0:6900::/43'=>'GB','2a05:dfc0:6920::/44'=>'GB','2a05:dfc0:6930::/45'=>'GB','2a05:dfc0:6938::/48'=>'GB','2a05:dfc0:6939::/48'=>'NL','2a05:dfc0:693a::/47'=>'GB','2a05:dfc0:693c::/46'=>'GB','2a05:dfc0:6940::/42'=>'GB','2a05:dfc0:6980::/41'=>'GB','2a05:dfc0:6a00::/39'=>'GB','2a05:dfc0:6c00::/38'=>'GB','2a05:dfc0:7000::/36'=>'GB','2a05:dfc0:8000::/33'=>'GB','2a05:dfc1::/32'=>'GB','2a05:dfc2::/31'=>'GB','2a05:dfc4::/31'=>'GB','2a05:dfc6::/32'=>'GB','2a05:dfc7::/46'=>'GB','2a05:dfc7:4::/48'=>'GB','2a05:dfc7:5::/48'=>'AQ','2a05:dfc7:6::/47'=>'GB','2a05:dfc7:8::/49'=>'SG','2a05:dfc7:8:8000::/49'=>'GB','2a05:dfc7:9::/48'=>'GB','2a05:dfc7:a::/47'=>'GB','2a05:dfc7:c::/46'=>'GB','2a05:dfc7:10::/48'=>'NL','2a05:dfc7:11::/48'=>'CH','2a05:dfc7:12::/47'=>'CH','2a05:dfc7:14::/46'=>'CH','2a05:dfc7:18::/47'=>'CH','2a05:dfc7:1a::/128'=>'AT','2a05:dfc7:1a::1/128'=>'CH','2a05:dfc7:1a::2/127'=>'CH','2a05:dfc7:1a::4/126'=>'CH','2a05:dfc7:1a::8/125'=>'CH','2a05:dfc7:1a::10/124'=>'CH','2a05:dfc7:1a::20/123'=>'CH','2a05:dfc7:1a::40/122'=>'CH','2a05:dfc7:1a::80/121'=>'CH','2a05:dfc7:1a::100/120'=>'CH','2a05:dfc7:1a::200/119'=>'CH','2a05:dfc7:1a::400/118'=>'CH','2a05:dfc7:1a::800/117'=>'CH','2a05:dfc7:1a::1000/116'=>'CH','2a05:dfc7:1a::2000/115'=>'CH','2a05:dfc7:1a::4000/114'=>'CH','2a05:dfc7:1a::8000/113'=>'CH','2a05:dfc7:1a::1:0/112'=>'CH','2a05:dfc7:1a::2:0/111'=>'CH','2a05:dfc7:1a::4:0/110'=>'CH','2a05:dfc7:1a::8:0/109'=>'CH','2a05:dfc7:1a::10:0/108'=>'CH','2a05:dfc7:1a::20:0/107'=>'CH','2a05:dfc7:1a::40:0/106'=>'CH','2a05:dfc7:1a::80:0/105'=>'CH','2a05:dfc7:1a::100:0/104'=>'CH','2a05:dfc7:1a::200:0/103'=>'CH','2a05:dfc7:1a::400:0/102'=>'CH','2a05:dfc7:1a::800:0/101'=>'CH','2a05:dfc7:1a::1000:0/100'=>'CH','2a05:dfc7:1a::2000:0/99'=>'CH','2a05:dfc7:1a::4000:0/98'=>'CH','2a05:dfc7:1a::8000:0/97'=>'CH','2a05:dfc7:1a::1:0:0/96'=>'CH','2a05:dfc7:1a::2:0:0/95'=>'CH','2a05:dfc7:1a::4:0:0/94'=>'CH','2a05:dfc7:1a::8:0:0/93'=>'CH','2a05:dfc7:1a::10:0:0/92'=>'CH','2a05:dfc7:1a::20:0:0/91'=>'CH','2a05:dfc7:1a::40:0:0/90'=>'CH','2a05:dfc7:1a::80:0:0/89'=>'CH','2a05:dfc7:1a::100:0:0/88'=>'CH','2a05:dfc7:1a::200:0:0/87'=>'CH','2a05:dfc7:1a::400:0:0/86'=>'CH','2a05:dfc7:1a::800:0:0/85'=>'CH','2a05:dfc7:1a::1000:0:0/84'=>'CH','2a05:dfc7:1a::2000:0:0/83'=>'CH','2a05:dfc7:1a::4000:0:0/82'=>'CH','2a05:dfc7:1a::8000:0:0/81'=>'CH','2a05:dfc7:1a:0:1::/80'=>'CH','2a05:dfc7:1a:0:2::/79'=>'CH','2a05:dfc7:1a:0:4::/78'=>'CH','2a05:dfc7:1a:0:8::/77'=>'CH','2a05:dfc7:1a:0:10::/76'=>'CH','2a05:dfc7:1a:0:20::/75'=>'CH','2a05:dfc7:1a:0:40::/74'=>'CH','2a05:dfc7:1a:0:80::/73'=>'CH','2a05:dfc7:1a:0:100::/72'=>'CH','2a05:dfc7:1a:0:200::/71'=>'CH','2a05:dfc7:1a:0:400::/70'=>'CH','2a05:dfc7:1a:0:800::/69'=>'CH','2a05:dfc7:1a:0:1000::/68'=>'CH','2a05:dfc7:1a:0:2000::/67'=>'CH','2a05:dfc7:1a:0:4000::/66'=>'CH','2a05:dfc7:1a:0:8000::/65'=>'CH','2a05:dfc7:1a:1::/64'=>'CH','2a05:dfc7:1a:2::/63'=>'CH','2a05:dfc7:1a:4::/62'=>'CH','2a05:dfc7:1a:8::/61'=>'CH','2a05:dfc7:1a:10::/60'=>'CH','2a05:dfc7:1a:20::/59'=>'CH','2a05:dfc7:1a:40::/58'=>'CH','2a05:dfc7:1a:80::/57'=>'CH','2a05:dfc7:1a:100::/56'=>'CH','2a05:dfc7:1a:200::/55'=>'CH','2a05:dfc7:1a:400::/54'=>'CH','2a05:dfc7:1a:800::/53'=>'CH','2a05:dfc7:1a:1000::/52'=>'CH','2a05:dfc7:1a:2000::/51'=>'CH','2a05:dfc7:1a:4000::/50'=>'CH','2a05:dfc7:1a:8000::/49'=>'CH','2a05:dfc7:1b::/48'=>'CH','2a05:dfc7:1c::/46'=>'CH','2a05:dfc7:20::/44'=>'GB','2a05:dfc7:30::/48'=>'US','2a05:dfc7:31::/48'=>'GB','2a05:dfc7:32::/47'=>'GB','2a05:dfc7:34::/46'=>'GB','2a05:dfc7:38::/45'=>'GB','2a05:dfc7:40::/48'=>'BY','2a05:dfc7:41::/48'=>'GB','2a05:dfc7:42::/47'=>'GB','2a05:dfc7:44::/46'=>'GB','2a05:dfc7:48::/45'=>'GB','2a05:dfc7:50::/44'=>'GB','2a05:dfc7:60::/43'=>'GB','2a05:dfc7:80::/41'=>'GB','2a05:dfc7:100::/40'=>'GB','2a05:dfc7:200::/39'=>'GB','2a05:dfc7:400::/38'=>'GB','2a05:dfc7:800::/37'=>'GB','2a05:dfc7:1000::/36'=>'GB','2a05:dfc7:2000::/35'=>'GB','2a05:dfc7:4000::/36'=>'GB','2a05:dfc7:5000::/39'=>'GB','2a05:dfc7:5200::/40'=>'GB','2a05:dfc7:5300::/42'=>'GB','2a05:dfc7:5340::/44'=>'GB','2a05:dfc7:5350::/47'=>'GB','2a05:dfc7:5352::/48'=>'GB','2a05:dfc7:5353::/48'=>'AQ','2a05:dfc7:5354::/46'=>'GB','2a05:dfc7:5358::/45'=>'GB','2a05:dfc7:5360::/43'=>'GB','2a05:dfc7:5380::/41'=>'GB','2a05:dfc7:5400::/38'=>'GB','2a05:dfc7:5800::/37'=>'GB','2a05:dfc7:6000::/35'=>'GB','2a05:dfc7:8000::/35'=>'GB','2a05:dfc7:a000::/36'=>'GB','2a05:dfc7:b000::/37'=>'GB','2a05:dfc7:b800::/38'=>'GB','2a05:dfc7:bc00::/39'=>'GB','2a05:dfc7:be00::/41'=>'GB','2a05:dfc7:be80::/42'=>'GB','2a05:dfc7:bec0::/43'=>'GB','2a05:dfc7:bee0::/45'=>'GB','2a05:dfc7:bee8::/46'=>'GB','2a05:dfc7:beec::/47'=>'GB','2a05:dfc7:beee::/48'=>'GB','2a05:dfc7:beef::/48'=>'AQ','2a05:dfc7:bef0::/44'=>'GB','2a05:dfc7:bf00::/40'=>'GB','2a05:dfc7:c000::/36'=>'GB','2a05:dfc7:d000::/37'=>'GB','2a05:dfc7:d800::/38'=>'GB','2a05:dfc7:dc00::/39'=>'GB','2a05:dfc7:de00::/40'=>'GB','2a05:dfc7:df00::/41'=>'GB','2a05:dfc7:df80::/42'=>'GB','2a05:dfc7:dfc0::/46'=>'GB','2a05:dfc7:dfc4::/47'=>'GB','2a05:dfc7:dfc6::/48'=>'GB','2a05:dfc7:dfc7::/48'=>'UA','2a05:dfc7:dfc8::/48'=>'US','2a05:dfc7:dfc9::/48'=>'GB','2a05:dfc7:dfca::/47'=>'GB','2a05:dfc7:dfcc::/46'=>'GB','2a05:dfc7:dfd0::/44'=>'GB','2a05:dfc7:dfe0::/43'=>'GB','2a05:dfc7:e000::/35'=>'GB','2a05:e000::/29'=>'DK','2a05:e040::/29'=>'KZ','2a05:e080::/29'=>'IE','2a05:e0c0::/29'=>'ES','2a05:e100::/29'=>'CH','2a05:e140::/29'=>'DE','2a05:e180::/29'=>'DE','2a05:e1c0::/29'=>'NL','2a05:e200::/29'=>'GB','2a05:e240::/29'=>'RU','2a05:e280::/29'=>'ES','2a05:e2c0::/29'=>'DE','2a05:e300::/29'=>'SK','2a05:e340::/29'=>'NO','2a05:e380::/29'=>'LB','2a05:e3c0::/29'=>'AT','2a05:e400::/29'=>'ES','2a05:e440::/29'=>'RU','2a05:e480::/29'=>'FR','2a05:e4c0::/29'=>'NL','2a05:e500::/29'=>'IQ','2a05:e540::/29'=>'RU','2a05:e580::/29'=>'CH','2a05:e5c0::/29'=>'TR','2a05:e640::/29'=>'RU','2a05:e680::/29'=>'NL','2a05:e6c0::/29'=>'ES','2a05:e700::/29'=>'DE','2a05:e740::/29'=>'DE','2a05:e780::/29'=>'IR','2a05:e7c0::/29'=>'FR','2a05:e800::/29'=>'SK','2a05:e840::/29'=>'SE','2a05:e880::/29'=>'NO','2a05:e8c0::/29'=>'ES','2a05:e940::/29'=>'GB','2a05:e980::/29'=>'DE','2a05:e9c0::/29'=>'NL','2a05:ea00::/29'=>'RU','2a05:ea40::/29'=>'ES','2a05:ea80::/29'=>'GB','2a05:eb20::/30'=>'BE','2a05:eb40::/29'=>'NO','2a05:eb80::/29'=>'IT','2a05:ebc0::/29'=>'CZ','2a05:ec00::/29'=>'CZ','2a05:ec40::/29'=>'RU','2a05:ec80::/29'=>'AE','2a05:ecc0::/29'=>'GB','2a05:ed00::/29'=>'IT','2a05:ed40::/29'=>'ES','2a05:ed80::/29'=>'DE','2a05:edc0::/29'=>'RU','2a05:ee00::/29'=>'GE','2a05:ee40::/29'=>'ES','2a05:ee80::/29'=>'IT','2a05:ef00::/29'=>'TR','2a05:ef40::/29'=>'NL','2a05:ef80::/29'=>'IR','2a05:efc0::/29'=>'IR','2a05:f000::/29'=>'TR','2a05:f040::/29'=>'KZ','2a05:f080::/29'=>'NL','2a05:f0c0::/29'=>'RU','2a05:f100::/29'=>'SE','2a05:f140::/29'=>'AM','2a05:f180::/29'=>'FR','2a05:f1c0::/29'=>'IE','2a05:f200::/29'=>'AZ','2a05:f240::/29'=>'DE','2a05:f280::/29'=>'PL','2a05:f2c0::/29'=>'RO','2a05:f300::/29'=>'ES','2a05:f340::/29'=>'IT','2a05:f380::/29'=>'BE','2a05:f3c0::/29'=>'PL','2a05:f400::/29'=>'CH','2a05:f440::/29'=>'FR','2a05:f480::/29'=>'FR','2a05:f4c0::/29'=>'BG','2a05:f500::/30'=>'IE','2a05:f504::/31'=>'IE','2a05:f506::/32'=>'IE','2a05:f507::/47'=>'IE','2a05:f507:2::/49'=>'DE','2a05:f507:2:8000::/49'=>'IE','2a05:f507:3::/49'=>'ES','2a05:f507:3:8000::/49'=>'IE','2a05:f507:4::/47'=>'IE','2a05:f507:6::/49'=>'GB','2a05:f507:6:8000::/49'=>'IE','2a05:f507:7::/48'=>'IE','2a05:f507:8::/48'=>'IE','2a05:f507:9::/49'=>'FR','2a05:f507:9:8000::/49'=>'IE','2a05:f507:a::/47'=>'IE','2a05:f507:c::/46'=>'IE','2a05:f507:10::/44'=>'IE','2a05:f507:20::/43'=>'IE','2a05:f507:40::/42'=>'IE','2a05:f507:80::/41'=>'IE','2a05:f507:100::/40'=>'IE','2a05:f507:200::/39'=>'IE','2a05:f507:400::/38'=>'IE','2a05:f507:800::/37'=>'IE','2a05:f507:1000::/36'=>'IE','2a05:f507:2000::/35'=>'IE','2a05:f507:4000::/34'=>'IE','2a05:f507:8000::/33'=>'IE','2a05:f540::/29'=>'FR','2a05:f580::/29'=>'GB','2a05:f5c0::/29'=>'HU','2a05:f600::/29'=>'FR','2a05:f640::/29'=>'RU','2a05:f6c0::/31'=>'DK','2a05:f6c2::/34'=>'DK','2a05:f6c2:4000::/37'=>'DK','2a05:f6c2:4800::/43'=>'DK','2a05:f6c2:4820::/44'=>'DK','2a05:f6c2:4830::/45'=>'DK','2a05:f6c2:4838::/49'=>'SE','2a05:f6c2:4838:8000::/49'=>'DK','2a05:f6c2:4839::/48'=>'DK','2a05:f6c2:483a::/47'=>'DK','2a05:f6c2:483c::/46'=>'DK','2a05:f6c2:4840::/42'=>'DK','2a05:f6c2:4880::/41'=>'DK','2a05:f6c2:4900::/40'=>'DK','2a05:f6c2:4a00::/39'=>'DK','2a05:f6c2:4c00::/38'=>'DK','2a05:f6c2:5000::/36'=>'DK','2a05:f6c2:6000::/35'=>'DK','2a05:f6c2:8000::/33'=>'DK','2a05:f6c3::/32'=>'DK','2a05:f6c4::/30'=>'DK','2a05:f700::/29'=>'DK','2a05:f740::/29'=>'TR','2a05:f780::/29'=>'DE','2a05:f7c0::/29'=>'TR','2a05:f800::/29'=>'PL','2a05:f840::/29'=>'NL','2a05:f900::/29'=>'RO','2a05:f940::/29'=>'DE','2a05:f980::/29'=>'ES','2a05:f9c0::/29'=>'FR','2a05:fa00::/29'=>'PL','2a05:fa40::/29'=>'DE','2a05:fac0::/29'=>'FR','2a05:fb00::/29'=>'SE','2a05:fb40::/29'=>'RU','2a05:fb80::/29'=>'DE','2a05:fbc0::/30'=>'TR','2a05:fbe0::/30'=>'CZ','2a05:fc00::/29'=>'AT','2a05:fc40::/29'=>'DE','2a05:fc80::/29'=>'CH','2a05:fcc0::/29'=>'IT','2a05:fd00::/29'=>'GB','2a05:fd40::/29'=>'LB','2a05:fd80::/29'=>'BE','2a05:fdc0::/29'=>'AL','2a05:fe00::/29'=>'IT','2a05:fe40::/29'=>'TR','2a05:fe80::/29'=>'DE','2a05:ff00::/29'=>'DE','2a05:ff40::/29'=>'SE','2a05:ff80::/29'=>'CH','2a05:ffc0::/29'=>'PL');
