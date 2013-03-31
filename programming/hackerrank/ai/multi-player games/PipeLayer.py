#!/bin/python
# Head ends here
def nextMove(player,board):
    moves=[]
    for i in xrange(13):
        for j in xrange(13):
            if board[i][j]==player:
                if i+1<13:
                    if board[i+1][j]=='.':
                        if i+2<13:
                            if board[i+2][j]==player:
                                moves.append([i+1,j])
            if board[i][j]==player:
                if i-1>=0:
                    if board[i-1][j]=='.':
                        if i-2>=0:
                            if board[i-2][j]==player:
                                moves.append([i-1,j])
            if board[i][j]==player:
                if j+1<13:
                    if board[i][j+1]=='.':
                        if j+2<13:
                            if board[i][j+2]==player:
                                moves.append([i,j+1])
            if board[i][j]==player:
                if j-1>=0:
                    if board[i][j-1]=='.':
                        if j-2>=0:
                            if board[i][j-2]==player:
                                moves.append([i,j-1])
    import random
    n=int(random.random()*100)%len(moves)
    return moves[n][0],moves[n][1]
    
    
# Tail starts here
player = raw_input()

board = []
for i in xrange(0, 13):
    board.append(raw_input())

a,b = nextMove(player,board)
print a,b
