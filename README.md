## Install this project
Customizable website for your own e-commerce, just use the admin back-office to setup your store. 
To launch the project on your host you should follow these steps : 
1. On your own device :
- [XAMPP :](https://www.apachefriends.org/fr/index.html). 
- [Composer:](https://getcomposer.org/download/).
- Put the repo on C:/xampp/htdocs
- ```composer install```
- ```cp .env.example .env```
- ```php artisan key:generate```
- ```php artisan migrate```
- ```php artisan serve```


2. Use Docker (easy way)
- ```cp .env.docker.example .env.docker```
- ```cp .env.example .env```
- Lancement du conteneur : ```docker-compose up -d --build```
- Vérification : ```docker-compose ps```
- Génération de la clé Laravel : ```docker exec -it webekommerce_app php artisan key:generate```
- Initialisation de la base de donnée : ```docker exec -it webekommerce_app php artisan migrate```

3. Commandes utiles 
# Arrêter les conteneurs
docker-compose down

# Voir les logs
docker-compose logs -f

# Accéder au conteneur Laravel
docker exec -it webekommerce_app bash





