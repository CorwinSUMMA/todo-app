<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Todo-app

Deze Laravel-app is een takenlijst met registratie en inloggen. Een ingelogde gebruiker kan eigen taken toevoegen, afronden en verwijderen. Taken zijn gekoppeld aan de gebruiker; gebruikers kunnen dus niet elkaars taken aanpassen.

### Lokaal starten

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
php artisan serve
```

Open daarna `http://localhost:8000`. Controleer lokaal met:

```bash
php artisan test
vendor/bin/pint --test
php artisan migrate:status
```

### OTAP en CI/CD

- **Ontwikkel:** lokaal ontwikkelen met `php artisan serve` en een lokale database.
- **Test:** GitHub Actions draait Pint en alle tests bij een push of pull request naar `main`.
- **Acceptatie:** docent of opdrachtgever controleert de app op een preview/stagingomgeving.
- **Productie:** Railway draait de goedgekeurde `main`-versie via HTTPS.

De workflow staat in `.github/workflows/ci.yml`. Na een groene build maakt de workflow op `main` een release-tag. Configureer op Railway minimaal `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY` en de databasevariabelen. Geheimen horen alleen in Railway Variables of GitHub Secrets, nooit in Git.

Een geschikte Railway startopdracht is:

```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

### AVG en auteursrecht

De app verwerkt naam, e-mailadres en een gehashte wachtwoordwaarde in `users`, plus de taaktekst en status in `tasks`. Deze gegevens zijn nodig voor authenticatie en de takenlijst. Laravel gebruikt hashing voor wachtwoorden; het oorspronkelijke wachtwoord wordt niet opgeslagen. Toegang tot taken is beperkt tot de eigenaar. Een gebruiker kan het account verwijderen via het profiel, waarbij gekoppelde taken door de foreign key worden verwijderd.

Bespreek vóór productie hoe lang accounts en taken worden bewaard en in welk datacenter Railway de gegevens opslaat. Beperk beheertoegang en verzamel geen gegevens die niet nodig zijn. Controleer de licenties van Composer- en NPM-packages; dit project gebruikt onder andere Laravel onder MIT-licentie. Gebruik alleen eigen of gelicentieerde afbeeldingen, tekst en iconen en noteer tutorial- of codebronnen.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
