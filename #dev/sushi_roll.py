import os, sys
import Image, ImageGrab, ImageOps
import time, random
from random import randrange
import win32api, win32con
from numpy import *

#LEGEND:
#-----------------------
#Day 1 Goal: 800Yen  - Bot Score: 1440Yen
#Day 1 Goal: 1500Yen - Bot Score: 2740Yen 
#Day 3 Goal: 2300Yen - Bot Score: 3100Yen
#Day 4 Goal: 3200Yen - Bot Score: 6290Yen
#Day 5 Goal: 4200Yen - Bot Score: 6390Yen
#Day 6 Goal: 5300Yen - Bot Score: 6360Yen (this score was with a broken bot)
#Day 5 Goal: 6500Yen - Bot Score: Yen



#----------------------------


#Define play area
topLeft = (157,346)
bottomRight = (796,825)
xPad, yPad = 156, 345


##Grabs entire play area
def grab():
    box= (157,346,796,825)
    table = (157,556,796,557)
    im = ImageGrab.grab(box)
    im.save(os.getcwd() + '\\Grab001.png', 'PNG')
    return im


#pixlocation 380,183



def mousePos(x=(0,0)):
    win32api.SetCursorPos(x)



def getPlates(loc):
    box = (xPad, yPad+205, xPad+638, yPad+205)  
    im = ImageGrab.grab(box)
    
    return im.getpixel(loc)
    
     
def garbageCollection():
    mousePos((xPad+365,yPad+315))
    leftClick()
    time.sleep(.04)
    leftClick()
    leftClick()
    leftClick()
    time.sleep(.04)
    
    

#Big List of Seat Check Functions
#----------------------------------
##table color = 238,219,169
    
def getSeatOne():

    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+25,yPad+60,xPad+88,yPad+76)))
    a = array(im.getcolors())
##    im.save(os.getcwd() + '\\SeatOneBubble.png', 'PNG')
    print 'table 1 bubble = %d' % a.sum()
    return a.sum()
    

def getSeatTwo():
    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+126,yPad+60,xPad+189,yPad+76)))
##    im.save(os.getcwd() + '\\SeatTwoBubble.png', 'PNG')
    a = array(im.getcolors())
    print 'table 2 bubble = %d' % a.sum()
    return a.sum()

def getSeatThree():
    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+227,yPad+60,xPad+290,yPad+76)))
    a = array(im.getcolors())
##    im.save(os.getcwd() + '\\SeatThreeBubble.png', 'PNG')
    print 'table 3 bubble = %d' % a.sum()
    return a.sum()

def getSeatFour():
    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+328,yPad+60,xPad+391,yPad+76)))
    a = array(im.getcolors())
##    im.save(os.getcwd() + '\\SeatFourBubble.png', 'PNG')
    print 'table 4 bubble = %d' % a.sum()
    return a.sum()
    
def getSeatFive():
    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+429,yPad+60,xPad+492,yPad+76)))
    a = array(im.getcolors())
##    im.save(os.getcwd() + '\\SeatFiveBubble.png', 'PNG')
    print 'table 5 bubble = %d' % a.sum()
    return a.sum()
    
def getSeatSix():
    im = ImageOps.grayscale(ImageGrab.grab
                            ((xPad+530,yPad+60,xPad+593,yPad+76)))
    a = array(im.getcolors())
##    im.save(os.getcwd() + '\\SeatSixBubble.png', 'PNG')
    print 'table 6 bubble = %d' % a.sum()
    return a.sum()


##END getSeat Functions
#------------------------------------



#Begin Checkbubs
#------------------------------------

def checkBubs():
    garbageCollection()
    print 'CheckBubs() -- Begin'
    global s1cooking
    global s2cooking
    global s3cooking
    global s4cooking
    global s5cooking
    global s6cooking
    
    global cookTime1
    global cookTime2
    global cookTime3
    global cookTime4
    global cookTime5
    global cookTime6

    
    bareTable = (238,219,169)
    
    
    garbageCollection()
    s1 = getSeatOne()
    if blankBubs['s1'] == s1:
        s1cooking = False
    if (time.time() - cookTime1) > 15:
        s1cooking = False
    checkFood()
    if s1 != blankBubs['s1'] and s1cooking == False:
        if sushiTypes.has_key(s1):
            print 'table 1 is occupied and needs %s' % sushiTypes[s1]
            makeFood(sushiTypes[s1])
