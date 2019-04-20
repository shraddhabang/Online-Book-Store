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


CREATE TABLE IF NOT EXISTS `cart` (
    `user_id_fk`int NOT NULL,
    `book_isbn_fk` varchar(20) COLLATE latin1_general_ci NOT NULL,
    `quantity` int DEFAULT 0,
    FOREIGN KEY (user_id_fk) REFERENCES `user`(`user_id_pk`),
    FOREIGN KEY (book_isbn_fk) REFERENCES `books`(`book_isbn`)
);

-- CREATE users
INSERT INTO `user` (`name`, `password`, `email`, `phone`, `city`, `zip`, `role`) VALUES ('admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'admin@admin.com', '4692234198', 'Dallas', '75252', 'admin');

INSERT INTO `user` (`name`, `password`, `email`, `phone`, `city`, `zip`, `role`) VALUES ('user', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user@user.com', '4692234198', 'Dallas', '75252', 'user');

-- Cart functionalities
SELECT book_isbn_fk from cart where user_id_fk=1;
INSERT INTO cart VALUES (3,'978-0-321-94786-4',1);

SELECT `book_title`,`book_price` FROM books inner join cart ON books.book_isbn=cart.book_isbn_fk WHERE user_id_fk=3;
