#!/bin/python

def move(myx,myy,board):
    moves=[]
    for i,j in [0,-1],[0,1],[-1,0],[1,0]:
        if myx+i>=0 and myx+i<15 and myy+j>=0 and myy+j<15:
            if board[myx+i][myy+j]=='-':
                moves.append([i,j])
    return moves


# Head ends here
def nextMove(player,x,y,o_x,o_y,board):
    if player=='r':
        me='r'
        opp='g'
        myx=x
        myy=y
        oppx=o_x
        oppy=o_y
    else:
        me='g'
        opp='r'
        myx=o_x
        myy=o_y
        oppx=x
        oppy=y
        
    moves=move(myx,myy,board)
    
    for i in xrange(len(moves)):
        if len(move(myx+moves[i][0],myy+moves[i][1],board))<2 and len(moves)!=1:
            moves.pop(i)
            break
    
    if len(moves)==0:
        return "LEFT"
    import random
    n=int(random.random()*100)%len(moves)
    if moves[n]==[0,-1]:
        return "LEFT"
    if moves[n]==[0,1]:
        return "RIGHT"
    if moves[n]==[-1,0]:
        return "UP"
    if moves[n]==[1,0]:
        return "DOWN"

# Tail starts here
player = raw_input()
pos = raw_input().split()
[x,y, o_x, o_y] = [int(i) for i in pos]
board = []
for i in xrange(0, 15):
    board.append(raw_input())

move = nextMove(player,x,y,o_x,o_y,board)
print move
