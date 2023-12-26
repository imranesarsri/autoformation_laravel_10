# Auto Formation Laravel 10 - Les Relation

## Relation 1-n, belongsTo

```bash
php artisan make:model Category -m
```

```php
<?php

use Illuminate\Database\Migrations\Migration;   
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Category::class);
        });
    }
};
```


On notera surtout l'utilisation de la méthode foreignIdFor() qui permet de nommer automatiquement la clef étrangère et permet de simplifier la déclaration de colonne trop verbeuse.

```php
$table->foreignIdFor(\App\Models\Category::class);
// Equivalent à
$table->unsignedBigInteger('category_id');
$table->foreign('category_id')->references('id')->on('categories');

```

Ensuite, on peut au niveau de nos model rajouter la définition de la relation grâce à une méthode portant le nom de la relation.

```php
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}   
```
On pourra aussi définir la relation inverse du côté des catégories.

```php
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
}
```

Ces méthodes vont nous offrir la possibilité d'intéragir avec les données liées plus facilement.

- L'accès à la propriété nous donne les résultats de la relation $post->category->name ou $category->posts[0]->title
- L'accès à la méthode nous renvoie la rélation que l'on peut utiliser pour contruire une requête ou effectuer certaines actions $category->posts()->where('online', 1)->get() ou $post->category()->create(['name' => 'Catégorie de cet article'])

## Eager loading et problème n+1
Aussi par défaut Laravel ne récupère une relation que lorsqu'elle est demandée. Par exemple si vous récupérez 10 articles `(Post::limit(10)->get())` il ne récupèrera pas les catégories associées. Si vous faites ensuite une boucle et que vous affichez la catégorie associé vous aurez 11 requêtes SQL. Pour éviter ce problème vous pouvez faire de l'eager-loading en préchargeant les relations en amont avec la méthode `with().`

```php
$posts = Post::with('category')->limit(10)->get()

```

## Relation n-n, belongsToMany

Ce type de relation est plus complexe car nécessite la création d'une table intermédiaire et on doit travailler sur cette table de liaison pour définir la relation. Comme pour l'approche précédente on va créer les models puis la migration qui correspond.

```bash
php artisan make:model Tag -m

```
Pour la migration on réutilisera `foreignIdFor`. La table de liaison prendra le nom des 2 éléments à lier au singulier et organisé alphabétiquement.

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Post::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Tag::class)->constrained()->cascadeOnDelete();
            $table->primary(['post_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
};
```

Ensuite au niveau de nos models on peut définir la relation.

```php
<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    public function tags (): BelongsToMany {
        return $this->belongsToMany(Tag::class);
    }
}
```

Comme précédemment on pourra ensuite récupérer les informations liées au travers de la propriété de même nom. En revanche on aura des méthodes sur la relation pour pouvoir rapidement attacher ou détacher des éléments au niveau de notre relation.

```php
$post->tags()->attach($tagId);
$post->tags()->detach($tagId);
$post->tags()->detach(); // Retire la liaison pour tous les tags de l'article
$user->roles()->sync([1, 2, 3]); // Synchronise la relation avec les ids, en supprimant et ajoutant les relation quand nécessaire
```

