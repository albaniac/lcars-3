#!/usr/bin/env python

import sys
import logging
import smbus


logging.basicConfig(filename='/var/log/lcars/i2c.log',format='%(asctime)s: %(levelname)s - %(message)s', datefmt='%d.%m.%Y %H:%M:%S',level=logging.INFO)


logging.debug(sys.argv[1]+' '+sys.argv[2])
dev_1=0x20
dev_2=0x21
b=smbus.SMBus(1)
# data vector
data=b.read_byte(dev_1)
if int(sys.argv[2]): #status
	data &= ~int(sys.argv[1], 2)
else:
	data |= int(sys.argv[1], 2)
b.write_byte(dev_1, data)
#print data 
