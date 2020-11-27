# :notebook_with_decorative_cover: Lolimac

<p align="center">
<img src="doc/readme-img/Lolimac.png?raw=true" width="100%" alt="Lolimac">
</p>

## Table of Contents

- [**Configuration**](#Configuration)
- [**Presentation**](#presentation)
- [**Main Features**](#main-features)
- [**Contributors**](#contributors)

## Configuration

Need to configure 2 PHP files :

`configVar.php` in `api`
```
<?php 
$secretKey = "4}_)V'<(ot`dtyDk1ETpCXTGCAh&r,QyW9LK0TAkT6jgi:vC{fDd%(fyZ{J=j=}";
$ip = "127.0.0.1";
```

`dbID.php` in `api/models`
```
<?php 
$dbHost = "localhost";
$dbTableName ="lolimac";
$dbUsername = "root";
$dbPassword = "root";
```

## Presentation
<p>
Application allowing its users to create events and invite other members to join them. Developed in Angular 7 for the frontend and PHP / MySQL for the backend, this project aimed to help students at IMAC engineering school more easily organize events.
</p>
<p>
This project is an initiative resulting from a lecture about web programming, at the IMAC engineering school.
</p>

Realized in May 2019.

[**See website**](https://lolimac.antoine-libert.com/)

<p align="center">
<img src="doc/readme-img/Lolimac2.png?raw=true" width="45%" alt="Screenshot">
<img src="doc/readme-img/Lolimac3.png?raw=true" width="45%" alt="Screenshot">
</p>


## Main Features
* Front responsive with Angular 7.
* API REST with PHP.
* Authentification with token JWT.

## Contributors

* Antoine Libert – Architecture back, JWT
* Jules Fouchy – Backend PHP
* Nicolas Liénart – Backend PHP
* Guillaume Haerinck – Front Angular
* Monica Lisasek – Front Design



