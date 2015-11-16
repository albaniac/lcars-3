#!/usr/bin/env python

import sys
import door
#import keys

if (sys.argv[1]=='check'):
    state=door.check()
    print state

if (sys.argv[1]=='addkey'):
    keys.adddkey(sys.argv[2],sys.argv[3],sys.argv[4])
    print "1"
    
if (sys.argv[1]=='toggle'):
    door.toggle(sys.argv[2],sys.argv[3])
    print "1"

    
if (sys.argv[1]=='open'):
    door.open(sys.argv[2])
    print "1"
    
if (sys.argv[1]=='close'):
    door.close(sys.argv[2])
    print "1"
