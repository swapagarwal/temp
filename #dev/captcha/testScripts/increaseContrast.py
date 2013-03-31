#!/usr/bin/python

import cv

grayImg = cv.LoadImage("../1.png", cv.CV_LOAD_IMAGE_GRAYSCALE)
mat = cv.GetMat(grayImg)
#cv.SaveImage("test.png", mat)

for i in range(mat.cols):
  for j in range(mat.rows):
    if mat[j,i] >= 180:
      mat[j,i] = 255
    else:
      mat[j,i] = 0

cv.SaveImage("test.png", mat)
