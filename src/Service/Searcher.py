from selenium import webdriver
from selenium.webdriver.firefox.options import Options
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.by import By
from selenium.webdriver.support import expected_conditions as EC
from time import sleep
import datetime
import sys
import os

### Dirige le navigateur vers le planning de la classe ###
def go_to_youtube(browser):
    browser.get('https://www.youtube.com/?hl=fr&gl=FR')
    while True:
        try:
            WebDriverWait(browser,10).until(EC.presence_of_element_located((By.ID, "primary")))
            break
        except:
            sleep(3)
            
### Lance la recherche de vidéo youtube par mots clés ###
def search(browser, mots_cles):
    m_c = mots_cles.replace(" ", "+")
    browser.get('https://www.youtube.com/results?search_query={}'.format(m_c))
    sleep(2)
    while True:
        try:
            WebDriverWait(browser,10).until(EC.presence_of_element_located((By.ID, "button")))
            break
        except:
            sleep(3)
   
    user_data = browser.find_elements_by_xpath('//*[@id="video-title"]')
    links = []
    titles = []
    for i in user_data:
            links.append(i.get_attribute('href'))
            titles.append(i.get_attribute('title'))
    print(links[0])
    print(links[1])
    print(links[2])
    print(mots_cles)
   
### Navigation vers Youtube afin de faire notre recherche ###    
options = Options()
options.headless = True
browser = webdriver.Firefox(options=options, executable_path=r'/root/geckodriver')
go_to_youtube(browser)
search(browser, sys.argv[1])

### Nettoyage ###
browser.close()
os.system('pkill firefox')
