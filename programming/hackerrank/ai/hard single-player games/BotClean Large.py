#!/usr/bin/python
# Head ends here
def next_move(posx, posy, dimx, dimy, board):
    dirt=[]
    for i in xrange(dimx):
        for j in xrange(dimy):
            if board[i][j]=='d':
                dirt.append([i,j])
    mini=dimx+dimy
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
    dim = [int(i) for i in raw_input().strip().split()]
    board = [[j for j in raw_input().strip()] for i in range(dim[0])]
    next_move(pos[0], pos[1], dim[0], dim[1], board)
