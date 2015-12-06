#!/usr/bin/env python

import MySQLdb
import sys
import logging
import smbus


logging.basicConfig(filename='/var/log/lcars/temp.log',format='%(asctime)s: %(levelname)s - %(message)s', datefmt='%d.%m.%Y %H:%M:%S',level=logging.INFO)
logging.debug('******************BEGIN********************')
try:
    logging.debug('Connecting to database...')
    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
   

except mdbError:
    logging.error('Error establishing a database connection.')
    #raise Exception('Database connection error')

cur = db.cursor()

cur.execute('SELECT `value` FROM `settings` WHERE `parameter`="i2c_th"')
value=cur.fetchall()
logging.debug('addr: '+value[0][0])
dev_1=int(value[0][0],16)

b=smbus.SMBus(1)

data=int(b.read_word_data(dev_1,0x00))
#logging.debug(bin(data))
mask=0b0000000011111111
msb=data & mask
lsb=data>>8
#logging.debug(str(bin(msb))+' '+str(bin(lsb)))
data=(msb<<8)+lsb
#logging.debug('Temp: '+str(bin(data))+';'+str(bin(data>>5))+';'+str((data>>5)*0.125))
temp=float(float(data>>5)*0.125)
logging.debug(temp)  
cur.execute('UPDATE `settings` SET `value`='+str(temp)+' WHERE `parameter`="temp"') 
print(temp)

cur.execute('SELECT `value` FROM `settings` WHERE `parameter`="tos"')
value=cur.fetchall()
tos=(int(value[0][0])*8)<<5
#logging.debug(bin(tos))
mask=0b0000000011111111
msb=tos & mask
lsb=tos>>8
#logging.debug(str(bin(msb))+' '+str(bin(lsb)))
data=(msb<<8)+lsb
b.write_word_data(dev_1,0x03,data)

cur.execute('SELECT `value` FROM `settings` WHERE `parameter`="thyst"')
value=cur.fetchall()
thyst=(int(value[0][0])*8)<<5
#logging.debug(bin(tos))
mask=0b0000000011111111
msb=thyst & mask
lsb=thyst>>8
#logging.debug(str(bin(msb))+' '+str(bin(lsb)))
data=(msb<<8)+lsb
b.write_word_data(dev_1,0x02,data)


db.commit()
cur.close()
logging.debug('********************END*********************')
