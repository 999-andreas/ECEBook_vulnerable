import requests
from bs4 import BeautifulSoup as bs
import pandas as pd
import csv
import mysql.connector
import numpy as np
import os

os.system('pip install requests')
os.system('pip install bs4')


r = requests.get('https://www.lemonde.fr/')
soup = bs(r.content, 'html.parser')
#s = soup.find('div', class_='article article--main')

#main_article = soup.find('p', {'class': 'article__desc'})
#print(main_article.text)

def insert_articles():
    F = open('news.csv', 'a')
    s = soup.find_all('p', {'class': 'article__title'})
    db = mysql.connector.connect(
        host = "localhost",
        user = "root",
        password = "",
        database = "ecebook"
    )

    cursor = db.cursor()


    i = 0
    for l in s:
        i += 1
        if i == 2:
            break
        else:
            F.write(l.text.strip()+",\n")
            print("News n°", i,": ", str(l.text.strip()))
            #cursor.execute("INSERT INTO `posts` (`id`, `title`) VALUES (NULL, %s);", (l.text.strip(),))
            #query = "INSERT INTO `post` (`id_post`, `message`, `image`, `commantaires`, `nomcrea`, `titre`, `id_user`, `pseudo`, `publique`, `date`) VALUES (NULL, '{}', '{}', '{}', '{}', '{}', '{}', '{}', NULL, NULL);".format('cd', 'cd', 'cd', 'cd', l.text.strip(), '98', 'cd')
            query = "INSERT INTO `post` (`id_post`, `message`, `image`, `nomcrea`, `titre`, `id_user`, `nom`, `publique`, `date`) VALUES (NULL, 'test', 'cd', 'cd', '{}', '121', 'cd', NULL, CURRENT_TIMESTAMP);".format(l.text.strip())
            cursor.execute(query)
            db.commit()
            db.close()
    F.close()

insert_articles()