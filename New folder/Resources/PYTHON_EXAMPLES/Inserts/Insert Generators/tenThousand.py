import random

f = open('tenThousandInserts.txt', 'w')
moves = ['Flash', 'Cut', 'Fly', 'Bide', 'Bubblebeam', 'Thunderbolt', 'NULL']
insert = 'INSERT INTO PokemonKnowMoves VALUES('
comma = ','
quotMarks = "'"
endIt = ");"
count = 4

for x in range(50000):
	randMove1 = random.choice(moves)
	randMove2 = random.choice(moves)
	randMove3 = random.choice(moves)
	randMove4 = random.choice(moves)
	stringcount = str(count)
	
	string = insert + stringcount + comma + quotMarks + randMove1 + quotMarks + comma + quotMarks + randMove2 + quotMarks + comma + quotMarks +  randMove3 + quotMarks + comma + quotMarks +  randMove4 + quotMarks + endIt
	
	count = count + 1
	f.write(string + '\n')