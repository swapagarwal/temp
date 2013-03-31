from PIL import Image
import win32api,win32con,ImageGrab,os,time,ImageOps,sys,timeit
from numpy import *
from func import *

def captcha():
    path=".\input"
    dirList=os.listdir(path)
    n=len(dirList)
    print 'Starting...'
    print
    print '%d'%n+' training sets found.'
    print
    print dirList
    print
    print 'Working...'
    print
    a=['000']*28
    #print a

    for i in range(n):
        b=['']*5
        for j in range(5):
            file_name(dirList,i,j,a,b)

        gray_crop(path,dirList,i,b)

    #print a
    #print
    print 'Completed...'
    #print '%d'%(n*5)+' test cases created in',


#timer=timeit.Timer(lambda:captcha())
#print timer.timeit(number=1),
#print 'seconds.'
"""
noise=100,120,180
text=20,40,100
width=250
height=60
font-size=0.85*height
image is rotated 1 degree

img = Image.open('second pass/doublepass.png')
img=img.convert("RGB")
pixdata=img.load()

for i in range(252):
    for j in range(65):
        if pixdata[i,j]==(255,255,255):
            pixdata[i,j]=(0,0,0)

for i in range(252):
    for j in range(65):
        if pixdata[i,j]!=(20,40,100):
            pixdata[i,j]=(255,255,255)

img.save('second pass/passed.png')
"""
