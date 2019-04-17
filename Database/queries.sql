CREATE TABLE IF NOT EXISTS `user` (
  `user_id_pk` int auto_increment primary key,
  `name` varchar(20) NOT NULL,
  `password` varchar(100)  NOT NULL,
  `email` varchar(50),
  `phone` varchar(10),
  `city` varchar(40),
  `zip` varchar(10),
  `role` varchar(20) NOT NULL
);

INSERT INTO `user` (`user_id_pk`, `name`, `password`, `email`, `phone`, `city`, `zip`, `role`) VALUES (NULL, 'Shraddha', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'shb@gmail.com', '4692234198', 'Dallas', '75252', 'admin');