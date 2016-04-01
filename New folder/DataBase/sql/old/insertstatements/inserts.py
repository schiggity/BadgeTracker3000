output = open('IS.sql','a');

#INSERT into BadgeRequirements VALUES(1,'analyze sales trends','commentcommentcomment');
insert = "INSERT into "; 


def doIt(BAID,BAQID,BARID,rnum,prevQ,file,output):
	global insert;
	for line in file:
		#print(line);
		quest = insert + "BadgeQuests VALUES(";
		badge = insert + "Badges VALUES(";
		req = insert + "BadgeRequirements VALUES(";
		BHQ = insert + "BadgeHasQuests VALUES(";
		QHR = insert + "BadgeQuestHasRequirements VALUES(";
		
		
		splitline = line.split(',');
		#print(splitline);
		if splitline[0] != '': # header
			1+1;	
		else: 
			if not(splitline[1] =='' or splitline[1] == ' '):  #new badge
				#print(splitline[2]);
				#print(splitline);
				#BAID+=1;
				#print("badge ID = ",BAID);
				if(splitline[1]=='1' or splitline[1]=='2' or splitline[1]=='3' or splitline[1]=='4' or splitline[1]=='5'): #quest num
					quest += str(BAQID) + ",\'" + str(splitline[2]) + "\'" + ",\'" + str(splitline[len(splitline)-1]) +"\');\n"
					BAQID = str(BAID) + str(splitline[1]);
					#print"quest", BAQID, splitline[1]
					output.write(quest);
				else:
					BAID+=1;
					badge += str(BAID) + ",\'" + str(splitline[1]) + "\');\n"
					#print"BADGE", BAID, splitline[1]
					output.write(badge);
			else:  #requirement
				if not(splitline[2] == 'Status: (P)artial or (C)omplete' or splitline[2] == ''):
					
					req += str(BARID) + ",\'" + str(splitline[2]) +"\',\'" + str(splitline[len(splitline)-1]) + "\');\n";
					if(BAQID == prevQ):
						rnum +=1;					
					else:
						rnum = 1;
					prevQ = BAQID;
					BARID = str(BAQID) + str(rnum);
					#print"requirement", BARID, splitline[2]
					output.write(req);
					
					
#file = open("DaisyBadgesC.csv");
#doIt(999,1000,10001,1,file,output);

file = open("BrownieBadgesC.csv");
doIt(1999,2000,20001,1,2000,file,output);

file = open("CadetteBadgesC.csv");
doIt(2999,3000,30001,1,3000,file,output);

file = open("JuniorBadgesC.csv");
doIt(3999,4000,40001,1,4000,file,output);

file = open("SeniorBadgesC.csv");
doIt(4999,5000,50001,1,5000,file,output);
					
file = open("AmbassadorBadgesC.csv");
doIt(5999,6000,60001,1,6000,file,output);	
					
					
					
					
