def win(me,init_board,x,y):
    board=[]
    for i in xrange(3):
        board.append(init_board[i])
    board[x]=board[x][:y]+me+board[x][y+1:]
    for i in xrange(3):
        count=0
        for j in xrange(3):
            if board[i][j]==me:
                count+=1
        if count==3:
            return 1
    for i in xrange(3):
        count=0
        for j in xrange(3):
            if board[j][i]==me:
                count+=1
        if count==3:
            return 1
    if board[1][1]==me:
        if board[0][0]==me:
            if board[2][2]==me:
                return 1
        if board[0][2]==me:
            if board[2][0]==me:
                return 1
    return 0

def nextMove(player,board):
    if player=='X':
        me='X'
        opp='O'
    else:
        me='O'
        opp='X'
    
    cond='rand'
    flag=0
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(me,board,i,j):
                    cond='win'
                    flag=1
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(opp,board,i,j):
                    cond='lose'
                    flag=1        
    
    flag=0
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(me,board,i,j):
                    print i,j
                    flag=1
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(opp,board,i,j):
                    print i,j
                    flag=1
    if flag==0:
        if board[0][0]=='_':
            if board[0][1]==me:
                if board[0][2]!=opp:
                    if board[1][0]!=opp:
                        if board[2][0]==me and flag==0:
                            print 0,0
                            flag=1
            elif board[1][0]==me:
                if board[2][0]!=opp:
                    if board[0][1]!=opp:
                        if board[0][2]==me and flag==0:
                            print 0,0
                            flag=1
        if board[0][2]=='_':
            if board[0][1]==me:
                if board[0][0]!=opp:
                    if board[1][2]!=opp:
                        if board[2][2]==me and flag==0:
                            print 0,2
                            flag=1
            elif board[1][2]==me:
                if board[2][2]!=opp:
                    if board[0][1]!=opp:
                        if board[0][0]==me and flag==0:
                            print 0,2
                            flag=1
        if board[2][0]=='_':
            if board[1][0]==me:
                if board[0][0]!=opp:
                    if board[2][1]!=opp:
                        if board[2][2]==me and flag==0:
                            print 2,0
                            flag=1
            elif board[2][1]==me:
                if board[2][2]!=opp:
                    if board[1][0]!=opp:
                        if board[0][0]==me and flag==0:
                            print 2,0
                            flag=1
        if board[2][2]=='_':
            if board[2][1]==me:
                if board[2][0]!=opp:
                    if board[1][2]!=opp:
                        if board[0][2]==me and flag==0:
                            print 2,2
                            flag=1
            elif board[1][2]==me:
                if board[0][2]!=opp:
                    if board[2][1]!=opp:
                        if board[2][0]==me and flag==0:
                            print 2,2
                            flag=1
            
            
            
        if board[0][1]=='_':
            if board[0][0]!=opp:
                if board[1][0]!=opp:
                    if board[2][0]==me and flag==0:
                        print 0,1
                        flag=1
            elif board[0][2]!=opp:
                if board[1][2]!=opp:
                    if board[2][2]==me and flag==0:
                        print 0,1
                        flag=1
        if board[1][0]=='_':
            if board[0][0]!=opp:
                if board[0][1]!=opp:
                    if board[0][2]==me and flag==0:
                        print 1,0
                        flag=1
            elif board[2][0]!=opp:
                if board[2][1]!=opp:
                    if board[2][2]==me and flag==0:
                        print 1,0
                        flag=1
        if board[2][1]=='_':
            if board[2][0]!=opp:
                if board[1][0]!=opp:
                    if board[0][0]==me and flag==0:
                        print 2,1
                        flag=1
            elif board[2][2]!=opp:
                if board[1][2]!=opp:
                    if board[0][2]==me and flag==0:
                        print 2,1
                        flag=1
        if board[1][2]=='_':
            if board[0][2]!=opp:
                if board[0][1]!=opp:
                    if board[0][0]==me and flag==0:
                        print 1,2
                        flag=1
            elif board[2][2]!=opp:
                if board[2][1]!=opp:
                    if board[2][0]==me and flag==0:
                        print 1,2
                        flag=1
        
        
        if board[0][0]=='_':
            if board[1][0]!=opp and board[2][0]!=opp and board[2][1]!=opp and board[2][2]!=opp and flag==0:
                print 0,0
                flag=1
            elif board[0][1]!=opp and board[0][2]!=opp and board[1][2]!=opp and board[2][2]!=opp and flag==0:
                print 0,0
                flag=1
        if board[2][0]=='_':
            if board[1][0]!=opp and board[0][0]!=opp and board[0][1]!=opp and board[0][2]!=opp and flag==0:
                print 2,0
                flag=1
            elif board[2][1]!=opp and board[2][2]!=opp and board[2][1]!=opp and board[2][0]!=opp and flag==0:
                print 2,0
                flag=1
        if board[0][2]=='_':
            if board[0][1]!=opp and board[0][0]!=opp and board[1][0]!=opp and board[2][0]!=opp and flag==0:
                print 0,2
                flag=1
            elif board[1][2]!=opp and board[2][2]!=opp and board[2][1]!=opp and board[2][0]!=opp and flag==0:
                print 0,2
                flag=1
        if board[2][2]=='_':
            if board[1][2]!=opp and board[0][2]!=opp and board[0][1]!=opp and board[0][0]!=opp and flag==0:
                print 2,2
                flag=1
            elif board[2][1]!=opp and board[2][0]!=opp and board[1][0]!=opp and board[0][0]!=opp and flag==0:
                print 2,2
                flag=1
        
        if flag==0:
            for i in range(3):
                for j in range(3):
                    if board[i][j]=='_' and flag==0:
                        print i,j
                        flag=1
                
#If player is X, I'm the first player.
#If player is O, I'm the second player.
player = raw_input()

#Read the board now. The board is a 3x3 array filled with X, O or _.
board = []
for i in xrange(0, 3):
    board.append(raw_input())

nextMove(player,board)
