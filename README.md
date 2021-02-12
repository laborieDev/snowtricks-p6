# snowtricks-p6

> Projet 6 OpenClassroom / Formation PHP Symfony

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/8cac9a8d35c442cb907ad68d27852d4e)](https://www.codacy.com/gh/laborieDev/snowtricks-p6/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laborieDev/snowtricks-p6&amp;utm_campaign=Badge_Grade)

## Environnement utilisé durant le développement
* Symfony 4.2.1
* Composer 1.10.5
* Mamp 5.5
    * Apache 2.2.34
    * PHP 7.3.8
    * MySQL 5.7.26


## Installation
1. Clonez le répository GitHub :
```
    git clone https://github.com/laborieDev/snowtricks-p6.git
```

2. Indiquez vos informations pour la connexion à la base de données dans le fichier `.env.local` qui devra être crée à la racine du projet en réalisant une copie du fichier `.env` :
```
    DATABASE_URL="mysql://[VOTRE_IDENTIFIANT]:[VOTRE_MOT_DE_PASSE]@[HOST]:[PORT]/[NOM_TABLE]?serverVersion=5.7"	
```

3. Téléchargez et installez les packages utilisés dans le projet avec [Composer](https://getcomposer.org/download/) :
```
    composer install
```

4. Si la base de donnée n'existe pas encore, vous pouvez la créer depuis votre terminal via la commande suivante:
```
    php bin/console doctrine:database:create
```

5. Mettez à jour votre base de donnée grâce aux migrations :
```
    php bin/console doctrine:migrations:migrate
```

6. Pour avoir un jeu de données, vous pouvez installer les fixtures :
```
    php bin/console doctrine:fixtures:load
```

7. Lancer l'application 
```
php -S localhost:8080 -t public/
```

8. L'appication est lancée ! Rendez-vous à l'adresse suivante : http://localhost:8080