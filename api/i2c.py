#!/usr/bin/env python

import smbus

def refresh(Dsql):
	dev_1=0x20
	dev_2=0x21
	b=smbus.SMBus(1)

	# data vector
	data=b.read_byte(dev_1)

	for row in Dsql:
		#print row[5]
		if int(row[3]): #status
			data &= ~int(row[2], 2)
		else:
			data |= int(row[2], 2)

	b.write_byte(dev_1, data)
	#print data  
