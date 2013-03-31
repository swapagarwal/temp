#!/bin/python

# Head ends here

def win(me,init_board,x,y):
    board=[]
    for i in xrange(3):
        board.append(init_board[i])
    board[x]=board[x][:y]+me+board[x][y+1:]
    for i in xrange(3):
        count=0
        for j in xrange(3):
            if board[i][j]==me:
                count+=1
        if count==3:
            return 1
    for i in xrange(3):
        count=0
        for j in xrange(3):
            if board[j][i]==me:
                count+=1
        if count==3:
            return 1
    if board[1][1]==me:
        if board[0][0]==me:
            if board[2][2]==me:
                return 1
        if board[0][2]==me:
            if board[2][0]==me:
                return 1
    return 0

def next_move(player, first_player_bids, second_player_bids, board, move):
    if player=='X':
        me='X'
        opp='O'
        adv='mine'
        my_bids=first_player_bids
        opp_bids=second_player_bids
    else:
        me='O'
        opp='X'
        adv='opp'
        my_bids=second_player_bids
        opp_bids=first_player_bids
    my_chips=4
    opp_chips=4
    for i in range(len(my_bids)):
        if my_bids[i]>opp_bids[i]:
            my_chips-=my_bids[i]
            opp_chips+=my_bids[i]
        elif my_bids[i]==opp_bids[i]:
            if adv=='mine':
                my_chips-=my_bids[i]
                opp_chips+=my_bids[i]
                adv='opp'
            elif adv=='opp':
                opp_chips-=opp_bids[i]
                my_chips+=opp_bids[i]
                adv='mine'
        elif my_bids[i]<opp_bids[i]:
            opp_chips-=opp_bids[i]
            my_chips+=opp_bids[i]
    
    cond='rand'
    flag=0
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(me,board,i,j):
                    cond='win'
                    flag=1
    for i in [0,1,2]:
        for j in [0,1,2]:
            if board[i][j]=='_' and flag==0:
                if win(opp,board,i,j):
                    cond='lose'
                    flag=1        
    
    if move=='BID':
        if me=='X' and len(my_bids)==0:
            print 1
        elif me=='O' and len(my_bids)==0:
            print 2
        elif cond=='win':
            print my_chips
        elif cond=='lose' and my_chips>4:
            print 9-my_chips
        elif cond=='lose':
            print my_chips
        elif my_chips==8:
            print 1
        elif my_chips==7 and adv=='mine':
            print 1
        elif my_chips==7 and adv=='opp':
            print 2
        elif my_chips>0:
            print 1
        elif my_chips==0:
            print 0
    elif move=='PLAY':
        flag=0
        for i in [0,1,2]:
            for j in [0,1,2]:
                if board[i][j]=='_' and flag==0:
                    if win(me,board,i,j):
                        print i,j
                        flag=1
        for i in [0,1,2]:
            for j in [0,1,2]:
                if board[i][j]=='_' and flag==0:
                    if win(opp,board,i,j):
                        print i,j
                        flag=1
        if flag==0:
            if board[0][0]=='_':
                if board[0][1]==me:
                    if board[0][2]!=opp:
                        if board[1][0]!=opp:
                            if board[2][0]==me and flag==0:
                                print 0,0
                                flag=1
                elif board[1][0]==me:
                    if board[2][0]!=opp:
                        if board[0][1]!=opp:
                            if board[0][2]==me and flag==0:
                                print 0,0
                                flag=1
            if board[0][2]=='_':
                if board[0][1]==me:
                    if board[0][0]!=opp:
                        if board[1][2]!=opp:
                            if board[2][2]==me and flag==0:
                                print 0,2
                                flag=1
                elif board[1][2]==me:
                    if board[2][2]!=opp:
                        if board[0][1]!=opp:
                            if board[0][0]==me and flag==0:
                                print 0,2
                                flag=1
            if board[2][0]=='_':
                if board[1][0]==me:
                    if board[0][0]!=opp:
                        if board[2][1]!=opp:
                            if board[2][2]==me and flag==0:
                                print 2,0
                                flag=1
                elif board[2][1]==me:
                    if board[2][2]!=opp:
                        if board[1][0]!=opp:
                            if board[0][0]==me and flag==0:
                                print 2,0
                                flag=1
            if board[2][2]=='_':
                if board[2][1]==me:
                    if board[2][0]!=opp:
                        if board[1][2]!=opp:
                            if board[0][2]==me and flag==0:
                                print 2,2
                                flag=1
                elif board[1][2]==me:
                    if board[0][2]!=opp:
                        if board[2][1]!=opp:
                            if board[2][0]==me and flag==0:
                                print 2,2
                                flag=1
                
                
                
            if board[0][1]=='_':
                if board[0][0]!=opp:
                    if board[1][0]!=opp:
                        if board[2][0]==me and flag==0:
                            print 0,1
                            flag=1
                elif board[0][2]!=opp:
                    if board[1][2]!=opp:
                        if board[2][2]==me and flag==0:
                            print 0,1
                            flag=1
            if board[1][0]=='_':
                if board[0][0]!=opp:
                    if board[0][1]!=opp:
                        if board[0][2]==me and flag==0:
                            print 1,0
                            flag=1
                elif board[2][0]!=opp:
                    if board[2][1]!=opp:
                        if board[2][2]==me and flag==0:
                            print 1,0
                            flag=1
            if board[2][1]=='_':
                if board[2][0]!=opp:
                    if board[1][0]!=opp:
                        if board[0][0]==me and flag==0:
                            print 2,1
                            flag=1
                elif board[2][2]!=opp:
                    if board[1][2]!=opp:
                        if board[0][2]==me and flag==0:
                            print 2,1
                            flag=1
            if board[1][2]=='_':
                if board[0][2]!=opp:
                    if board[0][1]!=opp:
                        if board[0][0]==me and flag==0:
                            print 1,2
                            flag=1
                elif board[2][2]!=opp:
                    if board[2][1]!=opp:
                        if board[2][0]==me and flag==0:
                            print 1,2
                            flag=1
            
            
            if board[0][0]=='_':
                if board[1][0]!=opp and board[2][0]!=opp and board[2][1]!=opp and board[2][2]!=opp and flag==0:
                    print 0,0
                    flag=1
                elif board[0][1]!=opp and board[0][2]!=opp and board[1][2]!=opp and board[2][2]!=opp and flag==0:
                    print 0,0
                    flag=1
            if board[2][0]=='_':
                if board[1][0]!=opp and board[0][0]!=opp and board[0][1]!=opp and board[0][2]!=opp and flag==0:
                    print 2,0
                    flag=1
                elif board[2][1]!=opp and board[2][2]!=opp and board[2][1]!=opp and board[2][0]!=opp and flag==0:
                    print 2,0
                    flag=1
            if board[0][2]=='_':
                if board[0][1]!=opp and board[0][0]!=opp and board[1][0]!=opp and board[2][0]!=opp and flag==0:
                    print 0,2
                    flag=1
                elif board[1][2]!=opp and board[2][2]!=opp and board[2][1]!=opp and board[2][0]!=opp and flag==0:
                    print 0,2
                    flag=1
            if board[2][2]=='_':
                if board[1][2]!=opp and board[0][2]!=opp and board[0][1]!=opp and board[0][0]!=opp and flag==0:
                    print 2,2
                    flag=1
                elif board[2][1]!=opp and board[2][0]!=opp and board[1][0]!=opp and board[0][0]!=opp and flag==0:
                    print 2,2
                    flag=1
            
            if flag==0:
                for i in range(3):
                    for j in range(3):
                        if board[i][j]=='_' and flag==0:
                            print i,j
                            flag=1
                

# Tail starts here
#gets the id of the player
player = raw_input()

move = raw_input()         #current position of the scotch

first_player_bids = [int(i) for i in raw_input().split()]
second_player_bids = [int(i) for i in raw_input().split()]
board = []

for i in xrange(0, 3):
    board.append(raw_input())

next_move(player, first_player_bids, second_player_bids, board, move)
