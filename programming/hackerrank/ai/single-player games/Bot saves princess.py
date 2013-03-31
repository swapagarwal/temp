#!/bin/python
# Head ends here
def nextMove(m,grid):
    moves=""
    for i in xrange(0,m):
        for j in xrange(0,m):
            if grid[i][j]=='m':
                botx=i
                boty=j
            if grid[i][j]=='p':
                prinx=i
                priny=j
    if botx<prinx:
        while(botx<prinx):
            moves+="DOWN\n"
            botx+=1
    if botx>prinx:
        while(botx>prinx):
            moves+="UP\n"
            botx-=1
    if boty<priny:
        while(boty<priny):
            moves+="RIGHT\n"
            boty+=1
    if boty>priny:
        while(boty>priny):
            moves+="LEFT\n"
            boty-=1
    return moves[:-1]
# Tail starts here
m = input()

grid = []
for i in xrange(0, m):
    grid.append(raw_input().strip())

print nextMove(m,grid)
