NZRE Hub
==============
This website is make for and run by NZ Resistance but feel free to use the code as you want.
If there is no admin user it will create new admin user called Ada with the password resistance.

Any sugestions or bug reports are welcome.

This runs on a LAMP server with the files in a folder called Ingress at the web root directory's.
There is a folder called .data with DB\_PASSWORD.php in it, in the root dir.This file is necessary because "Tools/database.php" imports it. This is some sample code for ".data/DB\_PASSWORD.php":
```php
<?php
	//Sample
	$HOST = "localhost";
	$USER = "ingress";
	$PSWD = "password";
	$DB = "ingress";
?>
```

The mobile version has been tested on screen sizes down to 480x800

* This project is in no way associated with Niantic Labs or Google.
* Use at your own risk.

***
MYSQL database layout:

```sql
create table AgentTable (username VARCHAR(30), passwordHash VARCHAR(128), Admin tinyint(1), lvl INT(3), AP  INT(9), Location INT(2), ViewDegree INT(2));
create table LocationTable (id INT(2),name VARCHAR(60),admin VARCHAR(60),Description VARCHAR(10000));
create table OfficerTable (username VARCHAR(30),Location INT(2));
create table PortalTable (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, PortalName VARCHAR(60), Location int(2), Lat int(10), Lon int(10));
create table KeyTable (username VARCHAR(30), portalID INT(5), NumKeys INT(4));
create table LogTable (Time VARCHAR(11), Message VARCHAR(50));
create table PortalTagTable (portalID INT(5), tagID INT(4));
create table TagTable (Name VARCHAR(30), ID int NOT NULL AUTO_INCREMENT PRIMARY KEY);
create table VerifyTable (Truster VARCHAR(30), Trustee VARCHAR(30));
create table OPSTable (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, Name VARCHAR(60), Description VARCHAR(10000), Private tinyint(1), Archived tinyint(1));
create table CoordinatorTable	 (ID int(5), Name VARCHAR(30));
create table ParticipantTable (ID int(5), Name VARCHAR(30));
create table CommentsTable (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, OP_ID int(5), Msg VARCHAR(10000), Name VARCHAR(30), Time int(11));
create table PortalOPTable (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, PortalName VARCHAR(60), Location int(2), Lat int(10), Lon int(10), Private tinyint(1), OP_ID int(5));
create table ItemTable (username VARCHAR(30),
R1  INT(4),R2  INT(4),R3  INT(4),R4  INT(4),R5  INT(4),R6  INT(4),R7  INT(4),R8  INT(4),
X1  INT(4),X2  INT(4),X3  INT(4),X4  INT(4),X5  INT(4),X6  INT(4),X7  INT(4),X8  INT(4),
U1  INT(4),U2  INT(4),U3  INT(4),U4  INT(4),U5  INT(4),U6  INT(4),U7  INT(4),U8  INT(4),
VA INT(4),VJ INT(4),
S1  INT(4),S2  INT(4),S3  INT(4),
CML  INT(4),RML  INT(4),VML  INT(4),
CMH  INT(4),RMH  INT(4),VMH  INT(4),
CMM  INT(4),RMM  INT(4),VMM  INT(4),
CMF  INT(4),RMF  INT(4),VMF  INT(4),
CMT  INT(4),RMT  INT(4),VMT  INT(4),
P1  INT(4),P2  INT(4),P3  INT(4),P4  INT(4),P5  INT(4),P6  INT(4),P7  INT(4),P8  INT(4),
K1 INT(4),
day INT(2),month VARCHAR(4),year INT(2));
```
Then I insert these default vaules
```sql
insert into LocationTable values(0,'New Zealand',NULL,NULL);
insert into LocationTable values(1,'Northland',NULL,NULL);
insert into LocationTable values(2,'Auckland',NULL,NULL);
insert into LocationTable values(3,'Waikato',NULL,NULL);
insert into LocationTable values(4,'Bay of Plenty',NULL,NULL);
insert into LocationTable values(5,'Gisborne',NULL,NULL);
insert into LocationTable values(6,'Hawke’s Bay',NULL,NULL);
insert into LocationTable values(7,'Taranaki',NULL,NULL);
insert into LocationTable values(8,'Manawatu-Wanganui',NULL,NULL);
insert into LocationTable values(9,'Wellington',NULL,NULL);
insert into LocationTable values(10,'Nelson-Tasman',NULL,NULL);
insert into LocationTable values(11,'Marlborough',NULL,NULL);
insert into LocationTable values(12,'West Coast',NULL,NULL);
insert into LocationTable values(13,'Canterbury',NULL,NULL);
insert into LocationTable values(14,'Otago',NULL,NULL);
insert into LocationTable values(15,'Southland',NULL,NULL);
```
