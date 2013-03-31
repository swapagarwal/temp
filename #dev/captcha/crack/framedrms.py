import ImageChops,os
import math, operator
from PIL import Image
for k in range(1):
    im1=Image.open('test/'+str(k)+'.png')
    path=".\output"
    dirList=os.listdir(path)
    print dirList
    dir=[]
    print
    for i in range(len(dirList)):
        dir.append([dirList[i],Image.open('output/'+dirList[i]).size[0]])
    for i in range(len(dir)-1):
        for j in range(len(dir)-1):
            if dir[j][1]<dir[j+1][1]:
                dir[j],dir[j+1]=dir[j+1],dir[j]
    
    print dir
    dirList=[]
    for i in range(len(dir)):
        dirList.append(dir[i][0])

    print dirList
    n=len(dirList)
    minimum=1000
    number=0
    for s in [0,70,110,150,180]:
        b=[]
        for i in range(n):
            img=Image.open('output/'+dirList[i])
            width=img.size[0]
            a=[]
            RMS=100
            for j in range(30):
                x1=s+j
                x2=x1+width
                h = ImageChops.difference(im1.crop((x1,0,x2,img.size[1])), img).histogram()
                rms = math.sqrt(reduce(operator.add,
                    map(lambda h, i: h*(i**2), h, range(256))
                ) / (float(im1.size[0]) * im1.size[1]))
                #print rms
                if rms<15:
                    a=[]
                    a.append([rms,x1,x2,dirList[i][0]])
                    break
                if rms<RMS:
                    a=[]
                    RMS=rms
                    a.append([rms,x1,x2,dirList[i][0]])
            b.append(a[0])
            if rms<15:
                break
        """
            for j in range(len(b)):
                if b[j][0]<10:
                    print b[j][1]
                    break
            if b[j][0]<10:
                break
        """
        for j in range(len(b)-1):
            for k in range(len(b)-1):
                if b[k][0]>b[k+1][0]:
                    b[k],b[k+1]=b[k+1],b[k]
        #print
        #print b
        print b[0]
