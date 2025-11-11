FROM node:18

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier le package.json et package-lock.json (s'il existe)
COPY package*.json ./

# Installer les dépendances
RUN npm install

# Copier le reste de l'application
COPY . .

# Exposer le port utilisé par Vite (par défaut 5173)
EXPOSE 5173
