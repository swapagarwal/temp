from PIL import Image
import win32api,win32con,ImageGrab,os,time,ImageOps,sys,timeit
from numpy import *
from func import *
from retrace import retrace
from scan import scan

def section():
    coordinates=[]
    img = Image.open('edited.png')

    image = img.convert('1')
    width, height = image.size
    data = image.load()
    TOP=6
    BOTTOM=60
    MIN=25
    MAX=57
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
    #print
    b=[]
    for i in range(len(a)):
        if a[i]+1 in a or a[i]-1 in a:
            b.append(a[i])

    #print b
    #print
    c=[]
    d=[]
    b=a
    for i in range(width):
        if i in b and (i+1 in b or i-1 in b):
            d.append(i)
        else:
            if d!=[]:
                c.append(d)
                d=[]
    c.append(d)  #remember to include last d        
    #print c
    #print
    e=[]

    #optimise c[0] to remove closer values
    e.append(c[0])
    f=[]
    unsorted=[]
    for i in range(1,len(c)-1):
        f.append([c[i],len(c[i])])
        unsorted.append([c[i],len(c[i])])

    #print unsorted
    #print
    #print f
    #print
    for j in range(len(f)-1):
        for i in range(len(f)-1):
            if f[i][1]<f[i+1][1]:
                f[i],f[i+1]=f[i+1],f[i]

    #print f
    #print 'optimising f'
    #print
    #print f








    #print
    g=[]
    g.append(f[0])
    g.append(f[1])
    g.append(f[2])
    g.append(f[3])
    #print g

    for j in range(len(g)-1):
        for i in range(len(g)-1):
            if g[i][0][0]>g[i+1][0][0]:
                g[i],g[i+1]=g[i+1],g[i]
    #print
    #print g
    #print
    e.append(g[0][0])
    e.append(g[1][0])
    e.append(g[2][0])
    e.append(g[3][0])
    e.append(c[-1])
    #print e
    #print

    u=e[0]
    u_=len(u)
    v=e[1]
    v_=len(v)
    w=e[2]
    w_=len(w)
    x=e[3]
    x_=len(x)
    y=e[4]
    y_=len(y)
    z=e[5]
    z_=len(z)
    first=0
    second=0
    third=0
    fourth=0
    fifth=0
    """
    if v[0]-u[-1]>MIN and v[0]-u[-1]<MAX:
        first=1
        image.crop((u[-1],0,v[0],height)).save('1.png')

    if w[0]-v[-1]>MIN and w[0]-v[-1]<MAX:
        second=1
        image.crop((v[-1],0,w[0],height)).save('2.png')

    if x[0]-w[-1]>MIN and x[0]-w[-1]<MAX:
        third=1
        image.crop((w[-1],0,x[0],height)).save('3.png')

    if y[0]-x[-1]>MIN and y[0]-x[-1]<MAX:
        fourth=1
        image.crop((x[-1],0,y[0],height)).save('4.png')

    if z[0]-y[-1]>MIN and z[0]-y[-1]<MAX:
        fifth=1
        image.crop((y[-1],0,z[0],height)).save('5.png')

    if first==0:
        #print 6
        #change x & y values within (min,max) to get first=1
        pass
    """

    """
    image.crop((u[-1],0,v[0],height)).save('1.png')
    image.crop((v[-1],0,w[0],height)).save('2.png')

    image.crop((w[-1],0,x[0],height)).save('3.png')
    image.crop((x[-1],0,y[0],height)).save('4.png')
    image.crop((y[-1],0,z[0],height)).save('5.png')
    """

    for i in range(len(unsorted)):
            for j in [0,-1]:
                unsorted[i].append(unsorted[i][0][j])
    next_start=e[0][-1]
    for n in range(5):
        temp=[]
        for i in range(next_start+MIN,next_start+MAX+1):
            for j in range(len(unsorted)):
                if i>=unsorted[j][2] and i<=unsorted[j][3]:
                    if unsorted[j] not in temp:
                        temp.append(unsorted[j])
        #print temp
        #count=0
        if len(temp)==1:
            cord_start=temp[0][2]
            cord_end=temp[0][3]
            #count+=1
        elif len(temp)==0:
            cord_start,cord_end=retrace(min(next_start+MIN,image.size[0]),min(next_start+MAX+1,image.size[0]),image)
        else:
            for i in range(len(temp)-1):
                if temp[i]>temp[i+1]:
                    cord_start=temp[i][2]
                    cord_end=temp[i][3]
                    #count+=1
                else:
                    cord_start=temp[i+1][2]
                    cord_end=temp[i+1][3]
                    #count+=1
        
        if cord_start>=image.size[0]:
            cord_start=image.size[0]-1
        #image.crop((next_start,0,cord_start,height)).save('ai'+str(n+1)+'.png')
        coordinates.append((next_start,0,cord_start,height))
        #print
        print next_start,0,cord_start,height
        #print
        next_start=cord_end
    print
    return coordinates,image
    
