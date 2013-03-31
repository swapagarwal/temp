import ImageChops
import math, operator
from PIL import Image

CASES=1
#possible='23456789ABCDEFGHKMNPRSTVWXYZ'
possible='2'

b=''
for k in range(1,6):
    a=[]
    im1=Image.open('test/'+str(k)+'.png')
    for j in possible:
        for i in range(1,CASES+1):
            h = ImageChops.difference(im1, Image.open('output/'+j+'00'+str(i)+'.png')).histogram()
            "Calculate the root-mean-square difference between two images"

            # calculate rms
            rms = math.sqrt(reduce(operator.add,
                map(lambda h, i: h*(i**2), h, range(256))
            ) / (float(im1.size[0]) * im1.size[1]))
            print rms
            #print j+'00'+str(i),rms
            if i==1:
                minimum=rms
                number=1
            else:
                if (rms<minimum):
                    number=i
                    minimum=rms
        a.append([minimum,j,number])
    print a

    rms=a[0][0]
    for j in range(len(a)):
        if a[j][0]<rms:
            rms=a[j][0]
            finalrms=a[j][0]
            finalchar=a[j][1]
            finalpos=a[j][2]
    #print finalchar
    b+=finalchar

print b
