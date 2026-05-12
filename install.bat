@echo off
echo Installation de Symfony 6.4 pour PIDEV...
echo.

echo Étape 1: Nettoyage...
if exist vendor rmdir /s /q vendor
if exist composer.lock del composer.lock

echo Étape 2: Téléchargement des dépendances...
composer install --no-scripts --no-interaction

echo Étape 3: Configuration de la base de données...
if not exist .env.local copy .env .env.local
echo DATABASE_URL="mysql://root:@127.0.0.1:3306/pidev_db?serverVersion=8&charset=utf8mb4" > .env.local

echo Étape 4: Installation de Twig...
composer require twig/twig --no-scripts

echo Étape 5: Nettoyage du cache...
php bin/console cache:clear --no-warmup

echo Étape 6: Installation des bundles supplémentaires...
composer require symfony/maker-bundle --dev --no-scripts
composer require symfony/security-bundle --no-scripts
composer require symfony/validator --no-scripts
composer require symfony/form --no-scripts

echo Étape 7: Finalisation...
php bin/console cache:clear --no-warmup

echo.
echo ========================================
echo ✅ INSTALLATION RÉUSSIE !
echo ========================================
echo.
echo Commandes disponibles:
echo - Démarrer le serveur: symfony serve
echo - Créer une entité: php bin/console make:entity
echo - Créer un contrôleur: php bin/console make:controller
echo.
pause