# Auto Formation Laravel 10 - Debugbar

> php artisan route:cache


## Les méthodes utiles
### @csrf
- Par défaut Laravel offre une protection CSRF qui permet de se protéger contre les attaques de type # Cross-site request forgery qui consiste à faire poster un formulaire depuis un site extérieur.

- Aussi, si vous créer un formulaire classique vous allez obtenir une erreur lors de sa soumission et vous devrez créer un champs caché contenant une clef CSRF pour que votre formulaire fonctionner. La directive @csrf permet de faire cela automatiquement.

### @error
- En cas d'erreur, l'utilisateur est automatiquement redirigé vers la page précédente avec les erreurs de validations sauvegardées en session. Pour gérer l'affichage des erreurs Laravel offre la directive @error qui permet d'afficher un message en cas d'erreur ou de conditionner l'affichage d'une classe.

### old()
- En plus des erreurs, en cas de redirection on veut aussi pouvoir réafficher les dernières informations rentrées par l'utilisateur dans le formulaire. La méthode old() va justement permettre de récupérer ces informations depuis la session. On pourra aussi lui passer en second paramètre une valeur par défaut à appliquer si il n'y a pas de valeur provenant de la session.

- old('firstname', $post->firstname);
### @method
- Enfin, une dernière directive vous permettra de créer un champs caché qui permettra de simuler des méthodes qui ne sont pas supportées par les formulaires HTML de base.
```php
@method("PUT")
```
### Exemple
Voici un petit exemple de formulaire construit avec

```php

<form action="{{ route('post.create') }}" method="post" class="vstack gap-2">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        @error("title")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" class="form-control @error("slug") is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
        @error("slug")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea id="content" class="form-control @error("content") is-invalid @enderror"  name="content">{{ old('content') }}</textarea>
        @error("content")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button class="btn btn-primary">
        Créer
    </button>
</form>
```

### Amélioration
- La création de formulaire peut rapidement devenir très verbeux aussi il ne faudra pas hésiter à se créer des morceaux de template réutilisable pour vous rendre plus efficace.
```php
<form action="{{ route('post.create') }}" method="post" class="vstack gap-2">
    @csrf
    @include('shared.input', ['name' => 'title', 'label' => 'Titre'])
    @include('shared.input', ['name' => 'slug', 'label' => 'URL'])
    @include('shared.input', ['name' => 'content', 'label' => 'Contenu', 'type' => 'textarea'])
    <button class="btn btn-primary">
        Créer
    </button>
</form>
```
