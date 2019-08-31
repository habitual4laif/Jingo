CREATE TABLE product1 (
    id int(11) NOT null PRIMARY KEY AUTO_INCREMENT,
    title varchar(255) not null,
    price decimal(10,2) not null,
    last_price decimal(10,2) not null,
    brand int(11) not null,
    categories varchar(255) not null,
    image varchar(255) not null,
    description text(255) not null
);

CREATE TABLE brand (
    id int(11) NOT null PRIMARY KEY AUTO_INCREMENT,
    brand int(11) not null,
);

CREATE TABLE categories (
    id int(11) NOT null PRIMARY KEY AUTO_INCREMENT,
    categories varchar(255) not null,
    parent int(11) DEFAULT(0)
);

CREATE TABLE user (
    id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    first varchar(128) not null,
    last varchar(128) not null,
    userID varchar(128) not null,
    pwd varchar(1000) not null
);

INSERT INTO `categories` (`id`, `categories`, `parent`) VALUES (NULL, 'Men', '0'), (NULL, 'Women', '0'), (NULL, 'Boys', '0'), (NULL, 'Girls', '0');

INSERT INTO `categories` (`id`, `categories`, `parent`) VALUES (NULL, 'Shirts', '1'), (NULL, 'Pants', '1'), (NULL, 'Shoes', '1'), (NULL, 'Accessories', '1');

INSERT INTO `categories` (`id`, `categories`, `parent`) VALUES (NULL, 'Shirts', '2'), (NULL, 'Pants', '2'), (NULL, 'Shoes', '2'), (NULL, 'Accessories', '2');


-- To insert into product1
INSERT INTO `product1` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`) VALUES (NULL, 'Levi\'s Jean', '29.99', '39.99', '1', '', 'assets/R88.jpg', 'This Jeans are amazing', '1', '28:3, 32:5, 36:1');

-- For Leather wedge
INSERT INTO `product1` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`) VALUES (NULL, 'Leather Wedge', '12.99', '28.99', '1', '7', 'assets/LW.jpg', 'This wedge is for You!', '0', '37:2, 38:4, 39:8, 40:10, 41:7, 42:6, 43:5, 44:3');

-- Polo
INSERT INTO `product1` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`) VALUES (NULL, 'Polo R8', '24.99', '49.99', '1', '', 'assets/R8.jpg', 'Polo Raph for You!', '1', 'M:3, L:5, XL:1');



-- For commentsDisplay
create TABLE comments (
    cid int(11) not null AUTO_INCREMENT PRIMARY KEY,
    uid varchar(128) not null,
    date datetime not null,
    message text not null
);




-- Brands
INSERT INTO `brand` (`id`, `brand`) VALUES (NULL, 'Levis');
INSERT INTO `brand` (`id`, `brand`) VALUES (NULL, 'Nike');
