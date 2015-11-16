#!/usr/bin/env python

import MySQLdb
import smbus
import time


def check():
    dev_1=0x20
    b=smbus.SMBus(1)

    #data vector
    data=0x00

    data=b.read_byte(dev_1)&0x80
    return data

def toggle(key,t):
    dev_1=0x20
    b=smbus.SMBus(1)
    
    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
    cur = db.cursor()

    cur.execute('SELECT `value` FROM `settings` WHERE `parameter`="door_time"')
    value=cur.fetchall()
    t=value[0][0]
	
    #data vector
    data=0x00

    data=b.read_byte(dev_1)&0x7F
    #print data  
    b.write_byte(dev_1, data)
    time.sleep(float(t))
    data=b.read_byte(dev_1)|0x80
    #print data
    b.write_byte(dev_1, data)
    #log access


    sql="INSERT INTO AccessLog(`Key`, `Action`) VALUES(%s, 'toggle')"
    cur.execute(sql, (key))
    db.commit()
  
def open(key):
    dev_1=0x20
    b=smbus.SMBus(1)

    #data vector
    data=0x00

    data=b.read_byte(dev_1)&0x7F
    #print data  
    b.write_byte(dev_1, data)
    #log access

    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
    cur = db.cursor()

    sql="INSERT INTO AccessLog(`Key`, `Action`) VALUES(%s, 'open')"
    cur.execute(sql, (key))
    db.commit()

def close(key):
    dev_1=0x20
    b=smbus.SMBus(1)

    #data vector
    data=0x00

    data=b.read_byte(dev_1)|0x80
    #print data
    b.write_byte(dev_1, data)
    #log access
    
    db = MySQLdb.connect(host="localhost", user="lcars", passwd="lcars", db="lcars") 
    cur = db.cursor()

    sql="INSERT INTO AccessLog(`Key`, `Action`) VALUES(%s, 'close')"
    cur.execute(sql, (key))
    db.commit()



