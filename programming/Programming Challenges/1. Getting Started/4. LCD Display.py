x=raw_input("")
s=int(x[:x.find(" ")])
n=int(x[x.find(" ")+1:])
count=0
size=[]
final=[]

def one(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if j==s+1 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            else:
                a[i]+=' '
    return a

def two(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>0 and i<s+1:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i>s+1 and i<2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def three(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>0 and i<s+1:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>s+1 and i<2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def four(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if j==0 and i>0 and i<s+1:
                a[i]+='|'
            elif j==s+1 and i>0 and i<s+1:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>s+1 and i<2*s+2:
                a[i]+='|'
            else:
                a[i]+=' '
    return a

def five(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i>0 and i<s+1:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>s+1 and i<2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def six(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i>s+1 and i<2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def seven(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            else:
                a[i]+=' '
    return a

def eight(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def nine(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i>0 and i<s+1:
                a[i]+='|'
            elif i==s+1 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==s+1 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a

def zero(s):
    a=[]
    for i in range(2*s+3):
        a.append("")
    for i in range(2*s+3):
        for j in range(s+2):
            if i==0 and j!=0 and j!=s+1:
                a[i]+='-'
            elif j==0 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif j==s+1 and i!=0 and i!=s+1 and i!=2*s+2:
                a[i]+='|'
            elif i==2*s+2 and j!=0 and j!=s+1:
                a[i]+='-'
            else:
                a[i]+=' '
    return a
                
while s!=0 or n!=0:
    size.append(s)
    count+=1
    number=str(n)
    answer=[]
    
    one_=one(s)
    two_=two(s)
    three_=three(s)
    four_=four(s)
    five_=five(s)
    six_=six(s)
    seven_=seven(s)
    eight_=eight(s)
    nine_=nine(s)
    zero_=zero(s)
    
    for i in range(2*s+3):
        answer.append('')
        for j in range(len(number)):
            if number[j]=='1':
                answer[i]+=one_[i]+' '
            elif number[j]=='2':
                answer[i]+=two_[i]+' '
            elif number[j]=='3':
                answer[i]+=three_[i]+' '
            elif number[j]=='4':
                answer[i]+=four_[i]+' '
            elif number[j]=='5':
                answer[i]+=five_[i]+' '
            elif number[j]=='6':
                answer[i]+=six_[i]+' '
            elif number[j]=='7':
                answer[i]+=seven_[i]+' '
            elif number[j]=='8':
                answer[i]+=eight_[i]+' '
            elif number[j]=='9':
                answer[i]+=nine_[i]+' '
            elif number[j]=='0':
                answer[i]+=zero_[i]+' '

    final.append(answer)
            
    x=raw_input("")
    s=int(x[:x.find(" ")])
    n=int(x[x.find(" ")+1:])

for i in range(count):
    for j in range(2*size[i]+3):
        print final[i][j]
    print
    
raw_input('Press any key to exit...')
