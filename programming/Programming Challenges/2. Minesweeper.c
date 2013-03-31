#include<stdio.h>
#include<conio.h>

int max(int a,int b );
int min(int a,int b );

void main()
{
	int n,m,i,j,a,b,mines,count=0;
	scanf("%d %d",&n,&m);
	while(n!=0||m!=0)
	{
		count+=1;
		char field[n][m];
		for (i=0;i<n;i++)
		{
			scanf("%s",&field[i]);
		}
		char uncovered[n][m+1];
		for (i=0;i<n;i++)
		{
			for (j=0;j<m;j++)
			{
				mines=0;
				if (field[i][j]=='.')
				{
					for (a=max(0,i-1);a<min(i+2,n);a++)
					{
						for(b=max(0,j-1);b<min(j+2,m);b++)
						{
							if(field[a][b]=='*')
							{
								mines+=1;
							}
						}
					}
					uncovered[i][j]='0'+mines;
				}
				else
				{
					uncovered[i][j]='*';
				}
				uncovered[i][j+1]='\n';
			}
		}
		uncovered[n-1][m]='\0';
		printf("Field #%d:\n",count);
		printf("%s\n\n",uncovered);
		scanf("%d %d",&n,&m);
	}
}

max(a,b)
{return a>b?a:b;}
min(a,b)
{return a<b?a:b;}