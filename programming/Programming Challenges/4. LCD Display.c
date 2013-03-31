#include<stdio.h>
#include<conio.h>
char one(int size);
void main()
{
	printf("%s",one(2));
}
one(size)
{
	int i,j;
	char a[2*size+3][size+2];
    for (i=0;i<2*size+3;i++)
	{
		for (j=0;j<size+2;j++)
		{
			if (j==size+1 && i!=0 && i!=size+1 && i!=2*size+2)
			{
				a[i][j]='|';
			} 
            else
			{
				a[i][j]=' ';
			}
		}
	}
    return a;
}