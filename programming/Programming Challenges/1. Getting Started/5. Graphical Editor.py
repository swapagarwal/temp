x=raw_input("")
z=x.split(' ')

def create(m,n):
    a=[]
    for i in range(n):
        a.append('')
        for j in range(m):
            a[i]+='O'
    return a

def clear(a):
    b=[]
    for i in range(len(a)):
        b.append('')
        for j in range(len(a[0])):
            b[i]+='O'
    return b

def color(a,x,y,c):
    a[y-1]=a[y-1][:x-1]+c+a[y-1][x:]
    return a

def vertical(a,x,y1,y2,c):
    for i in range(y1,y2+1):
        color(a,x,i,c)
    return a

def horizontal(a,x1,x2,y,c):
    for i in range(x1,x2+1):
        color(a,i,y,c)
    return a

def rectangle(a,x1,x2,y1,y2,c):
    for i in range(x1,x2+1):
        for j in range(y1,y2+1):
            color(a,i,j,c)
    return a

def fill(a,x,y,c):
    current=a[y-1][x-1]
    a[y-1]=a[y-1][:x-1]+c+a[y-1][x:]
    b=[]
    b.append(str(x-1)+str(y-1))
    for k in range(len(a)+len(a[0])):
        for i in range(len(a)):
            for j in range(len(a[0])):
                if a[i][j]==current:
                    if str(j)+str(min(len(a)-1,i+1)) in b or str(j)+str(max(0,i-1)) in b or str(min(len(a[0])-1,j+1))+str(i) in b or str(max(0,j-1))+str(i) in b:
                        b.append(str(j)+str(i))
                        a[i]=a[i][:j]+c+a[i][j+1:]
    return a

def save(a,name):
    print name
    for i in range(len(a)):
        print a[i]
    
while(z[0]!='X'):
    if z[0]=='I':
        a=create(int(z[1]),int(z[2]))
    elif z[0]=='C':
        a=clear(a)
    elif z[0]=='L':
        a=color(a,int(z[1]),int(z[2]),z[3])
    elif z[0]=='V':
        a=vertical(a,int(z[1]),int(z[2]),int(z[3]),z[4])
    elif z[0]=='H':
        a=horizontal(a,int(z[1]),int(z[2]),int(z[3]),z[4])
    elif z[0]=='K':
        a=rectangle(a,int(z[1]),int(z[2]),int(z[3]),int(z[4]),z[5])
    elif z[0]=='F':
        a=fill(a,int(z[1]),int(z[2]),z[3])
    elif z[0]=='S':
        save(a,z[1])

    x=raw_input("")
    z=x.split(' ')

raw_input('Press any key to exit...')
