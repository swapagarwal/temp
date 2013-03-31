#!/bin/python

def calculate_bid(player,pos,first_moves,second_moves):
    """your logic here"""
    if player==1:
        my=first_moves
        opp=second_moves
    else:
        my=second_moves
        opp=first_moves
    total=0
    for i in range(len(my)):
        if my[i]>=opp[i]:
            total+=my[i]
    left=100-total
    if left>10:
        return 10
    elif left>10:
        return 10
    elif left>5:
        return 5
    elif left>0:
        return 1
    else:
        return 0

#gets the id of the player
player = input()

scotch_pos = input()         #current position of the scotch

first_moves = [int(i) for i in raw_input().split()]
second_moves = [int(i) for i in raw_input().split()]
bid = calculate_bid(player,scotch_pos,first_moves,second_moves)
print bid
