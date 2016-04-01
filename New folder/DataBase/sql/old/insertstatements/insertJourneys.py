#INSERT into BadgeRequirements(1,'analyze sales trends','commentcommentcomment');
insert = "INSERT into "; 
output = open("IS.sql","a");


def doIt(JID,QID,RID,qnum,rnum,file,output):
	
	global insert;
	
	for line in file:
		Q = insert + "Quests VALUES(";
		J = insert + "Journey VALUES(";
		R = insert + "QuestRequirements VALUES(";
		JHQ = insert + "JourneyHasQuests VALUES(";
		QHR = insert + "QuestsHasQuestRequirements VALUES(";


		split = line.split(',');
		if(split[0] != ''):  #JOURNEY
			JID +=1;
			J += str(JID) + ",\'" + str(split[0]) + "\');\n"
			
			qnum = 1;
			QID = str(JID) + str(qnum);
			output.write(J);
		else:   #quest or req
			#REQ
			if(split[1]=='1' or split[1]=='2' or split[1]=='3' or split[1]=='4' or split[1]=='5'or split[1]=='6'or split[1]=='7'or split[1]=='8'or split[1]=='9'or split[1]=='10'):
				R+= str(RID) + ",\'" + str(split[2]) + "\',\'" + str(split[len(split)-1]) + "\');\n";
				QHR += str(QID) + ',' + str(RID) + ');\n'
				rnum += 1;
				RID = str(RID[:len(RID)-1]) + str(rnum);
				output.write(R);
				output.write(QHR);
										
			#QUESTS
			else:
				rnum = 1;
				QID = str(JID) + str(qnum);
				RID = str(QID) + str(rnum);
				Q+= str(QID) + ",\'" + str(split[1]) + "\',\'" + str(split[len(split)-1]) + "\');\n";
				JHQ += str(JID) + ',' + str(QID) + ');\n';
				
				qnum +=1;				
				
				
				output.write(Q);
				output.write(JHQ);



#file = open("DaisyJourneysC.csv");
#doIt(999,1000,10001,1,1,file,output);

file = open("BrownieJourneysC.csv");
doIt(1999,2000,20001,1,1,file,output);

file = open("CadetteJourneysC.csv");
doIt(2999,3000,30001,1,1,file,output);

file = open("JuniorJourneysC.csv");
doIt(3999,4000,40001,1,1,file,output);

file = open("SeniorJourneysC.csv");
doIt(4999,5000,50001,1,1,file,output);

file = open("AmbassadorJourneysC.csv");
doIt(5999,6000,60001,1,1,file,output);




