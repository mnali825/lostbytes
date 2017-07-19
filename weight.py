import RPi.GPIO as gpio
import threading
import time
import MySQLdb

db = MySQLdb.connect("localhost", "moniter", "password", "lostbytes")
curs = db.cursor()

DAT=13
DAT2=11
DAT3=12
CLK=8
num=0

gpio.setwarnings(False)
gpio.setmode(gpio.BOARD)
gpio.setup(CLK, gpio.OUT)

def weight():
  i=0
  num=0
  num2=0
  num3=0
  gpio.setup(DAT, gpio.OUT)
  gpio.setup(DAT2, gpio.OUT)
  gpio.setup(DAT3, gpio.OUT)
  gpio.output(DAT,1)
  gpio.output(DAT2,1)
  gpio.output(DAT3,1)
  gpio.output(CLK,0)
  gpio.setup(DAT, gpio.IN)
  gpio.setup(DAT2, gpio.IN)
  gpio.setup(DAT3, gpio.IN)

  while gpio.input(DAT) == 1 & gpio.input(DAT2) == 1 & gpio.input(DAT3) == 1:
      i=0
  for i in range(24):
        gpio.output(CLK,1)
        num=num<<1
        num2=num2<<1
        num3=num3<<1

        gpio.output(CLK,0)

        if gpio.input(DAT) == 0:
            num=num+1
        if gpio.input(DAT2) == 0:
            num2=num2+1
        if gpio.input(DAT3) == 0:
            num2=num2+1

  gpio.output(CLK,1)
  num=num^0x800000
  num2=num2^0x800000
  num3=num3^0x800000
  gpio.output(CLK,0)
  wei=0
  wei2=0
  wei3=0
  wei=((num)/1406)
  wei2=((num2)/1406)
  wei3=((num3)/1406)
  #print str(wei) + " before conversion"
  weight = (wei-6020)-95+158
  weight2 = (wei2-6020)-95+158
  weight3 = (wei3-6020)-95+158
  total = str(weight+weight2+weight3)
  with db:
    curs.execute("INSERT INTO weightTable values(NOW(), %s)", (total))
  time.sleep(0.5)

while True:
 weight()

