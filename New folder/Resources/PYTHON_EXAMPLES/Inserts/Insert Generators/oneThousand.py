import random

f = open('oneThousandInserts.txt', 'w')
trainers = ['Brock', 'Misty', 'Lt.Surge', 'Erika', 'Koga', 'Sabrina', 'Blaine', 'Giovanni', 'John', 'Lenny', 'Susan', 'Curly', 'Axel', 'Bently', 'Red', 'Blue']
insert = 'INSERT INTO TrainerOwnsPokemon VALUES('
comma = ','
quotMarks = "'"
endIt = ");"
count = 17

for x in range(5000):
	randTrainer = random.choice(trainers)
	stringcount = str(count)

	string = insert  + quotMarks + randTrainer + quotMarks + comma + stringcount + endIt

	count = count + 1
	f.write(string + '\n')
