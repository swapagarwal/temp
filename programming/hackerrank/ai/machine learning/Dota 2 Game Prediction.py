file=open("trainingdata.txt","r")
lines=file.readlines()
file.close()
data=[]
i=-1
for line in lines:
    i+=1
    data.append([[],[]])
    names=line[:-1].split(',')
    for j in range(5):
        data[i][0].append(names[j])
    for j in range(5,10):
        data[i][1].append(names[j])
    data[i].append(int(names[10]))
no=len(data)
n=input()
for i in range(n):
    names=raw_input().split(',')
    first=[]
    second=[]
    for j in range(5):
        first.append(names[j])
    for j in range(5,10):
        second.append(names[j])
    for j in range(no):
        count=0
        if first[0] in data[j][0]:
            count+=1
        if second[0] in data[j][1]:
            count+=1
        if first[1] in data[j][0]:
            count+=1
        if second[1] in data[j][1]:
            count+=1
        if first[2] in data[j][0]:
            count+=1
        if second[2] in data[j][1]:
            count+=1
        if first[3] in data[j][0]:
            count+=1
        if second[3] in data[j][1]:
            count+=1
        if first[4] in data[j][0]:
            count+=1
        if second[4] in data[j][1]:
            count+=1
        if count>3:
            print data[j][2]
            break
