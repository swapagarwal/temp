import numpy as np
import cv 

gray = cv.LoadImageM('../1.png', cv.CV_LOAD_IMAGE_GRAYSCALE)
#blur = cv.GaussianBlur(gray,(5,5),0)
blur = gray
#thresh = cv.AdaptiveThreshold(blur,255,1,1,11,2)
thresh = blur

#################      Now finding Contours         ###################

tmp = cv.CreateMemStorage(255*255)
contours = cv.FindContours(thresh, tmp, cv.CV_RETR_LIST,cv.CV_CHAIN_APPROX_SIMPLE)

samples =  np.empty((0,100))
responses = []
keys = [i for i in range(48,58)]

for cnt in contours:
    if cv.ContourArea(cnt)>50:
        [x,y,w,h] = cv.BoundingRect(cnt)

        if  h>28:
            cv.Rectangle(im,(x,y),(x+w,y+h),(0,0,255),2)
            roi = thresh[y:y+h,x:x+w]
            roismall = cv.Resize(roi,(10,10))
#            cv.Imshow('norm',im)
            key = cv.WaitKey(0)

            if key == 27:
                sys.exit()
            elif key in keys:
                responses.append(int(chr(key)))
                sample = roismall.reshape((1,100))
                samples = np.append(samples,sample,0)

responses = np.array(responses,np.float32)
responses = responses.reshape((responses.size,1))
print "training complete"

np.savetxt('generalsamples.data',samples)
np.savetxt('generalresponses.data',responses)
