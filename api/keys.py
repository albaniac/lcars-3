#!/usr/bin/env python
#http://www.stuffaboutcode.com/2012/06/raspberry-pi-run-program-at-start-up.html

import MySQLdb
import serial
import logging
import datetime
import door
import time
import i2c


Dsql=''
newDsql=''



logging.basicConfig(filename='/var/log/keys.log',format='%(asctime)s: %(levelname)s - %(message)s', datefmt='%d.%m.%Y %H:%M:%S',level=logging.DEBUG)

port = serial.Serial("/dev/ttyAMA0", baudrate=9600, timeout=1)

readout=""

try:
    logging.info('Connecting to database...')
    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
   

except mdbError:
    logging.error('Error establishing a database connection.')
    #raise Exception('Database connection error')

while 1:
    cur = db.cursor()
    cur.execute("SELECT * FROM devices")
    newDsql=cur.fetchall()
    #print newDsql
    if (Dsql!=newDsql):
	Dsql=newDsql
        i2c.refresh(Dsql)
        
    readout=""
    if (port.inWaiting() > 0):
        readout = port.read(13)
    else:
        readout=""
	
    if (len(readout) == 13):
        key = readout[1:11]
        check = hex(int(readout[11:14],16))
        try:
            calc=hex(int(key[0:2],16)^int(key[2:4],16)^int(key[4:6],16)^int(key[6:8],16)^int(key[8:10],16))
        except ValueError:
            logging.error('Error calculating checksum. Ignoring.')
            calc=0x00

        try:
            dec=int(key[2:10],16)
        except ValueError:
            logging.error('Error calculating card number. Ignoring.')
            dec=0
	
        if (check == calc):
            logging.info('Read card: {0}'.format(readout[1:14]))
            cur.execute("SELECT `value` FROM `control` WHERE `Parameter`='AddKey'")
            add=cur.fetchall()[0][0]
            #print add
            if int(add):
                #pisi v bazo
                cur.execute("SELECT `value` FROM `control` WHERE `Parameter`='NewName'")
                name=cur.fetchall()[0][0]
                cur.execute("SELECT `value` FROM `control` WHERE `Parameter`='NewGroup'")
                group=cur.fetchall()[0][0]
                cur.execute("SELECT `value` FROM `control` WHERE `Parameter`='NewActive'")
                active=cur.fetchall()[0][0]
                cur.execute("SELECT `value` FROM `control` WHERE `Parameter`='NewExpires'")
                expires=cur.fetchall()[0][0]
                sql="INSERT INTO `keys` (`Key`, `Name`, `Group`, `Active`, `Expires`, `Hex`) VALUES (%s, %s, %s, %s, %s, %s)"
                cur.execute(sql, (dec,name,group,active,expires,key))
                logging.debug("wrote to DB: {0}".format(sql, (dec,name,group,expires,key)))
		cur.execute("UPDATE `control` SET `Value`=0 WHERE `Parameter`='AddKey'")
		cur.execute("UPDATE `control` SET `Value`='' WHERE `Parameter`='NewName'")
		cur.execute("UPDATE `control` SET `Value`='' WHERE `Parameter`='NewGroup'")
		cur.execute("UPDATE `control` SET `Value`='' WHERE `Parameter`='NewActive'")
		cur.execute("UPDATE `control` SET `Value`='' WHERE `Parameter`='NewExpires'")
            else:
                try:			
                    cur.execute("SELECT * FROM `keys` WHERE `Hex`='{0}'".format(key))
                    card=cur.fetchall()
                    logging.debug("DB record: %s", (card))
                    if int(card[0][1])==dec:
                        #Cheking if active key, expiry date etc.
                        #Get username
                        name=card[0][2]
                        #Odpri vrata
			door.toggle(name,2)
                    else:
                        #logging.info("Card didn't pass the second check")
                        #Pisi v AccessLog
                        sql="INSERT INTO AccessLog(`Key`, `Action`) VALUES (%s,'Unknown card')"
                        cur.execute(sql, (dec))
                        #logging.debug("Wrote UNKNOWN CARD to DB: {0}".format(sql))               
                except IndexError:
                    logging.info("Card not recorded in the database.")
                    #Pisi v AccessLog
                    sql="INSERT INTO AccessLog(`Key`, `Action`) VALUES (%s,'Unknown card')"
                    cur.execute(sql, (dec))
                    logging.debug("Wrote UNKNOWN CARD to DB: {0}".format(sql))
                    print (dec)
                    print (key)
                readout=""
    else:
    	pass
    db.commit()
    cur.close()	
                    
