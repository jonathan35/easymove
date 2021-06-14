

CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_in_desktop` longtext CHARACTER SET latin1 DEFAULT NULL,
  `text_in_mobile` longtext CHARACTER SET latin1 DEFAULT NULL,
  `banner` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO banner VALUES("2","<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>","<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>","photo/60484589a24cd.jpg","2","1","2020-10-27 13:28:12","2021-03-10 12:05:29");
INSERT INTO banner VALUES("9","<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>","<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>","photo/60497621b308e.jpg","0","1","2021-03-11 09:44:45","2021-03-11 09:45:05");



CREATE TABLE `banner_dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_dashboard` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




CREATE TABLE `basic_commission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `max_distance` int(11) DEFAULT NULL,
  `commission` decimal(11,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO basic_commission VALUES("1","5","10.00","2021-05-08 20:53:40","2021-05-08 20:53:40");
INSERT INTO basic_commission VALUES("2","10","20.00","2021-05-08 20:53:46","2021-05-08 20:53:46");
INSERT INTO basic_commission VALUES("3","15","30.00","2021-05-08 20:53:50","2021-05-08 20:53:50");
INSERT INTO basic_commission VALUES("4","20","40.00","2021-05-08 21:54:35","2021-05-08 21:54:35");
INSERT INTO basic_commission VALUES("5","25","50.00","2021-05-08 21:54:39","2021-05-08 21:54:39");
INSERT INTO basic_commission VALUES("6","30","60.00","2021-05-08 21:54:50","2021-05-08 21:54:50");
INSERT INTO basic_commission VALUES("7","40","80.00","2021-05-08 21:55:01","2021-05-08 21:55:01");
INSERT INTO basic_commission VALUES("8","50","100.00","2021-05-08 21:55:26","2021-05-08 21:55:26");
INSERT INTO basic_commission VALUES("9","100","200.00","2021-05-08 21:55:30","2021-05-08 21:55:30");



CREATE TABLE `bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `max_distance` int(11) DEFAULT NULL,
  `min_point` int(11) DEFAULT NULL,
  `commission` decimal(11,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO bonus VALUES("1","10","100","1.10","2021-05-08 22:20:04","2021-05-08 22:23:38");
INSERT INTO bonus VALUES("2","30","100","1.50","2021-05-08 22:26:08","2021-05-08 22:26:08");
INSERT INTO bonus VALUES("3","60","100","1.90","2021-05-08 22:26:19","2021-05-08 22:26:19");
INSERT INTO bonus VALUES("4","120","100","2.30","2021-05-08 22:26:36","2021-05-08 22:26:36");
INSERT INTO bonus VALUES("5","10","120","1.30","2021-05-08 22:26:53","2021-05-08 22:26:53");
INSERT INTO bonus VALUES("6","30","120","2.00","2021-05-08 22:27:01","2021-05-08 22:27:01");
INSERT INTO bonus VALUES("7","60","120","2.70","2021-05-08 22:27:10","2021-05-08 22:27:10");
INSERT INTO bonus VALUES("8","120","120","3.40","2021-05-08 22:29:10","2021-05-08 22:29:10");
INSERT INTO bonus VALUES("9","10","140","1.50","2021-05-08 22:29:16","2021-05-08 22:29:16");
INSERT INTO bonus VALUES("10","30","140","2.30","2021-05-08 22:34:19","2021-05-08 22:34:19");
INSERT INTO bonus VALUES("11","60","140","3.10","2021-05-08 22:34:20","2021-05-08 22:34:20");
INSERT INTO bonus VALUES("12","120","140","3.90","2021-05-08 22:34:21","2021-05-08 22:34:21");
INSERT INTO bonus VALUES("13","30","140","4.70","2021-05-08 22:34:22","2021-05-08 22:34:22");



CREATE TABLE `branch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `branch_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_number` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `branch_location` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `branch_location_coordinate` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO branch VALUES("1","1","1","Taka Sdn. Bhd. Tabuan Branch","Headquarter","Tonny","12121212","addres asdsad asdasdasd","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1","2021-04-09 15:22:31","2021-04-12 19:32:05");
INSERT INTO branch VALUES("2","1","1","Taka sdn bhd (R.H. Plaza)","Branch","Jonny","12312321312","addasda sdasdas dasdasdasdas d","Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia","1.5039154504169283,110.35120765000002","","","2021-04-13 10:24:19");
INSERT INTO branch VALUES("3","1","7","icom square","Headquarter","yi","0168832233","icom square","Teapack 2.0 @ icom square, Kuching, Sarawak, Malaysia","1.5514838504301243,110.37334264999998","","2021-04-21 14:17:06","2021-04-21 14:35:26");
INSERT INTO branch VALUES("4","1","7","tea pack saradise","Headquarter","0168885499","0168832233","hsadhsadhsadgash","Saradise Kuching, Jalan Stutong, Kuching, Sarawak, Malaysia","1.5052900004173113,110.3584021","","2021-04-21 14:34:53","2021-04-21 14:34:53");



CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `category` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO category VALUES("1","1","Mulu Caves Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("2","1","BEACH RESORT","","0","2","2020-11-24 12:11:34","2020-11-26 11:53:59");
INSERT INTO category VALUES("4","1","National Park Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("5","1","Batang Ai Resort ","","0","2","2020-11-24 12:11:34","2020-11-26 11:54:14");
INSERT INTO category VALUES("6","1","WILDLIFE TOURS","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("8","1","Kuching Day Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("9","1","black coder","","0","2","2020-11-24 12:11:34","2020-11-26 11:53:36");
INSERT INTO category VALUES("10","2","3D/2N Mt Kinabalu Summit Trek","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("12","2","K K City Tour","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("13","2"," Sepilok Orangutan Rehabilitation Centre","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("14","2","3D2N Kinabatangan River Wildlife Safari","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("15","2","Sandakan Wildlife Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("16","2","Lok Kawi Wildlife Park","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("17","2","3D2N Tabin Wildlife Reserve","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("18","2","Padas Whitewater Rafting","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("19","2","Gaya Island","","","0","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("20","2","Kinabalu Park","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("21","2","Sandakan Day Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");
INSERT INTO category VALUES("22","2","Welcome To Sabah","","0","2","2020-11-24 12:11:34","2020-11-26 11:54:35");
INSERT INTO category VALUES("23","2","K.K. Day Tours","","","1","2020-11-24 12:11:34","2020-11-24 12:11:34");



CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO company VALUES("1","Taka Sdn. Bhd.","1","2021-04-09 15:18:42","2021-04-09 15:18:42");
INSERT INTO company VALUES("2","H&L Supermarket Sdn Bhd","1","2021-04-09 15:20:23","2021-04-09 15:20:23");
INSERT INTO company VALUES("3","","0","2021-04-21 13:57:30","2021-04-21 13:57:30");
INSERT INTO company VALUES("4","","0","2021-04-21 13:58:08","2021-04-21 13:58:08");
INSERT INTO company VALUES("5","tea pack","0","2021-04-21 13:59:42","2021-04-21 13:59:42");
INSERT INTO company VALUES("6","DD","0","2021-04-21 14:09:51","2021-04-21 14:09:51");
INSERT INTO company VALUES("7","tea pack","1","2021-04-21 14:14:24","2021-04-21 14:14:24");



CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `content` longtext CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO content VALUES("1","Contact Us","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="row">
<div class="col-12 col-md-12">
<p><strong style="font-size: 30px;">Administration Office</strong><br /><span style="color: #808080;">Sublot 47, 48 &amp; 49, Block A, 1st-3rd Flr, Demak Laut&nbsp; Commercial Centre Phase 3, Jalan Bako, Petra Jaya, Kuching, Sarawak. Malaysia.</span></p>
<p><span style="color: #808080;">TEL :6082-439732,&nbsp; Fax :608243976 /432359</span></p>
<p>&nbsp;</p>
<p><strong style="font-size: 30px;">Kuala Lumpur Office<br /></strong><span style="color: #808080;">Suite 8-8,8th Floor, Wisma UOA II, No 21, Jalan Pinang, 50450 Kuala Lumpur, Malaysia.</span></p>
<p><span style="color: #808080;">Tel :6082-21811999/603-21610178 Fax:603-21660637</span></p>
<p>&nbsp;</p>
</div>
<div class="col-12 col-md-12">
<p><strong style="font-size: 30px;">Sejingkat Fab. Yard</strong><br /><span style="color: #808080;">Lot 343, Block 8, Muara Tebas Land District, Sejingkat, Off Jalan Bako, 93050 Kuching, Sarawak, Malaysia.<br /></span></p>
<p><span style="color: #808080;">Tel:6082-432640 Fax:6082433146</span></p>
<p>&nbsp;</p>
<p><strong style="font-size: 30px;">Demak Fab. Yard </strong><br /><span style="color: #808080;">Lot 1010, Block 8, Muara Tebas Land District, Demak Laut Industrial Estate Phase III, 93050 Kuching, Sarawak, Malaysia.<br /></span></p>
<p><span style="color: #808080;">Tel:432353 Fax:432352</span></p>
<p>&nbsp;</p>
</div>
</div>
<div class="row">
<div class="col-12"><!--<p><iframe style="border: 0;" tabindex="0" src=".google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3454652410464!2d110.35509576004047!3d1.556877502372591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fba7ea00f1b6b1%3A0xcceb8f812855f8cc!2sMing%20Ming%20Travel%20Service%20Sdn.%20Bhd.!5e0!3m2!1sen!2smy!4v1609293965588!5m2!1sen!2smy" width="100%" height="50vh" frameborder="0" allowfullscreen="allowfullscreen" aria-hidden="false"></iframe></p>-->
<p><a href=".google.com/maps/place/Ming+Ming+Travel+Service+Sdn.+Bhd./@1.5568775,110.3550958,17z/data=!4m5!3m4!1s0x31fba7ea00f1b6b1:0xcceb8f812855f8cc!8m2!3d1.5571778!4d110.354849" target="_blank" rel="noopener"><span style="color: #808080;"><img src="../../photo/603341298d44b.png" alt="" width="1124" height="576" /></span></a></p>
</div>
</div>
</body>
</html>","1","2020-10-27 13:43:52","2021-02-22 13:30:24");
INSERT INTO content VALUES("2","Home Welcome","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p style="text-align: center;"><br /><img src="../../images/logo.gif" alt="" /></p>
<h1 style="text-align: center;">Welcome to Borneo Tours</h1>
<div class="row" style="text-align: center;">
<div class="col-12 col-md-8 offset-md-2">Welcome to the world of Inter-Borneo Tours! A family runs business to realize the love of travel; to search for new vistas and experience and to see for ourselves the rich diversity of history, people and their cultures that make up the world.</div>
</div>
<p style="text-align: center;"><br /><br /></p>
</body>
</html>","","2020-10-27 13:43:52","2020-11-30 10:23:54");



CREATE TABLE `developer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `developer_photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO developer VALUES("1","photo/5fa0aed81c68e.png","1","1","2020-10-27 13:36:40","2020-11-03 09:14:00");
INSERT INTO developer VALUES("2","photo/5fa0aeeb8a211.png","2","1","2020-10-27 13:36:43","2020-11-03 09:14:19");
INSERT INTO developer VALUES("3","photo/5fa0af0e2a35d.jpg","3","1","2020-10-27 13:36:48","2020-11-03 09:14:54");
INSERT INTO developer VALUES("4","photo/5fa0af137c1b4.png","4","1","2020-10-27 13:36:52","2020-11-03 09:14:59");
INSERT INTO developer VALUES("5","photo/5fa0af1a14eb1.jpg","5","1","2020-10-27 13:36:58","2020-11-03 09:15:06");
INSERT INTO developer VALUES("6","photo/5fa0af216b190.jpg","6","1","2020-10-27 13:37:01","2020-11-03 09:15:13");
INSERT INTO developer VALUES("7","photo/5fa0af296d32f.jpg","7","1","2020-10-27 13:37:57","2020-11-03 09:15:21");



CREATE TABLE `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` int(11) DEFAULT NULL,
  `vehicle_type` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `working_time` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_number` int(11) DEFAULT NULL,
  `emergency_contact_number` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `plate_number` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `branch_location_coordinate` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `vehicle_belonging` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `photo_of_ic` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `photo_of_driving_license` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `vehicle_front_view` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `vehicle_back_view` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `temp_password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `merit` int(11) DEFAULT NULL,
  `notify_note` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `location_time` int(11) DEFAULT NULL,
  `push_token` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO driver VALUES("1","1","1","Jonathan","full","2147483647","0123213213","123213213","","Jonathan","photo/6073ec22d5882.jpg","photo/6073ec22d753d.jpg","photo/6073ec22d898e.jpg","photo/6073ec3b87145.jpg","Q","7694f4a66316e53c8cdd9d9954bd611d","","144","","{"timestamp":1622191943567,"mocked":false,"coords":{"altitude":51.23489024434667,"heading":0,"altitudeAccuracy":3,"latitude":1.5314472,"speed":0,"longitude":110.246294,"accuracy":18.61199951171875}}","1622195223","ExponentPushToken[TT1n5_MWlZqy_thPbmbccG]","1","2021-04-12 14:43:46","2021-05-28 17:47:03");
INSERT INTO driver VALUES("2","1","1","Vivian","part","648182928","69191959595","Qar959","","Wong ","","","","","V","7694f4a66316e53c8cdd9d9954bd611d","","132","","{"timestamp":1622191943567,"mocked":false,"coords":{"altitude":51.23489024434667,"heading":0,"altitudeAccuracy":3,"latitude":1.5314472,"speed":0,"longitude":110.246294,"accuracy":18.61199951171875}}","1622193140","ExponentPushToken[z82bkeArq37w2DSPCU5CXy]","1","2021-04-29 09:58:00","2021-05-28 14:30:07");
INSERT INTO driver VALUES("88","1","1","John","part","9191919","94882829","Bbb","","Yheb","images/608bf02ed92f1.jpg","images/608bf02ed959c.jpg","images/608bf02ed9741.jpg","images/608bf02ed98f5.jpg","Johnson ","623016f34769b266b644be390638f266","","100","","","","","1","2021-04-30 19:48:14","2021-04-30 19:55:26");
INSERT INTO driver VALUES("93","1","1","A","","65","5994","Bsbbd","","Hdbbsbd","images/608bf2ef947f3.jpg","images/608bf2ef94ab8.jpg","images/608bf2ef94c5c.jpg","images/608bf2ef94e08.jpg","Howhv","528666570de3961df276c858d9080787","","100","","","","","","2021-04-30 20:06:02","2021-04-30 20:07:11");
INSERT INTO driver VALUES("94","1","1","A","","65","5994","Bsbbd","","Hdbbsbd","images/608bf34e8aadf.jpg","images/608bf34e8ada2.jpg","images/608bf34e8af36.jpg","images/608bf34e8b0e0.jpg","John","527bd5b5d689e2c32ae974c6229ff785","","100","","","","","1","2021-04-30 20:08:45","2021-04-30 20:08:46");



CREATE TABLE `driver_on_off` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver` int(11) DEFAULT NULL,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `node_time` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1721 DEFAULT CHARSET=utf8mb4;

INSERT INTO driver_on_off VALUES("2","1","1620291162","1620291188","","3600","2021-05-07","","2021-05-06 16:52:42","2021-05-06 16:53:08");
INSERT INTO driver_on_off VALUES("116","1","1620357184","1620370377","","13193","2021-05-07","","2021-05-07 11:13:04","2021-05-07 14:52:57");
INSERT INTO driver_on_off VALUES("125","1","1620717232","1620718662","1620718662","1430","2021-05-11","nodeCloseSession","2021-05-11 15:13:52","2021-05-11 15:37:54");
INSERT INTO driver_on_off VALUES("138","1","1620718867","1620718933","1620718933","66","2021-05-11","nodeCloseSession","2021-05-11 15:41:07","2021-05-11 15:43:04");
INSERT INTO driver_on_off VALUES("139","1","1620718984","1620719074","1620719074","90","2021-05-11","nodeCloseSession","2021-05-11 15:43:04","2021-05-11 15:44:59");
INSERT INTO driver_on_off VALUES("140","1","1620719099","1620719424","1620719424","325","2021-05-11","nodeCloseSession","2021-05-11 15:44:59","2021-05-11 15:54:05");
INSERT INTO driver_on_off VALUES("141","1","1620719645","1620719705","1620719705","60","2021-05-11","nodeCloseSession","2021-05-11 15:54:05","2021-05-11 15:56:05");
INSERT INTO driver_on_off VALUES("142","1","1620719765","1620719877","1620719877","112","2021-05-11","nodeCloseSession","2021-05-11 15:56:05","2021-05-11 15:58:57");
INSERT INTO driver_on_off VALUES("143","1","1620719937","1620719997","1620719997","60","2021-05-11","nodeCloseSession","2021-05-11 15:58:57","2021-05-11 16:00:57");
INSERT INTO driver_on_off VALUES("144","1","1620720057","1620720117","1620720117","60","2021-05-11","nodeCloseSession","2021-05-11 16:00:57","2021-05-11 16:02:57");
INSERT INTO driver_on_off VALUES("145","1","1620720177","1620720237","1620720237","60","2021-05-11","nodeCloseSession","2021-05-11 16:02:57","2021-05-11 16:04:57");
INSERT INTO driver_on_off VALUES("146","1","1620720297","1620720357","1620720357","60","2021-05-11","nodeCloseSession","2021-05-11 16:04:57","2021-05-11 16:06:57");
INSERT INTO driver_on_off VALUES("147","1","1620720417","1620720477","1620720477","60","2021-05-11","nodeCloseSession","2021-05-11 16:06:57","2021-05-11 16:08:57");
INSERT INTO driver_on_off VALUES("148","1","1620720537","1620720597","1620720597","60","2021-05-11","nodeCloseSession","2021-05-11 16:08:57","2021-05-11 16:10:57");
INSERT INTO driver_on_off VALUES("149","1","1620720657","1620720717","1620720717","60","2021-05-11","nodeCloseSession","2021-05-11 16:10:57","2021-05-11 16:12:57");
INSERT INTO driver_on_off VALUES("150","1","1620720777","1620720837","1620720837","60","2021-05-11","nodeCloseSession","2021-05-11 16:12:57","2021-05-11 16:14:57");
INSERT INTO driver_on_off VALUES("151","1","1620720897","1620720957","1620720957","60","2021-05-11","nodeCloseSession","2021-05-11 16:14:57","2021-05-11 16:16:57");
INSERT INTO driver_on_off VALUES("152","1","1620721017","1620721077","1620721077","60","2021-05-11","nodeCloseSession","2021-05-11 16:16:57","2021-05-11 16:18:57");
INSERT INTO driver_on_off VALUES("153","1","1620721137","1620721197","1620721197","60","2021-05-11","nodeCloseSession","2021-05-11 16:18:57","2021-05-11 16:20:57");
INSERT INTO driver_on_off VALUES("154","1","1620721257","1620721317","1620721317","60","2021-05-11","nodeCloseSession","2021-05-11 16:20:57","2021-05-11 16:22:57");
INSERT INTO driver_on_off VALUES("155","1","1620721377","1620721437","1620721437","60","2021-05-11","nodeCloseSession","2021-05-11 16:22:57","2021-05-11 16:24:57");
INSERT INTO driver_on_off VALUES("156","1","1620721497","1620721557","1620721557","60","2021-05-11","nodeCloseSession","2021-05-11 16:24:57","2021-05-11 16:26:57");
INSERT INTO driver_on_off VALUES("157","1","1620721617","1620721677","1620721677","60","2021-05-11","nodeCloseSession","2021-05-11 16:26:57","2021-05-11 16:28:35");
INSERT INTO driver_on_off VALUES("204","1","1620724051","1620724111","1620724111","60","2021-05-11","nodeCloseSession","2021-05-11 17:07:31","2021-05-11 17:12:59");
INSERT INTO driver_on_off VALUES("205","1","1620724379","1620724546","1620724546","167","2021-05-11","nodeCloseSession","2021-05-11 17:12:59","2021-05-11 17:16:35");
INSERT INTO driver_on_off VALUES("263","1","1620726719","1620726809","1620726809","90","2021-05-11","nodeCloseSession","2021-05-11 17:51:59","2021-05-11 17:54:29");
INSERT INTO driver_on_off VALUES("264","1","1620726869","1620726929","1620726929","60","2021-05-11","nodeCloseSession","2021-05-11 17:54:29","2021-05-11 17:56:29");
INSERT INTO driver_on_off VALUES("265","1","1620726989","1620727049","1620727049","60","2021-05-11","nodeCloseSession","2021-05-11 17:56:29","2021-05-11 17:58:29");
INSERT INTO driver_on_off VALUES("266","1","1620727109","1620727169","1620727169","60","2021-05-11","nodeCloseSession","2021-05-11 17:58:29","2021-05-11 18:00:29");
INSERT INTO driver_on_off VALUES("267","1","1620727229","1620727289","1620727289","60","2021-05-11","nodeCloseSession","2021-05-11 18:00:29","2021-05-11 18:17:08");
INSERT INTO driver_on_off VALUES("269","1","1620728347","1620728408","1620728408","61","2021-05-11","nodeCloseSession","2021-05-11 18:19:07","2021-05-11 18:21:08");
INSERT INTO driver_on_off VALUES("271","1","1620728588","1620735230","1620735230","6642","2021-05-11","nodeCloseSession","2021-05-11 18:23:08","2021-05-11 20:14:50");
INSERT INTO driver_on_off VALUES("272","1","1620735290","1620735350","1620735350","60","2021-05-11","nodeCloseSession","2021-05-11 20:14:50","2021-05-11 20:16:50");
INSERT INTO driver_on_off VALUES("273","1","1620735410","1620735470","1620735470","60","2021-05-11","nodeCloseSession","2021-05-11 20:16:50","2021-05-11 20:18:50");
INSERT INTO driver_on_off VALUES("274","1","1620735530","1620735592","1620735592","62","2021-05-11","nodeCloseSession","2021-05-11 20:18:50","2021-05-11 20:20:50");
INSERT INTO driver_on_off VALUES("289","1","1620787689","1620787749","1620787749","60","2021-05-12","nodeCloseSession","2021-05-12 10:48:10","2021-05-12 10:50:09");
INSERT INTO driver_on_off VALUES("290","1","1620787809","1620787869","1620787869","60","2021-05-12","nodeCloseSession","2021-05-12 10:50:09","2021-05-12 10:52:10");
INSERT INTO driver_on_off VALUES("292","1","1620788049","1620788109","1620788109","60","2021-05-12","nodeCloseSession","2021-05-12 10:54:09","2021-05-12 10:56:09");
INSERT INTO driver_on_off VALUES("293","1","1620788169","1620788229","1620788229","60","2021-05-12","nodeCloseSession","2021-05-12 10:56:09","2021-05-12 10:58:06");
INSERT INTO driver_on_off VALUES("295","1","1620788346","1620788436","1620788436","90","2021-05-12","nodeCloseSession","2021-05-12 10:59:06","2021-05-12 11:00:50");
INSERT INTO driver_on_off VALUES("322","1","1620790366","1620790426","1620790426","60","2021-05-12","nodeCloseSession","2021-05-12 11:32:46","2021-05-12 11:34:46");
INSERT INTO driver_on_off VALUES("323","1","1620790486","1620790546","1620790546","60","2021-05-12","nodeCloseSession","2021-05-12 11:34:46","2021-05-12 11:41:10");
INSERT INTO driver_on_off VALUES("328","1","1620814163","1620814223","1620814223","60","2021-05-12","nodeCloseSession","2021-05-12 18:09:23","2021-05-12 18:11:48");
INSERT INTO driver_on_off VALUES("439","1","1620817873","1620817933","1620817933","60","2021-05-12","nodeCloseSession","2021-05-12 19:11:13","2021-05-12 19:13:13");
INSERT INTO driver_on_off VALUES("440","1","1620817993","1620818053","1620818053","60","2021-05-12","nodeCloseSession","2021-05-12 19:13:13","2021-05-12 19:15:13");
INSERT INTO driver_on_off VALUES("441","1","1620818113","1620818173","1620818173","60","2021-05-12","nodeCloseSession","2021-05-12 19:15:13","2021-05-12 19:17:13");
INSERT INTO driver_on_off VALUES("442","1","1620818233","1620818293","1620818293","60","2021-05-12","nodeCloseSession","2021-05-12 19:17:13","2021-05-12 19:19:13");
INSERT INTO driver_on_off VALUES("443","1","1620818353","1620818413","1620818413","60","2021-05-12","nodeCloseSession","2021-05-12 19:19:13","2021-05-12 19:21:13");
INSERT INTO driver_on_off VALUES("444","1","1620818473","1620818533","1620818533","60","2021-05-12","nodeCloseSession","2021-05-12 19:21:13","2021-05-12 19:23:13");
INSERT INTO driver_on_off VALUES("445","1","1620818593","1620818653","1620818653","60","2021-05-12","nodeCloseSession","2021-05-12 19:23:13","2021-05-12 19:25:13");
INSERT INTO driver_on_off VALUES("446","1","1620818713","1620818773","1620818773","60","2021-05-12","nodeCloseSession","2021-05-12 19:25:13","2021-05-12 19:27:13");
INSERT INTO driver_on_off VALUES("447","1","1620818833","1620818893","1620818893","60","2021-05-12","nodeCloseSession","2021-05-12 19:27:13","2021-05-12 19:29:13");
INSERT INTO driver_on_off VALUES("448","1","1620818953","1620819013","1620819013","60","2021-05-12","nodeCloseSession","2021-05-12 19:29:13","2021-05-12 19:31:13");
INSERT INTO driver_on_off VALUES("449","1","1620819073","1620819133","1620819133","60","2021-05-12","nodeCloseSession","2021-05-12 19:31:13","2021-05-12 19:33:13");
INSERT INTO driver_on_off VALUES("450","1","1620819193","1620819253","1620819253","60","2021-05-12","nodeCloseSession","2021-05-12 19:33:13","2021-05-12 21:51:00");
INSERT INTO driver_on_off VALUES("451","1","1620827460","1620827520","1620827520","60","2021-05-12","nodeCloseSession","2021-05-12 21:51:00","2021-05-12 21:53:00");
INSERT INTO driver_on_off VALUES("452","1","1620827580","1620827640","1620827640","60","2021-05-12","nodeCloseSession","2021-05-12 21:53:00","2021-05-12 21:55:00");
INSERT INTO driver_on_off VALUES("453","1","1620827700","1620827760","1620827760","60","2021-05-12","nodeCloseSession","2021-05-12 21:55:00","2021-05-12 21:57:00");
INSERT INTO driver_on_off VALUES("454","1","1620827820","1620827880","1620827880","60","2021-05-12","nodeCloseSession","2021-05-12 21:57:00","2021-05-12 22:03:03");
INSERT INTO driver_on_off VALUES("455","1","1620828183","","","","2021-05-12","","2021-05-12 22:03:03","2021-05-12 22:03:03");
INSERT INTO driver_on_off VALUES("456","1","1621213914","1621214334","1621214334","420","2021-05-17","nodeCloseSession","2021-05-17 09:11:54","2021-05-17 09:32:54");
INSERT INTO driver_on_off VALUES("457","1","1621215174","1621216352","1621216352","1178","2021-05-17","nodeCloseSession","2021-05-17 09:32:54","2021-05-17 09:53:32");
INSERT INTO driver_on_off VALUES("458","1","1621216412","1621216472","1621216472","60","2021-05-17","nodeCloseSession","2021-05-17 09:53:32","2021-05-17 09:55:32");
INSERT INTO driver_on_off VALUES("478","1","1621217672","1621218432","1621218432","760","2021-05-17","nodeCloseSession","2021-05-17 10:14:32","2021-05-17 10:28:11");
INSERT INTO driver_on_off VALUES("479","1","1621218491","1621218551","1621218551","60","2021-05-17","nodeCloseSession","2021-05-17 10:28:11","2021-05-17 10:30:12");
INSERT INTO driver_on_off VALUES("480","1","1621218612","1621218672","1621218672","60","2021-05-17","nodeCloseSession","2021-05-17 10:30:12","2021-05-17 10:33:01");
INSERT INTO driver_on_off VALUES("481","1","1621218781","1621218841","1621218841","60","2021-05-17","nodeCloseSession","2021-05-17 10:33:02","2021-05-17 10:35:01");
INSERT INTO driver_on_off VALUES("482","1","1621218901","1621218961","1621218961","60","2021-05-17","nodeCloseSession","2021-05-17 10:35:01","2021-05-17 10:37:01");
INSERT INTO driver_on_off VALUES("483","1","1621219021","1621219081","1621219081","60","2021-05-17","nodeCloseSession","2021-05-17 10:37:01","2021-05-17 10:39:02");
INSERT INTO driver_on_off VALUES("484","1","1621219141","1621219201","1621219201","60","2021-05-17","nodeCloseSession","2021-05-17 10:39:02","2021-05-17 10:41:01");
INSERT INTO driver_on_off VALUES("485","1","1621219261","1621219321","1621219321","60","2021-05-17","nodeCloseSession","2021-05-17 10:41:01","2021-05-17 10:44:51");
INSERT INTO driver_on_off VALUES("517","1","1621223865","1621223925","1621223925","60","2021-05-17","nodeCloseSession","2021-05-17 11:57:45","2021-05-17 11:59:45");
INSERT INTO driver_on_off VALUES("518","1","1621223985","1621224045","1621224045","60","2021-05-17","nodeCloseSession","2021-05-17 11:59:45","2021-05-17 12:01:45");
INSERT INTO driver_on_off VALUES("519","1","1621224105","1621224165","1621224165","60","2021-05-17","nodeCloseSession","2021-05-17 12:01:45","2021-05-17 12:03:45");
INSERT INTO driver_on_off VALUES("520","1","1621224225","1621224285","1621224285","60","2021-05-17","nodeCloseSession","2021-05-17 12:03:45","2021-05-17 12:05:45");
INSERT INTO driver_on_off VALUES("521","1","1621224345","1621224405","1621224405","60","2021-05-17","nodeCloseSession","2021-05-17 12:05:45","2021-05-17 12:07:45");
INSERT INTO driver_on_off VALUES("522","1","1621224465","1621224525","1621224525","60","2021-05-17","nodeCloseSession","2021-05-17 12:07:45","2021-05-17 12:09:45");
INSERT INTO driver_on_off VALUES("523","1","1621224585","1621224645","1621224645","60","2021-05-17","nodeCloseSession","2021-05-17 12:09:45","2021-05-17 12:11:45");
INSERT INTO driver_on_off VALUES("524","1","1621224705","1621224765","1621224765","60","2021-05-17","nodeCloseSession","2021-05-17 12:11:45","2021-05-17 12:13:45");
INSERT INTO driver_on_off VALUES("525","1","1621224825","1621224885","1621224885","60","2021-05-17","nodeCloseSession","2021-05-17 12:13:45","2021-05-17 12:15:45");
INSERT INTO driver_on_off VALUES("526","1","1621224945","1621225005","1621225005","60","2021-05-17","nodeCloseSession","2021-05-17 12:15:45","2021-05-17 12:17:45");
INSERT INTO driver_on_off VALUES("527","1","1621225065","1621225125","1621225125","60","2021-05-17","nodeCloseSession","2021-05-17 12:17:45","2021-05-17 12:19:45");
INSERT INTO driver_on_off VALUES("528","1","1621225185","1621225245","1621225245","60","2021-05-17","nodeCloseSession","2021-05-17 12:19:45","2021-05-17 12:21:45");
INSERT INTO driver_on_off VALUES("529","1","1621225305","1621225365","1621225365","60","2021-05-17","nodeCloseSession","2021-05-17 12:21:45","2021-05-17 12:23:45");
INSERT INTO driver_on_off VALUES("530","1","1621225425","1621225485","1621225485","60","2021-05-17","nodeCloseSession","2021-05-17 12:23:45","2021-05-17 12:25:45");
INSERT INTO driver_on_off VALUES("531","1","1621225545","1621225605","1621225605","60","2021-05-17","nodeCloseSession","2021-05-17 12:25:45","2021-05-17 12:27:45");
INSERT INTO driver_on_off VALUES("532","1","1621225665","1621225725","1621225725","60","2021-05-17","nodeCloseSession","2021-05-17 12:27:45","2021-05-17 12:40:40");
INSERT INTO driver_on_off VALUES("533","1","1621226440","1621226569","1621226569","129","2021-05-17","nodeCloseSession","2021-05-17 12:40:40","2021-05-17 12:43:49");
INSERT INTO driver_on_off VALUES("534","1","1621226629","1621226689","1621226689","60","2021-05-17","nodeCloseSession","2021-05-17 12:43:49","2021-05-17 12:45:49");
INSERT INTO driver_on_off VALUES("535","1","1621226749","1621226809","1621226809","60","2021-05-17","nodeCloseSession","2021-05-17 12:45:49","2021-05-17 12:47:49");
INSERT INTO driver_on_off VALUES("536","1","1621226869","1621226929","1621226929","60","2021-05-17","nodeCloseSession","2021-05-17 12:47:49","2021-05-17 12:49:49");
INSERT INTO driver_on_off VALUES("537","1","1621226989","1621227049","1621227049","60","2021-05-17","nodeCloseSession","2021-05-17 12:49:49","2021-05-17 12:51:49");
INSERT INTO driver_on_off VALUES("538","1","1621227109","1621227169","1621227169","60","2021-05-17","nodeCloseSession","2021-05-17 12:51:49","2021-05-17 12:53:49");
INSERT INTO driver_on_off VALUES("539","1","1621227229","1621227289","1621227289","60","2021-05-17","nodeCloseSession","2021-05-17 12:53:49","2021-05-17 12:55:49");
INSERT INTO driver_on_off VALUES("540","1","1621227349","1621227409","1621227409","60","2021-05-17","nodeCloseSession","2021-05-17 12:55:49","2021-05-17 12:57:49");
INSERT INTO driver_on_off VALUES("541","1","1621227469","1621227529","1621227529","60","2021-05-17","nodeCloseSession","2021-05-17 12:57:49","2021-05-17 12:59:49");
INSERT INTO driver_on_off VALUES("542","1","1621227589","1621227649","1621227649","60","2021-05-17","nodeCloseSession","2021-05-17 12:59:49","2021-05-17 13:01:49");
INSERT INTO driver_on_off VALUES("543","1","1621227709","1621227769","1621227769","60","2021-05-17","nodeCloseSession","2021-05-17 13:01:49","2021-05-17 13:03:49");
INSERT INTO driver_on_off VALUES("544","1","1621227829","1621227889","1621227889","60","2021-05-17","nodeCloseSession","2021-05-17 13:03:49","2021-05-17 13:05:49");
INSERT INTO driver_on_off VALUES("545","1","1621227949","1621228118","1621228118","169","2021-05-17","nodeCloseSession","2021-05-17 13:05:49","2021-05-17 13:09:38");
INSERT INTO driver_on_off VALUES("546","1","1621228178","1621228238","1621228238","60","2021-05-17","nodeCloseSession","2021-05-17 13:09:38","2021-05-17 13:11:43");
INSERT INTO driver_on_off VALUES("548","1","1621228418","1621228478","1621228478","60","2021-05-17","nodeCloseSession","2021-05-17 13:13:38","2021-05-17 13:15:38");
INSERT INTO driver_on_off VALUES("549","1","1621228538","1621228598","1621228598","60","2021-05-17","nodeCloseSession","2021-05-17 13:15:38","2021-05-17 13:17:38");
INSERT INTO driver_on_off VALUES("550","1","1621228658","1621228718","1621228718","60","2021-05-17","nodeCloseSession","2021-05-17 13:17:38","2021-05-17 13:19:38");
INSERT INTO driver_on_off VALUES("551","1","1621228778","1621228838","1621228838","60","2021-05-17","nodeCloseSession","2021-05-17 13:19:38","2021-05-17 13:21:38");
INSERT INTO driver_on_off VALUES("552","1","1621228898","1621228958","1621228958","60","2021-05-17","nodeCloseSession","2021-05-17 13:21:38","2021-05-17 13:23:38");
INSERT INTO driver_on_off VALUES("553","1","1621229018","1621229078","1621229078","60","2021-05-17","nodeCloseSession","2021-05-17 13:23:38","2021-05-17 13:25:38");
INSERT INTO driver_on_off VALUES("554","1","1621229138","1621229198","1621229198","60","2021-05-17","nodeCloseSession","2021-05-17 13:25:38","2021-05-17 13:27:38");
INSERT INTO driver_on_off VALUES("555","1","1621229258","1621229391","1621229391","133","2021-05-17","nodeCloseSession","2021-05-17 13:27:38","2021-05-17 13:30:51");
INSERT INTO driver_on_off VALUES("556","1","1621229451","1621229511","1621229511","60","2021-05-17","nodeCloseSession","2021-05-17 13:30:51","2021-05-17 13:32:51");
INSERT INTO driver_on_off VALUES("557","1","1621229571","1621229631","1621229631","60","2021-05-17","nodeCloseSession","2021-05-17 13:32:51","2021-05-17 13:36:56");
INSERT INTO driver_on_off VALUES("558","1","1621229816","1621229876","1621229876","60","2021-05-17","nodeCloseSession","2021-05-17 13:36:56","2021-05-17 13:38:56");
INSERT INTO driver_on_off VALUES("559","1","1621229936","1621229996","1621229996","60","2021-05-17","nodeCloseSession","2021-05-17 13:38:56","2021-05-17 13:40:56");
INSERT INTO driver_on_off VALUES("560","1","1621230056","1621230116","1621230116","60","2021-05-17","nodeCloseSession","2021-05-17 13:40:56","2021-05-17 13:42:56");
INSERT INTO driver_on_off VALUES("561","1","1621230176","1621230236","1621230236","60","2021-05-17","nodeCloseSession","2021-05-17 13:42:56","2021-05-17 13:44:56");
INSERT INTO driver_on_off VALUES("562","1","1621230296","1621230356","1621230356","60","2021-05-17","nodeCloseSession","2021-05-17 13:44:56","2021-05-17 13:46:56");
INSERT INTO driver_on_off VALUES("563","1","1621230416","1621230476","1621230476","60","2021-05-17","nodeCloseSession","2021-05-17 13:46:56","2021-05-17 13:48:56");
INSERT INTO driver_on_off VALUES("564","1","1621230536","1621230596","1621230596","60","2021-05-17","nodeCloseSession","2021-05-17 13:48:56","2021-05-17 14:12:07");
INSERT INTO driver_on_off VALUES("565","1","1621231927","1621232072","1621232072","145","2021-05-17","nodeCloseSession","2021-05-17 14:12:07","2021-05-17 14:15:32");
INSERT INTO driver_on_off VALUES("566","1","1621232132","1621232192","1621232192","60","2021-05-17","nodeCloseSession","2021-05-17 14:15:32","2021-05-17 14:17:32");
INSERT INTO driver_on_off VALUES("567","1","1621232252","1621232312","1621232312","60","2021-05-17","nodeCloseSession","2021-05-17 14:17:32","2021-05-17 14:19:32");
INSERT INTO driver_on_off VALUES("568","1","1621232372","1621232432","1621232432","60","2021-05-17","nodeCloseSession","2021-05-17 14:19:32","2021-05-17 14:21:32");
INSERT INTO driver_on_off VALUES("569","1","1621232492","1621232552","1621232552","60","2021-05-17","nodeCloseSession","2021-05-17 14:21:32","2021-05-17 14:23:32");
INSERT INTO driver_on_off VALUES("570","1","1621232612","1621235136","1621235136","2524","2021-05-17","offSession","2021-05-17 14:23:32","2021-05-17 15:05:37");
INSERT INTO driver_on_off VALUES("571","1","1621235196","1621235256","1621235256","60","2021-05-17","nodeCloseSession","2021-05-17 15:06:36","2021-05-17 15:09:45");
INSERT INTO driver_on_off VALUES("572","1","1621235385","1621235449","1621235449","64","2021-05-17","nodeCloseSession","2021-05-17 15:09:45","2021-05-17 15:11:45");
INSERT INTO driver_on_off VALUES("573","1","1621235505","1621235565","1621235565","60","2021-05-17","nodeCloseSession","2021-05-17 15:11:45","2021-05-17 15:13:45");
INSERT INTO driver_on_off VALUES("574","1","1621235625","1621235685","1621235685","60","2021-05-17","nodeCloseSession","2021-05-17 15:13:45","2021-05-17 15:15:45");
INSERT INTO driver_on_off VALUES("576","1","1621235865","1621235925","1621235925","60","2021-05-17","nodeCloseSession","2021-05-17 15:17:45","2021-05-17 15:25:16");
INSERT INTO driver_on_off VALUES("579","1","1621237664","1621237724","1621237724","60","2021-05-17","nodeCloseSession","2021-05-17 15:47:44","2021-05-17 15:49:44");
INSERT INTO driver_on_off VALUES("580","1","1621237784","1621237844","1621237844","60","2021-05-17","nodeCloseSession","2021-05-17 15:49:44","2021-05-17 15:51:44");
INSERT INTO driver_on_off VALUES("581","1","1621237904","1621237964","1621237964","60","2021-05-17","nodeCloseSession","2021-05-17 15:51:44","2021-05-17 15:53:44");
INSERT INTO driver_on_off VALUES("582","1","1621238024","1621238084","1621238084","60","2021-05-17","nodeCloseSession","2021-05-17 15:53:44","2021-05-17 15:55:44");
INSERT INTO driver_on_off VALUES("583","1","1621238144","1621238204","1621238204","60","2021-05-17","nodeCloseSession","2021-05-17 15:55:44","2021-05-17 15:57:44");
INSERT INTO driver_on_off VALUES("584","1","1621238264","1621238324","1621238324","60","2021-05-17","nodeCloseSession","2021-05-17 15:57:44","2021-05-17 15:59:44");
INSERT INTO driver_on_off VALUES("585","1","1621238384","1621238444","1621238444","60","2021-05-17","nodeCloseSession","2021-05-17 15:59:44","2021-05-17 16:01:44");
INSERT INTO driver_on_off VALUES("586","1","1621238504","1621238564","1621238564","60","2021-05-17","nodeCloseSession","2021-05-17 16:01:44","2021-05-17 16:03:44");
INSERT INTO driver_on_off VALUES("587","1","1621238624","1621238684","1621238684","60","2021-05-17","nodeCloseSession","2021-05-17 16:03:44","2021-05-17 16:05:44");
INSERT INTO driver_on_off VALUES("588","1","1621238744","1621238804","1621238804","60","2021-05-17","nodeCloseSession","2021-05-17 16:05:44","2021-05-17 16:07:44");
INSERT INTO driver_on_off VALUES("589","1","1621238864","1621238924","1621238924","60","2021-05-17","nodeCloseSession","2021-05-17 16:07:44","2021-05-17 16:09:44");
INSERT INTO driver_on_off VALUES("590","1","1621238984","1621239044","1621239044","60","2021-05-17","nodeCloseSession","2021-05-17 16:09:44","2021-05-17 16:11:44");
INSERT INTO driver_on_off VALUES("591","1","1621239104","1621239164","1621239164","60","2021-05-17","nodeCloseSession","2021-05-17 16:11:44","2021-05-17 16:13:44");
INSERT INTO driver_on_off VALUES("592","1","1621239224","1621239284","1621239284","60","2021-05-17","nodeCloseSession","2021-05-17 16:13:44","2021-05-17 16:15:44");
INSERT INTO driver_on_off VALUES("593","1","1621239344","1621239404","1621239404","60","2021-05-17","nodeCloseSession","2021-05-17 16:15:44","2021-05-17 16:17:44");
INSERT INTO driver_on_off VALUES("594","1","1621239464","1621239524","1621239524","60","2021-05-17","nodeCloseSession","2021-05-17 16:17:44","2021-05-17 16:19:44");
INSERT INTO driver_on_off VALUES("595","1","1621239584","1621239644","1621239644","60","2021-05-17","nodeCloseSession","2021-05-17 16:19:44","2021-05-17 16:21:44");
INSERT INTO driver_on_off VALUES("596","1","1621239704","1621239764","1621239764","60","2021-05-17","nodeCloseSession","2021-05-17 16:21:44","2021-05-17 16:23:44");
INSERT INTO driver_on_off VALUES("597","1","1621239824","1621239884","1621239884","60","2021-05-17","nodeCloseSession","2021-05-17 16:23:44","2021-05-17 16:25:43");
INSERT INTO driver_on_off VALUES("598","1","1621239943","1621240004","1621240004","61","2021-05-17","nodeCloseSession","2021-05-17 16:25:43","2021-05-17 16:27:43");
INSERT INTO driver_on_off VALUES("599","1","1621240063","1621240124","1621240124","61","2021-05-17","nodeCloseSession","2021-05-17 16:27:43","2021-05-17 16:29:44");
INSERT INTO driver_on_off VALUES("600","1","1621240184","1621240244","1621240244","60","2021-05-17","nodeCloseSession","2021-05-17 16:29:44","2021-05-17 16:31:44");
INSERT INTO driver_on_off VALUES("601","1","1621240304","1621240364","1621240364","60","2021-05-17","nodeCloseSession","2021-05-17 16:31:44","2021-05-17 16:33:44");
INSERT INTO driver_on_off VALUES("602","1","1621240424","1621240484","1621240484","60","2021-05-17","nodeCloseSession","2021-05-17 16:33:44","2021-05-17 16:35:44");
INSERT INTO driver_on_off VALUES("603","1","1621240543","1621240604","1621240604","61","2021-05-17","nodeCloseSession","2021-05-17 16:35:44","2021-05-17 16:37:44");
INSERT INTO driver_on_off VALUES("604","1","1621240664","1621241094","1621241094","430","2021-05-17","nodeCloseSession","2021-05-17 16:37:44","2021-05-17 17:33:32");
INSERT INTO driver_on_off VALUES("605","1","1621244012","1621244072","1621244072","60","2021-05-17","nodeCloseSession","2021-05-17 17:33:32","2021-05-17 17:35:32");
INSERT INTO driver_on_off VALUES("606","1","1621244132","1621244192","1621244192","60","2021-05-17","nodeCloseSession","2021-05-17 17:35:32","2021-05-17 17:37:32");
INSERT INTO driver_on_off VALUES("607","1","1621244252","1621244312","1621244312","60","2021-05-17","nodeCloseSession","2021-05-17 17:37:32","2021-05-17 17:41:01");
INSERT INTO driver_on_off VALUES("608","1","1621244461","1621244521","1621244521","60","2021-05-17","nodeCloseSession","2021-05-17 17:41:01","2021-05-17 17:43:02");
INSERT INTO driver_on_off VALUES("611","1","1621244821","1621244881","1621244881","60","2021-05-17","nodeCloseSession","2021-05-17 17:47:01","2021-05-17 17:49:01");
INSERT INTO driver_on_off VALUES("612","1","1621244941","1621245001","1621245001","60","2021-05-17","nodeCloseSession","2021-05-17 17:49:01","2021-05-17 17:51:01");
INSERT INTO driver_on_off VALUES("613","1","1621245061","1621245121","1621245121","60","2021-05-17","nodeCloseSession","2021-05-17 17:51:01","2021-05-17 17:53:01");
INSERT INTO driver_on_off VALUES("614","1","1621245181","1621245241","1621245241","60","2021-05-17","nodeCloseSession","2021-05-17 17:53:01","2021-05-17 17:55:01");
INSERT INTO driver_on_off VALUES("615","1","1621245301","1621245361","1621245361","60","2021-05-17","nodeCloseSession","2021-05-17 17:55:01","2021-05-17 17:57:01");
INSERT INTO driver_on_off VALUES("616","1","1621245421","1621245481","1621245481","60","2021-05-17","nodeCloseSession","2021-05-17 17:57:01","2021-05-17 17:59:01");
INSERT INTO driver_on_off VALUES("617","1","1621245541","1621245601","1621245601","60","2021-05-17","nodeCloseSession","2021-05-17 17:59:01","2021-05-17 18:01:01");
INSERT INTO driver_on_off VALUES("618","1","1621245661","1621245721","1621245721","60","2021-05-17","nodeCloseSession","2021-05-17 18:01:01","2021-05-17 18:03:01");
INSERT INTO driver_on_off VALUES("619","1","1621245781","1621245841","1621245841","60","2021-05-17","nodeCloseSession","2021-05-17 18:03:01","2021-05-17 18:49:03");
INSERT INTO driver_on_off VALUES("620","1","1621248543","1621248603","1621248603","60","2021-05-17","nodeCloseSession","2021-05-17 18:49:03","2021-05-17 18:51:02");
INSERT INTO driver_on_off VALUES("621","1","1621248662","1621248723","1621248723","61","2021-05-17","nodeCloseSession","2021-05-17 18:51:02","2021-05-17 18:53:03");
INSERT INTO driver_on_off VALUES("622","1","1621248783","1621248843","1621248843","60","2021-05-17","nodeCloseSession","2021-05-17 18:53:03","2021-05-17 18:55:03");
INSERT INTO driver_on_off VALUES("623","1","1621248903","1621248963","1621248963","60","2021-05-17","nodeCloseSession","2021-05-17 18:55:03","2021-05-17 18:57:03");
INSERT INTO driver_on_off VALUES("624","1","1621249023","1621249083","1621249083","60","2021-05-17","nodeCloseSession","2021-05-17 18:57:03","2021-05-17 18:59:02");
INSERT INTO driver_on_off VALUES("625","1","1621249142","1621249202","1621249202","60","2021-05-17","nodeCloseSession","2021-05-17 18:59:02","2021-05-17 19:01:02");
INSERT INTO driver_on_off VALUES("626","1","1621249262","1621249322","1621249322","60","2021-05-17","nodeCloseSession","2021-05-17 19:01:02","2021-05-17 19:03:02");
INSERT INTO driver_on_off VALUES("627","1","1621249382","1621249555","1621249555","173","2021-05-17","nodeCloseSession","2021-05-17 19:03:03","2021-05-17 19:06:55");
INSERT INTO driver_on_off VALUES("628","1","1621249615","1621249675","1621249675","60","2021-05-17","nodeCloseSession","2021-05-17 19:06:55","2021-05-17 19:08:55");
INSERT INTO driver_on_off VALUES("629","1","1621249735","1621249795","1621249795","60","2021-05-17","nodeCloseSession","2021-05-17 19:08:55","2021-05-17 19:10:55");
INSERT INTO driver_on_off VALUES("630","1","1621249855","1621249915","1621249915","60","2021-05-17","nodeCloseSession","2021-05-17 19:10:55","2021-05-17 19:12:55");
INSERT INTO driver_on_off VALUES("631","1","1621249975","1621250035","1621250035","60","2021-05-17","nodeCloseSession","2021-05-17 19:12:55","2021-05-17 19:14:55");
INSERT INTO driver_on_off VALUES("632","1","1621250095","1621250155","1621250155","60","2021-05-17","nodeCloseSession","2021-05-17 19:14:55","2021-05-17 19:16:55");
INSERT INTO driver_on_off VALUES("633","1","1621250215","1621250275","1621250275","60","2021-05-17","nodeCloseSession","2021-05-17 19:16:55","2021-05-17 19:18:55");
INSERT INTO driver_on_off VALUES("634","1","1621250335","1621250395","1621250395","60","2021-05-17","nodeCloseSession","2021-05-17 19:18:55","2021-05-17 19:20:55");
INSERT INTO driver_on_off VALUES("635","1","1621250455","1621250515","1621250515","60","2021-05-17","nodeCloseSession","2021-05-17 19:20:55","2021-05-17 19:22:55");
INSERT INTO driver_on_off VALUES("636","1","1621250575","1621250635","1621250635","60","2021-05-17","nodeCloseSession","2021-05-17 19:22:55","2021-05-17 19:24:55");
INSERT INTO driver_on_off VALUES("637","1","1621250695","1621250755","1621250755","60","2021-05-17","nodeCloseSession","2021-05-17 19:24:55","2021-05-17 19:26:55");
INSERT INTO driver_on_off VALUES("638","1","1621250815","1621250875","1621250875","60","2021-05-17","nodeCloseSession","2021-05-17 19:26:55","2021-05-17 19:28:55");
INSERT INTO driver_on_off VALUES("639","1","1621250935","1621250995","1621250995","60","2021-05-17","nodeCloseSession","2021-05-17 19:28:55","2021-05-17 19:30:55");
INSERT INTO driver_on_off VALUES("640","1","1621251055","1621251115","1621251115","60","2021-05-17","nodeCloseSession","2021-05-17 19:30:55","2021-05-17 19:32:55");
INSERT INTO driver_on_off VALUES("641","1","1621251175","1621251235","1621251235","60","2021-05-17","nodeCloseSession","2021-05-17 19:32:55","2021-05-17 19:34:55");
INSERT INTO driver_on_off VALUES("642","1","1621251295","1621251355","1621251355","60","2021-05-17","nodeCloseSession","2021-05-17 19:34:55","2021-05-17 19:36:55");
INSERT INTO driver_on_off VALUES("643","1","1621251415","1621251475","1621251475","60","2021-05-17","nodeCloseSession","2021-05-17 19:36:55","2021-05-17 19:38:55");
INSERT INTO driver_on_off VALUES("644","1","1621251535","1621251595","1621251595","60","2021-05-17","nodeCloseSession","2021-05-17 19:38:55","2021-05-17 19:40:55");
INSERT INTO driver_on_off VALUES("645","1","1621251655","1621251715","1621251715","60","2021-05-17","nodeCloseSession","2021-05-17 19:40:55","2021-05-17 19:42:55");
INSERT INTO driver_on_off VALUES("646","1","1621251775","1621251835","1621251835","60","2021-05-17","nodeCloseSession","2021-05-17 19:42:55","2021-05-17 19:44:55");
INSERT INTO driver_on_off VALUES("647","1","1621251895","1621251955","1621251955","60","2021-05-17","nodeCloseSession","2021-05-17 19:44:55","2021-05-17 19:46:55");
INSERT INTO driver_on_off VALUES("648","1","1621252015","1621255643","1621255643","3628","2021-05-17","nodeCloseSession","2021-05-17 19:46:55","2021-05-17 20:48:28");
INSERT INTO driver_on_off VALUES("650","1","1621255823","1621255883","1621255883","60","2021-05-17","nodeCloseSession","2021-05-17 20:50:23","2021-05-17 20:52:23");
INSERT INTO driver_on_off VALUES("651","1","1621255943","1621256003","1621256003","60","2021-05-17","nodeCloseSession","2021-05-17 20:52:23","2021-05-17 20:54:23");
INSERT INTO driver_on_off VALUES("652","1","1621256063","1621256123","1621256123","60","2021-05-17","nodeCloseSession","2021-05-17 20:54:23","2021-05-17 20:56:23");
INSERT INTO driver_on_off VALUES("653","1","1621256183","1621262006","1621262006","5823","2021-05-17","nodeCloseSession","2021-05-17 20:56:23","2021-05-17 22:34:26");
INSERT INTO driver_on_off VALUES("654","1","1621262066","1621262127","1621262127","61","2021-05-17","nodeCloseSession","2021-05-17 22:34:26","2021-05-17 22:36:27");
INSERT INTO driver_on_off VALUES("655","1","1621262187","1621262247","1621262247","60","2021-05-17","nodeCloseSession","2021-05-17 22:36:27","2021-05-17 22:39:17");
INSERT INTO driver_on_off VALUES("656","1","1621262357","1621262417","1621262417","60","2021-05-17","nodeCloseSession","2021-05-17 22:39:17","2021-05-17 22:41:17");
INSERT INTO driver_on_off VALUES("657","1","1621262477","1621262537","1621262537","60","2021-05-17","nodeCloseSession","2021-05-17 22:41:17","2021-05-17 22:44:45");
INSERT INTO driver_on_off VALUES("658","1","1621262685","1621262745","1621262745","60","2021-05-17","nodeCloseSession","2021-05-17 22:44:45","2021-05-17 22:46:45");
INSERT INTO driver_on_off VALUES("680","1","1621263495","1621263555","1621263555","60","2021-05-17","nodeCloseSession","2021-05-17 22:58:15","2021-05-17 22:59:28");
INSERT INTO driver_on_off VALUES("691","1","1621263952","1621264012","1621264012","60","2021-05-17","nodeCloseSession","2021-05-17 23:05:52","2021-05-17 23:07:14");
INSERT INTO driver_on_off VALUES("713","1","1621265373","1621265496","1621265496","123","2021-05-17","nodeCloseSession","2021-05-17 23:29:33","2021-05-17 23:33:09");
INSERT INTO driver_on_off VALUES("714","1","1621265589","1621265649","1621265649","60","2021-05-17","nodeCloseSession","2021-05-17 23:33:09","2021-05-17 23:35:09");
INSERT INTO driver_on_off VALUES("715","1","1621265709","1621265769","1621265769","60","2021-05-17","nodeCloseSession","2021-05-17 23:35:09","2021-05-17 23:37:09");
INSERT INTO driver_on_off VALUES("716","1","1621265829","1621265889","1621265889","60","2021-05-17","nodeCloseSession","2021-05-17 23:37:09","2021-05-17 23:39:10");
INSERT INTO driver_on_off VALUES("718","1","1621266069","1621266129","1621266129","60","2021-05-17","nodeCloseSession","2021-05-17 23:41:09","2021-05-17 23:43:09");
INSERT INTO driver_on_off VALUES("719","1","1621266189","","","","2021-05-17","","2021-05-17 23:43:09","2021-05-17 23:43:09");
INSERT INTO driver_on_off VALUES("720","1","1621299964","1621300084","1621300084","120","2021-05-18","nodeCloseSession","2021-05-18 09:06:04","2021-05-18 09:09:04");
INSERT INTO driver_on_off VALUES("721","1","1621300144","1621300204","1621300204","60","2021-05-18","nodeCloseSession","2021-05-18 09:09:04","2021-05-18 09:11:04");
INSERT INTO driver_on_off VALUES("722","1","1621300264","1621300324","1621300324","60","2021-05-18","nodeCloseSession","2021-05-18 09:11:04","2021-05-18 09:13:04");
INSERT INTO driver_on_off VALUES("723","1","1621300384","1621300444","1621300444","60","2021-05-18","nodeCloseSession","2021-05-18 09:13:04","2021-05-18 09:15:04");
INSERT INTO driver_on_off VALUES("724","1","1621300504","1621300564","1621300564","60","2021-05-18","nodeCloseSession","2021-05-18 09:15:04","2021-05-18 09:17:04");
INSERT INTO driver_on_off VALUES("725","1","1621300624","1621300684","1621300684","60","2021-05-18","nodeCloseSession","2021-05-18 09:17:04","2021-05-18 09:19:04");
INSERT INTO driver_on_off VALUES("726","1","1621300744","1621300804","1621300804","60","2021-05-18","nodeCloseSession","2021-05-18 09:19:04","2021-05-18 09:21:04");
INSERT INTO driver_on_off VALUES("727","1","1621300864","1621300924","1621300924","60","2021-05-18","nodeCloseSession","2021-05-18 09:21:04","2021-05-18 09:23:04");
INSERT INTO driver_on_off VALUES("728","1","1621300984","1621301044","1621301044","60","2021-05-18","nodeCloseSession","2021-05-18 09:23:04","2021-05-18 09:25:04");
INSERT INTO driver_on_off VALUES("729","1","1621301104","1621301164","1621301164","60","2021-05-18","nodeCloseSession","2021-05-18 09:25:04","2021-05-18 09:27:04");
INSERT INTO driver_on_off VALUES("730","1","1621301224","1621301284","1621301284","60","2021-05-18","nodeCloseSession","2021-05-18 09:27:04","2021-05-18 09:29:04");
INSERT INTO driver_on_off VALUES("731","1","1621301344","1621301404","1621301404","60","2021-05-18","nodeCloseSession","2021-05-18 09:29:04","2021-05-18 09:31:04");
INSERT INTO driver_on_off VALUES("732","1","1621301464","1621301524","1621301524","60","2021-05-18","nodeCloseSession","2021-05-18 09:31:04","2021-05-18 09:33:04");
INSERT INTO driver_on_off VALUES("733","1","1621301584","1621301644","1621301644","60","2021-05-18","nodeCloseSession","2021-05-18 09:33:04","2021-05-18 09:35:04");
INSERT INTO driver_on_off VALUES("734","1","1621301704","1621301764","1621301764","60","2021-05-18","nodeCloseSession","2021-05-18 09:35:04","2021-05-18 09:37:04");
INSERT INTO driver_on_off VALUES("735","1","1621301824","1621301884","1621301884","60","2021-05-18","nodeCloseSession","2021-05-18 09:37:04","2021-05-18 09:39:04");
INSERT INTO driver_on_off VALUES("736","1","1621301944","1621302004","1621302004","60","2021-05-18","nodeCloseSession","2021-05-18 09:39:04","2021-05-18 09:53:05");
INSERT INTO driver_on_off VALUES("737","1","1621302785","1621302845","1621302845","60","2021-05-18","nodeCloseSession","2021-05-18 09:53:05","2021-05-18 09:55:05");
INSERT INTO driver_on_off VALUES("738","1","1621302905","1621302965","1621302965","60","2021-05-18","nodeCloseSession","2021-05-18 09:55:05","2021-05-18 09:57:05");
INSERT INTO driver_on_off VALUES("739","1","1621303025","1621303085","1621303085","60","2021-05-18","nodeCloseSession","2021-05-18 09:57:05","2021-05-18 09:59:04");
INSERT INTO driver_on_off VALUES("740","1","1621303144","1621303205","1621303205","61","2021-05-18","nodeCloseSession","2021-05-18 09:59:04","2021-05-18 11:29:11");
INSERT INTO driver_on_off VALUES("741","1","1621308551","1621308689","1621308689","138","2021-05-18","nodeCloseSession","2021-05-18 11:29:11","2021-05-18 11:32:29");
INSERT INTO driver_on_off VALUES("742","1","1621308749","1621308809","1621308809","60","2021-05-18","nodeCloseSession","2021-05-18 11:32:29","2021-05-18 11:34:29");
INSERT INTO driver_on_off VALUES("743","1","1621308869","1621308929","1621308929","60","2021-05-18","nodeCloseSession","2021-05-18 11:34:29","2021-05-18 11:36:29");
INSERT INTO driver_on_off VALUES("744","1","1621308989","1621309049","1621309049","60","2021-05-18","nodeCloseSession","2021-05-18 11:36:29","2021-05-18 11:38:29");
INSERT INTO driver_on_off VALUES("745","1","1621309109","1621309169","1621309169","60","2021-05-18","nodeCloseSession","2021-05-18 11:38:29","2021-05-18 11:40:29");
INSERT INTO driver_on_off VALUES("746","1","1621309229","1621309289","1621309289","60","2021-05-18","nodeCloseSession","2021-05-18 11:40:29","2021-05-18 11:42:29");
INSERT INTO driver_on_off VALUES("747","1","1621309349","1621309409","1621309409","60","2021-05-18","nodeCloseSession","2021-05-18 11:42:29","2021-05-18 11:44:29");
INSERT INTO driver_on_off VALUES("748","1","1621309469","1621309529","1621309529","60","2021-05-18","nodeCloseSession","2021-05-18 11:44:29","2021-05-18 11:46:29");
INSERT INTO driver_on_off VALUES("749","1","1621309589","1621309649","1621309649","60","2021-05-18","nodeCloseSession","2021-05-18 11:46:29","2021-05-18 11:48:29");
INSERT INTO driver_on_off VALUES("750","1","1621309709","1621309769","1621309769","60","2021-05-18","nodeCloseSession","2021-05-18 11:48:29","2021-05-18 11:50:29");
INSERT INTO driver_on_off VALUES("751","1","1621309829","1621309889","1621309889","60","2021-05-18","nodeCloseSession","2021-05-18 11:50:29","2021-05-18 11:52:29");
INSERT INTO driver_on_off VALUES("752","1","1621309949","1621310009","1621310009","60","2021-05-18","nodeCloseSession","2021-05-18 11:52:29","2021-05-18 11:54:29");
INSERT INTO driver_on_off VALUES("753","1","1621310069","1621310129","1621310129","60","2021-05-18","nodeCloseSession","2021-05-18 11:54:29","2021-05-18 11:56:29");
INSERT INTO driver_on_off VALUES("754","1","1621310189","1621310249","1621310249","60","2021-05-18","nodeCloseSession","2021-05-18 11:56:29","2021-05-18 11:58:29");
INSERT INTO driver_on_off VALUES("755","1","1621310309","1621310369","1621310369","60","2021-05-18","nodeCloseSession","2021-05-18 11:58:29","2021-05-18 12:00:29");
INSERT INTO driver_on_off VALUES("756","1","1621310429","1621310489","1621310489","60","2021-05-18","nodeCloseSession","2021-05-18 12:00:29","2021-05-18 12:02:29");
INSERT INTO driver_on_off VALUES("757","1","1621310549","1621310614","1621310614","65","2021-05-18","nodeCloseSession","2021-05-18 12:02:29","2021-05-18 12:04:29");
INSERT INTO driver_on_off VALUES("758","1","1621310669","1621310729","1621310729","60","2021-05-18","nodeCloseSession","2021-05-18 12:04:29","2021-05-18 12:06:29");
INSERT INTO driver_on_off VALUES("759","1","1621310789","1621310849","1621310849","60","2021-05-18","nodeCloseSession","2021-05-18 12:06:29","2021-05-18 12:08:29");
INSERT INTO driver_on_off VALUES("760","1","1621310909","1621310969","1621310969","60","2021-05-18","nodeCloseSession","2021-05-18 12:08:29","2021-05-18 12:10:29");
INSERT INTO driver_on_off VALUES("761","1","1621311029","1621311089","1621311089","60","2021-05-18","nodeCloseSession","2021-05-18 12:10:29","2021-05-18 12:12:29");
INSERT INTO driver_on_off VALUES("762","1","1621311149","1621311209","1621311209","60","2021-05-18","nodeCloseSession","2021-05-18 12:12:29","2021-05-18 12:14:29");
INSERT INTO driver_on_off VALUES("763","1","1621311269","1621311329","1621311329","60","2021-05-18","nodeCloseSession","2021-05-18 12:14:29","2021-05-18 12:16:29");
INSERT INTO driver_on_off VALUES("764","1","1621311389","1621311449","1621311449","60","2021-05-18","nodeCloseSession","2021-05-18 12:16:29","2021-05-18 12:18:29");
INSERT INTO driver_on_off VALUES("765","1","1621311509","1621311569","1621311569","60","2021-05-18","nodeCloseSession","2021-05-18 12:18:29","2021-05-18 12:20:29");
INSERT INTO driver_on_off VALUES("766","1","1621311629","1621311689","1621311689","60","2021-05-18","nodeCloseSession","2021-05-18 12:20:29","2021-05-18 12:22:29");
INSERT INTO driver_on_off VALUES("767","1","1621311749","1621311809","1621311809","60","2021-05-18","nodeCloseSession","2021-05-18 12:22:29","2021-05-18 12:24:29");
INSERT INTO driver_on_off VALUES("809","1","1621315641","1621315716","1621315716","75","2021-05-18","nodeCloseSession","2021-05-18 13:27:21","2021-05-18 13:29:22");
INSERT INTO driver_on_off VALUES("810","1","1621315762","1621315836","1621315836","74","2021-05-18","nodeCloseSession","2021-05-18 13:29:22","2021-05-18 13:31:21");
INSERT INTO driver_on_off VALUES("811","1","1621315881","1621315942","1621315942","61","2021-05-18","nodeCloseSession","2021-05-18 13:31:21","2021-05-18 13:33:28");
INSERT INTO driver_on_off VALUES("812","1","1621316008","1621316126","1621316126","118","2021-05-18","nodeCloseSession","2021-05-18 13:33:28","2021-05-18 13:36:21");
INSERT INTO driver_on_off VALUES("813","1","1621316181","1621316241","1621316241","60","2021-05-18","nodeCloseSession","2021-05-18 13:36:21","2021-05-18 13:38:37");
INSERT INTO driver_on_off VALUES("815","1","1621316421","1621316513","1621316513","92","2021-05-18","nodeCloseSession","2021-05-18 13:40:21","2021-05-18 13:42:22");
INSERT INTO driver_on_off VALUES("817","1","1621316661","1621316722","1621316722","61","2021-05-18","nodeCloseSession","2021-05-18 13:44:21","2021-05-18 13:46:22");
INSERT INTO driver_on_off VALUES("821","1","1621317142","1621317216","1621317216","74","2021-05-18","nodeCloseSession","2021-05-18 13:52:22","2021-05-18 13:54:21");
INSERT INTO driver_on_off VALUES("822","1","1621317261","1621317326","1621317326","65","2021-05-18","nodeCloseSession","2021-05-18 13:54:21","2021-05-18 13:55:41");
INSERT INTO driver_on_off VALUES("979","1","1621327103","1621327285","1621327285","182","2021-05-18","nodeCloseSession","2021-05-18 16:38:23","2021-05-18 16:44:41");
INSERT INTO driver_on_off VALUES("984","1","1621327678","1621327797","1621327797","119","2021-05-18","nodeCloseSession","2021-05-18 16:47:58","2021-05-18 16:50:42");
INSERT INTO driver_on_off VALUES("991","1","1621328291","1621329038","1621329038","747","2021-05-18","nodeCloseSession","2021-05-18 16:58:11","2021-05-18 17:11:38");
INSERT INTO driver_on_off VALUES("1038","1","1621331283","1621331343","1621331343","60","2021-05-18","nodeCloseSession","2021-05-18 17:48:03","2021-05-18 17:49:38");
INSERT INTO driver_on_off VALUES("1074","1","1621334383","1621334446","1621334446","63","2021-05-18","nodeCloseSession","2021-05-18 18:39:43","2021-05-18 18:41:32");
INSERT INTO driver_on_off VALUES("1108","1","1621337332","1621337654","1621337654","322","2021-05-18","nodeCloseSession","2021-05-18 19:28:52","2021-05-18 19:34:27");
INSERT INTO driver_on_off VALUES("1116","1","1621338087","1621338203","1621338203","116","2021-05-18","nodeCloseSession","2021-05-18 19:41:27","2021-05-18 19:44:31");
INSERT INTO driver_on_off VALUES("1118","1","1621338390","1621338450","1621338450","60","2021-05-18","nodeCloseSession","2021-05-18 19:46:30","2021-05-18 19:48:30");
INSERT INTO driver_on_off VALUES("1119","1","1621338510","1621338570","1621338570","60","2021-05-18","nodeCloseSession","2021-05-18 19:48:30","2021-05-18 19:50:30");
INSERT INTO driver_on_off VALUES("1120","1","1621338630","1621338690","1621338690","60","2021-05-18","nodeCloseSession","2021-05-18 19:50:30","2021-05-18 19:52:30");
INSERT INTO driver_on_off VALUES("1121","1","1621338750","1621338810","1621338810","60","2021-05-18","nodeCloseSession","2021-05-18 19:52:30","2021-05-18 19:54:30");
INSERT INTO driver_on_off VALUES("1122","1","1621338870","1621338930","1621338930","60","2021-05-18","nodeCloseSession","2021-05-18 19:54:30","2021-05-18 19:56:30");
INSERT INTO driver_on_off VALUES("1123","1","1621338990","1621339053","1621339053","63","2021-05-18","nodeCloseSession","2021-05-18 19:56:30","2021-05-18 19:58:33");
INSERT INTO driver_on_off VALUES("1124","1","1621339113","1621339173","1621339173","60","2021-05-18","nodeCloseSession","2021-05-18 19:58:33","2021-05-18 20:00:33");
INSERT INTO driver_on_off VALUES("1125","1","1621339233","1621339324","1621339324","91","2021-05-18","nodeCloseSession","2021-05-18 20:00:33","2021-05-18 20:03:04");
INSERT INTO driver_on_off VALUES("1126","1","1621339384","1621339444","1621339444","60","2021-05-18","nodeCloseSession","2021-05-18 20:03:04","2021-05-18 20:05:04");
INSERT INTO driver_on_off VALUES("1127","1","1621339504","1621339564","1621339564","60","2021-05-18","nodeCloseSession","2021-05-18 20:05:04","2021-05-18 20:07:04");
INSERT INTO driver_on_off VALUES("1128","1","1621339624","1621339684","1621339684","60","2021-05-18","nodeCloseSession","2021-05-18 20:07:04","2021-05-18 20:09:04");
INSERT INTO driver_on_off VALUES("1129","1","1621339744","1621339804","1621339804","60","2021-05-18","nodeCloseSession","2021-05-18 20:09:04","2021-05-18 20:11:40");
INSERT INTO driver_on_off VALUES("1130","1","1621339900","1621340108","1621340108","208","2021-05-18","nodeCloseSession","2021-05-18 20:11:40","2021-05-18 20:16:02");
INSERT INTO driver_on_off VALUES("1131","1","1621340162","1621340726","1621340726","564","2021-05-18","nodeCloseSession","2021-05-18 20:16:02","2021-05-18 22:31:28");
INSERT INTO driver_on_off VALUES("1132","1","1621348288","1621348352","1621348352","64","2021-05-18","nodeCloseSession","2021-05-18 22:31:28","2021-05-18 22:33:31");
INSERT INTO driver_on_off VALUES("1133","1","1621348411","1621348472","1621348472","61","2021-05-18","nodeCloseSession","2021-05-18 22:33:31","2021-05-18 22:35:31");
INSERT INTO driver_on_off VALUES("1134","1","1621348531","1621348591","1621348591","60","2021-05-18","nodeCloseSession","2021-05-18 22:35:31","2021-05-18 22:37:31");
INSERT INTO driver_on_off VALUES("1135","1","1621348651","1621348712","1621348712","61","2021-05-18","nodeCloseSession","2021-05-18 22:37:31","2021-05-18 22:39:31");
INSERT INTO driver_on_off VALUES("1136","1","1621348771","1621348831","1621348831","60","2021-05-18","nodeCloseSession","2021-05-18 22:39:31","2021-05-18 22:41:32");
INSERT INTO driver_on_off VALUES("1138","1","1621349012","1621349072","1621349072","60","2021-05-18","nodeCloseSession","2021-05-18 22:43:32","2021-05-18 22:45:31");
INSERT INTO driver_on_off VALUES("1139","1","1621349131","1621349191","1621349191","60","2021-05-18","nodeCloseSession","2021-05-18 22:45:31","2021-05-18 22:47:32");
INSERT INTO driver_on_off VALUES("1141","1","1621349371","1621349431","1621349431","60","2021-05-18","nodeCloseSession","2021-05-18 22:49:31","2021-05-18 22:51:31");
INSERT INTO driver_on_off VALUES("1142","1","1621349491","1621349551","1621349551","60","2021-05-18","nodeCloseSession","2021-05-18 22:51:31","2021-05-18 22:53:31");
INSERT INTO driver_on_off VALUES("1143","1","1621349611","1621349671","1621349671","60","2021-05-18","nodeCloseSession","2021-05-18 22:53:31","2021-05-18 22:55:31");
INSERT INTO driver_on_off VALUES("1144","1","1621349731","1621349791","1621349791","60","2021-05-18","nodeCloseSession","2021-05-18 22:55:31","2021-05-18 22:57:31");
INSERT INTO driver_on_off VALUES("1145","1","1621349851","1621349911","1621349911","60","2021-05-18","nodeCloseSession","2021-05-18 22:57:31","2021-05-18 22:59:31");
INSERT INTO driver_on_off VALUES("1146","1","1621349971","1621350032","1621350032","61","2021-05-18","nodeCloseSession","2021-05-18 22:59:31","2021-05-18 23:01:31");
INSERT INTO driver_on_off VALUES("1147","1","1621350091","1621350152","1621350152","61","2021-05-18","nodeCloseSession","2021-05-18 23:01:31","2021-05-18 23:03:31");
INSERT INTO driver_on_off VALUES("1148","1","1621350211","1621350271","1621350271","60","2021-05-18","nodeCloseSession","2021-05-18 23:03:31","2021-05-18 23:05:31");
INSERT INTO driver_on_off VALUES("1149","1","1621350331","1621350391","1621350391","60","2021-05-18","nodeCloseSession","2021-05-18 23:05:31","2021-05-18 23:07:34");
INSERT INTO driver_on_off VALUES("1151","1","1621350571","1621350631","1621350631","60","2021-05-18","nodeCloseSession","2021-05-18 23:09:31","2021-05-18 23:11:32");
INSERT INTO driver_on_off VALUES("1153","1","1621350812","1621350879","1621350879","67","2021-05-18","nodeCloseSession","2021-05-18 23:13:32","2021-05-18 23:15:39");
INSERT INTO driver_on_off VALUES("1154","1","1621350939","1621350999","1621350999","60","2021-05-18","nodeCloseSession","2021-05-18 23:15:39","2021-05-18 23:17:39");
INSERT INTO driver_on_off VALUES("1155","1","1621351059","1621351119","1621351119","60","2021-05-18","nodeCloseSession","2021-05-18 23:17:39","2021-05-18 23:19:39");
INSERT INTO driver_on_off VALUES("1156","1","1621351179","1621351239","1621351239","60","2021-05-18","nodeCloseSession","2021-05-18 23:19:39","2021-05-18 23:21:39");
INSERT INTO driver_on_off VALUES("1157","1","1621351299","","","","2021-05-18","","2021-05-18 23:21:39","2021-05-18 23:21:39");
INSERT INTO driver_on_off VALUES("1164","1","1621390668","1621390728","1621390728","60","2021-05-19","nodeCloseSession","2021-05-19 10:17:48","2021-05-19 10:19:48");
INSERT INTO driver_on_off VALUES("1165","1","1621390788","1621390848","1621390848","60","2021-05-19","nodeCloseSession","2021-05-19 10:19:48","2021-05-19 10:21:48");
INSERT INTO driver_on_off VALUES("1166","1","1621390908","1621390968","1621390968","60","2021-05-19","nodeCloseSession","2021-05-19 10:21:48","2021-05-19 10:23:48");
INSERT INTO driver_on_off VALUES("1167","1","1621391028","1621391088","1621391088","60","2021-05-19","nodeCloseSession","2021-05-19 10:23:48","2021-05-19 10:25:48");
INSERT INTO driver_on_off VALUES("1168","1","1621391148","1621391208","1621391208","60","2021-05-19","nodeCloseSession","2021-05-19 10:25:48","2021-05-19 11:14:02");
INSERT INTO driver_on_off VALUES("1169","1","1621394042","1621394129","1621394129","87","2021-05-19","nodeCloseSession","2021-05-19 11:14:02","2021-05-19 11:16:25");
INSERT INTO driver_on_off VALUES("1247","1","1621402076","1621404190","1621404190","2114","2021-05-19","nodeCloseSession","2021-05-19 13:27:56","2021-05-19 14:03:21");
INSERT INTO driver_on_off VALUES("1263","1","1621405230","1621405291","1621405291","61","2021-05-19","nodeCloseSession","2021-05-19 14:20:30","2021-05-19 14:23:02");
INSERT INTO driver_on_off VALUES("1346","1","1621410839","1621411736","1621411736","897","2021-05-19","nodeCloseSession","2021-05-19 15:53:59","2021-05-19 16:16:20");
INSERT INTO driver_on_off VALUES("1449","1","1621418900","1621418960","1621418960","60","2021-05-19","nodeCloseSession","2021-05-19 18:08:20","2021-05-19 18:40:42");
INSERT INTO driver_on_off VALUES("1451","1","1621420902","1621433188","1621433188","12286","2021-05-19","nodeCloseSession","2021-05-19 18:41:42","2021-05-19 22:07:28");
INSERT INTO driver_on_off VALUES("1452","1","1621433248","1621433308","1621433308","60","2021-05-19","nodeCloseSession","2021-05-19 22:07:28","2021-05-19 22:09:28");
INSERT INTO driver_on_off VALUES("1453","1","1621433368","1621433428","1621433428","60","2021-05-19","nodeCloseSession","2021-05-19 22:09:28","2021-05-19 22:11:27");
INSERT INTO driver_on_off VALUES("1454","1","1621433487","1621433548","1621433548","61","2021-05-19","nodeCloseSession","2021-05-19 22:11:27","2021-05-19 22:13:27");
INSERT INTO driver_on_off VALUES("1455","1","1621433607","1621433668","1621433668","61","2021-05-19","nodeCloseSession","2021-05-19 22:13:27","2021-05-19 22:15:28");
INSERT INTO driver_on_off VALUES("1456","1","1621433727","1621433788","1621433788","61","2021-05-19","nodeCloseSession","2021-05-19 22:15:28","2021-05-19 23:03:24");
INSERT INTO driver_on_off VALUES("1457","1","1621436604","","","","2021-05-19","","2021-05-19 23:03:24","2021-05-19 23:03:24");
INSERT INTO driver_on_off VALUES("1458","1","1621839936","1621839997","1621839997","61","2021-05-24","nodeCloseSession","2021-05-24 15:05:36","2021-05-24 15:07:33");
INSERT INTO driver_on_off VALUES("1487","1","1622121713","1622121794","1622121794","81","2021-05-27","nodeCloseSession","2021-05-27 21:21:53","2021-05-27 21:23:32");
INSERT INTO driver_on_off VALUES("1535","1","1622126462","1622126620","1622126620","158","2021-05-27","nodeCloseSession","2021-05-27 22:41:02","2021-05-27 22:44:39");
INSERT INTO driver_on_off VALUES("1567","1","1622166267","1622166327","1622166327","60","2021-05-28","nodeCloseSession","2021-05-28 09:44:27","2021-05-28 09:46:27");
INSERT INTO driver_on_off VALUES("1568","1","1622166387","1622166447","1622166447","60","2021-05-28","nodeCloseSession","2021-05-28 09:46:27","2021-05-28 09:48:27");
INSERT INTO driver_on_off VALUES("1569","1","1622166507","1622166567","1622166567","60","2021-05-28","nodeCloseSession","2021-05-28 09:48:27","2021-05-28 09:50:27");
INSERT INTO driver_on_off VALUES("1570","1","1622166627","1622166687","1622166687","60","2021-05-28","nodeCloseSession","2021-05-28 09:50:27","2021-05-28 09:52:27");
INSERT INTO driver_on_off VALUES("1571","1","1622166747","1622166807","1622166807","60","2021-05-28","nodeCloseSession","2021-05-28 09:52:27","2021-05-28 09:54:28");
INSERT INTO driver_on_off VALUES("1573","1","1622166987","1622167047","1622167047","60","2021-05-28","nodeCloseSession","2021-05-28 09:56:27","2021-05-28 09:58:27");
INSERT INTO driver_on_off VALUES("1574","1","1622167107","1622167167","1622167167","60","2021-05-28","nodeCloseSession","2021-05-28 09:58:27","2021-05-28 10:00:27");
INSERT INTO driver_on_off VALUES("1575","1","1622167227","1622167287","1622167287","60","2021-05-28","nodeCloseSession","2021-05-28 10:00:27","2021-05-28 10:02:27");
INSERT INTO driver_on_off VALUES("1576","1","1622167347","1622167407","1622167407","60","2021-05-28","nodeCloseSession","2021-05-28 10:02:27","2021-05-28 10:04:27");
INSERT INTO driver_on_off VALUES("1577","1","1622167467","1622167527","1622167527","60","2021-05-28","nodeCloseSession","2021-05-28 10:04:27","2021-05-28 10:06:27");
INSERT INTO driver_on_off VALUES("1578","1","1622167587","1622167647","1622167647","60","2021-05-28","nodeCloseSession","2021-05-28 10:06:27","2021-05-28 10:08:27");
INSERT INTO driver_on_off VALUES("1579","1","1622167707","1622167767","1622167767","60","2021-05-28","nodeCloseSession","2021-05-28 10:08:27","2021-05-28 10:10:27");
INSERT INTO driver_on_off VALUES("1580","1","1622167827","1622167887","1622167887","60","2021-05-28","nodeCloseSession","2021-05-28 10:10:27","2021-05-28 10:12:27");
INSERT INTO driver_on_off VALUES("1581","1","1622167947","1622168007","1622168007","60","2021-05-28","nodeCloseSession","2021-05-28 10:12:27","2021-05-28 10:14:27");
INSERT INTO driver_on_off VALUES("1582","1","1622168067","1622168127","1622168127","60","2021-05-28","nodeCloseSession","2021-05-28 10:14:27","2021-05-28 10:16:27");
INSERT INTO driver_on_off VALUES("1583","1","1622168187","1622168247","1622168247","60","2021-05-28","nodeCloseSession","2021-05-28 10:16:27","2021-05-28 10:18:27");
INSERT INTO driver_on_off VALUES("1584","1","1622168307","1622168404","1622168404","97","2021-05-28","nodeCloseSession","2021-05-28 10:18:27","2021-05-28 10:21:03");
INSERT INTO driver_on_off VALUES("1585","1","1622168463","1622168523","1622168523","60","2021-05-28","nodeCloseSession","2021-05-28 10:21:03","2021-05-28 10:23:04");
INSERT INTO driver_on_off VALUES("1586","1","1622168583","1622168643","1622168643","60","2021-05-28","nodeCloseSession","2021-05-28 10:23:04","2021-05-28 10:25:04");
INSERT INTO driver_on_off VALUES("1589","1","1622168943","1622169003","1622169003","60","2021-05-28","nodeCloseSession","2021-05-28 10:29:03","2021-05-28 10:31:03");
INSERT INTO driver_on_off VALUES("1590","1","1622169063","1622169123","1622169123","60","2021-05-28","nodeCloseSession","2021-05-28 10:31:03","2021-05-28 10:33:04");
INSERT INTO driver_on_off VALUES("1592","1","1622169303","1622169363","1622169363","60","2021-05-28","nodeCloseSession","2021-05-28 10:35:03","2021-05-28 10:37:03");
INSERT INTO driver_on_off VALUES("1593","1","1622169423","1622169483","1622169483","60","2021-05-28","nodeCloseSession","2021-05-28 10:37:03","2021-05-28 10:39:03");
INSERT INTO driver_on_off VALUES("1594","1","1622169543","1622169604","1622169604","61","2021-05-28","nodeCloseSession","2021-05-28 10:39:03","2021-05-28 10:41:03");
INSERT INTO driver_on_off VALUES("1595","1","1622169663","1622169724","1622169724","61","2021-05-28","nodeCloseSession","2021-05-28 10:41:03","2021-05-28 10:43:03");
INSERT INTO driver_on_off VALUES("1596","1","1622169783","1622169843","1622169843","60","2021-05-28","nodeCloseSession","2021-05-28 10:43:03","2021-05-28 10:45:03");
INSERT INTO driver_on_off VALUES("1597","1","1622169903","1622169963","1622169963","60","2021-05-28","nodeCloseSession","2021-05-28 10:45:03","2021-05-28 10:47:03");
INSERT INTO driver_on_off VALUES("1598","1","1622170023","1622170083","1622170083","60","2021-05-28","nodeCloseSession","2021-05-28 10:47:03","2021-05-28 10:49:03");
INSERT INTO driver_on_off VALUES("1599","1","1622170143","1622170203","1622170203","60","2021-05-28","nodeCloseSession","2021-05-28 10:49:03","2021-05-28 10:51:03");
INSERT INTO driver_on_off VALUES("1600","1","1622170263","1622170323","1622170323","60","2021-05-28","nodeCloseSession","2021-05-28 10:51:03","2021-05-28 10:53:03");
INSERT INTO driver_on_off VALUES("1601","1","1622170383","1622170444","1622170444","61","2021-05-28","nodeCloseSession","2021-05-28 10:53:03","2021-05-28 11:21:13");
INSERT INTO driver_on_off VALUES("1602","1","1622172073","1622181217","1622181217","9144","2021-05-28","nodeCloseSession","2021-05-28 11:21:13","2021-05-28 13:54:36");
INSERT INTO driver_on_off VALUES("1603","1","1622181276","1622181336","1622181336","60","2021-05-28","nodeCloseSession","2021-05-28 13:54:36","2021-05-28 13:56:32");
INSERT INTO driver_on_off VALUES("1627","2","1622183428","","","","2021-05-28","","2021-05-28 14:30:28","2021-05-28 14:30:28");
INSERT INTO driver_on_off VALUES("1629","1","1622184246","1622184306","1622184306","60","2021-05-28","nodeCloseSession","2021-05-28 14:44:06","2021-05-28 14:46:06");
INSERT INTO driver_on_off VALUES("1630","1","1622184366","1622184426","1622184426","60","2021-05-28","nodeCloseSession","2021-05-28 14:46:06","2021-05-28 15:03:59");
INSERT INTO driver_on_off VALUES("1692","1","1622191781","1622191841","1622191841","60","2021-05-28","nodeCloseSession","2021-05-28 16:49:41","2021-05-28 16:51:41");
INSERT INTO driver_on_off VALUES("1693","1","1622191901","1622191999","1622191999","98","2021-05-28","nodeCloseSession","2021-05-28 16:51:41","2021-05-28 16:54:18");
INSERT INTO driver_on_off VALUES("1694","1","1622192058","1622192119","1622192119","61","2021-05-28","nodeCloseSession","2021-05-28 16:54:18","2021-05-28 16:56:18");
INSERT INTO driver_on_off VALUES("1695","1","1622192178","1622192238","1622192238","60","2021-05-28","nodeCloseSession","2021-05-28 16:56:18","2021-05-28 16:58:19");
INSERT INTO driver_on_off VALUES("1697","1","1622192418","1622192478","1622192478","60","2021-05-28","nodeCloseSession","2021-05-28 17:00:18","2021-05-28 17:02:18");
INSERT INTO driver_on_off VALUES("1698","1","1622192538","1622192598","1622192598","60","2021-05-28","nodeCloseSession","2021-05-28 17:02:18","2021-05-28 17:04:24");
INSERT INTO driver_on_off VALUES("1700","1","1622192778","1622192838","1622192838","60","2021-05-28","nodeCloseSession","2021-05-28 17:06:18","2021-05-28 17:08:19");
INSERT INTO driver_on_off VALUES("1703","1","1622193138","1622193199","1622193199","61","2021-05-28","nodeCloseSession","2021-05-28 17:12:18","2021-05-28 17:14:19");
INSERT INTO driver_on_off VALUES("1705","1","1622193378","1622193438","1622193438","60","2021-05-28","nodeCloseSession","2021-05-28 17:16:18","2021-05-28 17:18:18");
INSERT INTO driver_on_off VALUES("1706","1","1622193498","1622193559","1622193559","61","2021-05-28","nodeCloseSession","2021-05-28 17:18:18","2021-05-28 17:20:18");
INSERT INTO driver_on_off VALUES("1707","1","1622193618","1622193678","1622193678","60","2021-05-28","nodeCloseSession","2021-05-28 17:20:18","2021-05-28 17:22:18");
INSERT INTO driver_on_off VALUES("1708","1","1622193738","1622193799","1622193799","61","2021-05-28","nodeCloseSession","2021-05-28 17:22:18","2021-05-28 17:24:19");
INSERT INTO driver_on_off VALUES("1710","1","1622193978","1622194039","1622194039","61","2021-05-28","nodeCloseSession","2021-05-28 17:26:18","2021-05-28 17:28:19");
INSERT INTO driver_on_off VALUES("1712","1","1622194218","1622194278","1622194278","60","2021-05-28","nodeCloseSession","2021-05-28 17:30:18","2021-05-28 17:32:19");
INSERT INTO driver_on_off VALUES("1713","1","1622194339","1622194399","1622194399","60","2021-05-28","nodeCloseSession","2021-05-28 17:32:19","2021-05-28 17:34:19");
INSERT INTO driver_on_off VALUES("1714","1","1622194459","1622194519","1622194519","60","2021-05-28","nodeCloseSession","2021-05-28 17:34:19","2021-05-28 17:36:18");
INSERT INTO driver_on_off VALUES("1715","1","1622194578","1622194639","1622194639","61","2021-05-28","nodeCloseSession","2021-05-28 17:36:18","2021-05-28 17:38:18");
INSERT INTO driver_on_off VALUES("1716","1","1622194698","1622194759","1622194759","61","2021-05-28","nodeCloseSession","2021-05-28 17:38:19","2021-05-28 17:40:19");
INSERT INTO driver_on_off VALUES("1717","1","1622194819","1622194879","1622194879","60","2021-05-28","nodeCloseSession","2021-05-28 17:40:19","2021-05-28 17:42:36");
INSERT INTO driver_on_off VALUES("1718","1","1622194956","1622195043","1622195043","87","2021-05-28","nodeCloseSession","2021-05-28 17:42:36","2021-05-28 17:45:03");
INSERT INTO driver_on_off VALUES("1719","1","1622195103","1622195163","1622195163","60","2021-05-28","nodeCloseSession","2021-05-28 17:45:03","2021-05-28 17:47:03");
INSERT INTO driver_on_off VALUES("1720","1","1622195223","","","","2021-05-28","","2021-05-28 17:47:03","2021-05-28 17:47:03");



CREATE TABLE `email_notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `notify1` varchar(3) DEFAULT NULL,
  `notify2` varchar(3) DEFAULT NULL,
  `notify3` varchar(3) DEFAULT NULL,
  `notify4` varchar(3) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO email_notification VALUES("1","jonathan.wphp@gmail.com","Yes","","","","2021-05-08 15:46:26","2021-05-08 15:46:26");



CREATE TABLE `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ic` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `sarawakian` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO guest VALUES("1","hls8h47htmk9fkjtu0pujtm0sv","27","Ali","Abu","2222","on","2021-01-04 18:27:13","2021-01-04 19:39:33");
INSERT INTO guest VALUES("2","hls8h47htmk9fkjtu0pujtm0sv","26","Ali","Abu","2222","on","2021-01-04 18:27:13","2021-01-04 19:02:04");
INSERT INTO guest VALUES("3","hls8h47htmk9fkjtu0pujtm0sv","28","G2","G22","444","on","2021-01-04 19:39:33","2021-01-04 19:45:24");
INSERT INTO guest VALUES("4","n1sgparkp3l9upi01spkukk5ur","29","Jonathan1","wong2","1111","off","2021-01-08 15:48:01","2021-01-08 16:10:06");
INSERT INTO guest VALUES("5","n1sgparkp3l9upi01spkukk5ur","30","aaa","bbhb","2222","on","2021-01-08 15:48:01","2021-01-08 16:10:06");
INSERT INTO guest VALUES("6","duhjflootihakjt5jmmpgr9h6p","31","Jonathan","wong","1221212212121212","on","2021-01-12 09:22:42","2021-01-12 09:22:42");
INSERT INTO guest VALUES("7","duhjflootihakjt5jmmpgr9h6p","32","Jonathan","woon","23443523453425","on","2021-01-12 09:24:52","2021-01-12 09:24:52");
INSERT INTO guest VALUES("8","16g0ujs5nae42klur9e4ov4goq","33","Jonathan","wong","2323423435232453245","on","2021-01-12 09:29:32","2021-01-12 09:29:32");
INSERT INTO guest VALUES("9","8qlc3abjk8pitfojvoga7ilr96","35","mark ","lee","xxxxxxxxxx","on","2021-01-13 10:00:55","2021-01-13 10:00:55");
INSERT INTO guest VALUES("10","8qlc3abjk8pitfojvoga7ilr96","36","louis ","abeng","ccccccc","off","2021-01-13 10:05:39","2021-01-13 10:05:39");
INSERT INTO guest VALUES("11","8qlc3abjk8pitfojvoga7ilr96","38","ah ","peng","123456","off","2021-01-13 11:51:22","2021-01-13 11:51:22");



CREATE TABLE `home_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_text` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO home_block VALUES("1","Numerous of deals done","1","1","2020-10-27 13:42:15","2020-10-27 13:42:15");
INSERT INTO home_block VALUES("2","40 team members at your services","2","1","2020-10-27 13:42:26","2020-10-27 13:42:26");
INSERT INTO home_block VALUES("3","24/7 available around the clock","3","1","2020-10-27 13:42:33","2020-10-27 13:42:33");



CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `date` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(11,2) DEFAULT NULL,
  `total_price` decimal(11,2) DEFAULT NULL,
  `sarawakian_unit_price` decimal(11,2) DEFAULT NULL,
  `sarawakian_total_price` decimal(11,2) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO items VALUES("29","n1sgparkp3l9upi01spkukk5ur","40","photo/55f7b5f35c098.jpg","5D4N Mulu headhunters Trail","2021-01-27","1","2150.00","2150.00","","","","2021-01-08 15:46:23","2021-01-08 15:46:23");
INSERT INTO items VALUES("30","n1sgparkp3l9upi01spkukk5ur","101","photo/5fd845fd4ba36.jpg","BAKO NATIONAL PARK (DAY TRIP)","2021-01-27","1","220.00","220.00","110.00","110.00","","2021-01-08 15:47:36","2021-01-08 16:10:06");
INSERT INTO items VALUES("32","duhjflootihakjt5jmmpgr9h6p","60","photo/5576a18c03178.jpg","BOS-7D K K City Tour","2021-01-20","1","100.00","100.00","50.00","50.00","","2021-01-12 09:24:37","2021-01-12 09:24:52");
INSERT INTO items VALUES("33","16g0ujs5nae42klur9e4ov4goq","63","photo/54f96616c895b.jpg","Orangutans & Monkeys","2021-01-13","1","100.00","100.00","50.00","50.00","","2021-01-12 09:29:23","2021-01-12 09:29:32");
INSERT INTO items VALUES("40","s5hlgrrhcj4uhnhq8n4tqeqhqb","60","photo/5576a18c03178.jpg","BOS-7D K K City Tour","2021-01-26","1","100.00","100.00","","","","2021-01-18 17:09:04","2021-01-18 17:09:04");
INSERT INTO items VALUES("39","gj5k35jmhdfe4pgb72o8j0302t","63","photo/54f96616c895b.jpg","Orangutans & Monkeys","2021-01-20","1","100.00","100.00","","","","2021-01-14 09:53:04","2021-01-14 09:53:04");
INSERT INTO items VALUES("38","8qlc3abjk8pitfojvoga7ilr96","60","photo/5576a18c03178.jpg","BOS-7D K K City Tour","2021-01-22","1","100.00","100.00","","","","2021-01-13 11:11:49","2021-01-13 11:11:49");
INSERT INTO items VALUES("22","hls8h47htmk9fkjtu0pujtm0sv","60","photo/5576a18c03178.jpg","BOS-7D K K City Tour","2021-01-12","1","100.00","100.00","50.00","50.00","","2021-01-04 11:38:10","2021-01-04 19:45:24");
INSERT INTO items VALUES("28","hls8h47htmk9fkjtu0pujtm0sv","39","photo/5fc09048093f1.jpg","Annah Rais Bidayuh Longhouse","2021-01-20","2","400.00","800.00","200.00","400.00","","2021-01-04 19:45:06","2021-01-04 19:45:24");



CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_group` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `name` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `username` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `temp_password` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO login VALUES("1","1","5","Administrator","jonathan.wphp@gmail.com","admin","21232f297a57a5a743894a0e4a801fc3","","1","2020-07-30 14:31:35","2020-09-04 15:47:13");
INSERT INTO login VALUES("3","2","1","jonathan","jonathan.wphp@gmail.com","jonathan","a4e383d5c41e7c852c1fc0d6dd85f117","","1","2021-04-08 16:57:56","2021-04-08 16:57:56");
INSERT INTO login VALUES("4","1","1","Kuching","kuching@asdasd.com","kuching","afa47cbc204eb255a23b159fe0a1a079","","1","2021-04-08 16:58:30","2021-04-08 16:58:30");



CREATE TABLE `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `temp_password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO merchant VALUES("1","1","1","Takatabuan1","0cfa2db0ddd8fd49eda7645f3b79f284","","1","2021-04-09 15:22:31","2021-04-13 14:47:08");
INSERT INTO merchant VALUES("2","1","2","Takarhplaza1","72b8e1a17d9fd2dc85a514e2ebe402e7","","1","2021-04-13 10:40:16","2021-04-13 14:18:18");
INSERT INTO merchant VALUES("3","1","2","Takatabuan1","Takatabuan1","","1","2021-04-13 14:34:30","2021-04-13 14:46:01");
INSERT INTO merchant VALUES("6","7","3","teapack123","63f10ffed712aa5b2d2535d2f54ce22f","","1","2021-04-21 14:20:30","2021-04-21 14:20:30");
INSERT INTO merchant VALUES("7","7","3","ic 001","Teapack1111","","1","2021-04-21 14:39:01","2021-04-21 14:39:01");



CREATE TABLE `merit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

INSERT INTO merit VALUES("1","1","1","season reward","19","2021-05-19 15:15:32","2021-05-19 15:15:32");
INSERT INTO merit VALUES("2","1","-1","slow pick","19","2021-05-19 15:15:32","2021-05-19 15:15:32");
INSERT INTO merit VALUES("3","1","-1","slow delivery","19","2021-05-19 15:15:32","2021-05-19 15:15:32");
INSERT INTO merit VALUES("4","1","1","fast pick","13","2021-05-19 15:15:45","2021-05-19 15:15:45");
INSERT INTO merit VALUES("5","1","1","fast delivery","13","2021-05-19 15:15:45","2021-05-19 15:15:45");
INSERT INTO merit VALUES("6","1","1","season reward","13","2021-05-19 15:15:45","2021-05-19 15:15:45");
INSERT INTO merit VALUES("7","1","1","fast pick","18","2021-05-19 16:35:23","2021-05-19 16:35:23");
INSERT INTO merit VALUES("8","1","1","season reward","18","2021-05-19 16:35:23","2021-05-19 16:35:23");
INSERT INTO merit VALUES("9","1","-1","slow delivery","18","2021-05-19 16:35:23","2021-05-19 16:35:23");
INSERT INTO merit VALUES("10","1","1","fast pick","2","2021-05-27 14:07:47","2021-05-27 14:07:47");
INSERT INTO merit VALUES("11","1","1","season reward","2","2021-05-27 14:07:47","2021-05-27 14:07:47");
INSERT INTO merit VALUES("12","1","-1","slow delivery","2","2021-05-27 14:07:47","2021-05-27 14:07:47");
INSERT INTO merit VALUES("13","1","1","fast pick","6","2021-05-27 21:21:20","2021-05-27 21:21:20");
INSERT INTO merit VALUES("14","1","1","season reward","6","2021-05-27 21:21:20","2021-05-27 21:21:20");
INSERT INTO merit VALUES("15","1","-1","slow delivery","6","2021-05-27 21:21:20","2021-05-27 21:21:20");
INSERT INTO merit VALUES("16","1","1","fast pick","5","2021-05-27 22:09:05","2021-05-27 22:09:05");
INSERT INTO merit VALUES("17","1","1","season reward","5","2021-05-27 22:09:05","2021-05-27 22:09:05");
INSERT INTO merit VALUES("18","1","-1","slow delivery","5","2021-05-27 22:09:05","2021-05-27 22:09:05");
INSERT INTO merit VALUES("19","1","1","fast pick","7","2021-05-27 22:56:10","2021-05-27 22:56:10");
INSERT INTO merit VALUES("20","1","1","season reward","7","2021-05-27 22:56:10","2021-05-27 22:56:10");
INSERT INTO merit VALUES("21","1","-1","slow delivery","7","2021-05-27 22:56:10","2021-05-27 22:56:10");
INSERT INTO merit VALUES("22","1","1","season reward","12","2021-05-28 14:17:56","2021-05-28 14:17:56");
INSERT INTO merit VALUES("23","1","-1","slow pick","12","2021-05-28 14:17:56","2021-05-28 14:17:56");
INSERT INTO merit VALUES("24","1","-1","slow delivery","12","2021-05-28 14:17:56","2021-05-28 14:17:56");
INSERT INTO merit VALUES("25","2","1","fast pick","8","2021-05-28 14:18:42","2021-05-28 14:18:42");
INSERT INTO merit VALUES("26","2","1","season reward","8","2021-05-28 14:18:42","2021-05-28 14:18:42");
INSERT INTO merit VALUES("27","2","-1","slow delivery","8","2021-05-28 14:18:42","2021-05-28 14:18:42");
INSERT INTO merit VALUES("28","2","1","fast pick","9","2021-05-28 14:30:07","2021-05-28 14:30:07");
INSERT INTO merit VALUES("29","2","1","season reward","9","2021-05-28 14:30:07","2021-05-28 14:30:07");
INSERT INTO merit VALUES("30","2","-1","slow delivery","9","2021-05-28 14:30:07","2021-05-28 14:30:07");



CREATE TABLE `merit_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rule1` varchar(255) DEFAULT NULL,
  `rule2` varchar(255) DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

INSERT INTO merit_setup VALUES("1","3","","1","Daily delivered","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("2","10","","1","Monthly delivered","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("4","","","1","Peak picked","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("5","2021-05-05","2021-07-12","1","Season reward","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("6","60","","1","Fast picked","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("7","5","66","1","Fast deliver","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("8","2","8","2","Attendance reward","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("10","20","","1","Slow picked","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("11","20","30","1","Slow deliver","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("13","","","2","No pickup compensate","","","2021-05-08 13:01:45");
INSERT INTO merit_setup VALUES("14","8","","3","Minimum Hour Weekly","","","2021-05-08 13:01:45");



CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tour` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `message` longtext CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `date` varchar(19) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO message VALUES("6","BOS-5C 3D2N Mulu Cave Splendor   ","Ali","ali@ali.com","12121212","ali message ","Read","2020-11-27 11:28:25","2020-11-27 11:28:25","2020-12-17 15:27:59");
INSERT INTO message VALUES("4","Package","Jonathan Wong","jonathan.wphp@gmail.com","0168653947","Testing message, can i ask you about the location. asdsadsdasdsadsadsadd asd","New","2020-10-30 14:57:47","2020-10-30 14:57:47","2020-11-03 17:46:10");
INSERT INTO message VALUES("5","BOS/2A Bako National Park","Jonathan","jonathan@gmail.com","111","asdsad","New","2020-11-25 16:49:14","2020-11-25 16:49:14","2020-11-25 16:50:56");
INSERT INTO message VALUES("7","2D1N KAMPUNG STING, BENGOH, PADAWAN","Jonathana ","qwq@asdsad.com","wwqe","asdasdasdas dsadas dd","Read","2021-01-08 15:44:06","2021-01-08 15:44:06","2021-01-12 13:38:15");



CREATE TABLE `message_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `zone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `business_field` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `mobile_number` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `date` varchar(19) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO message_contact VALUES("1","1","1","Jonathan","3242343423","23222222","asdasdasd asdasdasd","Read","2021-04-08 16:43:25","2021-04-08 16:43:25","2021-04-21 14:08:46");
INSERT INTO message_contact VALUES("2","1","1","Jonathan","3242343423","23222222","asdasdasd asdasdasd","Read","2021-04-08 16:44:03","2021-04-08 16:44:03","2021-04-09 15:30:26");



CREATE TABLE `navigator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `conceal_date` date DEFAULT NULL,
  `file_attachment` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `news_content` longtext CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO news VALUES("1","About Our Services","photo/606e9de57132f.jpg","2021-04-15","2021-04-15","2021-12-15","","Take your brand to the next level by customizing your own promotional message to your receivers! With marketing tools, you can now bring your brand to light and make your promotional message pop in front of your customers.","2","1","2020-11-03 17:40:34","2021-04-09 16:15:17");
INSERT INTO news VALUES("3","Sign Up as Merchant Today!","photo/60700cfb1150f.jpg","2021-04-09","2021-04-23","2021-09-16","","Grow your business and reach more hungry customers with online food delivery! Click here to find out more how to be a EasyDelivery Merchant-partner today!","3","1","2021-04-09 16:14:51","2021-04-09 16:14:51");
INSERT INTO news VALUES("2","Welcome to Our New Website","photo/606e9d60eaff6.jpg","2021-04-15","2021-04-15","2021-12-15","photo/5fa1277a80a83.png","Welcome to Our New Website. So needless to say, it is important that your website is doing the best job it can, representing your company and brand. Nothing reflects worse on a brand than a static and archaic website. Are you questioning whether its time for a new redesign for your company’s website? If so, we’ve compiled a list of some critical reasons to consider building a new website.","1","1","2020-11-03 17:48:42","2021-04-08 14:09:05");



CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `zone` int(11) DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `branch_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `merchant` int(11) DEFAULT NULL,
  `assign` int(11) DEFAULT NULL,
  `driver` int(11) DEFAULT NULL,
  `driver_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `driver_phone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `origin` varchar(400) CHARACTER SET latin1 DEFAULT NULL,
  `destination` varchar(400) CHARACTER SET latin1 DEFAULT NULL,
  `origin_coordinate` varchar(400) CHARACTER SET latin1 DEFAULT NULL,
  `destination_coordinate` varchar(400) CHARACTER SET latin1 DEFAULT NULL,
  `distance` decimal(11,2) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `time` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `message` longtext CHARACTER SET latin1 DEFAULT NULL,
  `requirement` longtext CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `proof_of_delivery` longtext CHARACTER SET latin1 DEFAULT NULL,
  `accepted_datetime` datetime DEFAULT NULL,
  `collected_datetime` datetime DEFAULT NULL,
  `delivered_datetime` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO orders VALUES("1","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","Jonathan","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Accepted","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-04-14 21:52:23");
INSERT INTO orders VALUES("2","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","Ali","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Ordered","images/20210527-14074860af37348091d.jpg","2021-05-12 10:55:36","2021-05-19 15:00:24","2021-05-27 14:07:47","2021-05-19 15:00:24","2021-05-27 14:07:48");
INSERT INTO orders VALUES("3","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","John","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Delivering","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-04-14 21:53:03");
INSERT INTO orders VALUES("4","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","Wong","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Received","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-04-14 21:53:04");
INSERT INTO orders VALUES("5","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","Joe","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Ordered","images/20210527-22090660afa80217181.jpg","2021-05-12 18:17:12","2021-05-19 15:00:24","2021-05-27 22:09:05","2021-05-19 15:00:24","2021-05-27 22:09:06");
INSERT INTO orders VALUES("6","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","Jonathan","2147483647","Tonny","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Delivered","images/20210519-11281360a485cd105be.jpg","2021-05-28 09:54:18","2021-05-19 15:00:24","2021-05-28 14:03:04","2021-05-19 15:00:24","2021-05-28 14:03:04");
INSERT INTO orders VALUES("7","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","Jonathan","2147483647","Clar","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Delivered","images/20210519-11251760a4851d5fd49.jpg","2021-05-28 09:54:32","2021-05-19 15:00:24","2021-05-28 14:16:28","2021-05-19 15:00:24","2021-05-28 14:16:28");
INSERT INTO orders VALUES("8","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","Jonathan","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Delivered","images/20210518-23174160a3da959d2b6.jpg","2021-05-12 18:11:20","2021-05-19 15:00:24","2021-05-28 14:19:48","2021-05-19 15:00:24","2021-05-28 14:19:48");
INSERT INTO orders VALUES("9","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","Abdul","016837745675","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","A.S.D Solutions Company, Wee Kheng Chiang, Jalan Datuk Wee Kheng Chiang, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5526371504304401,110.36251260000003","9.50","12","15:00","Additional Message.. Additional Message.. Additional Message.. ","Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. Vehicle Requirement.. ","Delivered","images/20210519-11205560a48417b28fc.jpg","2021-05-12 11:43:15","2021-05-19 15:00:24","2021-05-28 14:30:08","2021-05-19 15:00:24","2021-05-28 14:30:08");
INSERT INTO orders VALUES("10","4","1","1","1","2","Taka sdn bhd (R.H. Plaza)","2","","2","","","Plaza customer name","099846782","Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia","Siburan New Township, Siburan, Sarawak, Malaysia","1.5039154504169283,110.35120765000002","1.3451253003729107,110.40779844999999","26.60","lot 20, 2nd floor","15:00","asd asd asdasd asdas dasdsd","no need","Ordered","","2021-05-12 10:57:10","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-12 10:57:10");
INSERT INTO orders VALUES("11","4","1","1","1","2","Taka sdn bhd (R.H. Plaza)","2","","","","","Plaza customer name","099846782","Taka Cake House, 900B, R.H Plaza, Kuching, Sarawak, Malaysia","Siburan New Township, Siburan, Sarawak, Malaysia","1.5039154504169283,110.35120765000002","1.3451253003729107,110.40779844999999","26.60","lot 20, 2nd floor","15:00","asd asd asdasd asdas dasdsd","no need","Ordered","","2021-05-12 10:55:58","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-12 10:55:58");
INSERT INTO orders VALUES("12","2","1","2","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","1","Jonathan","2147483647","Mr. Lee","0123213213","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","10th Mile Medical Clinic, Lorong Kota Padawan 4, Padawan, Sarawak, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.4281900003959342,110.32599034999998","15.80","1212","15:00","asdasdas dasdasd asdasd asd","2","Delivered","","2021-05-24 15:20:10","2021-05-24 15:20:18","2021-05-28 14:17:56","2021-05-19 15:00:24","2021-05-28 14:17:56");
INSERT INTO orders VALUES("13","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","12122","122122","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","101 Kuching, 801-2B Jalan Tun Jugah, Kempas Heights, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5158318504202204,110.35337145","6.80","12","15:00","asdasdsad","1","Ordered","images/20210519-11384560a488451dbe4.jpg","2021-05-18 09:37:18","2021-05-19 15:00:24","2021-05-19 15:15:45","2021-05-19 15:00:24","2021-05-19 15:15:45");
INSERT INTO orders VALUES("18","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","1","Jonathan","2147483647","12122","122122","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","101 Kuching, 801-2B Jalan Tun Jugah, Kempas Heights, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5158318504202204,110.35337145","6.80","12","15:00","asdasdsad","1","Delivered","images/20210519-16352460a4cdcc8ed6e.jpg","2021-05-28 09:53:58","2021-05-19 15:00:24","2021-05-28 10:15:59","2021-05-19 15:00:24","2021-05-28 10:15:59");
INSERT INTO orders VALUES("19","2","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","1","","","asdsad","213213213asdsad","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","1 Plus 1 Kitchen, Jalan Stampin Baru, Kampung Stutong Baru, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.5008080004160775,110.3833991","4.80","1212","11:00","","1","Delivered","images/20210519-11350460a48768b5bc2.jpg","2021-05-18 09:17:03","2021-05-19 15:00:24","2021-05-28 15:11:54","2021-05-19 15:00:24","2021-05-28 15:11:54");
INSERT INTO orders VALUES("20","10","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","","","","Jonathan","121212121211","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","10th Mile Medical Clinic, Lorong Kota Padawan 4, Padawan, Sarawak, Kuching, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.4281900003959342,110.32599034999998","15.80","121212","15:00","","1","Ordered","{"pod":{"name":"uploadimage.jpg","type":"","tmp_name":"","error":1,"size":0}}{"submit":"ok","oid":"19"}","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-18 22:34:21");
INSERT INTO orders VALUES("30","10","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","Jonny","12323213213","10th Mile Medical Clinic, Lorong Kota Padawan 4, Padawan, Sarawak, Kuching, Sarawak, Malaysia","Satok Fly Over Cafe, Jalan Satok, Kuching, Sarawak, Malaysia","1.4281900003959342,110.32599034999998","1.5532992504306256,110.33656829999998","15.00","21","15:00","asdsadsad","1","Ordered","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-18 23:18:28");
INSERT INTO orders VALUES("31","7","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","asdsad","123213","Kubah National Park, Kuching, Sarawak, Malaysia","10th Mile Medical Clinic, Lorong Kota Padawan 4, Padawan, Sarawak, Kuching, Sarawak, Malaysia","1.6127200004471032,110.19692940000002","1.4281900003959342,110.32599034999998","34.80","12","15:00","","1","Ordered","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-17 20:42:46");
INSERT INTO orders VALUES("32","7","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","50asdsadsad","123213","Kubah National Park, Kuching, Sarawak, Malaysia","Siburan New Township, Siburan, Sarawak, Malaysia","1.6127200004471032,110.19692940000002","1.3451253003729107,110.40779844999999","50.50","12","15:00","","1","Ordered","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-17 20:44:21");
INSERT INTO orders VALUES("33","8","1","1","1","1","Taka Sdn. Bhd. Tabuan Branch","1","","2","","","asdsad","1232","Taka Patisserie, Jalan Tabuan Tranquility, Tabuan Jaya, Kuching, Sarawak, Malaysia","Lingga Police Station, Lingga, Sarawak, Malaysia","1.5125012504193178,110.38926830000001","1.3587327003766678,111.17431439999997","234.00","11","15:00","1","1","Ordered","","","2021-05-19 15:00:24","","2021-05-19 15:00:24","2021-05-17 20:45:49");



CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `content` longtext CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO pages VALUES("1","About Us","1","1","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="row">About Us content here</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
</body>","2020-10-27 13:43:52","2021-04-08 14:02:41");
INSERT INTO pages VALUES("3","Gallery","2","2","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p>Gallery here</p>
</body>
</html>","2020-12-31 17:14:14","2021-03-10 12:33:31");
INSERT INTO pages VALUES("2","Services","0","2","<!DOCTYPE html>
<html>
<head>
</head>
<body>

</body>
</html>","2020-10-27 13:44:23","2020-11-14 12:50:05");



CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `para1` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para2` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para3` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para4` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para5` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para6` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `para7` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO payment_gateway VALUES("1","paypal","","","","","","","1","2020-09-04 13:50:26","2021-01-04 17:27:33");
INSERT INTO payment_gateway VALUES("2","eghl","testing_server","sit","sit12345","","","","1","","2020-09-29 12:13:00");
INSERT INTO payment_gateway VALUES("3","PayPal","testing_server","sb-zv43ii3073669@business.example.com","","","","","1","","2020-09-07 15:02:58");
INSERT INTO payment_gateway VALUES("4","revpay","live_server","MER00000000466","AwrvLjTvji","","","","1","","2020-11-06 11:11:58");



CREATE TABLE `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_table` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `parent_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO photos VALUES("10","property","1","1","0","photo/5fa0af4082d05.jpg","2020-11-03 09:15:44","2020-11-03 09:15:44");
INSERT INTO photos VALUES("9","property","1","1","0","photo/5fa0af4081fe4.jpg","2020-11-03 09:15:44","2020-11-03 09:15:44");
INSERT INTO photos VALUES("8","property","1","1","0","photo/5fa0af408122f.jpg","2020-11-03 09:15:44","2020-11-03 09:15:44");
INSERT INTO photos VALUES("7","property","1","1","0","photo/5fa0af40808e6.jpg","2020-11-03 09:15:44","2020-11-03 09:15:44");
INSERT INTO photos VALUES("6","property","1","1","0","photo/5fa0af407fe86.jpg","2020-11-03 09:15:44","2020-11-03 09:15:44");
INSERT INTO photos VALUES("32","pages","0","1","0","photo/60334b0b307b2.gif","2021-02-22 14:11:23","2021-02-22 14:11:23");
INSERT INTO photos VALUES("33","pages","0","1","0","photo/60334b0ea4db1.gif","2021-02-22 14:11:26","2021-02-22 14:11:26");
INSERT INTO photos VALUES("13","tour","0","1","0","photo/5fc07bbae43eb.jpg","2020-11-27 12:08:26","2020-11-27 12:08:26");
INSERT INTO photos VALUES("14","tour","0","1","0","photo/5fc07bc641231.jpg","2020-11-27 12:08:38","2020-11-27 12:08:38");
INSERT INTO photos VALUES("15","tour","0","1","0","photo/5fd1ca847f4a2.jpg","2020-12-10 15:13:08","2020-12-10 15:13:08");
INSERT INTO photos VALUES("16","tour","0","1","0","photo/5fd1d5a8536dd.jpg","2020-12-10 16:00:40","2020-12-10 16:00:40");
INSERT INTO photos VALUES("17","tour","0","1","0","","2020-12-10 16:00:43","2020-12-10 16:00:43");
INSERT INTO photos VALUES("18","tour","0","1","0","photo/5fd1d9026df43.jpg","2020-12-10 16:14:58","2020-12-10 16:14:58");
INSERT INTO photos VALUES("19","tour","0","1","0","photo/5fd1d9305fe0a.jpg","2020-12-10 16:15:44","2020-12-10 16:15:44");
INSERT INTO photos VALUES("20","tour","0","1","0","photo/5fd81df02c991.jpg","2020-12-15 10:22:40","2020-12-15 10:22:40");
INSERT INTO photos VALUES("21","tour","0","1","0","photo/5fd841eed7561.jpg","2020-12-15 12:56:14","2020-12-15 12:56:14");
INSERT INTO photos VALUES("22","tour","0","1","0","","2020-12-15 12:56:16","2020-12-15 12:56:16");
INSERT INTO photos VALUES("23","tour","0","1","0","photo/5fd84b7626f0c.jpg","2020-12-15 13:36:54","2020-12-15 13:36:54");
INSERT INTO photos VALUES("24","tour","0","1","0","","2020-12-15 13:36:55","2020-12-15 13:36:55");
INSERT INTO photos VALUES("25","tour","0","1","0","photo/5fd852d6d3959.jpg","2020-12-15 14:08:22","2020-12-15 14:08:22");
INSERT INTO photos VALUES("26","tour","0","1","0","","2020-12-15 14:08:24","2020-12-15 14:08:24");
INSERT INTO photos VALUES("27","tour","0","1","0","photo/5fd862c47c9e5.jpg","2020-12-15 15:16:20","2020-12-15 15:16:20");
INSERT INTO photos VALUES("28","content","0","1","0","photo/5fdc07561d0c5.png","2020-12-18 09:35:18","2020-12-18 09:35:18");
INSERT INTO photos VALUES("30","content","0","1","0","photo/603341298d44b.png","2021-02-22 13:29:13","2021-02-22 13:29:13");
INSERT INTO photos VALUES("31","pages","0","1","0","photo/6033455a5e7d1.jpg","2021-02-22 13:47:06","2021-02-22 13:47:06");



CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `departure` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `validity_from` date DEFAULT NULL,
  `validity_to` date DEFAULT NULL,
  `sunday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `monday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `tuesday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `wednesday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `thursday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `friday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `saturday_sales` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `min_travellers` int(11) DEFAULT NULL,
  `physical_level` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `deletelater_brief_description` longtext CHARACTER SET latin1 DEFAULT NULL,
  `description` longtext CHARACTER SET latin1 DEFAULT NULL,
  `popular` varchar(3) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO product VALUES("5","1","8","photo/603358e5d365d.jpg","Fabrication of Offshore Modules","100.00","1.5 hours","Daily","10","2020-12-18","2021-12-18","Yes","Yes","Yes","Yes","Yes","Yes","Yes","1","Medium","Embark on M.V. Equatorial Sunset Cruise at Kuching Waterfront for an experience of a life time cruising along the legendary Sarawak River. Here time stands still and is very the same when the first white Rajah Sir James Brooke sailed into Kuching 175 years ago.","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p><strong>Fabrication of Offshore Modules</strong></p>
<ul>
<li>Drilling Platforms</li>
<li>Gas Compression / Production Modules</li>
<li>Water Injection Platforms</li>
</ul>
</body>
</html>","Yes","0","1","2020-11-24 12:12:42","2021-02-22 15:10:29");
INSERT INTO product VALUES("99","1","1","photo/6033592a541ee.jpg","Turnkey (EPCIC) for Offshore Marginal Field Development  ","0.00","2 DAYS 1 NIGHTS","KUCHING","10","2020-12-18","2021-12-18","Yes","Yes","Yes","Yes","Yes","Yes","Yes","1","Medium","What was once an 8-hour hike to a Bidayuh Village is now a 15-minute boat ride away surrounded by scenic mountainous backdrops across the majestic Bengoh Lake (1 hour from Kuching). Many waterfalls and streams flow into the Bengoh Lake which now serves as a water catchment for Kuching. Hike towards Kling Waterfall for a cold dip awaits you while a sumptuous picnic native lunch is being prepared.

Thereafter proceed to the picturesque Susung waterfalls. Your overnight stay at Kampung Sting high above the lake will yet be another highlight as you take in the beautiful scenery of the lake.","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p>Turnkey (EPCIC) for Offshore Marginal Field Development&nbsp;</p>
</body>
</html>","Yes","0","1","2020-12-10 15:13:26","2021-02-22 15:11:51");
INSERT INTO product VALUES("60","2","23","photo/6033520e30057.jpg","Two Semi Submersible Oil Rig Near Shore","100.00","3 Hours","9.am & 2.pm","10","2020-12-18","2021-12-18","Yes","Yes","Yes","Yes","Yes","Yes","Yes","1","","","<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="product-info-top"><strong>PowerPoint presentation slides</strong>
<p>Presenting this set of slides with name Two Semi Submersible Oil Rig Near Shore. The topics discussed in these slides are Oil Rig, Central Processing, Gas. This is a completely editable PowerPoint presentation and is available for immediate download. Download now and impress your audience.</p>
</div>
</body>
</html>","","0","1","2020-11-24 12:12:42","2021-02-22 15:05:21");



CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO region VALUES("1","Kuching","1.4870324","110.3394176","1","1","2021-04-08 14:55:10","2021-05-20 14:31:58");
INSERT INTO region VALUES("2","Sibu","2.284919","111.8276928","2","1","2021-04-08 14:55:19","2021-05-20 14:21:26");
INSERT INTO region VALUES("3","Miri","3.9495261","113.2480013","3","1","2021-04-08 14:55:27","2021-05-20 14:15:29");



CREATE TABLE `trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `branch` int(11) DEFAULT NULL,
  `trip_distance` int(11) DEFAULT NULL,
  `topup_trip` int(11) DEFAULT NULL,
  `trip_balance` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO trip VALUES("1","1","20","44","","2021-04-12 13:18:00","2021-04-12 13:46:42");
INSERT INTO trip VALUES("2","1","30","222","122","2021-04-12 13:19:00","2021-04-12 13:47:01");
INSERT INTO trip VALUES("3","2","10","1000","1000","2021-04-14 22:41:30","2021-04-14 22:41:30");
INSERT INTO trip VALUES("4","2","30","1000","993","2021-04-14 22:41:41","2021-04-14 23:13:33");
INSERT INTO trip VALUES("5","2","50","1000","1000","2021-04-14 22:41:46","2021-04-14 22:41:46");
INSERT INTO trip VALUES("6","3","10","100","100","2021-04-21 14:24:39","2021-04-21 14:24:39");



CREATE TABLE `vehicle_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` longtext CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO vehicle_type VALUES("1","Motobyte","Motobyte","1","1","2021-04-12 14:13:48","2021-04-12 14:14:22");
INSERT INTO vehicle_type VALUES("2","Van","Van (6 to 11 pessenger)","2","1","2021-04-12 14:14:48","2021-04-12 14:14:48");



CREATE TABLE `zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region` int(11) DEFAULT NULL,
  `zone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO zone VALUES("1","1","BDC","1","1","2021-04-08 15:01:27","2021-04-08 15:01:27");
INSERT INTO zone VALUES("2","1","Satok","2","1","2021-04-08 15:01:34","2021-04-08 15:01:34");
INSERT INTO zone VALUES("3","2","Jalan Oya","1","1","2021-04-08 15:01:54","2021-04-08 15:01:54");