##            print sushiTypes[s1]*20
            s1cooking = True
            cookTime1 = time.time()
            
        else:
            'sushi not found!'
        
    else:
        print 'table one unoccupied'

    garbageCollection()
    
    s2 = getSeatTwo()
    if blankBubs['s2'] == True:
        s2cooking = False
    if (time.time() - cookTime2) > 14:
        s2cooking = False
        
    checkFood()
    if s2 != blankBubs['s2'] and s2cooking == False:
        if sushiTypes.has_key(s2):
            print 'table 2 is occupied and needs %s' % sushiTypes[s2]
            makeFood(sushiTypes[s2])
            s2cooking = True
            cookTime2 = time.time()
        else:
            'sushi not found!'
        
    else:
        print 'table two unoccupied'


    garbageCollection()

    s3 = getSeatThree()
    if blankBubs['s3'] == True:
        s3cooking = False
    if (time.time() - cookTime3) > 15:
        s3cooking = False
        
    checkFood()
    if s3 != blankBubs['s3']and s3cooking == False:
        if sushiTypes.has_key(s3):
            print 'table 3 is occupied and needs %s' % sushiTypes[s3]
            makeFood(sushiTypes[s3])
            s3cooking = True
            cookTime3 = time.time()
        else:
            'sushi not found!'
        
    else:
        print 'table three unoccupied'

    garbageCollection()

        
    checkFood()
    s4 = getSeatFour()
    if blankBubs['s4'] == True:
        s4cooking = False
    if (time.time() - cookTime4) > 16:
        s4cooking = False
    if s4 != blankBubs['s4'] and s4cooking == False:
        if sushiTypes.has_key(s4):
            print 'table 4 is occupied and needs %s' % sushiTypes[s4]
            makeFood(sushiTypes[s4])
            s4cooking = True
            cookTime4 = time.time()
        else:
            'sushi not found!'
        
    else:
        print 'table Four unoccupied'

    garbageCollection()

        
    checkFood()
    s5 = getSeatFive()
    if blankBubs['s5'] == True:
        s5cooking = False
    if (time.time() - cookTime5) > 17:
        s5cooking = False
    if s5 != blankBubs['s5'] and s5cooking == False:
        if sushiTypes.has_key(s5):
            print 'table 5 is occupied and needs %s' % sushiTypes[s5]
            makeFood(sushiTypes[s5])
            s5cooking = True
            cookTime5 = time.time()
        else:
            'sushi not found!'
        
    else:
        print 'table Five unoccupied'

    garbageCollection()

        
    checkFood()
    s6 = getSeatSix()
    if blankBubs['s6'] == True:
        s6cooking = False
    if (time.time() - cookTime6) > 18:
        s6cooking = False
    if s6 != blankBubs['s6'] and s6cooking == False:
        if sushiTypes.has_key(s6):
            print 'table 6 is occupied and needs %s' % sushiTypes[s6]
            makeFood(sushiTypes[s6])
            s6cooking = True
            cookTime6 = time.time()
        else:
            'sushi not found!'
        
    else:
        print 'table Six unoccupied'
        
    checkFood()
    clearTables()
    garbageCollection()
    print 'CheckBubs() -- End'

def foldMat():
    mousePos((xPad+150,yPad+370))
    leftClick()
##    time.sleep(1)
    #Above is temporary

def clearTables():
    mousePos(plateLoc['Mouse_t1'])
    leftClick()
    mousePos(plateLoc['Mouse_t2'])
    leftClick()
    mousePos(plateLoc['Mouse_t3'])
    leftClick()
    mousePos(plateLoc['Mouse_t4'])
    leftClick()
    mousePos(plateLoc['Mouse_t5'])
    leftClick()
    mousePos(plateLoc['Mouse_t6'])
    leftClick()
    garbageCollection()
    time.sleep(.1)
                      

    
