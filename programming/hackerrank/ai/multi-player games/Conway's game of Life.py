#!/bin/python
import random
def nextMove(player,board):
    for i in xrange(29):
        for j in xrange(29):
            if board[i][j]=='-':
                count=0
                for a in [-1,0,1]:
                    for b in [-1,0,1]:
                        if i+a>=0 and i+a<29 and j+b>=0 and j+b<29:
                            if board[i+a][j+b]!='-':
                                count+=1
                if count==1:
                    return i,j
                if count==2:
                    return i,j
                if count>3:
                    continue
    x=int(random.random()*100)%29
    y=int(random.random()*100)%29
    while(board[x][y]!='-'):
        x=int(random.random()*100)%29
        y=int(random.random()*100)%29
    return x,y

# Tail starts here
player = raw_input()
board = []
for i in xrange(0, 29):
    board.append(raw_input())

a,b = nextMove(player,board)
print a,b
