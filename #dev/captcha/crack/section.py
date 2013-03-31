from PIL import Image
import win32api,win32con,ImageGrab,os,time,ImageOps,sys,timeit
from numpy import *
from func import *
from retrace import retrace

def section():
    coordinates=[]
    img = Image.open('edited.png')

    image = img.convert('1')
    width, height = image.size
    data = image.load()
    TOP=6
    BOTTOM=60
    MIN=24
    MAX=57
    GAP=20
    for i in range(width):
        count=0
        for j in range(height):
            if data[i,j]==0:
                count+=1
        if count<=2:
            for k in range(height):
                data[i,k]=255
    image.crop((0,TOP,width,BOTTOM)).save('final.png')
    image = Image.open('final.png')
    width, height = image.size
    data = image.load()
    a=[]
    for i in range(width):
        count=0
        for j in range(height):
            if data[i,j]==0:
                count+=1
        if count==0:
            a.append(i)

    #print a
    c=[]
    d=[]
    for i in range(width):
        if i in a and (i+1 in a or i-1 in a):
            d.append(i)
        else:
            if d!=[]:
                c.append([d,len(d),d[0],d[-1]])
                d=[]
    c.append([d,len(d),d[0],d[-1]])  #remember to include last d
    #print
    #print c
    #print
    #print

    next_start=c[0][3]
    pos=1
    end=c[pos][2]
    for n in range(5):
        while True:
            if pos>=len(c)-1:
                pos=len(c)-1
                break
            #end=c[pos][2]
            #print str(end) +'in while loop'+str(pos)
            pos,end=retrace(next_start,end,c,pos,image,MIN,MAX,GAP)
            #print next_start,end,pos
            if end-next_start>MIN and end-next_start<MAX:
                break
            else:
                pos,end=retrace(next_start,end,c,pos,image,MIN,MAX,GAP)
        coordinates.append((next_start,0,end,height))
        next_start=c[pos][3]
            
        print coordinates[n]
    print
    return coordinates,image
