import os
import cv2
import time
import numpy as np
import mysql.connector
from mysql.connector import Error
from mysql.connector import errorcode
from twilio.rest import Client


face_cascade=cv2.CascadeClassifier('haarcascade_frontalface_default.xml')

cap = cv2.VideoCapture(0)

count = 0

while True:
    _, img = cap.read()

    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    faces = face_cascade.detectMultiScale(gray, 1.1, 4)

    for (x,y,w,h) in faces:
        cv2.rectangle(img, (x,y), (x+w, y+h), (255,0,0), 2)

        cv2.imshow('img', img)
        t = time.strftime("%Y-%m-%d_%H-%M-%S")

        print("Image "+t+" saved")
        file = 'D:/DOCUMENTS/xampp\htdocs/cameraDetection/py/capture_images/images/'+t+'.jpg'
        cv2.imwrite(file,img)
        count+=1

        try:
            connection = mysql.connector.connect(host='localhost',
                                                    database='thesis_spc',
                                                    user='root',
                                                    password='')
            mySql_insert_query = """INSERT INTO images (image) 
                                    VALUES 
                                    ('image') """

            cursor = connection.cursor()
            cursor.execute(mySql_insert_query)
            connection.commit()
            print(cursor.rowcount, "Record inserted successfully into Images table")
            cursor.close()

        except mysql.connector.Error as error:
            print("Failed to insert record into Laptop table {}".format(error))

        finally:
            if (connection.is_connected()):
                connection.close()
                print("MySQL connection is closed")
                break

    k = cv2.waitKey(30) & 0xff
    if k == 27:
        break

cap.release()


account_sid = ''
auth_token = ''
client = Client(account_sid, auth_token)

message = client.messages.create(
    to = '',
    from_= '',
    body = 'Intruder Detected! Be Alert!'
)

print(message.sid)