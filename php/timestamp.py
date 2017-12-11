#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost", user="kellys11", passwd="gswd1q", db="kellys11_db")

cur = db.cursor()

buoys = ["44025"]

for buoy in buoys:
        cur.execute("ALTER TABLE " + buoy + "_2016 ADD date DATE")
        cur.execute("ALTER TABLE " + buoy + "_2016 ADD time TIME")
        cur.execute("ALTER TABLE " + buoy + "_2016 ADD timestamp DATETIME")
        cur.execute("UPDATE " + buoy + "_2016 SET date = STR_TO_DATE(CONCAT(year,'-',month,'-',day), '%Y-%m-%d')")
        cur.execute("UPDATE " + buoy + "_2016 SET time = STR_TO_DATE(CONCAT(hour,':',minute), '%H:%i')")
        cur.execute("UPDATE " + buoy + "_2016 SET timestamp = STR_TO_DATE(CONCAT(date,' ',time), '%Y-%m-%d %H:%i')")

db.close()
