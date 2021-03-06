# PYGTFTK WEBAPP

## About :

This is the implementation of the pygtftk program as a web application using the LARAVEL framework.


## Prerequisites :

You must have Docker and Docker Compose installed on your computer to launch the application correctly.

If you need to install these components follow the instructions on the following website depending on your operating system : 
- https://docs.docker.com/compose/install/

=> It is recommended to install docker version 20.10 or above and docker-compose version 1.25 or above.

You also need Git in order to clone the repository locally :
- https://git-scm.com/book/en/v2/Getting-Started-Installing-Git


## Getting Started :

Once you have Docker Compose set up you can run the following commands :

```bash
git clone https://github.com/Ouertani95/Web_OLOGRAM
cd Web_OLOGRAM/
docker build -f Dockerfile-pygtftk-conda -t gtftk:staging .
sudo groupadd docker
sudo adduser sail
usermod -aG docker sail
newgrp docker

```

## Usage :

Type the following comands to launch the webapplication :

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
sail up -d
sail artisan migrate
```
Now open your web browser and go to localhost.
You should have the following page :

![laravel](photos/Latest_interface_Web-OLOGRAM_08-07-22.png)

## Troubleshooting :

If you have a problem running sail commands or docker without root priviliges type the following commands :

```bash
sudo groupadd docker
sudo usermod -aG docker $USER
newgrp docker
```

Now you can run any docker or sail command from your account.

## Authors :

**Mohamed Ouertani**