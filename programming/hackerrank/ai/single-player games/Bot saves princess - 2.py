#!/bin/python
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
