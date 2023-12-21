# autoformation laravel chapitre ORM

## Introdaction

Dans ce nouveau chapitre où nous allons découvrir ensemble comment communiquer avec une base de données avec Laravel et son ORM Eloquent. Un ORM, si vous n'avez jamais entendu parler, c'est le diminutif de Object Relational Mapping, ce sont des classes qui vont nous permettre d'interagir avec les données en base de données et qui vont permettre de les représenter sous forme d'objet. Vous allez le voir, c'est plutôt simple à l'utilisation une fois que l'on a compris le principe.

Pour commencer il va falloir configurer la base de données qu'on souhaite utiliser. Dans notre cas on va utiliser la base de données la plus simple à configurer : **mysql** (Laravel supporte MySQL, MariaDB, PostgreSQL et SQL Server). Pour mettre en place mysql, on va modifier le fichier d'environnement (le fichier .env) et au niveau de la partie `DB_CONNECTION`, on va mettre "mysql" et on va retirer les autres informations.

## Migration

Dans notre cas, on souhaite pouvoir interagir avec notre base de données pour créer un système d'articles. Il nous faudra commencer par créer la table et les différents champs nécessaire et on n'aura pas nécessairement besoin d'utiliser du SQL. On pourra utiliser le système de migration de Laravel. Pour cela, on va se rendre dans le terminal et on va taper la commande :

```bash
php artisan make:migration CreatePostTable
```

Cela va créer un fichier de migration dans le dossier database/migration qui va permettre de rajouter des informations dans notre base de données. Le fichier de migration va contenir deux méthodes, une méthode up qui permet d'expliquer comment générer les table et les champs et une méthode down qui permettra de revenir en arrière.


```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
```

Ce système de migration permet d'interagir avec la création des tables avec une API PHP plutôt que de devoir écrire du SQL. Cela s'adapte quel que soit le système de gestion de base de données que vous utilisez.

Une fois que l'on est satisfait, on va pouvoir démarrer notre migration. Pour cela, encore une fois, il faudra se rendre sur le terminal et on tapera la commande

```bash
php artisan migrate

```


Si on regarde ensuite le contenu de cette base de données, on va voir qu'il y a bien nos différentes tables, et on a la table posts qui va contenir les champs que l'on a demandé.


Quelques commandes utiles:

```bash
# voir ce que fait la migration sans l'éxécuter
php artisan migrate --pretend

# annuler la dernière migration
php artisan migrate:rollback
```

N'hésitez pas à consulter la documentation sur le fonctionnement des migrations.

## Les models

Maintenant que notre table est créée on aimerait bien être capable de créer, lire et modifier des enregistrements. C'est là qu'intervient un second composant, les "Model". Comme pour les migrations, on peut les générer en ligne de commande, en faisant un `php artisan make:model`, et on va appeler le modèle `Post`.

```bash
php artisan make:model Post
```


Le nom du modèle correspondra au nom de la table au singulier. Cette commande va créer un fichier app/Models/Post.php. Dans ce fichier, on aura peu de choses au final.

```php
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
}
```
Ça va étendre de la classe Model qui provient du namespace de Eloquent. (c'est le nom de l'ORM qui est utilisé par Laravel).

Lors de la génération de Model Eloquent appliquent des conventions, il faudra adapter votre Model en conséquence.

## Créer un article

Avec cette classe on a la possibilité d'initialiser un nouvel article en faisant

```bash
$post = new Post();
```

Ensuite, je peux renseigner des informations dessus. Cet objet va avoir des propriétés qui correspondront au nom des champs dans notre base de données.

```php
$post->title = 'Mon titre';
$post->slug = 'mon-titre';
$post->content = 'Mon contenu';
```
Une fois qu'on a rempli cet objet, on peut décider de le sauvegarder en base de données grâce à la méthode save().

```php
$post->save();
```

Cette méthode est disponible directement au niveau de tous les modèles, et elle permet d'enregistrer les informations en base de données.

## Récupérer des articles

Donc en plus de pouvoir créer des articles, on va pouvoir utiliser ce modèle `Post` pour récupérer des informations. J'aimerais bien, par exemple, récupérer tous les articles depuis ma base. Dans ce cas-là, on utilisera des méthodes statiques sur notre classe Post.

```php
$posts = Post::all();
```

