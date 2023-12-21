# Auto Formation Laravel 10 - Routage

## Introduction

Dans ce nouveau chapitre où nous allons voir ensemble le fonctionnement du Routing qui va permettre à Laravel de faire correspondre à une URL particulière un bout de code spécifique. Pour utiliser le système de Routing, on va se rendre dans le dossier `routes` et on va modifier le fichier `web.php`. A l'intérieur de ce fichier-là, on voit qu'il y a déjà une route de définie.

```php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

```


Les routes sont définies en utilisant la classe `Illuminate\Support\Facades\Route`. Pour définir un nouveau chemin on utilisera une méthode qui a le même nom que la méthode HTTP. Ensuite, on mettra en premier paramètre l'URL, et en second paramètre une fonction qui permettra d'expliquer comment répondre.

Donc là, par exemple, cette route se traduit de la manière suivante : "lorsque j'accède à la page racine, il faut que tu répondes en retournant une vue qui s'appelle welcome. On parlera des vues un peu plus tard, mais les vues c'est simplement des fichiers PHP un qui permettent de générer le rendu HTML. Donc si je regarde dans le dossier "resources", on va avoir dans le dossier "view" un fichier "`welcome`.blade.php" qui va contenir simplement le code HTML que l'on voit à l'écran lorsque je me rends sur la page d'accueil.

Ce système de Routing va nous permettre de déclarer de nouvelles routes. Dans mon cas, j'aimerais répondre à la route "/blog". Pour cela, on va utiliser la même classe, on va répondre nous aussi à la méthode `get`, on mettra notre URL "/blog" et ensuite on définira une fonction. Vu qu'on n'a pas encore vu les vues, on va se contenter de retourner une chaîne de caractère qui dit "bonjour".

```php
use Illuminate\Support\Facades\Route;

Route::get('/blog', function () {
    return view('welcome');
});
```
Si vous renvoyez une chaîne de caractère, automatiquement Laravel va renvoyer les bonnes en tête et ce code va être affiché au niveau du navigateur comme une page HTML.

Ce qui est intéressant, c'est que si jamais on décide de retourner quelque chose qui ne peut pas être converti sous forme de chaîne de caractère, par exemple un tableau, dans ce cas là, il va renvoyer une en tête de type "JSON", et il va convertir notre tableau PHP en "json" qu'il va ensuite renvoyer au navigateur.

```php
use Illuminate\Support\Facades\Route;

Route::get('/blog', function () {
    return [
        'title' => 'Mon premier article',
        'content' => 'Ceci est le contenu de mon article'
    ];
});
```

Par défaut, il est assez intelligent pour savoir quel type de réponse il doit donner en fonction du type de retour de notre fonction.

## Objet Request

Maintenant, comment ça se passe si on veut gérer des paramètre dans l'url ? Par exemple `?name=john`. Par défaut, ce qu'on ferait dans une application PHP standard, c'est qu'on mettrait un appel à `$_GET` et on irait récupérer la clef `name`. Ce n'est pas la bonne manière de faire ça dans le cadre d'une application Laravel. Avec le framework, lorsque j'utilise une fonction, je peux lui injecter un paramètre supplémentaire qui va permettre de récupérer les informations sur la requête. Ce paramètre devra être de type `Illuminate\Http\Request`.

On retrouvera pas mal de méthode utiles sur cet objet `Request`. Pour récupérer les paramètres on a 2 méthodes qui vont être intéréssantes.

- all(), permet de récupérer tous les paramètres sous forme de tableau
- input($key), permet de récupérer un paramètre spécifiquement et renverra null si il n'existe pas

```php
use Illuminate\Http\Request;

Route::get('/blog', function (Request $request) {
    $request->input('name')
});
```

On aura l'occasion de revenir sur cet objet `Request` et ses méthodes plus tard.

## URL dynamiques

Maintenant, ce qu'on aimerait bien faire c'est avoir des URLs qui soient plus proches de la réalité. Par exemple, si je me rends sur un blog, souvent les urls des articles contiennent un slug suivi d'un ID.

```
https://grafikart.fr/tutoriels/mon-premier-article-32
```

Et on aimerait bien faire pareil avec notre Routing, pour cela on va déclarer une nouvelle route qui aura des paramètres mis entre accolades.

