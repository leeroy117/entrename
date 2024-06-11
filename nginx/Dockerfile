# Dockerfile
FROM nginx:alpine

# Copiar fastcgi-php.conf al directorio de snippets de Nginx
COPY ./nginx/fastcgi-php.conf /etc/nginx/snippets/fastcgi-php.conf

# Copiar la configuración de Nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Nginx en primer plano
CMD ["nginx", "-g", "daemon off;"]
