import random

f = open('oneThousandInsertsAgain.txt', 'w')
Pokemon = ['Bulbasaur', 'Ivysaur', 'Venusaur', 'Charmander', 'Charmeleon', 'Charizard', 'Squirtle', 'Wartortle', 'Blastoise', 'Caterpie', 'Metapod', 'Butterfree', 'Weedle', 'Kakuna',  'Beedrill',  'Pidgey',  'Pidgeotto', 'Pidgeot', 'Rattata', 'Raticate',]
insert = 'INSERT INTO Locations VALUES('
comma = ','
quotMarks = "'"
endIt = ");"
count = 24
route = 'Route'

for x in range(5000):
	randPokemon1 = random.choice(Pokemon)
	randPokemon2 = random.choice(Pokemon)

	stringcount = str(count)

	string = insert  + quotMarks + route + stringcount + quotMarks + comma + quotMarks + randPokemon1 + quotMarks + comma + quotMarks + randPokemon2 + quotMarks + endIt

	count = count + 1
	f.write(string + '\n')
