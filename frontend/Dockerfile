FROM node:10-alpine

WORKDIR /usr/app

COPY ./package.json ./

RUN yarn global add @vue/cli && yarn install

COPY . /usr/app

EXPOSE 8080

CMD [ "yarn", "serve" ]