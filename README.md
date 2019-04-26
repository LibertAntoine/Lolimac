# IMAC site d'organisation de soirée - BackEnd

Actuellement, sont fixés comme limite de taille pour les différents contenus du site : 
- contenu commentaires : 1000
- contenu posts : 10 000
- titre evenements/posts : 255
- description evenement : 5000
- nom et prénom des utilisateurs : 22
- pseudo : 25
- mail : 50

## Getting started

Besoin de définir 2 fichiers PHP (à mettre à jour en production):

`configVar.php` dans `api`
```
<?php 
$secretKey = "4}_)V'<(ot`dtyDk1ETpCXTGCAh&r,QyW9LK0TAkT6jgi:vC{fDd%(fyZ{J=j=}";
$ip = "127.0.0.1";
```

`dbID.php` dans `api/models`
```
<?php 
$dbHost = "localhost";
$dbTableName ="lolimac";
$dbUsername = "root";
$dbPassword = "root";
```

Il faut aussi vérifier que `Mcrpyt` (déprécié) est bien installé

## Inspirations

- [REST errors](https://blog.restcase.com/rest-api-error-codes-101/) - Best practices gestion erreurs api rest
- [Open Api errors](https://github.com/OAI/OpenAPI-Specification/issues/1392) - Proposition d'erreurs standardisés OpenAPI
- [Best practices](https://medium.com/studioarmix/learn-restful-api-design-ideals-c5ec915a430f) - Conseils quant à la création des endpoints
- [Microsoft guidelines](https://docs.microsoft.com/fr-fr/azure/architecture/best-practices/api-design) - Autre conseils d'organisations REST

## Dépendences

- [JWT](https://jwt.io/) - Json Web Tokens
