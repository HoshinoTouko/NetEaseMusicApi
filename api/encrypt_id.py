#! /usr/bin/env python
# -*- coding: utf-8 -*-
'''
Created on 2013-06-07 19:28
@author: Yang Junyong <yanunon@gmail.com>
@Modified: ivanCai & HoshinoTouko
'''


import hashlib
import base64
import urllib2
import urllib
import json
import random
import os
import sys

def encrypted_id(id):
    byte1 = bytearray('3go8&$8*3*3h0k(2)2')
    byte2 = bytearray(id)
    byte1_len = len(byte1)
    for i in xrange(len(byte2)):
        byte2[i] = byte2[i]^byte1[i%byte1_len]
    m = hashlib.md5()
    m.update(byte2)
    result = m.digest().encode('base64')[:-1]
    result = result.replace('/', '_')
    result = result.replace('+', '-')
    return result

if len(sys.argv) == 2:
    song_dfsId = sys.argv[1]
else:
    song_dfsId = "6067105162467887"
url = "http://m{}.music.126.net/{}/{}.mp3".format(random.randrange(1, 3), encrypted_id(song_dfsId), song_dfsId)
print(url)


