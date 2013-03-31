#!/usr/bin/python
import random

# Head ends here
def next_move(posx, posy, board):
    dirtx=5
    dirty=5
    for i in [-1,0,1]:
        for j in [-1,0,1]:
            if posx+i>=0 and posx+i<5:
                if posy+j>=0 and posy+j<5:
                    if board[posx+i][posy+j]=='d':
                        dirtx=posx+i
                        dirty=posy+j
    if dirtx==5 and dirty==5:
        moves=[['LEFT',0,-1],['RIGHT',0,1],['UP',-1,0],['DOWN',1,0]]
        x=int(random.random()*100)%4
        while(posx+moves[x][1]<0 or posx+moves[x][1]>=5 or posy+moves[x][2]<0 or posy+moves[x][2]>=5):
            x=int(random.random()*100)%4
        print moves[x][0]
    else:
        if posx<dirtx:
            print 'DOWN'
        elif posx>dirtx:
            print 'UP'
        elif posy<dirty:
            print 'RIGHT'
        elif posy>dirty:
            print 'LEFT'
        else:
            print 'CLEAN'

# Tail starts here
if __name__ == "__main__":
    pos = [int(i) for i in raw_input().strip().split()]
    board = [[j for j in raw_input().strip()] for i in range(5)]
    next_move(pos[0], pos[1], board)
