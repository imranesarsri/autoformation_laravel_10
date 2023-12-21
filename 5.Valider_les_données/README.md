# Auto Formation Laravel 10 - Valider les données

```php
$validated = $request->validate([
    'title' => 'required|string|min:8',
    'slug' => 'required|string|min:8',
    'content' => 'required|string|min:8|max:100',
]);
```