def makeFood(food):
    rice = (xPad+90,yPad+330)
    nori = (xPad+30,yPad+380)
    roe  = (xPad+90,yPad+380)


    if food == 'caliroll':
        print 'Making a caliroll'
        foodOnHand['rice'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['roe'] -= 1
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(roe)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        time.sleep(1.5)
##        sys.exit()
    
    elif food == 'onigiri':
        print 'Making a onigiri'
        foodOnHand['rice'] -= 2
        foodOnHand['nori'] -= 1
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        time.sleep(1.5)
##        sys.exit()
    elif food == 'gunkan':
        print 'Making a gunkan'
        foodOnHand['rice'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['roe'] -= 2
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(roe)
        leftClick()
        time.sleep(.05)
        mousePos(roe)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        time.sleep(1.5)
        print foodOnHand.keys()
##        sys.exit()

    if food == 'salmon':
        print 'Making a salmonroll'
        foodOnHand['rice'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['salmon'] -= 2
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(salmon)
        leftClick()
        time.sleep(.1)
        mousePos(salmon)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        print foodOnHand.keys()
        time.sleep(1.5)
##        sys.exit()


    if food == 'shrimpsushi':
        print 'Making a shrimpSushi Roll'
        foodOnHand['rice'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['shrimp'] -= 2
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(shrimp)
        leftClick()
        time.sleep(.1)
        mousePos(shrimp)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        print foodOnHand.keys()
        time.sleep(1.5)
##        sys.exit()




    if food == 'unagiroll':
        print 'Making a unagiri Roll'
        foodOnHand['rice'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['unagi'] -= 2
        mousePos(rice)
        leftClick()
        time.sleep(.1)
        mousePos(nori)
        leftClick()
        time.sleep(.1)
        mousePos(unagi)
        leftClick()
        time.sleep(.1)
        mousePos(unagi)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        print foodOnHand.keys()
        time.sleep(1.5)
##        sys.exit()




    if food == 'dragonroll':
        print 'Making a dragon roll'
        foodOnHand['rice'] -= 1
        foodOnHand['roe'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['unagi'] -= 2
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(roe)
        leftClick()
        time.sleep(.05)
        mousePos(unagi)
        leftClick()
        time.sleep(.1)
        mousePos(unagi)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        print foodOnHand.keys()
        time.sleep(1.5)
##        sys.exit()




    if food == 'combo':
        foodOnHand['rice'] -= 2
        foodOnHand['roe'] -= 1
        foodOnHand['nori'] -= 1
        foodOnHand['unagi'] -= 1
        foodOnHand['salmon'] -= 1
        foodOnHand['shrimp'] -= 1
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(rice)
        leftClick()
        time.sleep(.05)
        mousePos(nori)
        leftClick()
        time.sleep(.05)
        mousePos(roe)
        leftClick()
        time.sleep(.05)
        mousePos(unagi)
        leftClick()
        time.sleep(.1)
        mousePos(shrimp)
        leftClick()
        time.sleep(.1)
        mousePos(salmon)
        leftClick()
        time.sleep(.1)
        foldMat()
        time.sleep(.05)
        garbageCollection()
        print foodOnHand.keys()
        time.sleep(1.5)
##        sys.exit()
        

def debugCheckBubbles():
    print getSeatOne()
    print getSeatTwo()
    print getSeatThree()
    print getSeatFour()
    print getSeatFive()
    print getSeatSix()
    

def checkFood():
    for i, j in foodOnHand.items():
        if i == 'nori' or i == 'rice' or i == 'roe':
            if j <= 4:
                print '%s is low and needs to be replenished' % i
    ##            time.sleep(1)
                buyFood(i)
        else:
            if j<4:
                print 'need to buy %s' % i
                print 'only have %d on hand' % j
                buyFood(i)

#
def buyFood(food):
    print 'buyFood()\n'*4


    
    if food == 'rice':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_rice'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel((520,270)) != (118,83,85):
            
            print 'rice is available'
            mousePos(menuLoc['Ord_rice'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['rice']+=10
            clearTables()
            time.sleep(2.5)
        else:
            if foodOnHand[food] >=3:
                print 's.getpixel() ==  %s' % str(s.getpixel((520,270)))
                print 'rice is NOT available'
                mousePos(menuLoc['SO_close'])
                leftClick()
            else:
                print ('rice is NOT available. Do not have enough to continue.\
                            Must wait')
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(1)
                clearTables()
                garbageCollection()
                buyFood(food)

#
    if food == 'shrimp':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_topping'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel(menuLoc['col_shrimp']) != (127,71,47):
            print 's.getpixel() ==  %s\n' % str(s.getpixel((520,270)))
            print 'shrimp is available\n'
            mousePos(menuLoc['T_shrimp'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['shrimp']+=5
            time.sleep(3)
        else:
            print 'Shrimp was not available!\n'*4
            if foodOnHand[food] >=2:
                print 's.getpixel() ==  %s' % str(s.getpixel((520,270)))
                print 'shrimp is NOT available'
                mousePos(menuLoc['SO_close'])
                time.sleep(.1)
                leftClick()
            else:
                print ('shrimp is NOT available. Cannot continue \
                        until replenished')
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(1)
                clearTables()
                garbageCollection()
                buyFood(food) 





    if food == 'unagi':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_topping'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel(menuLoc['col_unagi']) != (94,49,8):
            
            print 'unagi is available\n'
            mousePos(menuLoc['T_unagi'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['unagi']+=5
            time.sleep(3)
        else:
            if foodOnHand[food] >=2:
                print 's.getpixel() ==  %s' % str(s.getpixel((520,270)))
                print 'unagi is NOT available'
                mousePos(menuLoc['SO_close'])
                leftClick()
            else:
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(1)
                clearTables()
                garbageCollection()
                buyFood(food)



    if food == 'nori':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_topping'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel(menuLoc['col_nori']) != (33,30,11):
            print 's.getpixel() ==  %s\n' % str(s.getpixel((520,270)))
            print 'nori is available'
            mousePos(menuLoc['T_nori'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['nori']+=10
            time.sleep(3)
        else:
            if foodOnHand[food] >=3:
                print 's.getpixel() ==  %s' % str(s.getpixel((520,270)))
                print 'nori is NOT available\n'
                mousePos(menuLoc['SO_close'])
                leftClick()
            else:
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(1)
                clearTables()
                garbageCollection()
                buyFood(food)
            



    if food == 'roe':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_topping'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel(menuLoc['col_roe']) != (127,61,0):
            print 's.getpixel() ==  %s\n' % str(s.getpixel((520,270)))
            print 'roe is available'
            mousePos(menuLoc['T_roe'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['roe']+=10
            time.sleep(3)
        else:
            if foodOnHand[food] >=3:    
                print 'roe is NOT available\n'
                mousePos(menuLoc['SO_close'])
                leftClick()
                time.sleep(2)
            else:
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(1)
                clearTables()
                garbageCollection()
                buyFood(food)



    if food == 'salmon':
        mousePos(menuLoc['phone'])
        time.sleep(.1)
        leftClick()
        mousePos(menuLoc['SO_topping'])
        time.sleep(.1)
        leftClick()
        s = grab()
        if s.getpixel(menuLoc['col_salmon']) != (127,71,47):
            
            print 'salmon is available\n'
            mousePos(menuLoc['T_salmon'])
            time.sleep(.1)
            leftClick()
            mousePos(menuLoc['D_normal'])
            time.sleep(.1)
            leftClick()
            foodOnHand['salmon']+=5
            time.sleep(3)
        else:
            if foodOnHand[food] >=2:    
                print 'salmon is NOT available'
                mousePos(menuLoc['SO_close'])
                leftClick()
            else:
                mousePos(menuLoc['SO_close'])
                leftClick()
                clearTables()
                garbageCollection()
                time.sleep(2)
                clearTables()
                garbageCollection()
                buyFood(food) 


##
##menuLoc = {'phone':         mousePos((xPad+550,yPad+406)),
##           'SO_rice':       mousePos((xPad+505,yPad+290)),
##           'Ord_rice':      mousePos((xPad+540,yPad+290)),
##           'SO_topping':    mousePos((xPad+505,yPad+270)),
##           'SO_sake':       mousePos((xPad+505,yPad+315)),
##           'SO_close':      mousePos((xPad+588,yPad+342)),
##           'T_shrimp':      mousePos((xPad+480,yPad+220)),
##           'T_unagi':       mousePos((xPad+560,yPad+220)),
##           'T_nori':        mousePos((xPad+480,yPad+280)),
##           'T_roe':         mousePos((xPad+580,yPad+280)),
##           'T_salmon':      mousePos((xPad+480,yPad+330)),
##           'T_close':       mousePos((xPad+595,yPad+335)),
##           'D_normal':      mousePos((xPad+490,yPad+290)),
##           'D_express':     mousePos((xPad+580,yPad+290)),}
    

def leftClick():
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTDOWN,0,0)
    time.sleep(.01)
    win32api.mouse_event(win32con.MOUSEEVENTF_LEFTUP,0,0)
    print "Click."
    time.sleep(.01)

#----------------------------------------------------------------------------
#
#Specific game actions

def clickPlay():
    mousePos((xPad+380 , yPad+183))
    leftClick()

#--------------------------

#GLOBALS

blankBubs = {'s1':6588,
             's2':5986,
             's3':11698,
             's4':10724,
             's5':7249,
             's6':8921}


sushiTypes = {3954:'onigiri', 
              4427:'caliroll',
              3961:'gunkan',
              3758:'salmon',
              4205:'shrimpsushi',
              4177:'unagiroll',
              4424:'dragonroll',
              4422:'dragonroll',
              4431:'combo',
              4461:'combo'}




toMake = {'onigiri':0,
           'caliroll':0,
           'gunkan':0}


plateLoc = {'t1':(90,0),
            't2':(191,0),
            't3':(292,0),
            't4':(393,0),
            't5':(464,0),
            't6':(595,0),
            'Mouse_t1':(xPad+90, yPad+205),
            'Mouse_t2':(xPad+191,yPad+205),
            'Mouse_t3':(xPad+292,yPad+205),
            'Mouse_t4':(xPad+393,yPad+205),
            'Mouse_t5':(xPad+494,yPad+205),
            'Mouse_t6':(xPad+595,yPad+205)}


foodOnHand = {'shrimp':5,
              'rice':10,
              'nori':10,
              'roe':10,
              'salmon':5,
              'unagi':5} 




rice =    (xPad+90,yPad+330)
shrimp =  (xPad+30,yPad+330)
nori =    (xPad+30,yPad+380)
roe  =    (xPad+90,yPad+380)
salmon=   (xPad+30,yPad+430)
unagi=    (xPad+90,yPad+430)

s1cooking = False
cookTime1 = 0

s2cooking = False
cookTime2 = 0

s3cooking = False
cookTime3 = 0

s4cooking = False
cookTime4 = 0

s5cooking = False
cookTime5 = 0

s6cooking = False
cookTime6 = 0


menuLoc = {'phone':         (xPad+550,yPad+406),
           'SO_rice':       (xPad+505,yPad+290),
           'Ord_rice':      (xPad+540,yPad+290),
           'SO_topping':    (xPad+505,yPad+270),
           'SO_sake':       (xPad+505,yPad+315),
           'SO_close':      (xPad+588,yPad+342),
           'T_shrimp':      (xPad+480,yPad+220),
           'T_unagi':       (xPad+560,yPad+220),
           'T_nori':        (xPad+480,yPad+280),
           'T_roe':         (xPad+580,yPad+280),
           'T_salmon':      (xPad+480,yPad+330),
           'T_close':       (xPad+595,yPad+335),
           'D_normal':      (xPad+490,yPad+290),
           'D_express':     (xPad+580,yPad+290),


           'col_shrimp':      (480,220),
           'col_unagi':       (560,220),
           'col_nori':        (480,280),
           'col_roe':         (580,280),
           'col_salmon':      (480,330),}
           
            
    



def main():
    grab()
##    print 'Ran Main()'
##    while True:
##        checkBubs()
    


if __name__ == '__main__':
    main()

    













    
##    b = getSeatOne()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'
##
##    b = getSeatTwo()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'
##
##    b = getSeatThree()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'
##
##    b = getSeatFour()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'
##
##    b = getSeatFive()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'
##
##    b = getSeatSix()
##    if all(a==b):
##        print 'true'
##    else:
##        print 'false'

   
    
