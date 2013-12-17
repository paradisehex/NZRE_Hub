NZRE Inventory
==============
This website is make for and run by NZ Resistance but feel free to use the code as you want.

Any sugestions or bug reports are welcome.

This runs on a LAMP server with the files in a folder called Ingress at the web directory's root .

The mobile version has been tested on screen sizes down to 480x800

* This project is in no way associated with Niantic Labs or Google.
* Use at your own risk.

***
This is the MYSQL database layout:

```sql
LogTable (Time VARCHAR(11), Message VARCHAR(50));
AgentTable (username VARCHAR(30), passwordHash VARCHAR(128), Admin tinyint(1), lvl INT(3), AP  INT(9), Location INT(2), InLvl INT(3), outLvl INT(3));
LocationTable (id INT(2),name VARCHAR(60),admin VARCHAR(60),Description VARCHAR(10000));
OfficerTable (username VARCHAR(30),Location INT(2));
PortalTable (ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, PortalName VARCHAR(60), Location int(2), Lat int(10), Lon int(10));
PortalTagTable (portalID INT(5), tagID INT(4));
TagTable (Name VARCHAR(30), ID int NOT NULL AUTO_INCREMENT PRIMARY KEY);
KeyTable (username VARCHAR(30), portalID INT(5), NumKeys INT(4));
ItemTable (username VARCHAR(30),
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
AP  INT(9),K1 INT(4),
day INT(2),month VARCHAR(4),year INT(2));
```
