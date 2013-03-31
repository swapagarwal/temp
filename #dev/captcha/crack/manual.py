from PIL import Image
img = Image.open('final.png')

img.crop((10,0,47,54)).save('output/1.png')

img.crop((54,0,88,54)).save('output/2.png')

img.crop((105,0,142,54)).save('output/3.png')

img.crop((160,0,198,54)).save('output/4.png')

img.crop((208,0,241,54)).save('output/5.png')
