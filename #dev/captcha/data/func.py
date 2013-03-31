from PIL import Image
import win32api,win32con,ImageGrab,os,time,ImageOps,sys
from numpy import *

def gray_crop(p,d,i,b):
    path=p
    dirList=d
    i=i
    b=b
    
    img = Image.open(path+"\\"+dirList[i])
    im=ImageOps.grayscale(img)
    #a=array(im.getcolors())
    image = img
    width, height = image.size
    data = image.load()

    chop = 0
    image = img.convert('1')
    width, height = image.size
    data = image.load()

    for y in range(height):
        for x in range(width):

            if data[x, y] > 128:
                continue

            total = 0

            for c in range(x, width):

                if data[c, y] < 128:
                    total += 1
                else:
                    break

            if total <= chop:
                for c in range(total):
                    data[x + c, y] = 255

            x += total

    for x in range(width):
        for y in range(height):

            if data[x, y] > 128:
                continue

            total = 0

            for c in range(y, height):

                if data[x, c] < 128:
                    total += 1

                else:
                    break

            if total <= chop:
                for c in range(total):
                    data[x, y + c] = 255

            y += total

    #image.save('singlepass.png')

    #img = Image.open('singlepass.png')
    img=image
    im=ImageOps.grayscale(img)
    #a=array(im.getcolors())
    image = img
    width, height = image.size
    data = image.load()

    for x in range(1,width-1):
        for y in range(1,height-1):
            if data[x-1,y]==255 and data[x+1,y]==255:
                if data[x,y+1]==255 and data[x,y-1]==255:
                    data[x,y]=255

    image=image.rotate(-1)

    img=image

    img.crop((25,10,55,60)).save('output/'+dirList[i][0]+b[0]+'.png')

    img.crop((68,10,98,60)).save('output/'+dirList[i][1]+b[1]+'.png')

    img.crop((111,10,141,60)).save('output/'+dirList[i][2]+b[2]+'.png')

    img.crop((154,10,184,60)).save('output/'+dirList[i][3]+b[3]+'.png')
    
    img.crop((197,10,227,60)).save('output/'+dirList[i][4]+b[4]+'.png')


