#!/bin/python
# Head ends here
def mobility(board,my,opp,moved):
    x=moved[0]
    y=moved[1]
    board[x]=board[x][:y]+my+board[x][y+1:]
    changed=moved[3][0]
    for i in changed:
        board[i[0]]=board[i[0]][:i[1]]+my+board[i[0]][i[1]+1:]
        
    moves=[]
    for i in xrange(8):
        for j in xrange(8):
            if board[i][j]=='-':
                total=0
                global_flag=0
                global_changes=[]
                #left up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==opp:
                        count+=1
                        changes.append([a-1,b-1])
                    if board[a-1][b-1]!=opp:
                        break
                    a-=1
                    b-=1
                if count>0 and a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #up
                a=i
                count=0
                flag=0
                changes=[]
                while a-1>=0:
                    if board[a-1][j]==opp:
                        count+=1
                        changes.append([a-1,j])
                    if board[a-1][j]!=opp:
                        break
                    a-=1
                if count>0 and a-1>=0:
                    if board[a-1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #right up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b+1<8:
                    if board[a-1][b+1]==opp:
                        count+=1
                        changes.append([a-1,b+1])
                    if board[a-1][b+1]!=opp:
                        break
                    a-=1
                    b+=1
                if count>0 and a-1>=0 and b+1<8:
                    if board[a-1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #left
                b=j
                count=0
                flag=0
                changes=[]
                while b-1>=0:
                    if board[i][b-1]==opp:
                        count+=1
                        changes.append([i,b-1])
                    if board[i][b-1]!=opp:
                        break
                    b-=1
                if count>0 and b-1>=0:
                    if board[i][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'left',j-b
                        total+=j-b
                #right
                b=j
                count=0
                flag=0
                changes=[]
                while b+1<8:
                    if board[i][b+1]==opp:
                        count+=1
                        changes.append([i,b+1])
                    if board[i][b+1]!=opp:
                        break
                    b+=1
                if count>0 and b+1<8:
                    if board[i][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=b-j
                #left down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b-1>=0:
                    if board[a+1][b-1]==opp:
                        count+=1
                        changes.append([a+1,b-1])
                    if board[a+1][b-1]!=opp:
                        break
                    a+=1
                    b-=1
                if count>0 and a+1<8 and b-1>=0:
                    if board[a+1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'leftdown',a-i
                        total+=a-i
                #down
                a=i
                count=0
                flag=0
                changes=[]
                while a+1<8:
                    if board[a+1][j]==opp:
                        count+=1
                        changes.append([a+1,j])
                    if board[a+1][j]!=opp:
                        break
                    a+=1
                if count>0 and a+1<8:
                    if board[a+1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                #right down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b+1<8:
                    if board[a+1][b+1]==opp:
                        count+=1
                        changes.append([a+1,b+1])
                    if board[a+1][b+1]!=opp:
                        break
                    a+=1
                    b+=1
                if count>0 and a+1<8 and b+1<8:
                    if board[a+1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                        
                if global_flag==1:
                        moves.append([i,j,total,global_changes])
    
    mine=len(moves)
    my,opp=opp,my
    moves=[]
    for i in xrange(8):
        for j in xrange(8):
            if board[i][j]=='-':
                total=0
                global_flag=0
                global_changes=[]
                #left up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==opp:
                        count+=1
                        changes.append([a-1,b-1])
                    if board[a-1][b-1]!=opp:
                        break
                    a-=1
                    b-=1
                if count>0 and a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #up
                a=i
                count=0
                flag=0
                changes=[]
                while a-1>=0:
                    if board[a-1][j]==opp:
                        count+=1
                        changes.append([a-1,j])
                    if board[a-1][j]!=opp:
                        break
                    a-=1
                if count>0 and a-1>=0:
                    if board[a-1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #right up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b+1<8:
                    if board[a-1][b+1]==opp:
                        count+=1
                        changes.append([a-1,b+1])
                    if board[a-1][b+1]!=opp:
                        break
                    a-=1
                    b+=1
                if count>0 and a-1>=0 and b+1<8:
                    if board[a-1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #left
                b=j
                count=0
                flag=0
                changes=[]
                while b-1>=0:
                    if board[i][b-1]==opp:
                        count+=1
                        changes.append([i,b-1])
                    if board[i][b-1]!=opp:
                        break
                    b-=1
                if count>0 and b-1>=0:
                    if board[i][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'left',j-b
                        total+=j-b
                #right
                b=j
                count=0
                flag=0
                changes=[]
                while b+1<8:
                    if board[i][b+1]==opp:
                        count+=1
                        changes.append([i,b+1])
                    if board[i][b+1]!=opp:
                        break
                    b+=1
                if count>0 and b+1<8:
                    if board[i][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=b-j
                #left down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b-1>=0:
                    if board[a+1][b-1]==opp:
                        count+=1
                        changes.append([a+1,b-1])
                    if board[a+1][b-1]!=opp:
                        break
                    a+=1
                    b-=1
                if count>0 and a+1<8 and b-1>=0:
                    if board[a+1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'leftdown',a-i
                        total+=a-i
                #down
                a=i
                count=0
                flag=0
                changes=[]
                while a+1<8:
                    if board[a+1][j]==opp:
                        count+=1
                        changes.append([a+1,j])
                    if board[a+1][j]!=opp:
                        break
                    a+=1
                if count>0 and a+1<8:
                    if board[a+1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                #right down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b+1<8:
                    if board[a+1][b+1]==opp:
                        count+=1
                        changes.append([a+1,b+1])
                    if board[a+1][b+1]!=opp:
                        break
                    a+=1
                    b+=1
                if count>0 and a+1<8 and b+1<8:
                    if board[a+1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                        
                if global_flag==1:
                        moves.append([i,j,total,global_changes])
              
    oppo=len(moves)
    return [mine,oppo]

def nextMove(player,board):
    moves=[]
    if player=='B':
        my='B'
        opp='W'
    else:
        my='W'
        opp='B'
    for i in xrange(8):
        for j in xrange(8):
            if board[i][j]=='-':
                total=0
                global_flag=0
                global_changes=[]
                #left up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==opp:
                        count+=1
                        changes.append([a-1,b-1])
                    if board[a-1][b-1]!=opp:
                        break
                    a-=1
                    b-=1
                if count>0 and a-1>=0 and b-1>=0:
                    if board[a-1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #up
                a=i
                count=0
                flag=0
                changes=[]
                while a-1>=0:
                    if board[a-1][j]==opp:
                        count+=1
                        changes.append([a-1,j])
                    if board[a-1][j]!=opp:
                        break
                    a-=1
                if count>0 and a-1>=0:
                    if board[a-1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #right up
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a-1>=0 and b+1<8:
                    if board[a-1][b+1]==opp:
                        count+=1
                        changes.append([a-1,b+1])
                    if board[a-1][b+1]!=opp:
                        break
                    a-=1
                    b+=1
                if count>0 and a-1>=0 and b+1<8:
                    if board[a-1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=i-a
                #left
                b=j
                count=0
                flag=0
                changes=[]
                while b-1>=0:
                    if board[i][b-1]==opp:
                        count+=1
                        changes.append([i,b-1])
                    if board[i][b-1]!=opp:
                        break
                    b-=1
                if count>0 and b-1>=0:
                    if board[i][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'left',j-b
                        total+=j-b
                #right
                b=j
                count=0
                flag=0
                changes=[]
                while b+1<8:
                    if board[i][b+1]==opp:
                        count+=1
                        changes.append([i,b+1])
                    if board[i][b+1]!=opp:
                        break
                    b+=1
                if count>0 and b+1<8:
                    if board[i][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=b-j
                #left down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b-1>=0:
                    if board[a+1][b-1]==opp:
                        count+=1
                        changes.append([a+1,b-1])
                    if board[a+1][b-1]!=opp:
                        break
                    a+=1
                    b-=1
                if count>0 and a+1<8 and b-1>=0:
                    if board[a+1][b-1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        #print i,j,'leftdown',a-i
                        total+=a-i
                #down
                a=i
                count=0
                flag=0
                changes=[]
                while a+1<8:
                    if board[a+1][j]==opp:
                        count+=1
                        changes.append([a+1,j])
                    if board[a+1][j]!=opp:
                        break
                    a+=1
                if count>0 and a+1<8:
                    if board[a+1][j]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                #right down
                a=i
                b=j
                count=0
                flag=0
                changes=[]
                while a+1<8 and b+1<8:
                    if board[a+1][b+1]==opp:
                        count+=1
                        changes.append([a+1,b+1])
                    if board[a+1][b+1]!=opp:
                        break
                    a+=1
                    b+=1
                if count>0 and a+1<8 and b+1<8:
                    if board[a+1][b+1]==my:
                        flag=1
                        global_flag=1
                        global_changes.append(changes)
                    if flag==1:
                        total+=a-i
                        
                if global_flag==1:
                        moves.append([i,j,total,global_changes])

    for i in range(len(moves)):
        for j in [0,7]:
            for k in [0,7]:
                if moves[i][0]==j and moves[i][1]==k:
                    return j,k
    if board[0][0]==my:
        for i in range(len(moves)):
            if moves[i][0]==0 and moves[i][1]==1:
                return 0,1
            elif moves[i][0]==1 and moves[i][1]==0:
                return 1,0
            elif moves[i][0]==1 and moves[i][1]==1:
                return 1,1
    if board[0][7]==my:
        for i in range(len(moves)):
            if moves[i][0]==0 and moves[i][1]==6:
                return 0,6
            elif moves[i][0]==1 and moves[i][1]==7:
                return 1,7
            elif moves[i][0]==1 and moves[i][1]==6:
                return 1,6
    if board[7][0]==my:
        for i in range(len(moves)):
            if moves[i][0]==7 and moves[i][1]==1:
                return 7,1
            elif moves[i][0]==6 and moves[i][1]==0:
                return 6,0
            elif moves[i][0]==6 and moves[i][1]==1:
                return 6,1
    if board[7][7]==my:
        for i in range(len(moves)):
            if moves[i][0]==7 and moves[i][1]==6:
                return 7,6
            elif moves[i][0]==6 and moves[i][1]==7:
                return 6,7
            elif moves[i][0]==6 and moves[i][1]==6:
                return 6,6
    if len(moves)==1:
        return moves[0][0],moves[0][1]
    
    for j in range(len(moves)-1):
        for i in range(len(moves)-1):
            num_diff=moves[i+1][2]-moves[i][2]
            my_mob_diff=mobility(board,my,opp,moves[i+1])[0]-mobility(board,my,opp,moves[i])[0]
            opp_mob_diff=mobility(board,my,opp,moves[i])[1]-mobility(board,my,opp,moves[i+1])[1]
            if num_diff>0 or opp_mob_diff>2 or my_mob_diff>2:
                moves[i],moves[i+1]=moves[i+1],moves[i]
    for i in range(len(moves)):
        j=[0,1,6,7]
        if moves[i][0] in j and moves[i][1] in j and i<(len(moves)-1):
            continue
        else:
            return moves[i][0],moves[i][1]

# Tail starts here
player = raw_input()

board = []
for i in xrange(0, 8):
    board.append(raw_input())

a,b = nextMove(player,board)
print a,b
