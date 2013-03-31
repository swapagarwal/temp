#!/bin/python

# Head ends here
def nextMove(player,board):
    moves=[]
    for i in xrange(9):
        for j in xrange(9):
            if board[i][j]=='-':
                moves.append([i,j])
    import random
    n=int(random.random()*100)%len(moves)
    return moves[n][0],moves[n][1]

# Tail starts here
player = raw_input()

board = []
for i in xrange(0, 9):
    board.append(raw_input())

a,b = nextMove(player,board)
print a,b
