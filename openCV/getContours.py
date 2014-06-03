import numpy as np
import cv2
import sys
import json
if len(sys.argv) == 4:
	imgFile = sys.argv[1]
	pointX = float(sys.argv[2])
	pointY = float(sys.argv[3])
	img = cv2.imread(imgFile)
	if (np.any(img)):
		imgray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
		ret,thresh = cv2.threshold(imgray,127,255,0)
		contours, hierarchy = cv2.findContours(thresh,cv2.RETR_TREE,cv2.CHAIN_APPROX_TC89_L1 )
		height, width = imgray.shape
		for (i,contour) in enumerate (contours):
			if hierarchy[0][i][2] == -1 :
				if cv2.pointPolygonTest(contour,(pointX, pointY), 0) > 0  :
					#newimg = np.zeros((height, width, 3), np.uint8)
					#cv2.drawContours(newimg, contours, i, (0,255,0), 3)
					#cv2.imwrite(`i`+'plantao.jpg', newimg)
					ret = [];
					for vertex in contour:
						ret.append(vertex[0].tolist())
					print ret
					exit(0)

	else:
		print "arquivo ruim"
else:
	print "getCountours.py imgFile pointX pointY"