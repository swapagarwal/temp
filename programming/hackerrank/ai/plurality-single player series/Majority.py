#!/usr/bin/py
# Head ends here
def nextQuestion(n, plurality, lies, color, exact_lies, query):
    a=[]
    for i in range(n):
        count=0
        for j in range(n):
            if query[i][j]!=-1:
                count+=1
        a.append(count)
    b=[]
    for i in range(n):
        if a[i]==0:
            b.append(i)
    for i in range(n):
        if a[i]==0:
            first_zero=i
            break
    black=[0]
    red=[]
    for i in range(n):
        for j in range(n):
            if query[i][j]==1:
                if i in black:
                    if j not in black:
                        black.append(j)
                elif i in red:
                    if j not in red:
                        red.append(j)
            elif query[i][j]==0:
                if i in black:
                    if j not in red:
                        red.append(j)
                elif i in red:
                    if j not in black:
                        black.append(j)
    if len(black)>=n/2:
        print black[0]
    elif len(red)>=n/2:
        print red[0]
    elif len(b)>0:
        if first_zero==0:
            print 0,1
        else:
            print first_zero-1,b[0]
        
        
# Tail starts here
if __name__ == '__main__':
    vals = [int(i) for i in raw_input().strip().split()]
    query_size = input()
    query = {}
    for i in range(vals[0]):
        query[i] = {}
    
    for i in range(vals[0]):
        for j in range(vals[0]):
            query[i][j]=-1
    
    for i in range(query_size):
        temp = [j for j in raw_input().strip().split()]
        if temp[2] == "YES":
            query[int(temp[0])][int(temp[1])] = 1
            query[int(temp[1])][int(temp[0])] = 1
        else:
            query[int(temp[0])][int(temp[1])] = 0
            query[int(temp[1])][int(temp[0])] = 0

    nextQuestion(vals[0], vals[1], vals[2], vals[3], vals[4], query)
