#!/usr/bin/python

def cop(x,y):
    moves=[]
    for a,b in [-1,0],[0,-1],[0,0],[0,1],[1,0]:
        if x+a>=0 and x+a<20 and y+b>=0 and y+b<20:
            moves.append([x+a,y+b])
    return moves

def jack(x,y):
    moves=[]
    for a in [-1,0,1]:
        for b in [-1,0,1]:
            if x+a>=0 and x+a<20 and y+b>=0 and y+b<20:
                moves.append([x+a,y+b])
    return moves


# Head ends here
def next_move(player, dr, cop1, cop2, cop3):
    import random
    if player=='R':
        moves=jack(dr[0],dr[1])
        moves1=cop(cop1[0],cop1[1])
        moves2=cop(cop2[0],cop2[1])
        moves3=cop(cop3[0],cop3[1])
        
        for i in range(len(moves1)):
            moves1.append(cop(moves1[i][0],moves1[i][1]))
        for i in range(len(moves2)):
            moves2.append(cop(moves2[i][0],moves2[i][1]))
        for i in range(len(moves3)):
            moves3.append(cop(moves3[i][0],moves3[i][1]))
            
        actual=[]
        for a in [-1,0,1]:
            for b in [-1,0,1]:
                i=dr[0]+a
                j=dr[1]+b
                if i>=0 and i<20 and j>=0 and j<20:
                    if [i,j] not in moves1 and [i,j] not in moves2 and [i,j] not in moves3:
                        actual.append([i,j])
        n=int(random.random()*100)%len(actual)
        print actual[n][0],moves[n][1]
        if len(actual)==0:
            n=int(random.random()*100)%len(moves)
            print moves[n][0],moves[n][1]
    else:
        moves1=cop(cop1[0],cop1[1])
        moves2=cop(cop2[0],cop2[1])
        moves3=cop(cop3[0],cop3[1])
        if [dr[0],dr[1]] in moves1:
            print dr[0],dr[1],cop2[0],cop2[1],cop3[0],cop3[1]
            return
        if [dr[0],dr[1]] in moves2:
            print cop1[0],cop1[1],dr[0],dr[1],cop3[0],cop3[1]
            return
        if [dr[0],dr[1]] in moves3:
            print cop1[0],cop1[1],cop2[0],cop2[1],dr[0],dr[1]
            return
       
        cop1x=cop1[0]
        cop1y=cop1[1]
        if cop1[0]-dr[0]>5:
            cop1x=cop1[0]-1
        if cop1[0]-dr[0]<-5:
            cop1x=cop1[0]+1
        if cop1[1]-dr[1]>5 and cop1x==cop1[0]:
            cop1y=cop1[1]-1
        if cop1[1]-dr[1]<-5 and cop1x==cop1[0]:
            cop1y=cop1[1]+1
        cop2x=cop2[0]
        cop2y=cop2[1]
        if cop2[0]-dr[0]>5:
            cop2x=cop2[0]-1
        if cop2[0]-dr[0]<-5:
            cop2x=cop2[0]+1
        if cop2[1]-dr[1]>5 and cop2x==cop2[0]:
            cop2y=cop2[1]-1
        if cop2[1]-dr[1]<-5 and cop2x==cop2[0]:
            cop2y=cop2[1]+1
        cop3x=cop3[0]
        cop3y=cop3[1]
        if cop3[0]-dr[0]>5:
            cop3x=cop3[0]-1
        if cop3[0]-dr[0]<-5:
            cop3x=cop3[0]+1
        if cop3[1]-dr[1]>5 and cop3x==cop3[0]:
            cop3y=cop3[1]-1
        if cop3[1]-dr[1]<-5 and cop3x==cop3[0]:
            cop3y=cop3[1]+1
        if (cop1x!=cop1[0] or cop1y!=cop1[1]) and (cop2x!=cop2[0] or cop2y!=cop2[1]) and (cop3x!=cop3[0] or cop3y!=cop3[1]):
            print cop1x,cop1y,cop2x,cop2y,cop3x,cop3y
            return
            
        n1=int(random.random()*100)%len(moves1)
        n2=int(random.random()*100)%len(moves2)
        n3=int(random.random()*100)%len(moves3)
        print moves1[n1][0],moves1[n1][1],moves2[n2][0],moves2[n2][1],moves3[n3][0],moves3[n3][1]
        
# Tail starts here
player = raw_input()
pos = [int(i) for i in raw_input().split()]
next_move(player, pos[0:2], pos[2:4], pos[4:6], pos[6:8])
