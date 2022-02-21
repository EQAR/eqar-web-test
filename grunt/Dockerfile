FROM node:latest

RUN mkdir /workdir
WORKDIR /workdir

RUN mkdir src
RUN mkdir -p public/css
RUN mkdir -p public/js

COPY package.json ./

RUN npm install --no-audit --no-fund

RUN npm install --global --no-audit --no-fund grunt-cli

ENTRYPOINT [ "/usr/local/bin/grunt" ]
CMD [ "default" ]

