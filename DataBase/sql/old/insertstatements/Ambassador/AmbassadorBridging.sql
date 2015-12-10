INSERT into Bridging VALUES(6000, "Ambassador");
INSERT into BridgeQuests VALUES(60001, "Pass It On!", "Share your talents and skills by teaching younger Girl Scouts something you learned to do as an Ambassador. 
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(600011, "Share favorite things you did on a" , "National Leadership Journey. Did you add a trip? Meet local experts? Do something special when you earned your awards? Put together a special package or presentation to share advice and experiences with Seniors.");
INSERT into BridgeRequirments VALUES(600012, "Share with a group of Seniors your" , "favorite memories of being an Ambassador-your Take Action projects, trips, outings, friendships, and leadership lessons learned. As you help Seniors define what leadership means to them, reflect on how others helped you along the way.");
INSERT into BridgeRequirments VALUES(600013, "Inspire younger girls by helping them" , "earn badges or complete a Journey activity. You could also hold a fitness clinic, teach a dance class, take them geocaching, or pass on any other special skill you've learned as a Girl Scout.");

INSERT into BridgeQuests VALUES(60002, "Look Ahead!", "More than 900,00 adults empower girls to become leaders through Girl Scouting. Talk to Girl Scout Adults to find out what inspires them and to get ideas about what you'd like to do.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(600021, "Get together with a Girl Scout adult.", "More than 900,00 adults empower girls to become leaders through Girl Scouting. Talk to Girl Scout Adults to find out what inspires them and to get ideas about what you'd like to do.
This list has a few ideas to get you started. You only have to do one of these-or something like it-to complete the step.");
INSERT into BridgeRequirments VALUES(600022, "Hold an appreciation breakfast of lunch", "for Girl Scout adults who have supported you. Share your memories, photos, or even a poem to tell them how much their help meant to you.");
INSERT into BridgeRequirments VALUES(600023, "Create a slide show of your best", "moments in Girl Scouts. Add some music, then gather your friends, family, and the Girl Scout adults who influenced you to share your walk down memory lane.");

INSERT into BridgeQuests VALUES(60003, "Plan a Ceremony", "");
INSERT into BridgeRequirments VALUES(600031, "Plan a Ceremony", "Congratulations! You've earned your Bridge to Girl Scout Adult Award! Celebrate with a favorite ceremony you learned in your time as a Girl Scout.");

INSERT into BridgingHasBridgeQuests VALUES(6000,60001);
INSERT into BridgingHasBridgeQuests VALUES(6000,60002);
INSERT into BridgingHasBridgeQuests VALUES(6000,60003);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60001,600011);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60001,600012);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60001,600013);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60002,600021);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60002,600022);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60002,600023);
INSERT into BridgeQuestHasBridgeRequirements VALUES(60003,600031);