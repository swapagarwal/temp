#include<stdio.h>
#include<conio.h>
void main()
{
	int i,j,k,n,length,max=0;
	scanf("%d %d",&i,&j);
	for (k=i;k<=j;k++)
	{
		n=k;
		length=1;
		while(n!=1)
		{
			if (n%2==0)
			{
				n/=2;
				length+=1;
			}
			else
			{
				n=3*n+1;
				length+=1;
			}
		}
		if (length>max)
		{
			max=length;
		}
	}
	printf("%d %d %d",i,j,max);
}