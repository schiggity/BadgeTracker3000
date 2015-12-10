import random

f = open('hundredThousandInserts.txt', 'w')
Pokemon = ['Bulbasaur', 'Ivysaur', 'Venusaur', 'Charmander', 'Charmeleon', 'Charizard', 'Squirtle', 'Wartortle', 'Blastoise', 'Caterpie', 'Metapod', 'Butterfree', 'Weedle', 'Kakuna',  'Beedrill',  'Pidgey',  'Pidgeotto', 'Pidgeot', 'Rattata', 'Raticate',]
Passive = ['Adaptability', 'Bad Dreams', 'Cacophony', 'Damp', 'Early Bird', 'Fairy Aura', 'Gale Wings', 'Harvest', 'Ice Body', 'Justified', 'Keen Eye', 'Leaf Guard', 'Magic Bounce', 'Natural Cure',  'Oblivious', 'Parental Bond', 'Quick Feet', 'Rain Dish', 'Sand Force', 'Tangled Feet']
Nature = ['Adamant', 'Bashful', 'Bold']
insert = 'INSERT INTO Pokemon VALUES('
comma = ','
quotMarks = "'"
endIt = ");"
count = 4

for x in range(150000):

	randPokemon = random.choice(Pokemon)
	randPassive = random.choice(Passive)
	randInt = str(random.randint(1, 100))
	randNature = random.choice(Nature)
	stringcount = str(count)
	
	string = insert + stringcount + comma + quotMarks + randPokemon + quotMarks + comma + quotMarks + randPassive + quotMarks + comma + randInt + comma + quotMarks + randNature + quotMarks + endIt

	count = count + 1
	#print (string)
	f.write(string + '\n')