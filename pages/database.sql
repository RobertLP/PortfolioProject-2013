create database webDatabase;
use webDatabase;

create table pageManagement ( 
	headPicutre varchar(25),
	amountBlocks varchar(2),
	floatBehaviour varchar(10),
	tabName varchar(15),
	primary key (tabName)
)
engine=INNODB;

create table blokken (
	tabName varchar(2),
	blockNumber varchar(2),
	primary key(blockNumber)
)
engine=INNODB;

create table BlockManagement (
	blockNumber varchar(2),
	blockTitle varchar(30),
	blockText varchar(300),
	blockPicture varchar(25),
	primary key(blockTitle)
)
engine=INNODB;