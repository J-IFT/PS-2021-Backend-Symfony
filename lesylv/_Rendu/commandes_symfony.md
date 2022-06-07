# Commandes Symfony qui ont été utilisées :  

## Création du projet  
```symfony new --full leSylv```  

## Création des entités par reverse-engineering  
```php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity```  

## Création des getter/setter pour les entités  
```php bin/console make:entity --regenerate App```

## Crud des entités
```php bin/console make:crud Client```  
```php bin/console make:crud Galaxie```  
```php bin/console make:crud Planete```  
```php bin/console make:crud Vehicule```  
```php bin/console make:crud Voyage```  