def file_name(w,x,y,z,v):
    dirList=w
    i=x
    j=y
    a=z
    b=v
    if dirList[i][j]=='2':
        if a[0][2]!='9':
            a[0]=a[0][:-1]+str(int(a[0][-1])+1)
        else:
            if a[0][1]!='9':
                a[0]=a[0][:-2]+str(int(a[0][-2:])+1)
        b[j]=a[0]
    
    if dirList[i][j]=='3':
        if a[1][2]!='9':
            a[1]=a[1][:-1]+str(int(a[1][-1])+1)
        else:
            if a[1][1]!='9':
                a[1]=a[1][:-2]+str(int(a[1][-2:])+1)
        b[j]=a[1]
        
    if dirList[i][j]=='4':
        if a[2][2]!='9':
            a[2]=a[2][:-1]+str(int(a[2][-1])+1)
        else:
            if a[2][1]!='9':
                a[2]=a[2][:-2]+str(int(a[2][-2:])+1)
        b[j]=a[2]
        
    if dirList[i][j]=='5':
        if a[3][2]!='9':
            a[3]=a[3][:-1]+str(int(a[3][-1])+1)
        else:
            if a[3][1]!='9':
                a[3]=a[3][:-2]+str(int(a[3][-2:])+1)
        b[j]=a[3]
        
    if dirList[i][j]=='6':
        if a[4][2]!='9':
            a[4]=a[4][:-1]+str(int(a[4][-1])+1)
        else:
            if a[4][1]!='9':
                a[4]=a[4][:-2]+str(int(a[4][-2:])+1)
        b[j]=a[4]

    if dirList[i][j]=='7':
        if a[5][2]!='9':
            a[5]=a[5][:-1]+str(int(a[5][-1])+1)
        else:
            if a[5][1]!='9':
                a[5]=a[5][:-2]+str(int(a[5][-2:])+1)
        b[j]=a[5]

    if dirList[i][j]=='8':
        if a[6][2]!='9':
            a[6]=a[6][:-1]+str(int(a[6][-1])+1)
        else:
            if a[6][1]!='9':
                a[6]=a[6][:-2]+str(int(a[6][-2:])+1)
        b[j]=a[6]

    if dirList[i][j]=='9':
        if a[7][2]!='9':
            a[7]=a[7][:-1]+str(int(a[7][-1])+1)
        else:
            if a[7][1]!='9':
                a[7]=a[7][:-2]+str(int(a[7][-2:])+1)
        b[j]=a[7]

    if dirList[i][j]=='A':
        if a[8][2]!='9':
            a[8]=a[8][:-1]+str(int(a[8][-1])+1)
        else:
            if a[8][1]!='9':
                a[8]=a[8][:-2]+str(int(a[8][-2:])+1)
        b[j]=a[8]

    if dirList[i][j]=='B':
        if a[9][2]!='9':
            a[9]=a[9][:-1]+str(int(a[9][-1])+1)
        else:
            if a[9][1]!='9':
                a[9]=a[9][:-2]+str(int(a[9][-2:])+1)
        b[j]=a[9]

    if dirList[i][j]=='C':
        if a[10][2]!='9':
            a[10]=a[11][:-1]+str(int(a[10][-1])+1)
        else:
            if a[10][1]!='9':
                a[10]=a[10][:-2]+str(int(a[10][-2:])+1)
        b[j]=a[10]

    if dirList[i][j]=='D':
        if a[11][2]!='9':
            a[11]=a[11][:-1]+str(int(a[11][-1])+1)
        else:
            if a[11][1]!='9':
                a[11]=a[11][:-2]+str(int(a[11][-2:])+1)
        b[j]=a[11]

    if dirList[i][j]=='E':
        if a[12][2]!='9':
            a[12]=a[12][:-1]+str(int(a[12][-1])+1)
        else:
            if a[12][1]!='9':
                a[12]=a[12][:-2]+str(int(a[12][-2:])+1)
        b[j]=a[12]

    if dirList[i][j]=='F':
        if a[13][2]!='9':
            a[13]=a[13][:-1]+str(int(a[13][-1])+1)
        else:
            if a[13][1]!='9':
                a[13]=a[13][:-2]+str(int(a[13][-2:])+1)
        b[j]=a[13]

    if dirList[i][j]=='G':
        if a[14][2]!='9':
            a[14]=a[14][:-1]+str(int(a[14][-1])+1)
        else:
            if a[14][1]!='9':
                a[14]=a[14][:-2]+str(int(a[14][-2:])+1)
        b[j]=a[14]

    if dirList[i][j]=='H':
        if a[15][2]!='9':
            a[15]=a[15][:-1]+str(int(a[15][-1])+1)
        else:
            if a[15][1]!='9':
                a[15]=a[15][:-2]+str(int(a[15][-2:])+1)
        b[j]=a[15]

    if dirList[i][j]=='K':
        if a[16][2]!='9':
            a[16]=a[16][:-1]+str(int(a[16][-1])+1)
        else:
            if a[16][1]!='9':
                a[16]=a[16][:-2]+str(int(a[16][-2:])+1)
        b[j]=a[16]

    if dirList[i][j]=='M':
        if a[17][2]!='9':
            a[17]=a[17][:-1]+str(int(a[17][-1])+1)
        else:
            if a[17][1]!='9':
                a[17]=a[17][:-2]+str(int(a[17][-2:])+1)
        b[j]=a[17]

    if dirList[i][j]=='N':
        if a[18][2]!='9':
            a[18]=a[18][:-1]+str(int(a[18][-1])+1)
        else:
            if a[18][1]!='9':
                a[18]=a[18][:-2]+str(int(a[18][-2:])+1)
        b[j]=a[18]

    if dirList[i][j]=='P':
        if a[19][2]!='9':
            a[19]=a[19][:-1]+str(int(a[19][-1])+1)
        else:
            if a[19][1]!='9':
                a[19]=a[19][:-2]+str(int(a[19][-2:])+1)
        b[j]=a[19]

    if dirList[i][j]=='R':
        if a[20][2]!='9':
            a[20]=a[20][:-1]+str(int(a[20][-1])+1)
        else:
            if a[20][1]!='9':
                a[20]=a[20][:-2]+str(int(a[20][-2:])+1)
        b[j]=a[20]

    if dirList[i][j]=='S':
        if a[21][2]!='9':
            a[21]=a[21][:-1]+str(int(a[21][-1])+1)
        else:
            if a[21][1]!='9':
               a[21]=a[21][:-2]+str(int(a[21][-2:])+1)
        b[j]=a[21]

    if dirList[i][j]=='T':
        if a[22][2]!='9':
            a[22]=a[22][:-1]+str(int(a[22][-1])+1)
        else:
            if a[22][1]!='9':
                a[22]=a[2][:-2]+str(int(a[22][-2:])+1)
        b[j]=a[22]

    if dirList[i][j]=='V':
        if a[23][2]!='9':
            a[23]=a[23][:-1]+str(int(a[23][-1])+1)
        else:
            if a[23][1]!='9':
                a[23]=a[23][:-2]+str(int(a[23][-2:])+1)
        b[j]=a[23]

    if dirList[i][j]=='W':
        if a[24][2]!='9':
            a[24]=a[24][:-1]+str(int(a[24][-1])+1)
        else:
            if a[24][1]!='9':
                a[24]=a[24][:-2]+str(int(a[24][-2:])+1)
        b[j]=a[24]

    if dirList[i][j]=='X':
        if a[25][2]!='9':
            a[25]=a[25][:-1]+str(int(a[25][-1])+1)
        else:
            if a[25][1]!='9':
                a[25]=a[25][:-2]+str(int(a[25][-2:])+1)
        b[j]=a[25]

    if dirList[i][j]=='Y':
        if a[26][2]!='9':
            a[26]=a[26][:-1]+str(int(a[26][-1])+1)
        else:
            if a[26][1]!='9':
                a[26]=a[26][:-2]+str(int(a[26][-2:])+1)
        b[j]=a[26]

    if dirList[i][j]=='Z':
        if a[27][2]!='9':
            a[27]=a[27][:-1]+str(int(a[27][-1])+1)
        else:
            if a[27][1]!='9':
                a[27]=a[27][:-2]+str(int(a[27][-2:])+1)
        b[j]=a[27]
