x=input()
count=0
b=[]
while x!=0:
    a=[]
    c=[]
    count+=1
    total=0
    exchange=0
    for i in range(x):
        a.append(input()*100)
        total+=a[i]
    for i in range(x):
        for j in range(x):
            if a[j]<a[min(j+1,x-1)]:
                a[j],a[j+1]=a[j+1],a[j]
    remaining=total%x
    average=(total-remaining)/x
    if remaining==0:
        for i in range(x):
            c.append(0)
    else:
        for i in range(x):
            if remaining>0:
                c.append(-1)
                remaining-=1
            else:
                c.append(1)
            
    for i in range(x):
        if a[i]+c[i]>average:
            exchange+=a[i]+c[i]-average
    b.append(int(exchange)/100.0)
    x=input()

for i in range(count):
    print '$'+str(b[i])
raw_input('Press any key to exit...')

