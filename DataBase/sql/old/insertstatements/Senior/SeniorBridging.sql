INSERT into Bridging VALUES(5000, "Senior");

INSERT into BridgeQuests VALUES(50001, "Pass It On!", "");
INSERT into BridgeRequirments VALUES(500011, "Pass It On!" , "Share your talents and skills by teaching younger Girl Scouts one thing you learned to do as a Senior.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.
IDEAS
•Share favorite things you did on a National Leadership Journey. Did you add a trip? Meet local experts? Do something special when you earned your awards? Put a little kit together and give to Cadettes to help them start charting their course after they bridge up.
•Invite a group of Cadettes on a campout, overnight trip, or other fun event, and talk about your experiences as a Senior.
•If you've earned your Gold Award, talk to Cadettes who want to do their own Gold Award projects. Share what you learned, and offer them tips based on your own experience.");

INSERT into BridgeQuests VALUES(50002, "Look Ahead!", "");
INSERT into BridgeRequirments VALUES(500021, "Look Ahead!" , "Explore what it's like to be an Ambassador. What's the best way to do that? Connect with girls who are already there.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step
IDEAS
•Invite Ambassadors to a round table. Start with some tasty snacks and a few ""getting to know you"" games. Ask your Ambassador sisters about their achievements and challenges. Find out about their most surprising, funny, or moving moments as Girl Scouts. Get their tips on how to make the most of your Ambassador experience.
•Connect with Girl Scout Ambassadors through social media. Tap the widest network you can to find out how others chose their Gold Award projects, how they connected with mentors, what outdoor adventures and trips they went on, or anything else that interests you.
•Join a council event, camping trip, overnight, or Take Action project that involves Ambassadors. See what you can learn about expanding your current interests as you move into your next step in Girl Scouting. For example, if you were excited by a project you did on a Senior Journey, find out how you could continue to develop it for an Ambassador Take Action or Gold Award project.");

INSERT into BridgeQuests VALUES(50003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(500031, "Plan a Ceremony" , "");
INSERT into BridgingHasBridgeQuests VALUES(5000,50001);
INSERT into BridgingHasBridgeQuests VALUES(5000,50002);
INSERT into BridgingHasBridgeQuests VALUES(5000,50003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50001,500011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50001,500012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50001,500013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50002,500021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50002,500022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50002,500023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(50003,500031);