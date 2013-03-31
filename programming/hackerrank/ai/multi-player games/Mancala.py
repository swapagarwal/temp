#!/usr/bin/python
import random

# Head ends here
def printNextMove(player, player1Mancala, player1Marbles, player2Mancala, player2Marbles):
    moves=[]
    if player==1:
        my=player1Marbles
        opp=player2Marbles
    else:
        my=player2Marbles
        opp=player1Marbles
    for i in range(6):
        if my[i]!=0:
            moves.append(i)
    r=int(random.random()*100)%len(moves)
    return moves[r]+1

# Tail starts here
player = input()
mancala1 = input()
mancala1_marbles = [int(i) for i in raw_input().strip().split()]
mancala2 = input()
mancala2_marbles = [int(i) for i in raw_input().strip().split()]
print printNextMove(player, mancala1, mancala1_marbles, mancala2, mancala2_marbles)
