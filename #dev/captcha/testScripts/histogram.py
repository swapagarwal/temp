#!/usr/bin/python
# Author : Rajat Khanduja
# Date : 23/1/13


def createHistogram(mat, value):
  ''' This function basically creates an array of size of the number of columns
      in mat and gives a count of elements that match a particular value.
  '''
  
  counts = [0] * mat.cols
  for j in range(mat.cols): 
    for i in range(mat.rows):
      if mat[i,j] == value:
        counts[j] += 1

  return counts
