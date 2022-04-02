# You can Launch app in 2 ways

### option 1  manually using php 
```
cd src/public
php -S localhost:8989
```


# or Install docker
### https://docs.docker.com/engine/install/ubuntu/
```
sudo apt-get remove docker docker-engine docker.io containerd runc
sudo apt-get update
 sudo apt-get install \
    ca-certificates \
    curl \
    gnupg \
    lsb-release
 curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
 sudo apt-get install docker-ce docker-ce-cli containerd.io docker-compose
```

To get app working
```
cd docker;
sudo docker-compose up


# to make it daemon 
sudo docker-compose up -d 
```

###  Browse to : http://localhost:8989/


## If launched as daemon to kill process:

```
sudo docker ps


CONTAINER ID   IMAGE               COMMAND                  CREATED         STATUS         PORTS                                   NAMES
9b97cacb1813   nginx:1.19-alpine   "/docker-entrypoint.…"   5 minutes ago   Up 3 minutes   0.0.0.0:8000->80/tcp, :::8000->80/tcp   myphpdockertest-nginx
7054986427e3   docker_app          "docker-php-entrypoi…"   5 minutes ago   Up 3 minutes   9000/tcp                                myphpdockertest-app



sudo docker kill 9b97cacb1813
sudo docker kill 7054986427e3
```