J'ai la possibilité aussi de spécifier les champs que je souhaite utiliser. Par exemple, je peux lui dire que je suis intéressé que par l'ID et le titre de l'article.


```php
$posts = Post::all(['title', 'id'])
```

Dans ce cas-là, il ne récupérera que ces informations-là. Si vous avez besoin de regarder à quoi ressemble un objet, vous avez une petite méthode qui est plutôt pratique, qui s'appelle dd, comme "die and debug", et qui vous permet de débuguer une variable.

```php
dd($posts);
```

Si on fait un `dd` de `posts`, on voit que ma méthode `all()`, ici, la renvoie à quelque chose de type Collection, et à l'intérieur de cette collection, on a nos éléments dans une propriété `items`. Chaque élément dans ma collection est un objet de type `Post`, qui est initialisé avec les informations provenant de la base de données. Lorsque l'on utilise des méthodes, il va faire ce qu'on appelle de l'hydratation, et créer des objets correspondant au type demandé et les remplir avec les informations provenant de la base de données (On rentrera un peu plus en profondeur sur ce qui se passe en interne plus tard).

En plus de la méthode `all()`, vous avez aussi d'autres méthodes intéressantes comme la méthode find qui permet de récupérer un élément à partir de son ID.

```php
$post = Post::find(3);
```

Si je lui demande de récupérer un enregistrement qui n'existe pas il me renverra nul. Vous avez aussi une autre méthode qui s'appelle `findOrFail()` qui, plutôt que de renvoyer nul, renverra une Exception si la donnée n'a pas été trouvée.

```php
$post = Post::findOrFail(3);
```
Cette erreur sera automatiquement capturée par Laravel qui génèrera une page d'erreur 404.

Vous pouvez utiliser `paginate()` qui permet de renvoyer les enregistrements en les paginant.

```php
$posts = Post::paginate(25);
```

En retour, cette fonction renverra un `LengthAwarePaginator`. C'est un objet qui peut être utilisé à la fois dans les vues mais aussi dans la partie API pour générer des paginations.

- Dans le cadre d'une API, si on retourne cet objet dans un controller, Laravel renverra un JSON contenant les éléments, mais aussi les informations associé à la pagination.
- Dans le cadre d'une application HTML on pourra boucler sur les articles plus tard et on pourra aussi utiliser la méthode links() qui permettra de générer le code HTML de la pagination.

Ce système de pagination sera aussi automatiquement influencé par le paramètre "?page" dans l'URL qui permettra de naviguer de page en page.

Enfin, pour finir de parler de la récupération des informations, vous avez la possibilité d'utiliser le système de Query Builder qui va permettre de concevoir des requêtes. Vous pouvez concevoir des requêtes spécifiques en partant du modèle avec des méthodes qui correspondront aux verbes utilisés au niveau de SQL.

```php
$posts = Post::where('created_at', '<', now())
    ->orderBy('created_at', 'desc')
    ->get();

```

## Créer

Pour créer un nouvel enregistrement on peut utiliser la méthode `create()` en lui passant les valeurs des différents champs.

```php
$post = Post::create([
    'title' => 'Mon Titre',
    'slug'  => 'mon-titre',
    'online'=> true
])

```

Par contre cette méthode est sécurisée par défaut dans Laravel qui ne vous laissera pas utiliser n'importe quel champs dans cette méthode. Il faut définir l'ensemble des champs "remplissable" au travers d'une propriété `fillable` dans le model.

```php
class Post {
    protected $fillable = ['title', 'slug', 'online'];
}
```

De la même manière, on a une propriété qui représente la notion inversée `guarded`, qui permet de définir les champs qui ne sont pas remplissables.

## Modifier

Si vous voulez modifier un article, la première approche qui est plutôt simple, c'est de récupérer un enregistrement puis de modifier ses propriétés.

```php

$post = Post::find(3);
$post->title = 'Mon nouveau titre';
$post->save();

```

Il est aussi possible de modifier plusieurs enregistrements depuis une requête.

```php
$post = Post::where('online', false)->update([
    'online' => true
])
```

## Supprimer

Enfin pour supprimer un enregistrement il suffit d'utiliser la méthode `delete()`.

```php
$post = Post::find(3);
$post->delete();
```

Mais comme pour l'update, on peut utiliser cette méthode à partir d'une requête pour supprimer plusieurs enregistrements.

