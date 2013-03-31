import ImageChops,math,operator,os,timeit,time
from PIL import Image

def rms():
    print 'Cracking...'
    print
    path="C:\Users\Swapnil\Downloads\#dev\captcha\data\output"
    dirList=os.listdir(path)
    n=len(dirList)
    a=[]
    b=''
    for k in range(1,6):
        im1=Image.open('test/'+str(k)+'.png')
        for j in dirList:
            h = ImageChops.difference(im1, Image.open('output/'+j)).histogram()
            
            rms = math.sqrt(reduce(operator.add,
                map(lambda h, i: h*(i**2), h, range(256))
            ) / (float(im1.size[0]) * im1.size[1]))
            #print j+'00'+str(i),rms
            if j=='2001.png':
                minimum=rms
                name=j
            else:
                if (rms<minimum):
                    name=j
                    minimum=rms
            if minimum<50:
                break
        a.append([minimum,name])
        b+=a[k-1][1][:1]
    print a
    print
    print b
    print 'Cracked in',

timer=timeit.Timer(lambda:rms())
print timer.timeit(number=1),
print 'seconds.'
