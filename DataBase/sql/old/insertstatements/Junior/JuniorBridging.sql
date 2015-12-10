INSERT into Bridging VALUES(4000, "Junior");

INSERT into BridgeQuests VALUES(40001, "Pass It On!", "Share your talents and skills by teaching younger Girl Scouts something you learned to do as a Junior.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(400011, "Invite Brownies to attend one of your" , "Invite Brownies to attend one of your meetings, and share something that will make them look forward to being a Girl Scout Junior. For example, you could show them photos from a mystery hunt you went on for your Detective badge, demonstrate how to pack for  an overnight camping trip, or show a video of everyone in your group talking about their favorite Junior memories.");
INSERT into BridgeRequirments VALUES(400011, "Invite girls your age who aren't Girl" , "Invite girls your age who aren't Girl Scouts to join you in a fun activity- doing martial arts, learning sign language, or building a parade float. If you're doing a Take Action project, ask your buddies to tag along! Maybe you'll inspire them to pitch in.");
INSERT into BridgeRequirments VALUES(400013, "Team up with the girls in your group" , "Team up with the girls in your group who earned a Bronze Award, and hold a question-and-answer session for interested Brownies. Describe how you chose your project, planned it, and overcame obstacles along the way. Inspire them to go for the Bronze, too!");

INSERT into BridgeQuests VALUES(40002, "Look Ahead!", "As a Cadette, you'll set your sights on the world outside your local area. There's no better way to find out what you have to look forward to than by talking with your Cadette sisters.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(400021, "Ask a Girl Scout Cadette to talk to you" , "Ask a Girl Scout Cadette to talk to you about her experiences. What was her favorite activity as a Cadette? What new skills did she learn?");
INSERT into BridgeRequirments VALUES(400022, "Do you want to work on your Girl Scout" , "Do you want to work on your Girl Scout Silver Award? Find Cadettes who have earned this honor, and ask them for tips. Find out how they formed their teams, how they selected a project, and what they learned along the way. If you have some ideas for your project, ask them for advice.");
INSERT into BridgeRequirments VALUES(400023, "Talk to Cadettes about which Journeys" , "Talk to Cadettes about which Journeys they went on. What did they enjoy about the experience? How did they make their community better? Ask them to share their best moments from their Journey with you.");

INSERT into BridgeQuests VALUES(40003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(400031, "Plan a Ceremony" , "Congratulations! You've earned your Bridge to Girl Scout Cadette Award! Celebrate with a favorite ceremony you learned on your Junior adventure—or make up a new one. Then add your award to your Cadette sash or vest.");
INSERT into BridgingHasBridgeQuests VALUES(4000,40001);
INSERT into BridgingHasBridgeQuests VALUES(4000,40002);
INSERT into BridgingHasBridgeQuests VALUES(4000,40003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40001,400011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40001,400012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40001,400013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40002,400021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40002,400022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40002,400023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(40003,400031);