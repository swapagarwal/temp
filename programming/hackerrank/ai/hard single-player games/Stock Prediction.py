#!/usr/bin/py

# Head ends here
def printTransactions(m, k, d, name, owned, prices):
    limit=m
    trans=[]
    for i in xrange(k):
        trans.append(0)
    for i in xrange(k):
        mini=min(prices[i][3],prices[i][2],prices[i][1],prices[i][0])
        while limit>prices[i][4] and prices[i][4]<prices[i][3] and prices[i][4]<prices[i][2] and prices[i][4]<prices[i][1] and prices[i][4]<prices[i][0] and prices[i][4]<mini*95/100:
            limit-=prices[i][4]
            trans[i]+=1
        maxi=max(prices[i][3],prices[i][2],prices[i][1],prices[i][0])
        while owned[i]>0 and prices[i][4]>prices[i][3] and prices[i][4]>prices[i][2] and prices[i][4]>prices[i][1] and prices[i][4]>prices[i][0] and prices[i][4]>maxi*105/100:
            owned[i]-=1
            trans[i]-=1
            
    for i in xrange(k):
        if limit>prices[i][4] and prices[i][4]<prices[i][3]:
            limit-=prices[i][4]
            trans[i]+=1
        if owned[i]>0 and prices[i][4]>prices[i][3]:
            trans[i]-=max(1,owned[i]/3)
            owned[i]-=max(1,owned[i]/3)
    count=0
    for i in xrange(k):
        if trans[i]!=0:
            count+=1
    print count
    for i in xrange(k):
        if trans[i]>0:
            print names[i],'BUY',trans[i]
        elif trans[i]<0:
            print names[i],'SELL',-trans[i]

# Tail starts here
if __name__ == '__main__':
    m, k, d = [float(i) for i in raw_input().strip().split()]
    k = int(k)
    d = int(d)
    names = []
    owned = []
    prices = []
    for data in range(k):
        temp = raw_input().strip().split()
        names.append(temp[0])
        owned.append(int(temp[1]))
        prices.append([float(i) for i in temp[2:7]])

    printTransactions(m, k, d, names, owned, prices)