```php
use Illuminate\Http\Request;

Route::get('/blog/{slug}-{id}', function () {
    // ...
});
```
Si maintenant je veux récupérer ces paramètres dans l'URL, je peux le faire en utilisant les paramètres de ma fonction.

```php
use Illuminate\Http\Request;

Route::get('/blog/{slug}-{id}', function (string $slug, string $id) {
    // ...
});
```

Dans le cas où on utilise des paramètres on peut aussi utiliser des expression régulières pour contraindre le format attendu à l'aide de la méthode `where`.

```php

use Illuminate\Http\Request;

Route::get('/blog/{slug}-{id}', function (string $slug, string $id) {
    // ...
})->where(['id' => '[0-9]+', 'slug' => '[a-z0-9\-]+']);

```
## Route nommée
Lorsque l'on définit une route dans Laravel on a la possibilité de la nommer à l'aide de la méthode `name()`.

```php
use Illuminate\Http\Request;

Route::get('/blog', function () {

})->name('blog.index');

Route::get('/blog/{slug}-{id}', function (string $slug, string $id) {
    // ...
})->name('blog.show');  
```
Ce nommage permet ensuite de générer des liens automatiquement à l'aide de la méthode `route()`.

```php
route('blog.index'); // "/blog"
route('blog.show', ['id' => 10, 'slug' => 'mon-article-test']); // /blog/mon-article-test-10
```
## Groupe de routes

Si plusieurs routes ont des informations communes il est possible de les grouper ensemble.


```php
Route::prefix('/blog')->name('blog.')->group(function () {

    Route::get('/', function () {
        // ...
    })->name('index');

    Route::get('/{slug}-{id}', function (string $slug, string $id) {
        // ...
    })->name('show');

});
```

---
---
## Les Méthode Des Route

### Route::get()

#### Définition

La méthode `Route::get()` est utilisée pour définir une route qui répond aux requêtes HTTP de type GET. Cette méthode est couramment utilisée pour la gestion des requêtes d'affichage de pages.

#### Exemple :

```php
Route::get('/accueil', function () {
    return 'Cette route répond aux requêtes GET.';
});
```

---

### Route::post()

#### Définition

La méthode `Route::post()` permet de définir une route qui répond aux requêtes HTTP de type POST. Elle est fréquemment utilisée pour la gestion des soumissions de formulaires et la création de données.

#### Exemple :

```php
Route::post('/soumettre-formulaire', function () {
    return 'Cette route répond aux requêtes POST.';
});

```

---

### Route::put()

#### Définition

La méthode `Route::put()` sert à définir une route qui réagit aux requêtes HTTP de type PUT. Elle est généralement utilisée pour la mise à jour de ressources existantes.

#### Exemple :

```php
Route::put('/mettre-a-jour-ressource', function () {
    return 'Cette route répond aux requêtes PUT.';
});

```

---

### Route::patch()

#### Définition

La méthode `Route::patch()` est similaire à Route::put() et permet de définir une route qui répond aux requêtes HTTP de type PATCH. Elle est souvent utilisée pour les mises à jour partielles de ressources.

#### Exemple :

```php
Route::patch('/mise-a-jour-partielle-ressource', function () {
    return 'Cette route répond aux requêtes PATCH.';
});

```

---

### Route::delete()

#### Définition

La méthode `Route::delete()` est utilisée pour définir une route qui répond aux requêtes HTTP de type DELETE. Elle est fréquemment employée pour la suppression de ressources.

#### Exemple :

```php
Route::delete('/supprimer-ressource', function () {
    return 'Cette route répond aux requêtes DELETE.';
});

```

---

### Route::any()

#### Définition

La méthode `Route::any()` permet à une route de répondre à n'importe quelle méthode HTTP (GET, POST, PUT, PATCH, DELETE). Cela est utile lorsque la même route doit gérer plusieurs méthodes HTTP.

#### Exemple :

```php
Route::any('/toute-route', function () {
    return "Cette route répond à n'importe quelle méthode HTTP.";
});

```

---

### Route::match()

#### Définition

La méthode `Route::match()` est utilisée pour spécifier une route qui répond à des méthodes HTTP spécifiques. Elle prend un tableau de verbes HTTP en premier argument.

#### Exemple :

```php
Route::match(['get', 'post'], '/route-correspondante', function () {
    return 'Cette route répond aux requêtes GET ou POST.';
});
```
