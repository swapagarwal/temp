import win32api,win32con,ImageGrab,os,time,ImageOps
from numpy import *
x_pad=156
y_pad=154
def screenGrab():
    box=(x_pad+1,y_pad+1,x_pad+641,y_pad+480)
    im=ImageGrab.grab()
    #im.save(os.getcwd()+'\\full_snap__'+str(int(time.time()))+'.png','PNG')
    return im
def grab():
    box=(x_pad+1,y_pad+1,x_pad+641,y_pad+480)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    return a
def leftClick():
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTDOWN,0,0)
    time.sleep(.1)
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTUP,0,0)
    #print "Click."

def leftDown():
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTDOWN,0,0)
    time.sleep(.1)
    print "left Down"

def leftUp():
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTUP,0,0)
    time.sleep(.1)
    print "left Release"

def mousePos(cord):
    win32api.SetCursorPos((x_pad+cord[0],y_pad+cord[1]))

def get_cords():
    x,y=win32api.GetCursorPos()
    x=x-x_pad
    y=y-y_pad
    print x,y

def startGame():
    #location of first menu - play
    mousePos((316,198))
    leftClick()
    time.sleep(.1)

    #location of second menu - skip iphone ad;continue
    mousePos((319,386))
    leftClick()
    time.sleep(.1)

    #location of fourth menu - skip tutorial
    mousePos((582,444))
    leftClick()
    time.sleep(.1)

    #location of third menu - todays goal;continue
    mousePos((318,395))
    leftClick()
    time.sleep(.1)


class Cord:

    f_shrimp=(38,326)
    f_rice=(94,329)
    f_nori=(35,382)
    f_roe=(88,382)
    f_salmon=(36,434)
    f_unagi=(90,436)

    phone=(585,351)

    menu_toppings=(521,272)

    t_shrimp=(494,220)
    t_nori=(498,270)
    t_roe=(576,273)
    t_salmon=(491,327)
    t_unagi=(569,219)
    t_exit=(592,327)

    menu_rice=(541,294)
    buy_rice=(546,275)

    delivery_norm=(490,288)

def clear_tables():
    mousePos((83,196))
    leftClick()
    mousePos((177,202))
    leftClick()
    mousePos((276,204))
    leftClick()
    mousePos((376,202))
    leftClick()
    mousePos((477,203))
    leftClick()
    mousePos((581,203))
    leftClick()
    time.sleep(1)
    
def makeFood(food):
    if food=='caliroll':
        print 'Making a caliroll'
        foodOnHand['rice']-=1
        foodOnHand['nori']-=1
        foodOnHand['roe']-=1
        mousePos(Cord.f_rice)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_nori)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_roe)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(1.5)
    elif food=='onigiri':
        print 'Making an  onigiri'
        foodOnHand['rice']-=2
        foodOnHand['nori']-=1
        mousePos(Cord.f_rice)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_rice)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_nori)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(1.5)
    elif food=='gunkan':
        print 'Making a gunkan'
        foodOnHand['rice']-=1
        foodOnHand['nori']-=1
        foodOnHand['roe']-=2
        mousePos(Cord.f_rice)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_nori)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_roe)
        leftClick()
        time.sleep(.05)
        mousePos(Cord.f_roe)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(1.5)

def foldMat():
    mousePos((Cord.f_rice[0]+40,Cord.f_rice[1]))
    leftClick()
    time.sleep(.1)

def buyFood(food):
    if food=='rice':
        mousePos(Cord.phone)
        time.sleep(.1)
        leftClick()
        mousePos(Cord.menu_rice)
        time.sleep(.05)
        leftClick()
        s=screenGrab()
        if s.getpixel(Cord.buy_rice)!=(239, 212, 140):
            print 'rice available'
            mousePos(Cord.buy_rice)
            time.sleep(.1)
            leftClick()
            mousePos(Cord.delivery_norm)
            foodOnHand['rice']+=10
            time.sleep(.1)
            leftClick()
            time.sleep(2.5)
        else:
            print 'rice NOT available'
            mousePos(Cord.t_exit)
            leftClick()
            time.sleep(1)
            buyFood(food)
    if food=='nori':
        mousePos(Cord.phone)
        time.sleep(.1)
        leftClick()
        mousePos(Cord.menu_toppings)
        time.sleep(.05)
        leftClick()
        s=screenGrab()
        print 'test'
        time.sleep(.1)
        if s.getpixel(Cord.t_nori)!=(132, 62, 23):
            print 'nori available'
            mousePos(Cord.t_nori)
            time.sleep(.1)
            leftClick()
            mousePos(Cord.delivery_norm)
            foodOnHand['nori']+=10
            time.sleep(.1)
            leftClick()
            time.sleep(2.5)
        else:
            print 'nori NOT available'
            mousePos(Cord.t_exit)
            leftClick()
            time.sleep(1)
            buyFood(food)
    if food=='roe':
        mousePos(Cord.phone)
        time.sleep(.1)
        leftClick()
        mousePos(Cord.menu_toppings)
        time.sleep(.05)
        leftClick()
        s=screenGrab()
        if s.getpixel(Cord.t_roe)!=(225, 181, 105):
            print 'roe available'
            mousePos(Cord.t_roe)
            time.sleep(.1)
            leftClick()
            mousePos(Cord.delivery_norm)
            foodOnHand['roe']+=10
            time.sleep(.1)
            leftClick()
            time.sleep(2.5)
        else:
            print 'roe NOT available'
            mousePos(Cord.t_exit)
            leftClick()
            time.sleep(1)
            buyFood(food)    

