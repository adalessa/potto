ARG NODE_VERSION
FROM node:${NODE_VERSION}


RUN npm install -g yarn

WORKDIR /app

RUN usermod -u ${USER_UID} node

USER node