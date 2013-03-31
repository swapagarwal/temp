#!/bin/python

def nextMove(player,board):
    if player=='h':
        for i in xrange(8):
            for j in xrange(8):
                if board[i][j]=='h':
                    if j+1<8:
                        if board[i][j+1]=='h':
                            if i+2<8:
                                if board[i+2][j]=='-' and board[i+2][j+1]=='-':
                                    return i+2,j
    else:
        for i in xrange(8):
            for j in xrange(8):
                if board[i][j]=='v':
                    if i+1<8:
                        if board[i+1][j]=='v':
                            if j+2<8:
                                if board[i][j+2]=='-' and board[i+1][j+2]=='-':
                                    return i,j+2
    for i in xrange(8):
        for j in xrange(8):
            if board[i][j]=='-':
                if player=='h':
                    if j+1<8:
                        if board[i][j+1]=='-':
                            return i,j
                else:
                    if i+1<8:
                        if board[i+1][j]=='-':
                            return i,j

player = raw_input()

board = []
for i in xrange(0, 8):
    board.append(raw_input())

a,b = nextMove(player,board)
print a,b

