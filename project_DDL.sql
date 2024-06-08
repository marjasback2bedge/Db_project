/*在終端機上面輸入這些
Create database project;
Show databases;
Use project;
source project_DDL.sql;
*/

/*用戶*/
create table user (
  ID varchar(5), 
	type varchar(1) not null, /*管理員0，使用者1*/
	name varchar(20), 
  contact varchar(100),
	primary key (ID)
) ENGINE=INNODB;
                                                                                     
/* 貼文*/
create table post (
    ID varchar(5),
    type varchar(1) not null, /* 失物0，招領1*/
    userID varchar(5), /* foreign key用戶ID*/
    occurtime datetime, /* 物品發現/遺失時間 datetime:YYYY-MM-DD HH:MM:SS*/
    posttime datetime, /* 發布時間*/
    primary key (ID),
    foreign key (userID) references user(ID) on delete cascade
) ENGINE=INNODB;

/* 物品*/
create table item (
    ID varchar(5),
    postID varchar(5), /* foreign key貼文ID*/
    state varchar(1) not null, /* 尋找中0 待領取1 已解決2*/
    name varchar(50),
    kind varchar(50),
    description varchar(50), /* 類型、顏色、品牌等描述*/
    photo blob, 
    primary key (ID),
    foreign key (postID) references post(ID) on delete cascade
) ENGINE=INNODB;

/* 場所*/
create table department (
    ID varchar(5),
    name varchar(100),
    campus text,
    building text,
    primary key (ID)
) ENGINE=INNODB;

/* 通知*/
create table note (
    ID varchar(5),
    userID varchar(5), /* foreign key用戶ID*/
    content text,
    time datetime,
    primary key (ID),
    foreign key (userID) references user(ID) on delete cascade
) ENGINE=INNODB;

/* 響應*/
create table response (
    time datetime,
    userID varchar(5), /* foreign key用戶ID*/
    postID varchar(5), /* foreign key貼文ID*/
    content text,
    primary key (time, userID),
    foreign key (userID) references user(ID),
    foreign key (postID) references post(ID) 
		on delete set null
) ENGINE=INNODB;

/* 貼文發生位置*/
create table postlocate (
    ID varchar(5),
    postID varchar(5), /* foreign key貼文ID*/
    deptID varchar(5), /* foreign key場所ID*/
    primary key (ID, postID),
    foreign key (postID) references post(ID),
    foreign key (deptID) references department(ID) 
    on delete set null
) ENGINE=INNODB;

/* 物品目前位置*/
create table itemlocate (
    ID varchar(5),
    itemID varchar(5), /* foreign key物品ID*/
    deptID varchar(5), /* foreign key場所ID*/
    primary key (ID, itemID),
    foreign key (itemID) references item(ID),
    foreign key (deptID) references department(ID)
    on delete set null
) ENGINE=INNODB;
