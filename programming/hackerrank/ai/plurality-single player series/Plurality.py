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
    colour=[]
    not_colour=[]
    for i in range(color):
        colour.append([])
        not_colour.append([])
    colour[0].append(0)
    for i in range(1,color):
        not_colour[i].append(0)
    
    no=1
    for p in range(n):
        for i in range(n):
            for j in range(n):
                if query[i][j]==1:
                    for k in range(color):
                        if i in colour[k]:
                            if j not in colour[k]:
                                colour[k].append(j)
                                for l in set(range(color))-set([k]):
                                    if j not in not_colour[l]:
                                        not_colour[l].append(j)
                elif query[i][j]==0:
                    for k in range(color):
                        if i in colour[k]:
                            if j not in not_colour[k]:
                                not_colour[k].append(j)
        for i in range(color):
            for j in range(len(not_colour[i])):
                count=0
                for k in set(range(color))-set([i]):
                    if not_colour[i][j] in not_colour[k]:
                        count+=1
                    else:
                        diff=k
                if count==color-2:
                    if not_colour[i][j] not in colour[diff]:
                        colour[diff].append(not_colour[i][j])
        for i in range(len(not_colour[0])):
            count=0
            for j in range(1,no):
                if not_colour[0][i] in not_colour[j]:
                    count+=1
            if count==no-1:
                if len(colour[no])==0:
                    colour[no].append(not_colour[0][i])
                    no+=1
    flag=0
    for i in range(color):
        if len(colour[i])>=n/2:
            print colour[i][0]
            flag=1
    if flag==0 and len(b)>0:
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
