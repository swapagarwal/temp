#!/bin/python

# Head ends here
def nextMove(player, move, board):
    if move=="INIT":
        moves=[]
        for i in xrange(7):
            for j in xrange(7):
                if board[i][j]=='O':
                    moves.append([i,j])
        import random
        n=int(random.random()*100)%len(moves)
        print moves[n][0],moves[n][1]
    elif move=="MILL":
        if player=='W':
            me='W'
            opp='B'
        else:
            me='O'
            opp='W'
        moves=[]
        for i in xrange(7):
            for j in xrange(7):
                if board[i][j]==opp:
                    moves.append([i,j])
        import random
        n=int(random.random()*100)%len(moves)
        print moves[n][0],moves[n][1]
    elif move=="MOVE":
        if player=='W':
            me='W'
            opp='B'
        else:
            me='B'
            opp='W'
        count=0
        for i in xrange(7):
            for j in xrange(7):
                if board[i][j]==me:
                    count+=1
        if count>3:
            moves=[]
            to=[]
            for i in xrange(7):
                for j in xrange(7):
                    if board[i][j]==me:
                        moves.append([i,j])
            import random
            while len(to)==0:
                n=0
                x=moves[n][0]
                y=moves[n][1]
                if x==0:
                    if y==0:
                        a=[[0,3],[3,0]]
                    elif y==3:
                        a=[[0,0],[0,6],[1,3]]
                    elif y==6:
                        a=[[0,3],[3,6]]
                elif x==1:
                    if y==1:
                        a=[[1,3],[3,1]]
                    elif y==3:
                        a=[[1,1],[0,3],[2,3],[1,5]]
                    elif y==5:
                        a=[[1,3],[3,5]]
                elif x==2:
                    if y==2:
                        a=[[2,3],[3,2]]
                    elif y==3:
                        a=[[2,2],[1,3],[2,4]]
                    elif y==4:
                        a=[[2,3],[3,4]]
                elif x==3:
                    if y==0:
                        a=[[0,0],[6,0],[3,1]]
                    elif y==1:
                        a=[[3,0],[1,1],[5,1],[3,2]]
                    elif y==2:
                        a=[[3,1],[2,2],[4,2]]
                    elif y==4:
                        a=[[2,4],[4,4],[3,5]]
                    elif y==5:
                        a=[[3,4],[1,5],[5,5],[3,6]]
                    elif y==6:
                        a=[[3,5],[0,6],[6,6]]
                elif x==4:
                    if y==2:
                        a=[[3,2],[4,3]]
                    elif y==3:
                        a=[[4,2],[5,3],[4,4]]
                    elif y==4:
                        a=[[4,3],[3,4]]
                elif x==5:
                    if y==1:
                        a=[[5,3],[3,1]]
                    elif y==3:
                        a=[[5,1],[6,3],[4,3],[5,5]]
                    elif y==5:
                        a=[[5,3],[3,5]]
                elif x==6:
                    if y==0:
                        a=[[6,3],[3,0]]
                    elif y==3:
                        a=[[6,0],[6,6],[5,3]]
                    elif y==6:
                        a=[[6,3],[3,6]]
                for i,j in a:
                    if board[i][j]=='O':
                        to.append([i,j])
            if len(to)==0:
                n+=1
            else:
                m=int(random.random()*100)%len(to)
                print x,y,to[m][0],to[m][1]
        else:
            moves=[]
            to=[]
            for i in xrange(7):
                for j in xrange(7):
                    if board[i][j]==me:
                        moves.append([i,j])
            for i in xrange(7):
                for j in xrange(7):
                    if board[i][j]=='O':
                        to.append([i,j])
            import random
            n=int(random.random()*100)%len(moves)
            m=int(random.random()*100)%len(to)
            print moves[n][0],moves[n][1],to[m][0],to[m][1]

# Tail starts here
player = raw_input().strip()
move = raw_input().strip()

board = []
for i in xrange(0, 7):
    board.append(raw_input().strip())

nextMove(player, move, board)
