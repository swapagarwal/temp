#!/usr/bin/python

# Head ends here
def next_move(posx, posy, board):
    dirt=[]
    for i in xrange(5):
        for j in xrange(5):
            if board[i][j]=='d':
                dirt.append([i,j])
    mini=10
    for i in xrange(len(dirt)):
        if abs(dirt[i][0]-posx)+abs(dirt[i][1]-posy)<mini:
            mini=abs(dirt[i][0]-posx)+abs(dirt[i][1]-posy)
            dirtx=dirt[i][0]
            dirty=dirt[i][1]
    if posx<dirtx:
        print "DOWN"
    elif posx>dirtx:
        print "UP"
    elif posy<dirty:
        print "RIGHT"
    elif posy>dirty:
        print "LEFT"
    else:
        print "CLEAN"

# Tail starts here
if __name__ == "__main__":
    pos = [int(i) for i in raw_input().strip().split()]
    board = [[j for j in raw_input().strip()] for i in range(5)]
    next_move(pos[0], pos[1], board)#!/bin/python
# Head ends here
def nextMove(n,x,y,grid):
    for i in xrange(n):
        for j in xrange(n):
            if grid[i][j]=='p':
                prinx=i
                priny=j
    if x<prinx:
        print "DOWN"
    elif x>prinx:
        print "UP"
    elif y<priny:
        print "RIGHT"
    elif y>priny:
        print "LEFT"
# Tail starts here
n = input()
x,y = [int(i) for i in raw_input().strip().split()]
grid = []
for i in xrange(0, n):
    grid.append(raw_input())

nextMove(n,x,y,grid)
