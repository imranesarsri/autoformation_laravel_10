# Auto Formation Laravel 10 - Blade
## Introdaction

Dans ce chapitre nous allons découvrir la partie vue dans la structure MVC. Laravel dispose d'un moteur de template qui va nous permettre de générer plus simplement des vues HTML.

Les vues blade seront créées dans des fichier avec l'extension `.blade.php` et on pourra afficher les variables à l'aide d'accolades.

```bash
php artisan make:view blog.index
```

```php
{{ $username }}
```

Cette méthode, par rapport à l'utilisation de simple `<?= ?>` permet d'automatiquement échapper les caractères HTML.

Il est aussi possible d'utiliser des conditions et des boucles à l'aide de directives qui seront préfixées par un @.

```php
@if (count($records) === 1)
    I have one record!
@elseif (count($records) > 1)
    I have multiple records!
@else
    I dont have any records!
@endif
```

