file=open("trainingdata.txt","r")
lines=file.readlines()
file.close()
data=[]
for line in lines:
    data.append([float(i) for i in line[:-1].split(',')])
n=len(data)
for i in range(n):
    for j in range(n-1):
        if data[j][0]>data[j+1][0]:
            data[j],data[j+1]=data[j+1],data[j]
x=input()
for i in range(n-1):
    if x>data[i][0] and x<data[i+1][0]:
        print (x-data[i][0])/(data[i+1][0]-data[i][0])*(data[i+1][1]-data[i][1])+data[i][1]
