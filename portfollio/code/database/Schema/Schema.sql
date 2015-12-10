CREATE TABLE Scouts(
SID INT UNIQUE,
DoB Date,
Grade INT,
Ranks Text,
PRIMARY KEY (SID)
);
 
CREATE TABLE Bridging(
BID INT UNIQUE,
Name Text,
PRIMARY KEY (BID)
);
 
CREATE TABLE BridgeQuests(
BQID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (BQID)
);
 
CREATE TABLE BridgeRequirments(
BRID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (BRID)
);
 
CREATE TABLE Users(
userName varchar(255) UNIQUE,
password Text,
salt Text,
Email Text,
PRIMARY KEY (userName)
);
 
CREATE TABLE Finances(
FID INT UNIQUE,
Purpose Text,
Amount INT,
PRIMARY KEY (FID)
);
 
CREATE TABLE Events(
EID INT UNIQUE,
TheDate Date,
Event Text,
PRIMARY KEY (EID)
);
 
CREATE TABLE Journey(
JID INT UNIQUE,
Name Text,
PRIMARY KEY (JID)
);
 
CREATE TABLE BadgeRequirements(
BARID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (BARID)
);
 
CREATE TABLE Quests(
QID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (QID)
);
 
CREATE TABLE Awards(
AID INT UNIQUE,
Name Text,
PRIMARY KEY (AID)
);
 
CREATE TABLE QuestRequirements(
RID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (RID)
);
 
CREATE TABLE AwardRequirements(
ARID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (ARID)
);
 
CREATE TABLE EmergencyInfo(
EMID INT UNIQUE,
PrimaryCont Text,
SecondaryCont Text,
Allergies Text,
Other Text,
PRIMARY KEY (EMID)
);
 
CREATE TABLE Badges(
BAID INT UNIQUE,
Name Text,
PRIMARY KEY (BAID)
);
 
CREATE TABLE Troops(
TID INT,
Council Text, 
Leader Text,
PRIMARY KEY (TID)
);
 
CREATE TABLE BadgeQuests(
BAQID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (BAQID)
);
 
CREATE TABLE BadgeRequirments(
BARID INT UNIQUE,
Name Text,
Comments Text,
PRIMARY KEY (BARID)
);
 
CREATE TABLE JourneyHasQuests(
JID INT,
QID INT,
FOREIGN KEY (JID) REFERENCES Journey(JID),
FOREIGN KEY (QID) REFERENCES Quests(QID)
);
 
CREATE TABLE QuestsHasQuestRequirements(
QID INT,
RID INT,
FOREIGN KEY (QID) REFERENCES Quests(QID),
FOREIGN KEY (RID) REFERENCES QuestRequirements(RID)
);
 
CREATE TABLE ScoutsDoJourney(
SID INT,
JID INT,
RID INT,
TheDate DATE,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (JID) REFERENCES Journey(JID),
FOREIGN KEY (RID) REFERENCES QuestRequirements(RID)
);
 
CREATE TABLE ScoutsAwardedQuests(
QID INT,
SID INT,
TheDate DATE,
FOREIGN KEY (QID) REFERENCES Quests(QID),
FOREIGN KEY (SID) REFERENCES Scouts(SID)
);
 
CREATE TABLE AwardHasRequirements(
AID INT,
ARID INT,
FOREIGN KEY (AID) REFERENCES Awards(AID),
FOREIGN KEY (ARID) REFERENCES AwardRequirements(ARID)
);
 
CREATE TABLE ScoutsDoAward(
SID INT,
AID INT,
ARID INT,
TheDate DATE,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (AID) REFERENCES Awards(AID),
FOREIGN KEY (ARID) REFERENCES AwardRequirements(ARID)
);
 
CREATE TABLE ScoutsAwardedAwards(
SID INT,
AID INT,
TheDate DATE,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (AID) REFERENCES Awards(AID)
);
 
CREATE TABLE ScoutsHasEmergencyInfo(
SID INT,
EMID INT,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (EMID) REFERENCES EmergencyInfo(EMID)
);
 
CREATE TABLE BadgeHasQuest(
BAID INT,
BAQID INT,
FOREIGN KEY (BAID) REFERENCES Badges(BAID),
FOREIGN KEY (BAQID) REFERENCES BadgeQuests(BAQID)
);
 
CREATE TABLE BadgeQuestHasRequirements(
BAQID INT,
BARID INT,
FOREIGN KEY (BAQID) REFERENCES BadgeQuests(BAQID),
FOREIGN KEY (BARID) REFERENCES BadgeRequirements(BARID)
);
 
CREATE TABLE ScoutsDoBadge(
SID INT,
BAID INT,
BARID INT,
TheDate DATE,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (BAID) REFERENCES Badges(BAID),
FOREIGN KEY (BARID) REFERENCES BadgeRequirements(BARID)
);
 
CREATE TABLE ScoutsAwardedBadge(
SID INT,
BAID INT,
TheDate Date,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (BAID) REFERENCES Badges(BAID)
);
 
CREATE TABLE BridgingHasBridgeQuest(
BID INT,
BQID INT,
FOREIGN KEY (BID) REFERENCES Bridging(BID),
FOREIGN KEY (BQID) REFERENCES BridgeQuests(BQID)
);
 
CREATE TABLE BridgeQuestHasBridgeRequirments(
BQID INT,
BRID INT,
FOREIGN KEY (BQID) REFERENCES BridgeQuests(BQID),
FOREIGN KEY (BRID) REFERENCES BridgeRequirments(BRID)
);
 
CREATE TABLE ScoutsAwardedBridging(
SID INT,
BID INT,
TheDate Date,
FOREIGN KEY (BID) REFERENCES Bridging(BID),
FOREIGN KEY (SID) REFERENCES Scouts(SID)
);
 
CREATE TABLE ScoutsDoBridgeQuest(
SID INT,
BQID INT,
TheDate Date,
FOREIGN KEY (BQID) REFERENCES BridgeQuests(BQID),
FOREIGN KEY (SID) REFERENCES Scouts(SID)
);
 
CREATE TABLE ScoutsDoBridgeRequirments(
SID INT,
BRID INT,
TheDate Date,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (BRID) REFERENCES BridgeRequirments(BRID)
);
 
CREATE TABLE ScoutsInTroop(
SID INT,
TID INT,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (TID) REFERENCES Troops(TID)
);
 
CREATE TABLE TroopHasUsers(
TID INT,
userName Text,
FOREIGN KEY (TID) REFERENCES Troops(TID),
FOREIGN KEY (userName) REFERENCES Users(userName)
);
 
CREATE TABLE ScoutsPayDuesFinances(
SID INT,
FID INT,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (FID) REFERENCES Finances(FID)
);
 
CREATE TABLE TroopHaveFinances(
TID INT,
FID INT,
FOREIGN KEY (TID) REFERENCES Troops(TID),
FOREIGN KEY (FID) REFERENCES Finances(FID)
);
 
CREATE TABLE ScoutsGoToEvents(
SID INT,
EID INT,
FOREIGN KEY (SID) REFERENCES Scouts(SID),
FOREIGN KEY (EID) REFERENCES Events(EID)
);
 
CREATE TABLE FinancesCreateDuesEvents(
FID INT,
EID INT,
FOREIGN KEY (FID) REFERENCES Finances(FID),
FOREIGN KEY (EID) REFERENCES Events(EID)
);