foodOnHand={'shrimp':5,
            'rice':10,
            'nori':10,
            'roe':10,
            'salmon':5,
            'unagi':5}
def checkFood():
    for i,j in foodOnHand.items():
        if i=='nori' or i=='rice' or i=='roe':
            if j<=4:
                print '%s is low and needs to be replenished' %i
                buyFood(i)

def get_seat_one():
    box=(x_pad+26,y_pad+61,x_pad+26+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_one__'+str(int(time.time()))+'.png','PNG')
    return a

def get_seat_two():
    box=(x_pad+127,y_pad+61,x_pad+127+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_two__'+str(int(time.time()))+'.png','PNG')
    return a

def get_seat_three():
    box=(x_pad+228,y_pad+61,x_pad+228+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_three__'+str(int(time.time()))+'.png','PNG')
    return a

def get_seat_four():
    box=(x_pad+329,y_pad+61,x_pad+329+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_four__'+str(int(time.time()))+'.png','PNG')
    return a

def get_seat_five():
    box=(x_pad+430,y_pad+61,x_pad+430+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_five__'+str(int(time.time()))+'.png','PNG')
    return a

def get_seat_six():
    box=(x_pad+531,y_pad+61,x_pad+531+63,y_pad+61+16)
    im=ImageOps.grayscale(ImageGrab.grab(box))
    a=array(im.getcolors())
    a=a.sum()
    print a
    im.save(os.getcwd()+'\\seat_six__'+str(int(time.time()))+'.png','PNG')
    return a

def get_all_seats():
    get_seat_one()
    get_seat_two()
    get_seat_three()
    get_seat_four()
    get_seat_five()
    get_seat_six()

sushiTypes={2670:'onigiri',
            3143:'caliroll',
            2677:'gunkan'}

class Blank:
    seat_1=8119
    seat_2=5986
    seat_3=11596
    seat_4=10613
    seat_5=7286
    seat_6=9119

def check_bubs():
    checkFood()
    s1=get_seat_one()
    if s1!=Blank.seat_1:
        if sushiTypes.has_key(s1):
            print 'table 1 is occupied and needs %s' %sushiTypes[s1]
            makeFood(sushiTypes[s1])
        else:
            print 'sushi not found!\n sushiType=%i'%s1
    else:
        print 'table 1 unoccupied'

    clear_tables()
    checkFood()
    s2=get_seat_two()
    if s2!=Blank.seat_2:
        if sushiTypes.has_key(s2):
            print 'table 2 is occupied and needs %s' %sushiTypes[s2]
            makeFood(sushiTypes[s2])
        else:
            print 'sushi not found!\n sushiType=%i'%s2
    else:
        print 'table 2 unoccupied'

    checkFood()
    s3=get_seat_three()
    if s3!=Blank.seat_3:
        if sushiTypes.has_key(s3):
            print 'table 3 is occupied and needs %s' %sushiTypes[s3]
            makeFood(sushiTypes[s3])
        else:
            print 'sushi not found!\n sushiType=%i'%s3
    else:
        print 'table 3 unoccupied'

    checkFood()
    s4=get_seat_four()
    if s4!=Blank.seat_4:
        if sushiTypes.has_key(s4):
            print 'table 4 is occupied and needs %s' %sushiTypes[s4]
            makeFood(sushiTypes[s4])
        else:
            print 'sushi not found!\n sushiType=%i'%s4
    else:
        print 'table 4 unoccupied'

    clear_tables()
    checkFood()
    s5=get_seat_five()
    if s5!=Blank.seat_5:
        if sushiTypes.has_key(s5):
            print 'table 5 is occupied and needs %s' %sushiTypes[s5]
            makeFood(sushiTypes[s5])
        else:
            print 'sushi not found!\n sushiType=%i'%s5
    else:
        print 'table 5 unoccupied'

    checkFood()
    s6=get_seat_six()
    if s6!=Blank.seat_6:
        if sushiTypes.has_key(s6):
            print 'table 6 is occupied and needs %s' %sushiTypes[s6]
            makeFood(sushiTypes[s6])
        else:
            print 'sushi not found!\n sushiType=%i'%s6
    else:
        print 'table 6 unoccupied'

    clear_tables()

def main():
    startGame()
    while True:
        check_bubs()
