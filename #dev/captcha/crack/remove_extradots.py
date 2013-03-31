from PIL import Image
import win32api,win32con,ImageGrab,os,time,ImageOps,sys,timeit
from numpy import *
from func import *

img = Image.open('doublepass.png')

image = img.convert('1')
width, height = image.size
data = image.load()

for x in range(1):
    for y in range(32):
        data[x,y] = 255

for x in range(12):
    for y in range(64,65):
        data[x,y] = 255

for x in range(88,252):
    for y in range(0,1):
        data[x,y] = 255

for x in range(165,252):
    for y in range(1,2):
        data[x,y] = 255

for x in range(241,252):
    for y in range(2,3):
        data[x,y] = 255

image.save('edited.png')
