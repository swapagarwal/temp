from PIL import Image

def retrace(x,end,c,pos,image,MIN,MAX,GAP):
    start=x
    new=pos
    data=image.load()
    
    temp=[]
    for i in range(start+MIN,start+MAX+1):
        for j in range(len(c)):
            if i in c[j][0]:
                if c[j] not in temp:
                    temp.append(c[j])
    #print temp

    for i in range(len(temp)):
        if temp[i][1]>3:
            for j in range(len(c)):
                if c[j][2]==temp[i][2]:
                    new=j
            return new,temp[i][2]
    #print temp
    if len(temp)==0:
        pos=temp[0][2]
    else:
        for n in range(len(temp)-1):
            for i in range(len(temp)-1):
                if temp[i][1]<temp[i+1][1]:
                    temp[i],temp[i+1]=temp[i+1],temp[i]
    for i in range(len(c)):
        if c[i][2]==temp[0][2]:
            new=i
    #print temp
    return new,temp[0][2]
