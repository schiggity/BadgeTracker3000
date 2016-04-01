INSERT into Bridging VALUES(2000, "Brownie");
INSERT into BridgeQuests VALUES(20001, "Pass It On!", "Share your talents and skills by teaching younger Girl Scouts something you have learned to do as a Brownie.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(200011, "Teach a group of Daisies a song, game" , "Teach a group of Girl Scout Daisies a song, game, or craft that you enjoyed doing on your Brownie adventure.");
INSERT into BridgeRequirments VALUES(200012, "Help the Daisies create and decorate" , "Talk to your Daisy sisters about the Journeys you did as a Brownie and how you made the world a better place. Maybe you can show photos that you took on a Journey or teach one of the skills you learned.");
INSERT into BridgeRequirments VALUES(200013, "Invite Daisies to attend one of your " , "Help the Daisies make small books by stapling blank pages between two pieces of construction paper. Pass the books around and write message to the Daisies, telling them what makes them special, why you're glad they're your sister Girl Scouts, and what they can look forward to as Brownies. Inspire your Daisy sisters to climb the ladder of leadership!");
INSERT into BridgeQuests VALUES(20002, "Look Ahead!", "As a Junior, you'll find new stars to guide you and become a star yourself! The best way to find out what it really means to be a Girl Scout Junior is to talk to girls who are already Juniors.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(200021, "Ask your Junior friends what activities" , "Ask your Junior friends what Journeys they did. Maybe they can tach you something they learned on thier Journeys. If any of the girls were also Girl Scout Brownies, ask them how being a Junior was different from being a Brownie.");
INSERT into BridgeRequirments VALUES(200022, "Talk to a Girl Scout Junior who earned" , "Talk to a Girl Scout Junior who earned her Girl Scout Bronze Award. How did she choose her project? Who was on her team? What did she learn? Ask what advice she would give to someone who wants to earn her Bronze Award.");
INSERT into BridgeRequirments VALUES(200023, "Go to a meeting of Girl Scout Juniors" , "Go to a meeting of Girl Scout Juniors. Talk to them about their favorite memories of being a Junior and what fun activities you shouldn't miss.");
INSERT into BridgeQuests VALUES(20003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(200031, "Plan a Ceremony" , "Congratulations! You've earned your Bridge to Girl Scout Junior Award! Celebrate with a favorite ceremony you learned on your Brownie journey—or make up a new one. Then add your Bridging patch to your Junior sash or vest. Some girls receive their Brownie wings at this ceremony, too.");
INSERT into BridgingHasBridgeQuests VALUES(2000,20001);
INSERT into BridgingHasBridgeQuests VALUES(2000,20002);
INSERT into BridgingHasBridgeQuests VALUES(2000,20003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20001,200011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20001,200012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20001,200013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20002,200021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20002,200022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20002,200023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(20003,200031);