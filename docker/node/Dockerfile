FROM node:18-alpine

WORKDIR /var/www/html

# Устанавливаем зависимости
COPY package*.json ./
RUN npm ci

#Project files copied in php-fpm stage

# Открываем порт для Vite
EXPOSE 3000

# Запускаем Vite в режиме разработки
CMD ["npm", "run", "dev"]