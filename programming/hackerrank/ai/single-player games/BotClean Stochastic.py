#!/usr/bin/python

# Head ends here
def nextMove(posx, posy, board):
    for i in xrange(5):
        for j in xrange(5):
            if board[i][j]=='d':
                dirtx=i
                dirty=j
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
    nextMove(pos[0], pos[1], board)
