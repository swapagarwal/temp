"""
firefox max;bookmarks toolbar enabled
mouse wheel rorated 2 times
x_pad=156
y_pad=154
Play Area=x_pad+1,y_pad+1,797,634
"""
import ImageGrab,os,time

x_pad=156
y_pad=154

def screenGrab():
    box=(x_pad+1,y_pad+1,x_pad+641,y_pad+480)
    im=ImageGrab.grab(box)
    im.save(os.getcwd()+'\\full_snap__'+str(int(time.time()))+'.png','PNG')

def main():
    screenGrab()

if __name__=='__main__':
    main()
