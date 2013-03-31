a=[]
x=0
white=0
black=0
y=0
z=[]
for i in range(8):
    a.append(raw_input())
    if a[i]=='........':
        x+=1

while(x!=8):
    def rook(current,target,m):
        x=int(current[0])
        y=int(current[1])
        a=int(target[0])
        b=int(target[1])
        for i in range(1,8):
            if x+i==a and y==b:
                return 1
            if m[min(7,x+i)][y]!='.':
                break
        for i in range(-1,-8,-1):
            if x+i==a and y==b:
                return 1
            if m[max(0,x+i)][y]!='.':
                break
        for i in range(1,8):
            if x==a and y+i==b:
                return 1
            if m[x][min(7,y+i)]!='.':
                break
        for i in range(-1,-8,-1):
            if x==a and y+i==b:
                return 1
            if m[x][max(0,y+i)]!='.':
                break
        return 0

    def bishop(current,target,m):
        x=int(current[0])
        y=int(current[1])
        a=int(target[0])
        b=int(target[1])
        for i in range(1,8):
            if x+i==a and y+i==b:
                return 1
            if m[min(7,x+i)][min(7,y+i)]!='.':
                break
        for i in range(-1,-8,-1):
            if x+i==a and y+i==b:
                return 1
            if m[max(0,x+i)][max(0,y+i)]!='.':
                break
        for i in range(1,8):
            if x-i==a and y+i==b:
                return 1
            if m[max(0,x-i)][min(7,y+i)]!='.':
                break
        for i in range(-1,-8,-1):
            if x-i==a and y+i==b:
                return 1
            if m[min(7,x-i)][max(0,y+i)]!='.':
                break
        return 0

    def king(current,target):
        x=int(current[0])
        y=int(current[1])
        a=int(target[0])
        b=int(target[1])
        for i in range(x-1,x+2):
            for j in range(y-1,y+2):
                if i==a and j==b:
                    return 1
        return 0

    def queen(current,target,m):
        if rook(current,target,m) or bishop(current,target,m):
            return 1
        return 0

    def knight(current,target):
        x=int(current[0])
        y=int(current[1])
        a=int(target[0])
        b=int(target[1])
        if x+2==a and y+1==b or x+1==a and y+2==b or x-2==a and y-1==b or x-1==a and y-2==b or x+1==a and y-2==b or x+2==a and y-1==b or x-1==a and y+2==b or x-2==a and y+1==b:
            return 1
        return 0

    def pawn(current,target,color):
        x=int(current[0])
        y=int(current[1])
        a=int(target[0])
        b=int(target[1])
        if color=='black':
            if x+1==a and y+1==b or x+1==a and y-1==b:
                return 1
        if color=='white':
            if x-1==a and y+1==b or x-1==a and y-1==b:
                return 1
        return 0

    for i in range(8):
        for j in range(8):
            if a[i][j]=='K':
                white_king=str(i)+str(j)
            if a[i][j]=='k':
                black_king=str(i)+str(j)

    for i in range(8):
        for j in range(8):
            if a[i][j]=='p':
                white+=pawn(str(i)+str(j),white_king,'black')
            if a[i][j]=='n':
                white+=knight(str(i)+str(j),white_king)
            if a[i][j]=='b':
                white+=bishop(str(i)+str(j),white_king,a)
            if a[i][j]=='r':
                white+=rook(str(i)+str(j),white_king,a)
            if a[i][j]=='q':
                white+=queen(str(i)+str(j),white_king,a)
            if a[i][j]=='k':
                white+=king(str(i)+str(j),white_king)

    for i in range(8):
        for j in range(8):
            if a[i][j]=='P':
                black+=pawn(str(i)+str(j),black_king,'white')
            if a[i][j]=='N':
                black+=knight(str(i)+str(j),black_king)
            if a[i][j]=='B':
                black+=bishop(str(i)+str(j),black_king,a)
            if a[i][j]=='R':
                black+=rook(str(i)+str(j),black_king,a)
            if a[i][j]=='Q':
                black+=queen(str(i)+str(j),black_king,a)
            if a[i][j]=='K':
                black+=king(str(i)+str(j),black_king)

    y+=1
    if white!=0:
        z.append('Game #'+str(y)+': white king is in check.')
    else:
        if black!=0:
            z.append('Game #'+str(y)+': black king is in check.')
        else:
            z.append('Game #'+str(y)+': no king is in check.')
        

    a=[]
    x=0
    white=0
    black=0
    raw_input()
    for i in range(8):
        a.append(raw_input())
        if a[i]=='........':
            x+=1

for i in range(len(z)):
    print z[i]
raw_input('Press any key to exit...')
