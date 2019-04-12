CREATE TABLE IF NOT EXISTS `user` (
  `user_id_pk` int auto_increment primary key,
  `name` varchar(20) NOT NULL,
  `password` varchar(40)  NOT NULL,
  `email` varchar(50),
  `phone` varchar(10),
  `city` varchar(40),
  `zip` varchar(10),
  `role` varchar(20) NOT NULL
);