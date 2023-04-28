FROM nginx:stable-alpine

RUN apk add --update --no-cache nginx

# Timezone
ENV TIMEZONE Europe/Kiev

COPY nginx/zt.conf /etc/nginx/conf.d/
COPY nginx/zt.conf /etc/nginx/sites-enable/

RUN adduser -D -g '' -G www-data www-data
RUN mkdir -p /run/nginx


#CMD ["nginx"]
CMD [ "nginx", "-g", "daemon off;" ]


EXPOSE 80
EXPOSE 443