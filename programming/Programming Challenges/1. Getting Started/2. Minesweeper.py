count=0
z=[]
x=raw_input("")
n=int(x[:x.find(" ")])
m=int(x[x.find(" ")+1:])

while(n!=0 or m!=0):
    field=[]
    field_uncovered=""
    count+=1
    z.append("")
    
    for i in list(range(n)):
        field.append(raw_input())
        
    for i in list(range(n)):
        for j in list(range(m)):
            mine_count=0
            if field[i][j]=='.':
                for a in list(range(max(0,i-1),min(n,i+2))):
                    for b in list(range(max(0,j-1),min(m,j+2))):
                        if field[a][b]=='*':
                            mine_count+=1
                field_uncovered+=str(mine_count)
            else:
                field_uncovered+='*'
        field_uncovered+='\n'

    z[count-1]+='Field #'+str(count)+':\n'+field_uncovered

    x=raw_input("")
    n=int(x[:x.find(" ")])
    m=int(x[x.find(" ")+1:])

for i in list(range(max(0,count-1))):
    print z[i]

if count>0:
    print z[count-1][:-1]

raw_input('Press any key to exit...')
