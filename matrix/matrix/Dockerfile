FROM ubuntu:latest

#install software-properties to add ppa repository
RUN apt-get update && apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php && apt-get update  

#install php7.3
RUN apt-get install -y php7.3 curl php7.3-xml

#install node and npm
RUN curl -sL https://deb.nodesource.com/setup_12.x  | bash -
RUN apt-get install -y nodejs

#make room for app
RUN mkdir -p matrix-app
COPY . /matrix-app

#build vue project
RUN cd ./matrix-app && npm run dev