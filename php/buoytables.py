#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost", user="kellys11", passwd="gswd1q", db="kellys11_db")

cur = db.cursor()

buoys = ["44065", "44018", "44025", "44017"]

for buoy in buoys :

    cur.execute("CREATE TABLE IF NOT EXISTS 44017_2016 (year VARCHAR(4), month VARCHAR(2), day VARCHAR(2), hour INT(2), minute INT(2), wind_dir INT(3), wind_spd FLOAT(8), gust FLOAT(8), wave_height Float(8), dpd FLOAT(8), apd FLOAT(8), mwd FLOAT(8), pressure FLOAT(8), airtemp FLOAT(8), wtmp FLOAT(8), dewp FLOAT(8), vis FLOAT(8), tide FLOAT(8))")
    cur.execute("LOAD DATA LOCAL INFILE '44017_2016.csv' INTO TABLE 44017_2016 FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n' IGNORE 2 LINES")
    cur.execute("UPDATE 44017_2016 SET date = STR_TO_DATE(CONCAT(year,'-',month,'-',day), '%Y-%m-%d')")
    cur.execute("UPDATE 44017_2016 SET time = STR_TO_DATE(CONCAT(hour,':',minute), '%H:%i')")
    cur.execute("UPDATE 44017_2016 SET timestamp = STR_TO_DATE(CONCAT(date,' ',time), '%Y-%m-%d %H:%i')")

db.close()
