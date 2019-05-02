CREATE TABLE IF NOT EXISTS `user` (
  `user_id_pk` int auto_increment primary key,
  `name` varchar(20) NOT NULL,
  `password` varchar(100)  NOT NULL,
  `email` varchar(50),
  `phone` varchar(10),
  `city` varchar(40),
  `zip` varchar(10),
  `role` varchar(20) NOT NULL,
  PRIMARY KEY(user_id_pk)
);

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(10) unsigned NOT NULL,
  `user_id_fk` int NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id_fk) REFERENCES `user`(`user_id_pk`),
  PRIMARY KEY (orderid_pk)
);

CREATE TABLE IF NOT EXISTS `order_items` (
  `orderid` int(10) unsigned NOT NULL,
  `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` tinyint(3) unsigned NOT NULL,
  FOREIGN KEY (orderid) REFERENCES `orders`(`orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;




CREATE TABLE IF NOT EXISTS `cart` (
    `user_id_fk`int NOT NULL,
    `book_isbn_fk` varchar(20) COLLATE latin1_general_ci NOT NULL,
    `quantity` int DEFAULT 0,
    FOREIGN KEY (user_id_fk) REFERENCES `user`(`user_id_pk`),
    FOREIGN KEY (book_isbn_fk) REFERENCES `books`(`book_isbn`)
);

CREATE TABLE IF NOT EXISTS `books` (
  `book_isbn` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `book_title` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `book_author` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `book_image` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `book_descr` text COLLATE latin1_general_ci,
  `book_price` decimal(6,2) NOT NULL,
  `publisherid` int(10) unsigned NOT NULL,
  `quantity` int DEFAULT 0,
  `category_id_fk` varchar(30),
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- CREATE users
INSERT INTO `user` (`name`, `password`, `email`, `phone`, `city`, `zip`, `role`) VALUES ('admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'admin@admin.com', '4692234198', 'Dallas', '75252', 'admin');

INSERT INTO `user` (`name`, `password`, `email`, `phone`, `city`, `zip`, `role`) VALUES ('user', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'user@user.com', '4692234198', 'Dallas', '75252', 'user');

-- Cart functionalities
SELECT book_isbn_fk from cart where user_id_fk=1;
INSERT INTO cart VALUES (3,'978-0-321-94786-4',1);

SELECT `book_title`,`book_price` FROM books inner join cart ON books.book_isbn=cart.book_isbn_fk WHERE user_id_fk=3;

ALTER TABLE `orders` DROP `ship_name`, DROP `ship_address`, DROP `ship_city`, DROP `ship_zip_code`, DROP `ship_country`;

ALTER TABLE  books ADD quantity int(10) unsigned DEFAULT 0;

ALTER TABLE  books ADD category varchar(30);

UPDATE books
SET category = "Academic & Professional";

CREATE Table category(
  `category_id_pk` int auto_increment primary key,
  `name` varchar(100) NOT NULL,
  `images` varchar(100)  NOT NULL,
)


INSERT INTO `category`( `name`, `images`) VALUES ('Academic & Professional','book.svg');
INSERT INTO `category`( `name`, `images`) VALUES ('Literature & Fiction','laptop.svg');
INSERT INTO `category`( `name`, `images`) VALUES ('History','letter.svg');
INSERT INTO `category`( `name`, `images`) VALUES ('Science Fiction & Fantasy','letter.svg');





//List of Categories
// Academic & Professional
// Literature & Fiction
// History
// Science Fiction & Fantasy




//Admin Add edit flow
//Added book quantity
//Adding category
//Adding publishers
//
