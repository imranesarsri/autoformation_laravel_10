# autoformation laravel chapitre Controllers

```bash
php artisan make:controller BlogController
```

```bash
php artisan make:controller BlogController -r
```

```php
<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index()
    {
        return Post::all();
        // return Post::paginate(2);

    }
}
```
Ensuite on peut utiliser cette méthode dans notre routing.

```php
Route::get('/blog', [BlogController::class, 'index']);

```
