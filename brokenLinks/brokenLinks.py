# -*- coding: utf-8 -*-
import urllib.request, re, sys
alreadyChecked  = []

if len(sys.argv) < 2:
    print("Usage: "+sys.argv[0]+" [url]")
    exit()
base_url    = sys.argv[1]

def checkLinks(urls):
    for url in urls:
        url = url[6:]

        if url in alreadyChecked:
            continue
        alreadyChecked.append(url)
        try:
            url_code  = urllib.request.urlopen(url).getcode()
            if url_code == 200:
                if re.search(base_url, url):
                    response = urllib.request.urlopen(url).read()
                    response = re.findall('href="http://[^"]*', str(response))
                    checkLinks(response)
            else:
                print('Site not found:'+url)
        except:
            print('Error: '+url)
            continue

urls        = urllib.request.urlopen(base_url).read()
urls        = re.findall('href="http://[^"]*', str(urls))

checkLinks(urls)
