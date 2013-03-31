from PIL import Image

def retrace(x,y,image):
    start=x
    end=y
    data=image.load()
    a=[]

    for i in range(start,min(image.size[0],end)):
        count=0
        for j in range(image.size[1]):
            if data[i,j]==0:
                count+=1
        a.append(count)
    minimum=0
    if len(a)==0:
        minimum=image.size[0]
    elif len(a)==1:
        minimum=start
    else:
        for i in range(len(a)-1):
            if a[i]<a[i+1]:
                minimum=i+start
    if minimum==0:
        minimum=image.size[0]
    return minimum,minimum
