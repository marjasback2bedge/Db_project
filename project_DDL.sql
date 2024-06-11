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