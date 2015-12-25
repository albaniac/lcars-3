#!/usr/bin/env python

import MySQLdb
import sys
import logging
import smbus
import time



logging.basicConfig(filename='/var/log/lcars/rh.log',format='%(asctime)s: %(levelname)s - %(message)s', datefmt='%d.%m.%Y %H:%M:%S',level=logging.INFO)
logging.debug('******************BEGIN********************')
try:
    logging.debug('Connecting to database...')
    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
   

except mdbError:
    logging.error('Error establishing a database connection.')
    #raise Exception('Database connection error')

cur = db.cursor()

cur.execute('SELECT `value` FROM `settings` WHERE `parameter`="i2c_rh"')
value=cur.fetchall()
logging.debug('addr: '+value[0][0])
dev_1=int(value[0][0],16)

b=smbus.SMBus(1)

#RPI SMBUS has a bug and can't handle clock stretching, only using MSB, giving us 0.488% accuracy
b.write_byte(dev_1,0xF5)
time.sleep(0.04)
msb=int(b.read_byte(dev_1))
#logging.debug(bin(data))
#mask=0b0000000011111111
#msb=data & mask
lsb=int(0)
logging.debug(str(bin(msb))+' '+str(bin(lsb)))
data=(msb<<8)+lsb
rh=((data*125)/65536)-6
logging.debug('Rh: '+str(bin(data)+'; %:'+str(rh)))

data=int(b.read_word_data(dev_1,0xE0))
#logging.debug(bin(data))
mask=0b0000000011111111
msb=data & mask
lsb=data>>8
logging.debug(str(bin(msb))+' '+str(bin(lsb)))
data=(msb<<8)+lsb
temp=((data*175.72)/65536)-46.85
logging.debug('Temp: '+str(bin(data)+'; C:'+str(temp)))


#cur.execute('UPDATE `settings` SET `value`='+str(temp)+' WHERE `parameter`="temp"') 
#print(temp)
print(rh)

db.commit()
cur.close()
logging.debug('********************END*********************')
