# Auto Formation Laravel 10 - Authentification

```php
class User extends Authenticatable
{
    //....
}
```

Ensuite pour interagir avec l'authentification on pourra utiliser la façade Auth qui contiendra différentes méthodes intéressantes :

```php
use Illuminate\Support\Facades\Auth;

// Essaie de connecter un utilisateur et renvoie true en cas de succès
Auth::attempt([
    'email' => 'john@doe.fr'
    'password' => '0000'
]);

// Connecte un utilisateur manuellement
Auth::login($user); 

// Renvoie l'utilisateur connecté ou null
$user = Auth::user(); 

// Renvoie l'id de l'utilisateur connecté ou null
$id = Auth::id();
```

La configuration liée à l'authentification peut être gérée via le fichier de configuration config/auth.php.

## Connexion

Pour permettre à l'utilisateur de se connecter nous allons créer un formulaire permettant à l'utilisateur de rentrer son email et son mot de passe. On créera ensuite une action dans notre contrôleur qui permettra de vérifier que ces identifiants sont valides et qui authentifiera l'utilisateur dans le cas ou le mot de passe correspond bien à l'email.


```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }
}
```


On notera l'utilisation de plusieurs méthodes spécifiques dans ce controller :

- La méthode session() sur $request nous permet d'obtenir les informations sauvegardées en session pour l'utilisateur. On utilisera la méthode regenerate afin de générer une nouvelle session et d'éviter le vol de session.
- En cas d'erreur on utilisera les méthodes withErrors() et onlyIinput() pour renvoyer respectivement les erreurs et les informations précédemment entrées par l'utilisateur.
Si l'utilisateur a rentré des informations correctes il est alors authentifié sur l'application et peut continuer à naviguer. La méthode intended permet de rediriger l'utilisateur vers la page qu'il avait originellement demandée avant d'être redirigé vers le formulaire de connexion.

## Autorisation

Maintenant que l'on a notre système d'authentification il faut être capable de limiter l'accès à certaines pages de notre site aux seuls utilisateurs authentifiés. Pour cela nous avons la possibilité d'utiliser le middleware auth qui va permettre de limiter l'accès à un groupe de route.


```php
Route::middleware(['auth'])->group(function () {
    // ...
});
```
