from mysql.connector import (connection)

conn = connection.MySQLConnection(user='Oak', password='missingno', host='pokedex.ddns.net', database='Pokedex');


file = open("HundredThousandInsertsNew.sql");
csr = conn.cursor()
poop = 1;
for line in file:
	try:
		csr.execute(line)
		conn.commit()
	except:
		print(poop);
		poop +=1
		conn.rollback()
csr.close();

file = open("TenThousandInserts.sql");
csr = conn.cursor()
poop = 1;
for line in file:
	try:
		csr.execute(line)
		conn.commit()
	except:
		print(poop);
		poop +=1
		conn.rollback()
csr.close();


	
file = open("OneThousandInserts1New.sql");
csr = conn.cursor()
poop = 1;
for line in file:
	try:
		csr.execute(line)
		conn.commit()
	except:
		print(poop);
		poop +=1	
		conn.rollback()
		
csr.close();

file = open("OneThousandInserts2.sql");
csr = conn.cursor()
poop = 1;
for line in file:
	try:
		csr.execute(line)
		conn.commit()
	except:
		print(poop);
		poop +=1
		conn.rollback()
csr.close();
		
conn.close()
