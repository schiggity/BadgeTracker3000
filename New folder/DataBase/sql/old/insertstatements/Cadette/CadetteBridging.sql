INSERT into Bridging VALUES(3000, "Cadette");
INSERT into BridgeQuests VALUES(30001, "Pass It On!", "Share your talents and skills by teaching younger Girl Scouts something you learned to do as a Cadette.  (And what about younger girls who aren't Girl Scouts yet? Maybe your story will inspire them to join!)This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(300011, "Share favorite things you did on a" , "National Leadership Journey. Did you add a trip? Meet local experts? Do something special when you earned your awards? Put a little kit together and present it as a 'boarding pass' gift to Juniors that they can use to start their Journey after they bridge up.");
INSERT into BridgeRequirments VALUES(300012, "Take a group of Juniors to your favorite" , "local hiking spot, demonstrate something you've learned about outdoor safety, and talk to them about Leave No Trace. Or tell them about your group's most memorable adventure and teach them your favorite Girl Scout tradition.");
INSERT into BridgeRequirments VALUES(300013, "Did you earn a Silver Award?" , "Tell a group of Juniors about your project  (maybe you could make a presentation or video). Let them know how you or your team got through the tough times and how much fun you had along the way.");
INSERT into BridgeQuests VALUES(30002, "Look Ahead!", "As a Senior, your world will get even bigger-which means there's so much more to explore. There's no better way to find out what you have to look forward to than by talking with your Senior sisters.This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(300021, "As a Senior, you can take part in the " , "global travel opportunities offered by the Girl Scouts. Talk to Girl Scout Seniors who have traveled internationally or to a national conference about their adventures.");
INSERT into BridgeRequirments VALUES(300022, "If you're interested in earning your Gold" , "Award, connect with Seniors who have already earned their Gold. Ask for advice about how to choose from among all your ideas.");
INSERT into BridgeRequirments VALUES(300023, "Find out how Seniors customized" , "their experiences on a National Leadership Journey. What trips, experts, and projects did they do? How did they have fun bringing the theme to life?");
INSERT into BridgeQuests VALUES(30003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(300031, "Plan a Ceremony" , "Congratulations! You've earned your Bridge to Girl Scout Senior Award! Celebrate with a favorite ceremony you learned on your Cadette adventure—or make up a new one. Then add your award to your Senior sash or vest.");

INSERT into BridgingHasBridgeQuests VALUES(3000,30001);
INSERT into BridgingHasBridgeQuests VALUES(3000,30002);
INSERT into BridgingHasBridgeQuests VALUES(3000,30003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30001,300011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30001,300012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30001,300013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30002,300021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30002,300022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30002,300023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(30003,300031);