CREATE DATABASE IF NOT EXISTS `rfid_attendance`;

USE rfid_attendance;

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `activty_id` int(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `activity_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` tinytext NOT NULL,
  `date_in` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `remark` tinytext NOT NULL,
  `instructor` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `department` varchar(225) NOT NULL,
  `section` varchar(225) NOT NULL,
  `year_group` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendance` VALUES("83","Jobert Gosuico Simbre","0000-00-00","09:11:17","00:00:00","On Time","Teacher Instructor Example","Programming","BSIT","AP","4th");
INSERT INTO `attendance` VALUES("84","Jobert Gosuico Simbre","2022-12-01","02:27:57","02:57:46","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("85","Jobert Gosuico Simbre","2022-12-01","02:59:28","03:36:45","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("86","Jobert Gosuico Simbre","2022-12-01","03:43:44","03:45:18","On Time","Teacher Instructor Example","","BSIT","","0");
INSERT INTO `attendance` VALUES("87","Jobert Gosuico Simbre","2022-12-01","03:48:56","04:03:45","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("88","Jobert Gosuico Simbre","2022-12-01","04:04:32","04:05:49","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("89","Jobert Gosuico Simbre","2022-12-01","04:51:02","05:02:33","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("90","Jobert Gosuico Simbre","2022-12-01","05:04:08","05:04:21","On Time","Teacher Instructor Example","","","","0");
INSERT INTO `attendance` VALUES("91","Jobert Gosuico Simbre","2022-12-02","02:24:01","02:24:21","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("92","Jobert Gosuico Simbre","2022-12-02","02:24:35","02:24:46","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("93","Jobert Gosuico Simbre","2022-12-02","02:32:46","02:32:55","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("94","Jobert Gosuico Simbre","2022-12-02","02:33:23","02:34:57","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("95","Jobert Gosuico Simbre","2022-12-02","02:35:01","02:35:07","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("96","Jobert Gosuico Simbre","2022-12-02","02:38:02","02:38:08","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("97","Jobert Gosuico Simbre","2022-12-02","02:38:18","02:38:25","On Time","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("98","Jobert Gosuico Simbre","2022-12-02","02:38:41","02:38:57","Late","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("99","Jobert Gosuico Simbre","2022-12-02","02:40:43","02:40:56","Late","Teacher Instructor Example","","","","");
INSERT INTO `attendance` VALUES("100","Jobert Gosuico Simbre","2022-12-02","02:40:58","02:42:10","Late","Teacher Instructor Example","","","","");



DROP TABLE IF EXISTS `attendance_instructor`;

CREATE TABLE `attendance_instructor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` tinytext NOT NULL,
  `date_in` date NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `remark` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `attendance_instructor` VALUES("17","Teacher Instructor Example","2022-11-29","09:10:58","00:00:00","","");
INSERT INTO `attendance_instructor` VALUES("18","Teacher Instructor Example","2022-12-01","02:27:34","02:27:49","","");
INSERT INTO `attendance_instructor` VALUES("19","Teacher Instructor Example","2022-12-01","02:27:53","02:58:29","","");
INSERT INTO `attendance_instructor` VALUES("20","Teacher Instructor Example","2022-12-01","02:58:48","03:36:30","","");
INSERT INTO `attendance_instructor` VALUES("21","Teacher Instructor Example","2022-12-01","03:36:40","04:03:51","","");
INSERT INTO `attendance_instructor` VALUES("22","Teacher Instructor Example","2022-12-01","04:04:21","04:49:46","","");
INSERT INTO `attendance_instructor` VALUES("23","Teacher Instructor Example","2022-12-01","04:49:55","04:49:57","","");
INSERT INTO `attendance_instructor` VALUES("24","Teacher Instructor Example","2022-12-01","04:50:39","00:00:00","","");
INSERT INTO `attendance_instructor` VALUES("25","Teacher Instructor Example","2022-12-02","02:23:36","00:00:00","","");



DROP TABLE IF EXISTS `class_list`;

CREATE TABLE `class_list` (
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time` time NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `rfid`;

CREATE TABLE `rfid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardid` varchar(250) NOT NULL,
  `logdate` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rfid` VALUES("37","2348130","1667893879");
INSERT INTO `rfid` VALUES("38","2348130","1667893885");
INSERT INTO `rfid` VALUES("39","2250590","1669207403");
INSERT INTO `rfid` VALUES("40","1609090","1669207460");
INSERT INTO `rfid` VALUES("41","1606890","1669207493");
INSERT INTO `rfid` VALUES("42","1855000","1669207519");
INSERT INTO `rfid` VALUES("43","2152890","1669207546");
INSERT INTO `rfid` VALUES("44","2049790","1669207578");
INSERT INTO `rfid` VALUES("45","2111690","1669207642");
INSERT INTO `rfid` VALUES("46","1717590","1669207673");
INSERT INTO `rfid` VALUES("47","1716400","1669207702");
INSERT INTO `rfid` VALUES("48","1768290","1669207721");
INSERT INTO `rfid` VALUES("49","2348130","1669207745");



DROP TABLE IF EXISTS `rfid_card`;

CREATE TABLE `rfid_card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` int(11) NOT NULL,
  `card_status` tinytext NOT NULL,
  `card_holder` tinytext NOT NULL,
  `card_holder_id` int(11) NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rfid_card` VALUES("2","2348130","Assigned","Jobert Padilla Simbre","0");
INSERT INTO `rfid_card` VALUES("5","1768290","Available","","0");



DROP TABLE IF EXISTS `student_list`;

CREATE TABLE `student_list` (
  `student_id` int(11) NOT NULL,
  `student_firstname` tinytext NOT NULL,
  `student_middlename` tinytext NOT NULL,
  `student_lastname` tinytext NOT NULL,
  `phone` tinytext NOT NULL,
  `year_group` tinyint(4) DEFAULT NULL,
  `department` tinytext DEFAULT NULL,
  `section` tinytext DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `guardian_email` varchar(255) NOT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `student_id_fk` FOREIGN KEY (`student_id`) REFERENCES `user_list` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `student_list` VALUES("113","Jobert","Gosuico","Simbre","09163218023","4","BSIT","AP",NULL,"ignacio.khiana13@gmail.com");
INSERT INTO `student_list` VALUES("117","Students","","Two","","4","BSIT","a",NULL,"");



DROP TABLE IF EXISTS `studentclasses_list`;

CREATE TABLE `studentclasses_list` (
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  KEY `class_id` (`class_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `subject_list`;

CREATE TABLE `subject_list` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` tinytext NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




DROP TABLE IF EXISTS `teacher_list`;

CREATE TABLE `teacher_list` (
  `teacher_id` int(11) NOT NULL,
  `teacher_firstname` tinytext NOT NULL,
  `teacher_middlename` tinytext NOT NULL,
  `teacher_lastname` tinytext NOT NULL,
  `subject_taught` tinytext DEFAULT NULL,
  `department` tinytext DEFAULT NULL,
  `rfid_card_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`),
  CONSTRAINT `teacher_id_fk` FOREIGN KEY (`teacher_id`) REFERENCES `user_list` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `teacher_list` VALUES("112","Teacher","Instructor","Example",NULL,"BSIT",NULL);



DROP TABLE IF EXISTS `user_list`;

CREATE TABLE `user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `position` tinytext DEFAULT NULL,
  `card_number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `user_list` VALUES("57","admin","$2y$10$jCBPKsCOVo6LKlMHZDOZdOHQ.7Lo3Z2e6ZkLyeYDxI63f7qOfZE0K","admin@example.com","2022-11-01 13:24:14","Administrator","0");
INSERT INTO `user_list` VALUES("112","teacher1","$2y$10$IdMRLy901/MBIZ6wl5Ntm.I/5WX/VrzLJUYHRFCqWUKTb71Gb1Hea","kljokas@gmail.com","2022-11-24 00:09:04","Instructor","1768290");
INSERT INTO `user_list` VALUES("113","student1","$2y$10$qq4vFOTeyJJItoaaVtVrg..7CGmtB2PMsZcyI.t6qBxFded7bbV/W","asdasdas@gmail.com","2022-11-18 09:21:03","Student","2348130");
INSERT INTO `user_list` VALUES("117","student2","$2y$10$Ei/4LCuyRDJXLXD/XNgVqeagW59LpI554iA6sbUmGOjrSWmjiJEI.","student2@example.com","2022-11-30 13:27:50","Student","0");



DROP TABLE IF EXISTS `user_log`;

CREATE TABLE `user_log` (
  `user_log_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `log_date` date NOT NULL,
  `log_time` time NOT NULL,
  PRIMARY KEY (`user_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_log` VALUES("1","57","admin","","Login","2022-11-29","06:49:56");
INSERT INTO `user_log` VALUES("2","113","student1","","Login","2022-11-29","06:57:14");
INSERT INTO `user_log` VALUES("3","57","admin","","Login","2022-11-29","07:03:19");
INSERT INTO `user_log` VALUES("4","57","admin","","Logout","2022-11-29","07:07:08");
INSERT INTO `user_log` VALUES("5","57","admin","","Login","2022-11-29","08:32:25");
INSERT INTO `user_log` VALUES("6","57","admin","","Login","2022-11-29","08:33:25");
INSERT INTO `user_log` VALUES("7","57","admin","","Login","2022-11-29","08:48:18");
INSERT INTO `user_log` VALUES("8","57","admin","","Login","2022-11-29","08:48:35");
INSERT INTO `user_log` VALUES("9","57","admin","","Login","2022-11-29","08:48:55");
INSERT INTO `user_log` VALUES("10","57","admin","","Login","2022-11-29","08:55:45");
INSERT INTO `user_log` VALUES("11","57","admin","","Login","2022-11-29","08:58:33");
INSERT INTO `user_log` VALUES("12","57","admin","","Login","2022-11-29","08:59:18");
INSERT INTO `user_log` VALUES("13","57","admin","","Login","2022-11-29","09:01:02");
INSERT INTO `user_log` VALUES("14","57","admin","","Login","2022-11-29","09:01:28");
INSERT INTO `user_log` VALUES("15","57","admin","","Login","2022-11-30","07:11:03");
INSERT INTO `user_log` VALUES("16","57","admin","","Logout","2022-11-30","07:49:32");
INSERT INTO `user_log` VALUES("17","57","admin","","Login","2022-11-30","07:49:41");
INSERT INTO `user_log` VALUES("18","57","admin","","Logout","2022-11-30","07:49:49");
INSERT INTO `user_log` VALUES("19","57","admin","","Login","2022-11-30","07:49:55");
INSERT INTO `user_log` VALUES("20","57","admin","","Logout","2022-11-30","08:31:17");
INSERT INTO `user_log` VALUES("21","113","student1","","Login","2022-11-30","08:31:25");
INSERT INTO `user_log` VALUES("22","113","student1","","Logout","2022-11-30","08:31:31");
INSERT INTO `user_log` VALUES("23","57","admin","","Login","2022-11-30","08:31:35");
INSERT INTO `user_log` VALUES("24","57","admin","","Logout","2022-11-30","08:57:53");
INSERT INTO `user_log` VALUES("25","57","admin","","Login","2022-11-30","08:58:00");
INSERT INTO `user_log` VALUES("26","57","admin","","Logout","2022-11-30","12:12:53");
INSERT INTO `user_log` VALUES("27","57","admin","","Login","2022-11-30","12:13:01");
INSERT INTO `user_log` VALUES("28","116","student2","","Register","2022-11-30","01:24:14");
INSERT INTO `user_log` VALUES("29","117","student2","","Register","2022-11-30","01:27:50");
INSERT INTO `user_log` VALUES("30","57","admin","","Logout","2022-11-30","02:33:26");
INSERT INTO `user_log` VALUES("31","57","admin","","Login","2022-11-30","02:33:32");
INSERT INTO `user_log` VALUES("32","57","admin","","Logout","2022-12-01","08:08:14");
INSERT INTO `user_log` VALUES("33","113","student1","","Login","2022-12-01","08:08:31");
INSERT INTO `user_log` VALUES("34","113","student1","","Logout","2022-12-01","08:14:02");
INSERT INTO `user_log` VALUES("35","112","teacher1","","Login","2022-12-01","08:14:14");
INSERT INTO `user_log` VALUES("36","112","teacher1","","Login","2022-12-01","08:14:23");
INSERT INTO `user_log` VALUES("37","112","teacher1","","Login","2022-12-01","08:20:14");
INSERT INTO `user_log` VALUES("38","112","teacher1","","Logout","2022-12-01","02:24:26");
INSERT INTO `user_log` VALUES("39","57","admin","","Login","2022-12-01","02:26:31");
INSERT INTO `user_log` VALUES("40","57","admin","","Logout","2022-12-01","02:41:22");
INSERT INTO `user_log` VALUES("41","57","admin","","Login","2022-12-01","02:42:27");
INSERT INTO `user_log` VALUES("42","57","admin","","Logout","2022-12-01","02:50:35");
INSERT INTO `user_log` VALUES("43","112","teacher1","","Login","2022-12-01","02:50:45");
INSERT INTO `user_log` VALUES("44","112","teacher1","","Logout","2022-12-01","02:57:21");
INSERT INTO `user_log` VALUES("45","57","admin","","Login","2022-12-01","02:57:26");
INSERT INTO `user_log` VALUES("46","57","admin","","Logout","2022-12-01","03:37:02");
INSERT INTO `user_log` VALUES("47","57","admin","","Login","2022-12-01","03:37:30");
INSERT INTO `user_log` VALUES("48","57","admin","","Login","2022-12-01","03:42:49");
INSERT INTO `user_log` VALUES("49","57","admin","","Logout","2022-12-01","03:49:26");
INSERT INTO `user_log` VALUES("50","113","student1","","Login","2022-12-01","03:49:59");
INSERT INTO `user_log` VALUES("51","113","student1","","Logout","2022-12-01","03:50:19");
INSERT INTO `user_log` VALUES("52","112","teacher1","","Login","2022-12-01","03:50:28");
INSERT INTO `user_log` VALUES("53","112","teacher1","","Logout","2022-12-01","03:51:17");
INSERT INTO `user_log` VALUES("54","57","admin","","Login","2022-12-01","03:51:23");
INSERT INTO `user_log` VALUES("55","57","admin","","Logout","2022-12-01","03:53:44");
INSERT INTO `user_log` VALUES("56","57","admin","","Login","2022-12-01","04:02:19");
INSERT INTO `user_log` VALUES("57","57","admin","","Logout","2022-12-01","04:05:23");
INSERT INTO `user_log` VALUES("58","113","student1","","Login","2022-12-01","04:05:30");
INSERT INTO `user_log` VALUES("59","113","student1","","Logout","2022-12-01","04:10:15");
INSERT INTO `user_log` VALUES("60","57","admin","","Login","2022-12-01","04:10:20");
INSERT INTO `user_log` VALUES("61","57","admin","","Logout","2022-12-01","04:31:13");
INSERT INTO `user_log` VALUES("62","112","teacher1","","Login","2022-12-01","04:31:22");
INSERT INTO `user_log` VALUES("63","112","teacher1","","Logout","2022-12-01","04:45:15");
INSERT INTO `user_log` VALUES("64","57","admin","","Login","2022-12-01","04:45:33");
INSERT INTO `user_log` VALUES("65","57","admin","","Logout","2022-12-01","04:47:24");
INSERT INTO `user_log` VALUES("66","113","student1","","Login","2022-12-01","04:47:31");
INSERT INTO `user_log` VALUES("67","113","student1","","Logout","2022-12-01","04:47:46");
INSERT INTO `user_log` VALUES("68","112","teacher1","","Login","2022-12-01","04:47:55");
INSERT INTO `user_log` VALUES("69","112","teacher1","","Logout","2022-12-01","04:48:18");
INSERT INTO `user_log` VALUES("70","57","admin","","Login","2022-12-01","04:48:25");
INSERT INTO `user_log` VALUES("71","57","admin","","Logout","2022-12-01","05:11:24");
INSERT INTO `user_log` VALUES("72","113","student1","","Login","2022-12-01","05:11:32");
INSERT INTO `user_log` VALUES("73","57","admin","","Login","2022-12-01","07:34:06");
INSERT INTO `user_log` VALUES("74","57","admin","","Logout","2022-12-01","11:11:06");
INSERT INTO `user_log` VALUES("75","57","admin","","Login","2022-12-01","11:11:16");
INSERT INTO `user_log` VALUES("76","57","admin","","Logout","2022-12-01","11:50:25");
INSERT INTO `user_log` VALUES("77","57","admin","","Login","2022-12-01","11:52:57");
INSERT INTO `user_log` VALUES("78","57","admin","","Logout","2022-12-01","11:53:06");
INSERT INTO `user_log` VALUES("79","113","student1","","Login","2022-12-01","11:53:22");
INSERT INTO `user_log` VALUES("80","113","student1","","Logout","2022-12-01","11:53:29");
INSERT INTO `user_log` VALUES("81","112","teacher1","","Login","2022-12-01","11:53:39");
INSERT INTO `user_log` VALUES("82","112","teacher1","","Logout","2022-12-01","11:53:45");
INSERT INTO `user_log` VALUES("83","57","admin","","Login","2022-12-01","11:54:09");
INSERT INTO `user_log` VALUES("84","57","admin","","Logout","2022-12-02","11:49:21");
INSERT INTO `user_log` VALUES("85","57","admin","","Login","2022-12-02","11:49:26");
INSERT INTO `user_log` VALUES("86","57","admin","","Logout","2022-12-02","11:50:48");
INSERT INTO `user_log` VALUES("87","57","admin","","Login","2022-12-02","11:50:53");
INSERT INTO `user_log` VALUES("88","57","admin","","Logout","2022-12-02","11:57:26");
INSERT INTO `user_log` VALUES("89","57","admin","","Login","2022-12-02","11:57:31");
INSERT INTO `user_log` VALUES("90","57","admin","","Logout","2022-12-02","02:12:14");
INSERT INTO `user_log` VALUES("91","57","admin","","Login","2022-12-02","02:12:21");
INSERT INTO `user_log` VALUES("92","57","admin","","Logout","2022-12-02","02:16:40");
INSERT INTO `user_log` VALUES("93","113","student1","","Login","2022-12-02","02:17:11");
INSERT INTO `user_log` VALUES("94","113","student1","","Logout","2022-12-02","02:20:55");
INSERT INTO `user_log` VALUES("95","57","admin","","Login","2022-12-02","02:23:46");
INSERT INTO `user_log` VALUES("96","57","admin","","Logout","2022-12-02","03:20:05");
INSERT INTO `user_log` VALUES("97","113","student1","","Login","2022-12-02","03:20:12");
INSERT INTO `user_log` VALUES("98","113","student1","","Logout","2022-12-02","03:23:13");
INSERT INTO `user_log` VALUES("99","57","admin","","Login","2022-12-02","03:23:17");
INSERT INTO `user_log` VALUES("100","57","admin","","Logout","2022-12-02","03:25:19");
INSERT INTO `user_log` VALUES("101","113","student1","","Login","2022-12-02","03:25:24");
INSERT INTO `user_log` VALUES("102","113","student1","","Logout","2022-12-02","03:26:47");
INSERT INTO `user_log` VALUES("103","57","admin","","Login","2022-12-02","03:26:53");
INSERT INTO `user_log` VALUES("104","57","admin","","Logout","2022-12-02","03:35:13");
INSERT INTO `user_log` VALUES("105","57","admin","","Login","2022-12-02","03:42:26");
INSERT INTO `user_log` VALUES("106","57","admin","","Logout","2022-12-02","04:18:49");
INSERT INTO `user_log` VALUES("107","57","admin","","Login","2022-12-02","04:19:16");
INSERT INTO `user_log` VALUES("108","57","admin","","Logout","2022-12-02","04:19:28");
INSERT INTO `user_log` VALUES("109","57","admin","","Login","2022-12-02","04:19:46");
