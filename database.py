#!/usr/bin/env python

import MySQLdb

db = MySQLdb.connect("localhost", "moniter", "password", "tempdb")
curs=db.cursor()

temp = 13

with db:
  curs.execute("""INSERT INTO temptable
	values(CURRENT_DATE(), NOW(),""" + str(temp) + """)""")

print "Data commited"

