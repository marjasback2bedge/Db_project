/*在終端機上面輸入這些
Create database project;
Show databases;
Use project;
source project_DDL.sql;
*/

SET time_zone = "+00:00";

/*用戶*/
create table user (
  ID BIGINT(30) NOT NULL AUTO_INCREMENT, 
	type varchar(1) not null DEFAULT 1, /*管理員0，使用者1*/
	name varchar(20), 
  contact varchar(100),
  password varchar(20),
	primary key (ID)
) ENGINE=INNODB AUTO_INCREMENT=1;
                                                                                     
/* 貼文*/
create table post (
    ID BIGINT(30) NOT NULL AUTO_INCREMENT,
    type varchar(1) not null, /* 失物0，招領1*/
    userID BIGINT(30), /* foreign key用戶ID*/
    occurtime datetime, /* 物品發現/遺失時間 datetime:YYYY-MM-DD HH:MM:SS*/
    posttime datetime NOT NULL DEFAULT current_timestamp(), /* 發布時間*/
    primary key (ID),
    foreign key (userID) references user(ID) on delete cascade
) ENGINE=INNODB AUTO_INCREMENT=1;

/* 物品*/
create table item (
    ID BIGINT(30) NOT NULL AUTO_INCREMENT,
    postID BIGINT(30), /* foreign key貼文ID*/
    state varchar(1) not null, /* 尋找中0 待領取1 已解決2*/
    name varchar(50),
    kind varchar(50),
    description varchar(50), /* 類型、顏色、品牌等描述*/
    photo blob, 
    primary key (ID),
    foreign key (postID) references post(ID) on delete cascade
) ENGINE=INNODB AUTO_INCREMENT=1;

/* 場所*/
create table department (
    ID BIGINT(30) NOT NULL AUTO_INCREMENT,
    name varchar(100),
    campus text,
    building text,
    primary key (ID)
) ENGINE=INNODB AUTO_INCREMENT=1;

/* 通知*/
create table note (
    ID BIGINT(30) NOT NULL AUTO_INCREMENT,
    userID BIGINT(30), /* foreign key用戶ID*/
    content text,
    time datetime NOT NULL DEFAULT current_timestamp(),
    primary key (ID),
    foreign key (userID) references user(ID) on delete cascade
) ENGINE=INNODB AUTO_INCREMENT=1;

/* 響應*/
create table response (
    time datetime NOT NULL DEFAULT current_timestamp(),
    userID BIGINT(30), /* foreign key用戶ID*/
    postID BIGINT(30), /* foreign key貼文ID*/
    content text,
    primary key (time, userID),
    foreign key (userID) references user(ID),
    foreign key (postID) references post(ID) 
		on delete set null
) ENGINE=INNODB;

/* 貼文發生位置*/
create table postlocate (
    ID BIGINT(30) NOT NULL AUTO_INCREMENT,
    postID BIGINT(30), /* foreign key貼文ID*/
    deptID BIGINT(30), /* foreign key場所ID*/
    primary key (ID, postID),
    foreign key (postID) references post(ID) on delete cascade,
    foreign key (deptID) references department(ID) on delete cascade
) ENGINE=INNODB AUTO_INCREMENT=1;

/* 物品目前位置*/
create table itemlocate (
    ID BIGINT(30),
    itemID BIGINT(30), /* foreign key物品ID*/
    deptID BIGINT(30), /* foreign key場所ID*/
    primary key (ID, itemID),
    foreign key (itemID) references item(ID) on delete cascade,
    foreign key (deptID) references department(ID) on delete cascade
) ENGINE=INNODB AUTO_INCREMENT=1;

INSERT INTO `user` (`ID`, `type`, `name`, `contact`, `password`) VALUES (NULL, '0', 'admin', 'admin@gmail.com', 'adminpassword');

INSERT INTO user (ID, type, name, contact, password) VALUES 
(NULL, '1', 'Alice', 'alice@example.com', 'password1'),
(NULL, '1', 'Bob', 'bob@example.com', 'password2'),
(NULL, '1', 'Charlie', 'charlie@example.com', 'password3'),
(NULL, '1', 'David', 'david@example.com', 'password4'),
(NULL, '1', 'Eve', 'eve@example.com', 'password5');

/* 插入五个贴文 */
INSERT INTO post (ID, type, userID, occurtime, posttime) VALUES 
(NULL, '0', 1, '2024-01-01 10:00:00', CURRENT_TIMESTAMP),
(NULL, '1', 2, '2024-01-02 11:00:00', CURRENT_TIMESTAMP),
(NULL, '0', 3, '2024-01-03 12:00:00', CURRENT_TIMESTAMP),
(NULL, '1', 4, '2024-01-04 13:00:00', CURRENT_TIMESTAMP),
(NULL, '0', 5, '2024-01-05 14:00:00', CURRENT_TIMESTAMP);

/* 插入五个物品 */
INSERT INTO item (ID, postID, state, name, kind, description, photo) VALUES 
(NULL, 1, '0', 'Wallet', 'Personal', 'Black leather wallet', NULL),
(NULL, 2, '1', 'Phone', 'Electronics', 'White iPhone', NULL),
(NULL, 3, '0', 'Laptop', 'Electronics', 'Silver MacBook', NULL),
(NULL, 4, '1', 'Book', 'Stationery', 'Red notebook', NULL),
(NULL, 5, '1', 'Watch', 'Accessory', 'Gold watch', NULL);

/* 插入五个场所 */
INSERT INTO department (ID, name, campus, building) VALUES 
(NULL, 'Library', 'Main', 'Building A'),
(NULL, 'Gym', 'West', 'Building B'),
(NULL, 'Cafeteria', 'East', 'Building C'),
(NULL, 'Dormitory', 'North', 'Building D'),
(NULL, 'Office', 'South', 'Building E');

/* 插入五个通知 */
INSERT INTO note (ID, userID, content, time) VALUES 
(NULL, 1, 'Your lost item has been found.', CURRENT_TIMESTAMP),
(NULL, 2, 'You have a new message.', CURRENT_TIMESTAMP),
(NULL, 3, 'Your account has been updated.', CURRENT_TIMESTAMP),
(NULL, 4, 'Your post has a new response.', CURRENT_TIMESTAMP),
(NULL, 5, 'Your password has been changed.', CURRENT_TIMESTAMP);

/* 插入五个响应 */
INSERT INTO response (time, userID, postID, content) VALUES 
(CURRENT_TIMESTAMP, 1, 1, 'I found a similar item.'),
(CURRENT_TIMESTAMP, 2, 2, 'I can help you with this.'),
(CURRENT_TIMESTAMP, 3, 3, 'Can you provide more details?'),
(CURRENT_TIMESTAMP, 4, 4, 'I have seen this item.'),
(CURRENT_TIMESTAMP, 5, 5, 'Is this still available?');

/* 插入五个贴文发生位置 */
INSERT INTO postlocate (ID, postID, deptID) VALUES 
(NULL, 1, 1),
(NULL, 2, 2),
(NULL, 3, 3),
(NULL, 4, 4),
(NULL, 5, 5);

/* 插入五个物品当前地点 */
INSERT INTO itemlocate (ID, itemID, deptID) VALUES 
(NULL, 1, 1),
(NULL, 2, 2),
(NULL, 3, 3),
(NULL, 4, 4),
(NULL, 5, 5);