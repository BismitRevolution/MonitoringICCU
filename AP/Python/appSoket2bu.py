import os, time
import time
import socket
import sys
import MySQLdb
from time import gmtime, strftime
#from time import localtime, strftime

from random import randint
from time import sleep


from datetime import datetime
from pytz import timezone    
import pytz
#from pytz import timezone

#WIB = pytz.WIB
#utc = pytz.utc +7
#utc.zone
#'WIB'
#eastern = timezone('Asia/Jakarta')
#eastern.zone
#'Asia/Eastern'
#jkt = timezone('Asia/Jakarta')
#fmt = '%Y-%m-%d %H:%M:%S %Z%z'
#now_time = datetime.now(timezone('Asia/Jakarta'))
#print now_time.strftime(fmt)

jkt = timezone('Asia/Jakarta')
sa_time = datetime.now(jkt)
print sa_time.strftime('%Y-%m-%d_%H-%M-%S')

#localtime = time.asctime( time.localtime(time.time()) )
#print "Waktu lokal saat ini :", localtime




#db = MySQLdb.connect("localhost","root","")
#cursor = db.cursor()

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="root",         # your username
                     passwd="",  # your password
                     db="monitoringdetakjantung")        # name of the data base
cursor = db.cursor()


def mtrim(s):
    if s.endswith(" "): s = s[:-1]
    if s.startswith(" "): s = s[1:]
    return s


def get_constants(prefix):
    """Create a dictionary mapping socket module constants to their names."""
    return dict( (getattr(socket, n), n)
                 for n in dir(socket)
                 if n.startswith(prefix)
                 )

KP='RWT1804001' #RWT1803003
families = get_constants('AF_')
types = get_constants('SOCK_')
protocols = get_constants('IPPROTO_')

# Create a TCP/IP socket
sock = socket.create_connection(('192.168.5.2', 23))

print >>sys.stderr, 'Family  :', families[sock.family]
print >>sys.stderr, 'Type    :', types[sock.type]
print >>sys.stderr, 'Protocol:', protocols[sock.proto]
print >>sys.stderr

#date_default_timezone_set("Asia/Jakarta");
#time.strftime('%X %x %Z')
#os.environ['TZ'] = 'Asia/Jakarta'
#time.tzset()
#time.strftime('%X %x %Z')

B0=0
B1=1
try:
    
    # Send data
    message = 'ping'
    print >>sys.stderr, 'Sending "%s"' % message
    sock.sendall(message)

    amount_received = 0
    amount_expected = len(message)
    M=1
    gdata='';
    while M==1:
        data = sock.recv(512)
        amount_received += len(data)
        gdata=gdata+data;
        B1=data
        PS=data.find('\n')
        if len(gdata)>4 and (B0 !=B1) and PS<0:
            data=gdata
            gdata='';
            time.localtime()
            print(data)
            sa_time = datetime.now(jkt)
            tgl=sa_time.strftime('%Y-%m-%d') #strftime("%Y-%m-%d", gmtime())
            jam=sa_time.strftime('%H:%M:%S') #strftime("%H:%M:%S", gmtime())
            B0=data
            AR= data.split("#")
            #09:36:11 =>data: 89 status:0 split: 89 dan 0  : 130#29.56
            data2="0"
            data1=AR[1]
            if len(AR)>1:
                data2=AR[2]
            
            idata=int(data1)
            value=0;
            if idata<60:
                value=-1
            elif idata>100:
                value=1
                
            peak=str(value)    
            print >>sys.stderr, '+"%s %s =>data: %s status:%s split: %s dan %s' % (tgl,jam,data,peak,data1,data2)
            
            
            sql='INSERT INTO `tb_log` (`kode_perawatan`, `tanggal`, `jam`, `detak_jantung`, `detak_jantung2`, `note`, `peak`) VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s")' % (KP,tgl, jam, data1,data2,0,peak)
           
            try:
                cursor.execute(sql)
                db.commit()
            except:
                db.rollback()
          
        

finally:
    print >>sys.stderr, 'closing socket'
    sock.close()
