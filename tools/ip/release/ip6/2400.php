<?php

/**
 * @Project NUKEVIET 4.x
 * @This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com
 * @Createdate Fri, 08 Jun 2018 08:58:59 GMT
 */

$ranges = array('2400::/20'=>'KR','2400:1000::/32'=>'JP','2400:1040::/32'=>'CN','2400:10c0::/32'=>'BD','2400:1100::/32'=>'HK','2400:1140::/32'=>'BD','2400:11c0::/32'=>'IN','2400:1200::/32'=>'NZ','2400:1240::/32'=>'AU','2400:12c0::/32'=>'CN','2400:1300::/32'=>'TW','2400:1340::/32'=>'CN','2400:1380::/32'=>'CN','2400:13c0::/32'=>'AU','2400:1400::/32'=>'ID','2400:1440::/32'=>'BT','2400:1480::/32'=>'SG','2400:14c0::/32'=>'PK','2400:1500::/32'=>'TW','2400:1540::/32'=>'SG','2400:1580::/32'=>'NZ','2400:15c0::/32'=>'CN','2400:1600::/32'=>'IN','2400:1640::/32'=>'CN','2400:1680::/32'=>'PK','2400:16c0::/32'=>'CN','2400:1700::/32'=>'SG','2400:1740::/32'=>'CN','2400:17c0::/32'=>'CN','2400:1800::/32'=>'KR','2400:1840::/32'=>'CN','2400:1880::/32'=>'ID','2400:18c0::/32'=>'CN','2400:1900::/32'=>'AU','2400:1940::/32'=>'CN','2400:1980::/32'=>'AF','2400:19c0::/32'=>'CN','2400:1a00::/32'=>'NP','2400:1a40::/32'=>'CN','2400:1a80::/32'=>'PK','2400:1ac0::/32'=>'CN','2400:1b00::/32'=>'AU','2400:1b40::/32'=>'CN','2400:1b80::/32'=>'JP','2400:1bc0::/32'=>'AU','2400:1c00::/32'=>'SG','2400:1c40::/32'=>'HK','2400:1c80::/32'=>'HK','2400:1cc0::/32'=>'CN','2400:1d00::/32'=>'SG','2400:1d40::/32'=>'CN','2400:1d80::/32'=>'HK','2400:1dc0::/32'=>'CN','2400:1e00::/32'=>'IN','2400:1e40::/32'=>'CN','2400:1e80::/32'=>'HK','2400:1ec0::/32'=>'CN','2400:1f00::/32'=>'IN','2400:1f40::/32'=>'CN','2400:1f80::/32'=>'HK','2400:1fc0::/32'=>'CN','2400:2000::/22'=>'JP','2400:2400::/28'=>'JP','2400:2410::/39'=>'JP','2400:2410:200::/40'=>'JP','2400:2410:300::/41'=>'JP','2400:2410:380::/42'=>'JP','2400:2410:3c0::/48'=>'JP','2400:2410:3c1::/52'=>'JP','2400:2410:3c1:1000::/52'=>'US','2400:2410:3c1:2000::/51'=>'JP','2400:2410:3c1:4000::/50'=>'JP','2400:2410:3c1:8000::/49'=>'JP','2400:2410:3c2::/47'=>'JP','2400:2410:3c4::/46'=>'JP','2400:2410:3c8::/45'=>'JP','2400:2410:3d0::/44'=>'JP','2400:2410:3e0::/43'=>'JP','2400:2410:400::/38'=>'JP','2400:2410:800::/37'=>'JP','2400:2410:1000::/36'=>'JP','2400:2410:2000::/35'=>'JP','2400:2410:4000::/34'=>'JP','2400:2410:8000::/33'=>'JP','2400:2411::/33'=>'JP','2400:2411:8000::/36'=>'JP','2400:2411:9000::/40'=>'JP','2400:2411:9100::/41'=>'JP','2400:2411:9180::/42'=>'JP','2400:2411:91c0::/47'=>'JP','2400:2411:91c2::/51'=>'JP','2400:2411:91c2:2000::/54'=>'JP','2400:2411:91c2:2400::/54'=>'US','2400:2411:91c2:2800::/53'=>'JP','2400:2411:91c2:3000::/52'=>'JP','2400:2411:91c2:4000::/50'=>'JP','2400:2411:91c2:8000::/49'=>'JP','2400:2411:91c3::/48'=>'JP','2400:2411:91c4::/46'=>'JP','2400:2411:91c8::/45'=>'JP','2400:2411:91d0::/44'=>'JP','2400:2411:91e0::/43'=>'JP','2400:2411:9200::/39'=>'JP','2400:2411:9400::/38'=>'JP','2400:2411:9800::/37'=>'JP','2400:2411:a000::/35'=>'JP','2400:2411:c000::/34'=>'JP','2400:2412::/35'=>'JP','2400:2412:2000::/38'=>'JP','2400:2412:2400::/39'=>'JP','2400:2412:2600::/40'=>'JP','2400:2412:2700::/41'=>'JP','2400:2412:2780::/43'=>'JP','2400:2412:27a0::/48'=>'JP','2400:2412:27a1::/49'=>'JP','2400:2412:27a1:8000::/50'=>'JP','2400:2412:27a1:c000::/50'=>'US','2400:2412:27a2::/47'=>'JP','2400:2412:27a4::/46'=>'JP','2400:2412:27a8::/45'=>'JP','2400:2412:27b0::/44'=>'JP','2400:2412:27c0::/42'=>'JP','2400:2412:2800::/37'=>'JP','2400:2412:3000::/36'=>'JP','2400:2412:4000::/34'=>'JP','2400:2412:8000::/33'=>'JP','2400:2413::/32'=>'JP','2400:2414::/30'=>'JP','2400:2418::/29'=>'JP','2400:2420::/27'=>'JP','2400:2440::/26'=>'JP','2400:2480::/25'=>'JP','2400:2500::/24'=>'JP','2400:2600::/26'=>'JP','2400:2640::/28'=>'JP','2400:2650::/31'=>'JP','2400:2652::/34'=>'JP','2400:2652:4000::/35'=>'JP','2400:2652:6000::/36'=>'JP','2400:2652:7000::/40'=>'JP','2400:2652:7100::/41'=>'JP','2400:2652:7180::/43'=>'JP','2400:2652:71a0::/49'=>'NO','2400:2652:71a0:8000::/49'=>'JP','2400:2652:71a1::/48'=>'JP','2400:2652:71a2::/47'=>'JP','2400:2652:71a4::/46'=>'JP','2400:2652:71a8::/45'=>'JP','2400:2652:71b0::/44'=>'JP','2400:2652:71c0::/42'=>'JP','2400:2652:7200::/39'=>'JP','2400:2652:7400::/38'=>'JP','2400:2652:7800::/37'=>'JP','2400:2652:8000::/33'=>'JP','2400:2653::/39'=>'JP','2400:2653:200::/41'=>'JP','2400:2653:280::/47'=>'JP','2400:2653:282::/49'=>'JP','2400:2653:282:8000::/49'=>'CA','2400:2653:283::/48'=>'JP','2400:2653:284::/46'=>'JP','2400:2653:288::/45'=>'JP','2400:2653:290::/44'=>'JP','2400:2653:2a0::/43'=>'JP','2400:2653:2c0::/42'=>'JP','2400:2653:300::/41'=>'JP','2400:2653:380::/42'=>'JP','2400:2653:3c0::/49'=>'JP','2400:2653:3c0:8000::/49'=>'US','2400:2653:3c1::/48'=>'JP','2400:2653:3c2::/47'=>'JP','2400:2653:3c4::/46'=>'JP','2400:2653:3c8::/45'=>'JP','2400:2653:3d0::/44'=>'JP','2400:2653:3e0::/43'=>'JP','2400:2653:400::/38'=>'JP','2400:2653:800::/37'=>'JP','2400:2653:1000::/36'=>'JP','2400:2653:2000::/35'=>'JP','2400:2653:4000::/34'=>'JP','2400:2653:8000::/35'=>'JP','2400:2653:a000::/40'=>'JP','2400:2653:a100::/41'=>'JP','2400:2653:a180::/43'=>'JP','2400:2653:a1a0::/47'=>'JP','2400:2653:a1a2::/49'=>'US','2400:2653:a1a2:8000::/49'=>'JP','2400:2653:a1a3::/48'=>'JP','2400:2653:a1a4::/46'=>'JP','2400:2653:a1a8::/45'=>'JP','2400:2653:a1b0::/44'=>'JP','2400:2653:a1c0::/42'=>'JP','2400:2653:a200::/39'=>'JP','2400:2653:a400::/38'=>'JP','2400:2653:a800::/37'=>'JP','2400:2653:b000::/36'=>'JP','2400:2653:c000::/34'=>'JP','2400:2654::/30'=>'JP','2400:2658::/29'=>'JP','2400:2660::/27'=>'JP','2400:2680::/25'=>'JP','2400:2700::/24'=>'JP','2400:2800::/21'=>'JP','2400:3000::/32'=>'JP','2400:3040::/32'=>'CN','2400:3080::/32'=>'AF','2400:30c0::/32'=>'GB','2400:3100::/32'=>'VU','2400:3140::/32'=>'CN','2400:3180::/32'=>'IN','2400:31c0::/32'=>'CN','2400:3200::/32'=>'CN','2400:3240::/32'=>'BD','2400:3280::/32'=>'CN','2400:32c0::/32'=>'CN','2400:3300::/32'=>'KR','2400:3340::/32'=>'CN','2400:3380::/32'=>'IN','2400:33c0::/32'=>'CN','2400:3400::/32'=>'VU','2400:3440::/32'=>'CN','2400:3480::/32'=>'TH','2400:34c0::/32'=>'CN','2400:3500::/32'=>'TV','2400:3540::/32'=>'CN','2400:3580::/32'=>'ID','2400:35c0::/32'=>'CN','2400:3600::/32'=>'CN','2400:3640::/32'=>'CN','2400:3680::/32'=>'IN','2400:36c0::/32'=>'CN','2400:3740::/32'=>'AU','2400:37c0::/32'=>'AU','2400:3800::/32'=>'JP','2400:3840::/32'=>'IN','2400:3880::/32'=>'AU','2400:38c0::/32'=>'CN','2400:3900::/32'=>'AU','2400:3940::/32'=>'IN','2400:3980::/32'=>'JP','2400:39c0::/32'=>'CN','2400:3a00::/32'=>'CN','2400:3a40::/32'=>'CN','2400:3a80::/32'=>'IN','2400:3ac0::/32'=>'IN','2400:3b00::/32'=>'IN','2400:3b40::/32'=>'CN','2400:3b80::/32'=>'IN','2400:3bc0::/32'=>'CN','2400:3c00::/32'=>'US','2400:3c01::/32'=>'US','2400:3c02::/31'=>'US','2400:3c40::/32'=>'CN','2400:3c80::/32'=>'AU','2400:3cc0::/32'=>'CN','2400:3d00::/32'=>'AU','2400:3d40::/32'=>'IN','2400:3d80::/32'=>'NZ','2400:3dc0::/32'=>'BD','2400:3e00::/32'=>'CN','2400:3e40::/32'=>'AU','2400:3e80::/32'=>'JP','2400:3ec0::/32'=>'HK','2400:3f00::/32'=>'SG','2400:3f40::/32'=>'CN','2400:3f80::/32'=>'JP','2400:3fc0::/32'=>'CN','2400:4000::/27'=>'JP','2400:4020::/29'=>'JP','2400:4028::/30'=>'JP','2400:402c::/32'=>'JP','2400:402d::/33'=>'JP','2400:402d:8000::/35'=>'JP','2400:402d:a000::/39'=>'JP','2400:402d:a200::/41'=>'JP','2400:402d:a280::/42'=>'JP','2400:402d:a2c0::/44'=>'JP','2400:402d:a2d0::/45'=>'JP','2400:402d:a2d8::/48'=>'JP','2400:402d:a2d9::/49'=>'US','2400:402d:a2d9:8000::/49'=>'JP','2400:402d:a2da::/47'=>'JP','2400:402d:a2dc::/46'=>'JP','2400:402d:a2e0::/43'=>'JP','2400:402d:a300::/40'=>'JP','2400:402d:a400::/38'=>'JP','2400:402d:a800::/37'=>'JP','2400:402d:b000::/36'=>'JP','2400:402d:c000::/34'=>'JP','2400:402e::/33'=>'JP','2400:402e:8000::/36'=>'JP','2400:402e:9000::/37'=>'JP','2400:402e:9800::/38'=>'JP','2400:402e:9c00::/39'=>'JP','2400:402e:9e00::/40'=>'JP','2400:402e:9f00::/41'=>'JP','2400:402e:9f80::/43'=>'JP','2400:402e:9fa0::/44'=>'JP','2400:402e:9fb0::/45'=>'JP','2400:402e:9fb8::/47'=>'JP','2400:402e:9fba::/49'=>'JP','2400:402e:9fba:8000::/49'=>'MY','2400:402e:9fbb::/48'=>'JP','2400:402e:9fbc::/46'=>'JP','2400:402e:9fc0::/42'=>'JP','2400:402e:a000::/37'=>'JP','2400:402e:a800::/39'=>'JP','2400:402e:aa00::/40'=>'JP','2400:402e:ab00::/41'=>'JP','2400:402e:ab80::/43'=>'JP','2400:402e:aba0::/45'=>'JP','2400:402e:aba8::/46'=>'JP','2400:402e:abac::/48'=>'JP','2400:402e:abad::/51'=>'JP','2400:402e:abad:2000::/53'=>'JP','2400:402e:abad:2800::/54'=>'JP','2400:402e:abad:2c00::/56'=>'US','2400:402e:abad:2d00::/56'=>'JP','2400:402e:abad:2e00::/55'=>'JP','2400:402e:abad:3000::/52'=>'JP','2400:402e:abad:4000::/50'=>'JP','2400:402e:abad:8000::/49'=>'JP','2400:402e:abae::/47'=>'JP','2400:402e:abb0::/44'=>'JP','2400:402e:abc0::/42'=>'JP','2400:402e:ac00::/38'=>'JP','2400:402e:b000::/36'=>'JP','2400:402e:c000::/34'=>'JP','2400:402f::/32'=>'JP','2400:4030::/28'=>'JP','2400:4040::/26'=>'JP','2400:4080::/25'=>'JP','2400:4100::/27'=>'JP','2400:4120::/33'=>'JP','2400:4120:8000::/35'=>'JP','2400:4120:a000::/37'=>'JP','2400:4120:a800::/39'=>'JP','2400:4120:aa00::/42'=>'JP','2400:4120:aa40::/44'=>'JP','2400:4120:aa50::/48'=>'JP','2400:4120:aa51::/49'=>'BR','2400:4120:aa51:8000::/49'=>'JP','2400:4120:aa52::/47'=>'JP','2400:4120:aa54::/46'=>'JP','2400:4120:aa58::/45'=>'JP','2400:4120:aa60::/43'=>'JP','2400:4120:aa80::/41'=>'JP','2400:4120:ab00::/40'=>'JP','2400:4120:ac00::/38'=>'JP','2400:4120:b000::/36'=>'JP','2400:4120:c000::/34'=>'JP','2400:4121::/32'=>'JP','2400:4122::/33'=>'JP','2400:4122:8000::/37'=>'JP','2400:4122:8800::/39'=>'JP','2400:4122:8a00::/40'=>'JP','2400:4122:8b00::/42'=>'JP','2400:4122:8b40::/44'=>'JP','2400:4122:8b50::/45'=>'JP','2400:4122:8b58::/46'=>'JP','2400:4122:8b5c::/47'=>'JP','2400:4122:8b5e::/49'=>'CO','2400:4122:8b5e:8000::/49'=>'JP','2400:4122:8b5f::/48'=>'JP','2400:4122:8b60::/43'=>'JP','2400:4122:8b80::/41'=>'JP','2400:4122:8c00::/38'=>'JP','2400:4122:9000::/36'=>'JP','2400:4122:a000::/35'=>'JP','2400:4122:c000::/34'=>'JP','2400:4123::/32'=>'JP','2400:4124::/30'=>'JP','2400:4128::/29'=>'JP','2400:4130::/30'=>'JP','2400:4134::/31'=>'JP','2400:4136::/33'=>'JP','2400:4136:8000::/36'=>'JP','2400:4136:9000::/37'=>'JP','2400:4136:9800::/38'=>'JP','2400:4136:9c00::/39'=>'JP','2400:4136:9e00::/40'=>'JP','2400:4136:9f00::/42'=>'JP','2400:4136:9f40::/46'=>'JP','2400:4136:9f44::/47'=>'JP','2400:4136:9f46::/48'=>'JP','2400:4136:9f47::/49'=>'DE','2400:4136:9f47:8000::/49'=>'JP','2400:4136:9f48::/45'=>'JP','2400:4136:9f50::/44'=>'JP','2400:4136:9f60::/43'=>'JP','2400:4136:9f80::/41'=>'JP','2400:4136:a000::/35'=>'JP','2400:4136:c000::/34'=>'JP','2400:4137::/32'=>'JP','2400:4138::/29'=>'JP','2400:4140::/26'=>'JP','2400:4180::/25'=>'JP','2400:4200::/23'=>'JP','2400:4400::/32'=>'MY','2400:4440::/32'=>'CN','2400:4480::/32'=>'IN','2400:44c0::/32'=>'CN','2400:4500::/32'=>'TW','2400:4540::/32'=>'CN','2400:4580::/32'=>'HK','2400:45c0::/32'=>'US','2400:4600::/32'=>'CN','2400:4640::/32'=>'CN','2400:4680::/32'=>'SG','2400:46c0::/32'=>'CN','2400:4700::/32'=>'AU','2400:4740::/32'=>'CN','2400:4780::/32'=>'KR','2400:47c0::/32'=>'BD','2400:4800::/32'=>'NZ','2400:4840::/32'=>'JP','2400:4880::/32'=>'KH','2400:48c0::/32'=>'JP','2400:4900::/32'=>'SG','2400:4940::/32'=>'HK','2400:4980::/32'=>'KR','2400:49c0::/32'=>'HK','2400:4a00::/32'=>'ID','2400:4a40::/32'=>'HK','2400:4a80::/32'=>'IN','2400:4ac0::/32'=>'BD','2400:4b00::/32'=>'AU','2400:4b40::/32'=>'AU','2400:4b80::/32'=>'AU','2400:4bc0::/32'=>'CN','2400:4c00::/32'=>'HK','2400:4c40::/32'=>'BD','2400:4c80::/32'=>'ID','2400:4cc0::/32'=>'BD','2400:4d00::/32'=>'AU','2400:4d40::/32'=>'BD','2400:4dc0::/32'=>'AU','2400:4e00::/32'=>'CN','2400:4e40::/32'=>'CN','2400:4e80::/32'=>'TW','2400:4ec0::/32'=>'ID','2400:4f00::/32'=>'PK','2400:4f40::/32'=>'ID','2400:4fc0::/32'=>'BD','2400:5000::/32'=>'AU','2400:5040::/32'=>'ID','2400:5080::/32'=>'CN','2400:50c0::/32'=>'BT','2400:5100::/32'=>'JP','2400:5140::/32'=>'ID','2400:5180::/32'=>'AF','2400:51c0::/32'=>'HK','2400:5200::/32'=>'IN','2400:5240::/32'=>'AU','2400:5280::/32'=>'CN','2400:52c0::/32'=>'SG','2400:5300::/32'=>'IN','2400:5340::/32'=>'HK','2400:5380::/32'=>'MY','2400:53c0::/32'=>'HK','2400:5400::/32'=>'CN','2400:5440::/32'=>'HK','2400:5480::/32'=>'HK','2400:54c0::/32'=>'IN','2400:5500::/32'=>'PH','2400:5540::/32'=>'NZ','2400:5580::/32'=>'CN','2400:55c0::/32'=>'CN','2400:5600::/32'=>'CN','2400:5640::/32'=>'CN','2400:5680::/32'=>'MY','2400:56c0::/32'=>'CN','2400:5700::/32'=>'IN','2400:5740::/32'=>'ID','2400:5780::/32'=>'TH','2400:57c0::/32'=>'CN','2400:5800::/32'=>'BD','2400:5840::/32'=>'CN','2400:5880::/32'=>'MY','2400:58c0::/32'=>'IN','2400:5900::/32'=>'NZ','2400:59c0::/32'=>'TH','2400:5a00::/32'=>'CN','2400:5a40::/32'=>'CN','2400:5a80::/32'=>'BD','2400:5ac0::/32'=>'CN','2400:5b40::/32'=>'CN','2400:5b80::/32'=>'AU','2400:5bc0::/32'=>'CN','2400:5c40::/32'=>'CN','2400:5c80::/32'=>'CN','2400:5cc0::/32'=>'CN','2400:5d00::/32'=>'AU','2400:5d40::/32'=>'BD','2400:5d80::/32'=>'AU','2400:5dc0::/32'=>'AU','2400:5e00::/32'=>'AU','2400:5e40::/32'=>'HK','2400:5e80::/32'=>'CN','2400:5ec0::/32'=>'ID','2400:5f00::/32'=>'PF','2400:5f40::/32'=>'MM','2400:5f80::/32'=>'HK','2400:5fc0::/32'=>'CN','2400:6000::/32'=>'CN','2400:6040::/32'=>'CN','2400:6080::/32'=>'NZ','2400:60c0::/32'=>'CN','2400:6100::/32'=>'AU','2400:6140::/32'=>'AU','2400:6180::/40'=>'SG','2400:6180:100::/49'=>'IN','2400:6180:100:8000::/49'=>'SG','2400:6180:101::/48'=>'SG','2400:6180:102::/47'=>'SG','2400:6180:104::/46'=>'SG','2400:6180:108::/45'=>'SG','2400:6180:110::/44'=>'SG','2400:6180:120::/43'=>'SG','2400:6180:140::/42'=>'SG','2400:6180:180::/41'=>'SG','2400:6180:200::/39'=>'SG','2400:6180:400::/38'=>'SG','2400:6180:800::/37'=>'SG','2400:6180:1000::/36'=>'SG','2400:6180:2000::/35'=>'SG','2400:6180:4000::/34'=>'SG','2400:6180:8000::/33'=>'SG','2400:61c0::/32'=>'CN','2400:6200::/32'=>'CN','2400:6240::/32'=>'ID','2400:6280::/32'=>'TH','2400:62c0::/32'=>'MM','2400:6300::/32'=>'IN','2400:6340::/32'=>'MM','2400:6380::/32'=>'AU','2400:63c0::/32'=>'IN','2400:6400::/32'=>'TO','2400:6440::/32'=>'MM','2400:6480::/32'=>'IN','2400:64c0::/32'=>'ID','2400:6500::/50'=>'SG','2400:6500:0:4000::/51'=>'SG','2400:6500:0:6000::/52'=>'SG','2400:6500:0:7000::/56'=>'SG','2400:6500:0:7100::/56'=>'JP','2400:6500:0:7200::/56'=>'AU','2400:6500:0:7300::/56'=>'SG','2400:6500:0:7400::/56'=>'KR','2400:6500:0:7500::/56'=>'IN','2400:6500:0:7600::/55'=>'SG','2400:6500:0:7800::/53'=>'SG','2400:6500:0:8000::/49'=>'SG','2400:6500:1::/48'=>'SG','2400:6500:2::/47'=>'SG','2400:6500:4::/46'=>'SG','2400:6500:8::/45'=>'SG','2400:6500:10::/44'=>'SG','2400:6500:20::/43'=>'SG','2400:6500:40::/42'=>'SG','2400:6500:80::/41'=>'SG','2400:6500:100::/50'=>'SG','2400:6500:100:4000::/51'=>'SG','2400:6500:100:6000::/52'=>'SG','2400:6500:100:7000::/56'=>'SG','2400:6500:100:7100::/56'=>'CN','2400:6500:100:7200::/56'=>'CN','2400:6500:100:7300::/56'=>'SG','2400:6500:100:7400::/54'=>'SG','2400:6500:100:7800::/53'=>'SG','2400:6500:100:8000::/49'=>'SG','2400:6500:101::/48'=>'SG','2400:6500:102::/47'=>'SG','2400:6500:104::/46'=>'SG','2400:6500:108::/45'=>'SG','2400:6500:110::/44'=>'SG','2400:6500:120::/43'=>'SG','2400:6500:140::/42'=>'SG','2400:6500:180::/41'=>'SG','2400:6500:200::/39'=>'SG','2400:6500:400::/38'=>'SG','2400:6500:800::/37'=>'SG','2400:6500:1000::/36'=>'SG','2400:6500:2000::/35'=>'SG','2400:6500:4000::/34'=>'SG','2400:6500:8000::/33'=>'SG','2400:6540::/32'=>'VN','2400:6580::/32'=>'IN','2400:65c0::/32'=>'IN','2400:6600::/32'=>'CN','2400:6640::/32'=>'CN','2400:6680::/32'=>'SG','2400:66c0::/32'=>'CN','2400:6700::/32'=>'JP','2400:6740::/32'=>'CN','2400:6780::/32'=>'SG','2400:67c0::/32'=>'CN','2400:6800::/32'=>'AU','2400:6840::/32'=>'CN','2400:6880::/32'=>'AU','2400:68c0::/32'=>'CN','2400:6900::/32'=>'NZ','2400:6940::/32'=>'CN','2400:6980::/32'=>'AU','2400:69c0::/32'=>'CN','2400:6a00::/32'=>'CN','2400:6a40::/32'=>'CN','2400:6a80::/32'=>'PH','2400:6ac0::/32'=>'CN','2400:6b00::/32'=>'JP','2400:6b40::/32'=>'CN','2400:6b80::/32'=>'IN','2400:6bc0::/32'=>'CN','2400:6c00::/32'=>'AU','2400:6c40::/32'=>'CN','2400:6c80::/32'=>'HK','2400:6cc0::/32'=>'CN','2400:6d00::/32'=>'FJ','2400:6d40::/32'=>'CN','2400:6d80::/32'=>'AU','2400:6dc0::/32'=>'CN','2400:6e00::/32'=>'CN','2400:6e40::/32'=>'CN','2400:6e80::/32'=>'MY','2400:6ec0::/32'=>'CN','2400:6f00::/32'=>'JP','2400:6f40::/32'=>'CN','2400:6f80::/32'=>'CN','2400:6fc0::/32'=>'CN','2400:7000::/32'=>'TW','2400:7040::/32'=>'CN','2400:7080::/32'=>'NP','2400:70c0::/32'=>'AU','2400:7100::/32'=>'CN','2400:7140::/32'=>'CN','2400:7180::/32'=>'NZ','2400:71c0::/32'=>'CN','2400:7200::/32'=>'CN','2400:7240::/32'=>'CN','2400:72c0::/32'=>'CN','2400:7300::/32'=>'HK','2400:7340::/32'=>'CN','2400:7380::/32'=>'NZ','2400:73c0::/32'=>'CN','2400:7400::/32'=>'MY','2400:7440::/32'=>'CN','2400:7480::/32'=>'MN','2400:74c0::/32'=>'CN','2400:7500::/32'=>'ID','2400:7540::/32'=>'CN','2400:75c0::/32'=>'CN','2400:7600::/32'=>'AU','2400:7640::/32'=>'CN','2400:7680::/32'=>'CN','2400:76c0::/32'=>'CN','2400:7700::/32'=>'NZ','2400:7740::/32'=>'CN','2400:7780::/32'=>'IN','2400:77c0::/32'=>'CN','2400:7800::/34'=>'JP','2400:7800:4000::/39'=>'JP','2400:7800:4200::/40'=>'JP','2400:7800:4300::/44'=>'JP','2400:7800:4310::/45'=>'JP','2400:7800:4318::/47'=>'JP','2400:7800:431a::/49'=>'US','2400:7800:431a:8000::/49'=>'JP','2400:7800:431b::/48'=>'JP','2400:7800:431c::/46'=>'JP','2400:7800:4320::/43'=>'JP','2400:7800:4340::/42'=>'JP','2400:7800:4380::/41'=>'JP','2400:7800:4400::/38'=>'JP','2400:7800:4800::/37'=>'JP','2400:7800:5000::/36'=>'JP','2400:7800:6000::/35'=>'JP','2400:7800:8000::/33'=>'JP','2400:7840::/32'=>'SE','2400:7880::/32'=>'NZ','2400:78c0::/32'=>'ID','2400:7900::/32'=>'IN','2400:7940::/32'=>'JP','2400:7980::/32'=>'SG','2400:79c0::/32'=>'CN','2400:7a00::/32'=>'HK','2400:7a40::/32'=>'AU','2400:7a80::/32'=>'HK','2400:7ac0::/32'=>'CN','2400:7b00::/32'=>'JP','2400:7b40::/32'=>'BD','2400:7b80::/30'=>'TH','2400:7bc0::/32'=>'CN','2400:7c00::/32'=>'MY','2400:7c40::/32'=>'BD','2400:7c80::/32'=>'IN','2400:7cc0::/32'=>'BD','2400:7d00::/32'=>'AU','2400:7d80::/32'=>'AU','2400:7dc0::/32'=>'ID','2400:7e00::/32'=>'JP','2400:7e40::/32'=>'HK','2400:7e80::/32'=>'SG','2400:7ec0::/32'=>'GB','2400:7f00::/32'=>'AU','2400:7f80::/32'=>'CN','2400:7fc0::/32'=>'CN','2400:8000::/32'=>'ID','2400:8040::/32'=>'JP','2400:8080::/32'=>'CN','2400:80c0::/32'=>'IN','2400:8100::/32'=>'AU','2400:8140::/32'=>'ID','2400:8180::/32'=>'IN','2400:81c0::/32'=>'LA','2400:8200::/32'=>'CN','2400:8240::/32'=>'SG','2400:8280::/32'=>'AU','2400:82c0::/32'=>'CN','2400:8300::/32'=>'JP','2400:8340::/32'=>'AU','2400:8380::/32'=>'AU','2400:83c0::/32'=>'GB','2400:8400::/32'=>'JP','2400:8440::/32'=>'AU','2400:8480::/32'=>'MM','2400:84c0::/45'=>'HK','2400:84c0:8::/46'=>'HK','2400:84c0:c::/47'=>'HK','2400:84c0:e::/48'=>'HK','2400:84c0:f::/49'=>'US','2400:84c0:f:8000::/49'=>'HK','2400:84c0:10::/44'=>'HK','2400:84c0:20::/43'=>'HK','2400:84c0:40::/42'=>'HK','2400:84c0:80::/41'=>'HK','2400:84c0:100::/40'=>'HK','2400:84c0:200::/39'=>'HK','2400:84c0:400::/38'=>'HK','2400:84c0:800::/37'=>'HK','2400:84c0:1000::/36'=>'HK','2400:84c0:2000::/35'=>'HK','2400:84c0:4000::/34'=>'HK','2400:84c0:8000::/33'=>'HK','2400:8500::/32'=>'JP','2400:8540::/32'=>'HK','2400:8580::/32'=>'CN','2400:85c0::/32'=>'IN','2400:8600::/32'=>'CN','2400:8640::/32'=>'HK','2400:86c0::/32'=>'BD','2400:8700::/32'=>'JP','2400:8740::/32'=>'IN','2400:8780::/32'=>'CN','2400:87c0::/32'=>'CN','2400:8800::/32'=>'HK','2400:8840::/32'=>'CN','2400:8880::/32'=>'IN','2400:88c0::/32'=>'ID','2400:8900::/33'=>'JP','2400:8900:8000::/34'=>'JP','2400:8900:c000::/35'=>'JP','2400:8900:e000::/48'=>'JP','2400:8900:e001::/51'=>'JP','2400:8900:e001:2000::/53'=>'JP','2400:8900:e001:2800::/56'=>'JP','2400:8900:e001:2900::/58'=>'JP','2400:8900:e001:2940::/61'=>'JP','2400:8900:e001:2948::/62'=>'JP','2400:8900:e001:294c::/64'=>'JP','2400:8900:e001:294d::/66'=>'JP','2400:8900:e001:294d:4000::/69'=>'JP','2400:8900:e001:294d:4800::/72'=>'JP','2400:8900:e001:294d:4900::/73'=>'JP','2400:8900:e001:294d:4980::/74'=>'JP','2400:8900:e001:294d:49c0::/79'=>'JP','2400:8900:e001:294d:49c2::/81'=>'JP','2400:8900:e001:294d:49c2:8000::/84'=>'JP','2400:8900:e001:294d:49c2:9000::/86'=>'JP','2400:8900:e001:294d:49c2:9400::/88'=>'JP','2400:8900:e001:294d:49c2:9500::/91'=>'JP','2400:8900:e001:294d:49c2:9520::/92'=>'JP','2400:8900:e001:294d:49c2:9530::/93'=>'JP','2400:8900:e001:294d:49c2:9538::/94'=>'JP','2400:8900:e001:294d:49c2:953c::/99'=>'JP','2400:8900:e001:294d:49c2:953c:2000:0/101'=>'JP','2400:8900:e001:294d:49c2:953c:2800:0/102'=>'JP','2400:8900:e001:294d:49c2:953c:2c00:0/109'=>'JP','2400:8900:e001:294d:49c2:953c:2c08:0/110'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:0/116'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1000/118'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1400/119'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1600/121'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1680/123'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16a0/128'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16a1/128'=>'SG','2400:8900:e001:294d:49c2:953c:2c0c:16a2/127'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16a4/126'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16a8/125'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16b0/124'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:16c0/122'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1700/120'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:1800/117'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:2000/115'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:4000/114'=>'JP','2400:8900:e001:294d:49c2:953c:2c0c:8000/113'=>'JP','2400:8900:e001:294d:49c2:953c:2c0d:0/112'=>'JP','2400:8900:e001:294d:49c2:953c:2c0e:0/111'=>'JP','2400:8900:e001:294d:49c2:953c:2c10:0/108'=>'JP','2400:8900:e001:294d:49c2:953c:2c20:0/107'=>'JP','2400:8900:e001:294d:49c2:953c:2c40:0/106'=>'JP','2400:8900:e001:294d:49c2:953c:2c80:0/105'=>'JP','2400:8900:e001:294d:49c2:953c:2d00:0/104'=>'JP','2400:8900:e001:294d:49c2:953c:2e00:0/103'=>'JP','2400:8900:e001:294d:49c2:953c:3000:0/100'=>'JP','2400:8900:e001:294d:49c2:953c:4000:0/98'=>'JP','2400:8900:e001:294d:49c2:953c:8000:0/97'=>'JP','2400:8900:e001:294d:49c2:953d::/96'=>'JP','2400:8900:e001:294d:49c2:953e::/95'=>'JP','2400:8900:e001:294d:49c2:9540::/90'=>'JP','2400:8900:e001:294d:49c2:9580::/89'=>'JP','2400:8900:e001:294d:49c2:9600::/87'=>'JP','2400:8900:e001:294d:49c2:9800::/85'=>'JP','2400:8900:e001:294d:49c2:a000::/83'=>'JP','2400:8900:e001:294d:49c2:c000::/82'=>'JP','2400:8900:e001:294d:49c3::/80'=>'JP','2400:8900:e001:294d:49c4::/78'=>'JP','2400:8900:e001:294d:49c8::/77'=>'JP','2400:8900:e001:294d:49d0::/76'=>'JP','2400:8900:e001:294d:49e0::/75'=>'JP','2400:8900:e001:294d:4a00::/71'=>'JP','2400:8900:e001:294d:4c00::/70'=>'JP','2400:8900:e001:294d:5000::/68'=>'JP','2400:8900:e001:294d:6000::/67'=>'JP','2400:8900:e001:294d:8000::/65'=>'JP','2400:8900:e001:294e::/63'=>'JP','2400:8900:e001:2950::/60'=>'JP','2400:8900:e001:2960::/59'=>'JP','2400:8900:e001:2980::/57'=>'JP','2400:8900:e001:2a00::/55'=>'JP','2400:8900:e001:2c00::/54'=>'JP','2400:8900:e001:3000::/52'=>'JP','2400:8900:e001:4000::/50'=>'JP','2400:8900:e001:8000::/49'=>'JP','2400:8900:e002::/47'=>'JP','2400:8900:e004::/46'=>'JP','2400:8900:e008::/45'=>'JP','2400:8900:e010::/44'=>'JP','2400:8900:e020::/43'=>'JP','2400:8900:e040::/42'=>'JP','2400:8900:e080::/41'=>'JP','2400:8900:e100::/40'=>'JP','2400:8900:e200::/39'=>'JP','2400:8900:e400::/38'=>'JP','2400:8900:e800::/37'=>'JP','2400:8900:f000::/36'=>'JP','2400:8901::/32'=>'SG','2400:8902::/32'=>'JP','2400:8903::/32'=>'US','2400:8940::/32'=>'MY','2400:8980::/32'=>'CN','2400:89c0::/32'=>'CN','2400:8a00::/32'=>'AU','2400:8a40::/32'=>'IN','2400:8a80::/31'=>'PH','2400:8b00::/32'=>'ID','2400:8b40::/32'=>'ID','2400:8b80::/32'=>'ID','2400:8bc0::/32'=>'IN','2400:8c00::/32'=>'NZ','2400:8c40::/32'=>'PK','2400:8c80::/32'=>'AU','2400:8cc0::/32'=>'HK','2400:8d00::/32'=>'HK','2400:8d40::/32'=>'JP','2400:8dc0::/32'=>'IN','2400:8e00::/32'=>'CN','2400:8e40::/32'=>'NZ','2400:8e80::/32'=>'HK','2400:8ec0::/32'=>'ID','2400:8f00::/32'=>'CN','2400:8f40::/32'=>'AU','2400:8f80::/32'=>'AU','2400:8fc0::/32'=>'CN','2400:9000::/32'=>'AU','2400:9040::/32'=>'CN','2400:9080::/32'=>'IN','2400:90c0::/32'=>'PK','2400:9100::/32'=>'VN','2400:9140::/32'=>'ID','2400:9180::/32'=>'JP','2400:91c0::/32'=>'ID','2400:9240::/32'=>'AU','2400:9280::/32'=>'ID','2400:92c0::/32'=>'AU','2400:9300::/32'=>'PG','2400:9340::/32'=>'CN','2400:9380::/31'=>'HK','2400:93c0::/32'=>'IN','2400:9400::/32'=>'BN','2400:9440::/32'=>'MY','2400:9480::/32'=>'AU','2400:94c0::/32'=>'AU','2400:9500::/32'=>'NP','2400:9540::/32'=>'PH','2400:9580::/32'=>'CN','2400:95c0::/32'=>'CN','2400:9600::/32'=>'CN','2400:9640::/32'=>'US','2400:96c0::/32'=>'NZ','2400:9700::/32'=>'NP','2400:9740::/32'=>'BD','2400:9780::/32'=>'SG','2400:97c0::/32'=>'GB','2400:9800::/32'=>'ID','2400:9840::/32'=>'BD','2400:9880::/32'=>'AU','2400:98c0::/32'=>'CN','2400:9900::/32'=>'NP','2400:9940::/32'=>'BD','2400:9980::/32'=>'IN','2400:99c0::/32'=>'AU','2400:9a00::/32'=>'CN','2400:9a40::/32'=>'CN','2400:9a80::/32'=>'AU','2400:9ac0::/32'=>'PK','2400:9b40::/32'=>'VN','2400:9b80::/32'=>'AU','2400:9bc0::/32'=>'VN','2400:9c00::/32'=>'AU','2400:9c40::/32'=>'TH','2400:9c80::/32'=>'ID','2400:9cc0::/32'=>'AF','2400:9d00::/32'=>'PH','2400:9d80::/32'=>'IN','2400:9dc0::/32'=>'CN','2400:9e00::/32'=>'CN','2400:9e40::/32'=>'GB','2400:9e80::/32'=>'KR','2400:9f40::/32'=>'IN','2400:9f80::/32'=>'KR','2400:9fc0::/32'=>'PK','2400:a040::/32'=>'CN','2400:a080::/32'=>'JP','2400:a0c0::/32'=>'PK','2400:a140::/32'=>'JP','2400:a1c0::/32'=>'US','2400:a240::/32'=>'LK','2400:a2c0::/32'=>'BD','2400:a300::/32'=>'JP','2400:a340::/32'=>'ID','2400:a380::/32'=>'CN','2400:a3c0::/32'=>'NZ','2400:a400::/32'=>'NP','2400:a440::/32'=>'SG','2400:a480::/32'=>'CN','2400:a4c0::/32'=>'AU','2400:a500::/32'=>'AU','2400:a540::/32'=>'BD','2400:a580::/32'=>'KR','2400:a5c0::/32'=>'NZ','2400:a600::/32'=>'AU','2400:a640::/32'=>'ID','2400:a680::/32'=>'ID','2400:a6c0::/32'=>'CN','2400:a700::/32'=>'AU','2400:a740::/32'=>'BD','2400:a780::/32'=>'CN','2400:a7c0::/32'=>'BD','2400:a800::/32'=>'JP','2400:a840::/32'=>'AU','2400:a880::/32'=>'AU','2400:a8c0::/32'=>'CN','2400:a900::/32'=>'CN','2400:a940::/32'=>'PH','2400:a980::/29'=>'CN','2400:a9c0::/32'=>'BD','2400:aa00::/32'=>'LA','2400:aa40::/32'=>'MY','2400:aa80::/32'=>'TW','2400:aac0::/32'=>'BD','2400:ab00::/32'=>'KR','2400:ab40::/32'=>'PK','2400:ab80::/32'=>'NZ','2400:abc0::/32'=>'CN','2400:ac00::/32'=>'JP','2400:ac40::/32'=>'MM','2400:ac80::/32'=>'SG','2400:acc0::/32'=>'BD','2400:ad00::/32'=>'AU','2400:ad40::/32'=>'BD','2400:ad80::/32'=>'NZ','2400:adc0::/27'=>'PK','2400:ae00::/32'=>'CN','2400:ae40::/32'=>'MY','2400:ae80::/32'=>'AU','2400:aec0::/32'=>'HK','2400:af40::/32'=>'BD','2400:af80::/32'=>'JP','2400:afc0::/32'=>'BD','2400:b000::/32'=>'PH','2400:b040::/32'=>'BD','2400:b080::/32'=>'ID','2400:b0c0::/32'=>'AU','2400:b100::/32'=>'AU','2400:b140::/32'=>'BD','2400:b180::/32'=>'ID','2400:b1c0::/32'=>'HK','2400:b200::/32'=>'CN','2400:b240::/32'=>'BD','2400:b2c0::/32'=>'CN','2400:b300::/32'=>'AU','2400:b340::/32'=>'BD','2400:b380::/32'=>'TW','2400:b3c0::/32'=>'JP','2400:b400::/32'=>'NZ','2400:b440::/32'=>'AU','2400:b480::/32'=>'TW','2400:b4c0::/32'=>'AU','2400:b500::/32'=>'CN','2400:b540::/32'=>'PK','2400:b580::/32'=>'IN','2400:b5c0::/32'=>'TH','2400:b600::/32'=>'CN','2400:b640::/32'=>'IN','2400:b680::/32'=>'JP','2400:b6c0::/32'=>'CN','2400:b700::/32'=>'CN','2400:b740::/32'=>'PK','2400:b780::/32'=>'AU','2400:b7c0::/32'=>'CN','2400:b800::/32'=>'AU','2400:b840::/32'=>'TH','2400:b880::/32'=>'AU','2400:b8c0::/32'=>'CN','2400:b940::/32'=>'PK','2400:b980::/32'=>'ID','2400:b9c0::/32'=>'CN','2400:ba00::/32'=>'CN','2400:ba40::/32'=>'CN','2400:ba41::/48'=>'CN','2400:ba41:1::/48'=>'US','2400:ba41:2::/48'=>'SG','2400:ba41:3::/48'=>'CN','2400:ba41:4::/46'=>'CN','2400:ba41:8::/45'=>'CN','2400:ba41:10::/44'=>'CN','2400:ba41:20::/43'=>'CN','2400:ba41:40::/42'=>'CN','2400:ba41:80::/41'=>'CN','2400:ba41:100::/40'=>'CN','2400:ba41:200::/39'=>'CN','2400:ba41:400::/38'=>'CN','2400:ba41:800::/37'=>'CN','2400:ba41:1000::/36'=>'CN','2400:ba41:2000::/35'=>'CN','2400:ba41:4000::/34'=>'CN','2400:ba41:8000::/33'=>'CN','2400:ba80::/32'=>'HK','2400:bac0::/32'=>'CN','2400:bb00::/32'=>'SG','2400:bb40::/32'=>'PA','2400:bbc0::/32'=>'HK','2400:bc00::/32'=>'AU','2400:bc40::/32'=>'CN','2400:bc80::/32'=>'VN','2400:bcc0::/32'=>'BD','2400:bd00::/32'=>'NZ','2400:bd40::/32'=>'PH','2400:bdc0::/32'=>'AF','2400:be00::/32'=>'CN','2400:be40::/32'=>'HK','2400:be80::/32'=>'HK','2400:bec0::/32'=>'AU','2400:bf00::/32'=>'CN','2400:bf40::/32'=>'PK','2400:bf80::/32'=>'ID','2400:bfc0::/32'=>'HK','2400:c000::/32'=>'NZ','2400:c040::/32'=>'AU','2400:c080::/32'=>'ID','2400:c0c0::/32'=>'VU','2400:c100::/32'=>'AU','2400:c140::/32'=>'VN','2400:c180::/32'=>'LA','2400:c1c0::/32'=>'ID','2400:c200::/32'=>'CN','2400:c240::/32'=>'AU','2400:c2c0::/32'=>'HK','2400:c300::/32'=>'HK','2400:c340::/32'=>'HK','2400:c380::/32'=>'CN','2400:c3c0::/32'=>'AU','2400:c400::/32'=>'AU','2400:c401::/32'=>'US','2400:c440::/32'=>'PH','2400:c4c0::/32'=>'MY','2400:c500::/32'=>'AU','2400:c540::/32'=>'TH','2400:c580::/32'=>'NZ','2400:c5c0::/32'=>'TH','2400:c600::/32'=>'BD','2400:c640::/32'=>'BD','2400:c680::/32'=>'HK','2400:c6c0::/32'=>'IN','2400:c700::/32'=>'IN','2400:c740::/32'=>'BD','2400:c780::/32'=>'TW','2400:c7c0::/32'=>'BD','2400:c800::/29'=>'HK','2400:c840::/32'=>'CN','2400:c880::/32'=>'IN','2400:c8c0::/32'=>'CN','2400:c900::/32'=>'ID','2400:c940::/32'=>'CN','2400:c980::/32'=>'SG','2400:c9c0::/32'=>'CN','2400:ca00::/32'=>'BD','2400:ca40::/32'=>'CN','2400:cac0::/32'=>'CN','2400:cb00::/44'=>'US','2400:cb00:10::/45'=>'US','2400:cb00:18::/48'=>'US','2400:cb00:19::/48'=>'FR','2400:cb00:1a::/47'=>'US','2400:cb00:1c::/46'=>'US','2400:cb00:20::/48'=>'NL','2400:cb00:21::/48'=>'GB','2400:cb00:22::/48'=>'JP','2400:cb00:23::/48'=>'HK','2400:cb00:24::/47'=>'US','2400:cb00:26::/48'=>'AU','2400:cb00:27::/48'=>'US','2400:cb00:28::/48'=>'US','2400:cb00:29::/48'=>'CA','2400:cb00:2a::/47'=>'US','2400:cb00:2c::/46'=>'US','2400:cb00:30::/48'=>'US','2400:cb00:31::/48'=>'CZ','2400:cb00:32::/47'=>'US','2400:cb00:34::/48'=>'KR','2400:cb00:35::/48'=>'SG','2400:cb00:36::/47'=>'US','2400:cb00:38::/48'=>'CL','2400:cb00:39::/48'=>'IT','2400:cb00:3a::/47'=>'US','2400:cb00:3c::/46'=>'US','2400:cb00:40::/48'=>'ES','2400:cb00:41::/48'=>'CO','2400:cb00:42::/48'=>'US','2400:cb00:43::/48'=>'PE','2400:cb00:44::/48'=>'AR','2400:cb00:45::/48'=>'ZA','2400:cb00:46::/48'=>'NZ','2400:cb00:47::/48'=>'AU','2400:cb00:48::/48'=>'DE','2400:cb00:49::/48'=>'FR','2400:cb00:4a::/47'=>'US','2400:cb00:4c::/46'=>'US','2400:cb00:50::/48'=>'RO','2400:cb00:51::/48'=>'JP','2400:cb00:52::/48'=>'IE','2400:cb00:53::/48'=>'KW','2400:cb00:54::/48'=>'QA','2400:cb00:55::/48'=>'OM','2400:cb00:56::/48'=>'MY','2400:cb00:57::/48'=>'IN','2400:cb00:58::/47'=>'IN','2400:cb00:5a::/47'=>'US','2400:cb00:5c::/46'=>'US','2400:cb00:60::/48'=>'AE','2400:cb00:61::/48'=>'KE','2400:cb00:62::/48'=>'EG','2400:cb00:63::/48'=>'GB','2400:cb00:64::/48'=>'CH','2400:cb00:65::/48'=>'DK','2400:cb00:66::/48'=>'US','2400:cb00:67::/48'=>'DE','2400:cb00:68::/48'=>'PH','2400:cb00:69::/48'=>'CA','2400:cb00:6a::/47'=>'US','2400:cb00:6c::/46'=>'US','2400:cb00:70::/48'=>'CA','2400:cb00:71::/48'=>'DE','2400:cb00:72::/48'=>'US','2400:cb00:73::/48'=>'PL','2400:cb00:74::/48'=>'BG','2400:cb00:75::/48'=>'DE','2400:cb00:76::/48'=>'US','2400:cb00:77::/48'=>'PH','2400:cb00:78::/48'=>'BE','2400:cb00:79::/48'=>'FI','2400:cb00:7a::/47'=>'US','2400:cb00:7c::/46'=>'US','2400:cb00:80::/48'=>'TW','2400:cb00:81::/48'=>'US','2400:cb00:82::/48'=>'US','2400:cb00:83::/48'=>'NO','2400:cb00:84::/47'=>'AU','2400:cb00:86::/48'=>'TH','2400:cb00:87::/48'=>'RU','2400:cb00:88::/48'=>'GR','2400:cb00:89::/48'=>'ES','2400:cb00:8a::/47'=>'US','2400:cb00:8c::/46'=>'US','2400:cb00:90::/48'=>'PA','2400:cb00:91::/48'=>'US','2400:cb00:92::/47'=>'IN','2400:cb00:94::/48'=>'US','2400:cb00:95::/48'=>'EC','2400:cb00:96::/48'=>'AO','2400:cb00:97::/48'=>'BR','2400:cb00:98::/48'=>'US','2400:cb00:99::/48'=>'LU','2400:cb00:9a::/47'=>'US','2400:cb00:9c::/46'=>'US','2400:cb00:a0::/43'=>'US','2400:cb00:c0::/42'=>'US','2400:cb00:100::/48'=>'DE','2400:cb00:101::/48'=>'BR','2400:cb00:102::/47'=>'US','2400:cb00:104::/48'=>'TH','2400:cb00:105::/48'=>'CW','2400:cb00:106::/48'=>'US','2400:cb00:107::/48'=>'PT','2400:cb00:108::/45'=>'US','2400:cb00:110::/48'=>'CL','2400:cb00:111::/48'=>'LK','2400:cb00:112::/48'=>'US','2400:cb00:113::/48'=>'ZA','2400:cb00:114::/48'=>'AT','2400:cb00:115::/48'=>'US','2400:cb00:116::/48'=>'US','2400:cb00:117::/48'=>'AM','2400:cb00:118::/48'=>'TR','2400:cb00:119::/48'=>'US','2400:cb00:11a::/47'=>'US','2400:cb00:11c::/46'=>'US','2400:cb00:120::/48'=>'RS','2400:cb00:121::/48'=>'US','2400:cb00:122::/48'=>'DJ','2400:cb00:123::/48'=>'HU','2400:cb00:124::/48'=>'HR','2400:cb00:125::/48'=>'US','2400:cb00:126::/48'=>'IT','2400:cb00:127::/48'=>'TH','2400:cb00:128::/48'=>'SE','2400:cb00:129::/48'=>'TH','2400:cb00:12a::/47'=>'US','2400:cb00:12c::/46'=>'US','2400:cb00:130::/48'=>'SA','2400:cb00:131::/48'=>'US','2400:cb00:132::/48'=>'UA','2400:cb00:133::/48'=>'US','2400:cb00:134::/46'=>'US','2400:cb00:138::/48'=>'US','2400:cb00:139::/48'=>'MU','2400:cb00:13a::/47'=>'US','2400:cb00:13c::/46'=>'US','2400:cb00:140::/47'=>'US','2400:cb00:142::/48'=>'NP','2400:cb00:143::/48'=>'US','2400:cb00:144::/48'=>'KH','2400:cb00:145::/48'=>'IS','2400:cb00:146::/47'=>'US','2400:cb00:148::/48'=>'US','2400:cb00:149::/48'=>'IL','2400:cb00:14a::/47'=>'US','2400:cb00:14c::/46'=>'US','2400:cb00:150::/44'=>'US','2400:cb00:160::/43'=>'US','2400:cb00:180::/41'=>'US','2400:cb00:200::/39'=>'US','2400:cb00:400::/38'=>'US','2400:cb00:800::/37'=>'US','2400:cb00:1000::/36'=>'US','2400:cb00:2000::/35'=>'US','2400:cb00:4000::/34'=>'US','2400:cb00:8000::/33'=>'US','2400:cb40::/32'=>'CN','2400:cb80::/32'=>'CN','2400:cbc0::/32'=>'CN','2400:cc00::/32'=>'AU','2400:cc40::/32'=>'CN','2400:cc80::/32'=>'CN','2400:ccc0::/32'=>'CN','2400:cd00::/32'=>'TH','2400:cd40::/32'=>'CN','2400:cd80::/32'=>'ID','2400:cdc0::/32'=>'CN','2400:ce00::/32'=>'CN','2400:ce40::/32'=>'CN','2400:ce80::/32'=>'BD','2400:cec0::/32'=>'HK','2400:cf00::/32'=>'KR','2400:cf40::/32'=>'CN','2400:cf80::/32'=>'CN','2400:cfc0::/32'=>'CN','2400:d040::/32'=>'LK','2400:d0c0::/32'=>'CN','2400:d100::/32'=>'CN','2400:d140::/32'=>'ID','2400:d180::/32'=>'IN','2400:d1c0::/32'=>'CN','2400:d200::/32'=>'CN','2400:d280::/32'=>'IN','2400:d2c0::/32'=>'AU','2400:d300::/32'=>'CN','2400:d340::/32'=>'BD','2400:d380::/32'=>'CN','2400:d3c0::/32'=>'IN','2400:d400::/32'=>'AU','2400:d440::/32'=>'CN','2400:d480::/32'=>'AU','2400:d4c0::/32'=>'BD','2400:d500::/32'=>'AU','2400:d540::/32'=>'AF','2400:d580::/32'=>'TW','2400:d5c0::/32'=>'AF','2400:d600::/32'=>'CN','2400:d640::/32'=>'JP','2400:d680::/32'=>'ID','2400:d6c0::/32'=>'CN','2400:d700::/32'=>'HK','2400:d740::/32'=>'ID','2400:d780::/32'=>'CN','2400:d7c0::/32'=>'PK','2400:d800::/30'=>'SG','2400:d840::/32'=>'AU','2400:d880::/32'=>'HK','2400:d8c0::/32'=>'ID','2400:d940::/32'=>'ID','2400:d980::/32'=>'BD','2400:d9c0::/32'=>'AU','2400:da00::/32'=>'CN','2400:da40::/32'=>'BD','2400:da80::/32'=>'SG','2400:dac0::/32'=>'BD','2400:db00::/32'=>'HK','2400:db40::/32'=>'BD','2400:db80::/32'=>'MN','2400:dbc0::/32'=>'IN','2400:dc00::/32'=>'ID','2400:dc40::/32'=>'IN','2400:dc80::/32'=>'BD','2400:dcc0::/32'=>'JP','2400:dd00::/28'=>'CN','2400:dd40::/32'=>'CN','2400:dd80::/32'=>'BD','2400:ddc0::/32'=>'JP','2400:de00::/32'=>'CN','2400:de40::/32'=>'MM','2400:de80::/32'=>'CN','2400:dec0::/32'=>'HK','2400:df00::/32'=>'JP','2400:df40::/32'=>'TW','2400:df80::/32'=>'MY','2400:dfc0::/32'=>'IN','2400:e000::/32'=>'JP','2400:e040::/32'=>'HK','2400:e0c0::/32'=>'CN','2400:e100::/32'=>'JP','2400:e140::/32'=>'CN','2400:e180::/32'=>'KR','2400:e1c0::/32'=>'IN','2400:e200::/32'=>'AU','2400:e240::/32'=>'VN','2400:e2c0::/32'=>'VN','2400:e300::/32'=>'AU','2400:e340::/32'=>'BD','2400:e3c0::/32'=>'AU','2400:e400::/32'=>'JP','2400:e440::/32'=>'AU','2400:e480::/32'=>'TW','2400:e4c0::/32'=>'ID','2400:e500::/32'=>'AF','2400:e540::/32'=>'HK','2400:e5c0::/32'=>'CN','2400:e640::/32'=>'AF','2400:e680::/32'=>'CN','2400:e6c0::/32'=>'PH','2400:e740::/32'=>'BD','2400:e780::/32'=>'NZ','2400:e7c0::/32'=>'HK','2400:e840::/32'=>'HK','2400:e880::/32'=>'CN','2400:e8c0::/32'=>'BD','2400:e900::/32'=>'AU','2400:e940::/32'=>'NZ','2400:e980::/32'=>'IN','2400:e9c0::/32'=>'MM','2400:ea00::/32'=>'TH','2400:ea40::/32'=>'ID','2400:ea80::/32'=>'IN','2400:eac0::/32'=>'SG','2400:eb00::/32'=>'AU','2400:eb40::/32'=>'US','2400:eb80::/32'=>'BD','2400:ebc0::/32'=>'CN','2400:ec00::/32'=>'AU','2400:ec40::/32'=>'AU','2400:ec80::/32'=>'SG','2400:ecc0::/32'=>'MM','2400:ed00::/32'=>'SG','2400:ed40::/32'=>'VN','2400:ed80::/32'=>'AU','2400:edc0::/32'=>'CN','2400:ee00::/32'=>'CN','2400:ee40::/32'=>'HK','2400:ee80::/32'=>'NZ','2400:eec0::/32'=>'CN','2400:ef00::/32'=>'HK','2400:ef40::/32'=>'CN','2400:ef80::/32'=>'HK','2400:efc0::/32'=>'GB','2400:f000::/32'=>'HK','2400:f040::/32'=>'SG','2400:f080::/32'=>'IN','2400:f0c0::/32'=>'NP','2400:f100::/32'=>'HK','2400:f140::/32'=>'ID','2400:f180::/32'=>'US','2400:f1c0::/32'=>'MM','2400:f200::/32'=>'PH','2400:f240::/32'=>'MM','2400:f280::/32'=>'AU','2400:f2c0::/32'=>'PH','2400:f340::/32'=>'ID','2400:f380::/32'=>'AU','2400:f3c0::/32'=>'HK','2400:f400::/32'=>'JP','2400:f440::/32'=>'AU','2400:f480::/32'=>'CN','2400:f4c0::/32'=>'TH','2400:f540::/32'=>'CN','2400:f580::/32'=>'ID','2400:f5c0::/32'=>'CN','2400:f600::/32'=>'PH','2400:f640::/32'=>'AU','2400:f680::/32'=>'IN','2400:f6c0::/32'=>'NP','2400:f700::/32'=>'HK','2400:f740::/32'=>'IN','2400:f780::/32'=>'IN','2400:f7c0::/32'=>'CN','2400:f800::/32'=>'HK','2400:f840::/32'=>'CN','2400:f880::/32'=>'HK','2400:f8c0::/32'=>'BD','2400:f900::/32'=>'AU','2400:f940::/32'=>'BD','2400:f980::/32'=>'CN','2400:f9c0::/32'=>'BD','2400:fa00::/32'=>'AU','2400:fa40::/32'=>'BD','2400:fa80::/32'=>'AU','2400:fac0::/32'=>'CN','2400:fb00::/32'=>'ID','2400:fb40::/32'=>'CN','2400:fb80::/32'=>'SG','2400:fbc0::/32'=>'CN','2400:fc00::/32'=>'PK','2400:fc40::/32'=>'CN','2400:fc80::/32'=>'TW','2400:fcc0::/32'=>'CN','2400:fd00::/32'=>'BD','2400:fd40::/32'=>'SC','2400:fd80::/32'=>'KR','2400:fdc0::/32'=>'IN','2400:fe00::/32'=>'CN','2400:fe40::/32'=>'MM','2400:fe80::/32'=>'AU','2400:fec0::/32'=>'BD','2400:ff00::/32'=>'LK','2400:ff40::/32'=>'AU','2400:ffc0::/32'=>'IN');
