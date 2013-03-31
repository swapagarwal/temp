#!/usr/bin/python
# Author : Rajat Khanduja
# Date : 15/1/13
# 
# This program is meant to modify the input image so that the noise is removed
# and the image is obtained in a format in which it is possible to differentiate
# between different characters.

import cv
import sys
from contrast import increaseContrast, averageMat
from histogram import createHistogram

image = sys.argv[1]

grayImg = cv.LoadImage(image, cv.CV_LOAD_IMAGE_GRAYSCALE)
mat = cv.GetMat(grayImg)

tmpArr = createHistogram(mat, 255)
minimas = []


image = sys.argv[1]

grayImg = cv.LoadImage(image, cv.CV_LOAD_IMAGE_GRAYSCALE)
mat = cv.GetMat(grayImg)

#t = increaseContrast(averageMat(averageMat(mat)))
t = increaseContrast(averageMat(averageMat(averageMat(averageMat(mat)))))
#cv.SaveImage(image + "_avg", t)
eroded = cv.CreateMat(t.rows, t.cols, t.type)
dilated = cv.CreateMat(t.rows, t.cols, t.type)
morphGrad = cv.CreateMat(t.rows, t.cols, t.type)

cv.Erode (t, eroded)
cv.Dilate(t, dilated)

for i in range(dilated.rows):
  for j in range(dilated.cols):
    morphGrad[i,j] = dilated[i,j] - eroded[i,j]

cv.SaveImage(image + "_avg_morphed", morphGrad)

hist = createHistogram(morphGrad, 255)
onGoingCut = False
cuts = []
segments = []
for i in range(len(hist)):
  if not onGoingCut and hist[i] > 0:
    cuts.append(i)
    onGoingCut = True
  elif onGoingCut:
    if i - cuts[-1] > 31:
      if hist[i] == 0: #or (hist[i] < hist[i - 1] and (i < len(hist) - 1 and hist[i] < hist[i + 1])):
        segments.append( (cuts[-1], i))
        cuts.append (i)
        onGoingCut = False

#for j in cuts:
#  for i in range(morphGrad.rows):
#    morphGrad[i,j] = 255

idx = 1
for segment in segments:
  print segment
  tmpMat = cv.CreateMat(morphGrad.rows, segment[1] - segment[0] + 1, morphGrad.type)
  for i in range(tmpMat.rows):
    for j in range(tmpMat.cols):
      tmpMat[i,j] = morphGrad[i, segment[0] + j]
  cv.SaveImage(image + "_cut_" + str(idx), tmpMat)
  idx += 1
 
cv.SaveImage(image + "_avg_morphed_cuts", morphGrad)
