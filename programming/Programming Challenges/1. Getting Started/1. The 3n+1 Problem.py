x=raw_input()
i=int(x[:x.find(" ")])
j=int(x[x.find(" ")+1:])
max=0

for n in list(range(i,j+1)):
    cycle_length=1
    while n!=1:
        if n%2==0:
            n/=2
            cycle_length+=1
        else:
            n=3*n+1
            cycle_length+=1
    if cycle_length>max:
        max=cycle_length

print i,j,max 

raw_input('Press any key to exit...')
