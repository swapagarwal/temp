import ImageChops,os
import math, operator
from PIL import Image
a=[]
b=[]
path="./set"
dirList=os.listdir(path)
n=len(dirList)
minimum=1000
number=0
for k in range(n):
    im1=Image.open('./set/'+dirList[k])
    RMS=0
    #print dirList
    for i in range(n):
        im2=Image.open('./set/'+dirList[i])
        h = ImageChops.difference(im1, im2).histogram()
        rms = math.sqrt(reduce(operator.add,
            map(lambda h, i: h*(i**2), h, range(256))
        ) / (float(im1.size[0]) * im1.size[1]))
        a.append([dirList[k][0],dirList[i][0],rms])
        RMS+=rms
    b.append([dirList[k][0],RMS])
for i in range(len(b)):
    print b[i]
