INSERT into Bridging VALUES(1000, "Daisy");
INSERT into BridgeQuests VALUES(10001, "Pass It On!", "Remember how excited you were about becoming a Daisy? There are younger girls who can't wait to follow in your footsteps! Share your talents and skills by teaching younger Girl Scouts something you learned to do as a Daisy.
This list has a few ideas to get started. You only have to do one of these-or something like it-to complete the step.");

INSERT into BridgeRequirments VALUES(100011, "Teach younger girls the GS Promise" , "Teach younger girls the Girl Scout Promise and the Girl Scout Law.");
INSERT into BridgeRequirments VALUES(100011, "Tell younger girls about the Flower" , "Tell younger girls about the Flower Friends. Then share a story about your favoite. Why is she your favorite? What did you learn from her? Help the younger girls color pictures of the Flower Friends to take home.");
INSERT into BridgeRequirments VALUES(100013, "Play a game together!" , "Play a game together! Is there a special game you loved to play as a Daisy that you could teach the younger girls?");

INSERT into BridgeQuests VALUES(10002, "Look Ahead!", "Spend time with some Brownie sisters-after all, they know about the fun and adventures Brownies can have together! 
This list has a few ideas to get started. You only have to do one of these-or something like it-to complete the step.");

INSERT into BridgeRequirments VALUES(100021, "Say the Girl Scout Promise together." , "Say the Girl Scout Promise together, then trade stories about living the Promise and Law. What did you do as a Daisy? Were you friendly and helpful, or courageous and strong? What did the Brownies do?");
INSERT into BridgeRequirments VALUES(100022, "Ask the Brownies to teach you" , "Ask the Brownies to teach you their favorite Brownie song, then sing it together.");
INSERT into BridgeRequirments VALUES(100023, "Ask the Brownies to show you" , "Ask the Brownies to show you their Journey awards and tell you what they did to earn them. How did they make the world a better place? ");

INSERT into BridgeQuests VALUES(10003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(100031, "Plan a Ceremony" , "Daisy sisters can help your community when you become Brownies. Ask the Brownies to help you decorate a box or jar that will become your \"Take Action Idea Bank.\" Get ideas by asking the Brownies how you can to help your community. Get more ideas by talking to an adult who works in the community such as at a firehouse, hospital, library, or mayor's office. You could even get ideas by walking around your neighborhood with an adult and looking for ways to help. For example, maybe you might see playground equipment that needs to be fixed. Write down all your ideas and put them in your idea bank. These ideas will be waiting for you when you become a Girl Scout Brownie!");
INSERT into BridgingHasBridgeQuests VALUES(1000,10001);
INSERT into BridgingHasBridgeQuests VALUES(1000,10002);
INSERT into BridgingHasBridgeQuests VALUES(1000,10003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10001,100011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10001,100012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10001,100013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10002,100021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10002,100022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10002,100023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(10003,100031);