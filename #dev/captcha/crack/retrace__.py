from PIL import Image

def retrace(x,end,c,pos,image,MIN,MAX,GAP):
    start=x
    new=pos
    data=image.load()
    
    fwd=0
    for i in range(end+1,end+4):
        for j in range(image.size[1]):
            if data[i,j]==0:
                fwd+=1
    back=0
    for i in range(end-1,end-4,-1):
        for j in range(image.size[1]):
            if data[i,j]==0:
                back+=1
    deepfwd=0
    for i in range(end+1,end+6):
        for j in range(image.size[1]):
            if data[i,j]==0:
                deepfwd+=1
    deepback=0
    for i in range(end-1,end-6,-1):
        for j in range(image.size[1]):
            if data[i,j]==0:
                deepback+=1
    """
    count=0
    for i in range(start,end):
        for j in range(len(c)):
            for k in range(len(c[j])):
                if i in c[j]:
                    count+=1
    """       
    if fwd>3 and (c[pos+1][2]-start)<MAX:
        new=pos+1
        #if c[new][3]-c[new][2]>5:
            #return new,c[new][2]
        #print 'jbj'
    if back<0 and (c[pos-1][2]-start)>MIN:
        new=pos-1
    if deepfwd>5 and (c[pos+1][2]-start)<MAX:
        new=pos+1
        #print 'yo'
    if deepback<0 and (c[pos-1][2]-start)>MIN:
        new=pos-1
    #if c[pos][3]-c[pos][2]>GAP:
        #new=pos-1
        #print c[pos][3]
        #print c[pos-1][3]
    #if count>10:
    #    new=pos-1
    #    print 'count = '+str(count)
    if (end-start)>MAX:
        new=pos-1
    if (end-start)<MIN:
        new=pos+1
        #print 'hdfhghf'
    
    """if (end-start)>MAX:
        new=pos-1
    if (end-start)<0:
        new=pos+1
        print 'negative'"""
    print str(new)+' called '+str(fwd)+' '+str(back)
    return new,c[new][2]
