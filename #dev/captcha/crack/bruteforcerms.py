import ImageChops,os
import math, operator
from PIL import Image
a=[]
b=''
for k in range(1,6):
    im1=Image.open('test/'+str(k)+'.png')
    path=".\output"
    dirList=os.listdir(path)
    #print dirList
    n=len(dirList)
    minimum=1000
    number=0
    for i in range(n):
        h = ImageChops.difference(im1, Image.open('output/'+dirList[i])).histogram()
        rms = math.sqrt(reduce(operator.add,
            map(lambda h, i: h*(i**2), h, range(256))
        ) / (float(im1.size[0]) * im1.size[1]))
        #print rms,
        if n==1:
            minimum=rms
            number=1
        else:
            if (rms<minimum):
                number=i
                minimum=rms
        #print minimum,number,dirList[number][0]
    #print
    a.append([minimum,number])
    #print a
    b+=dirList[a[k-1][1]][0]

print a
print b
