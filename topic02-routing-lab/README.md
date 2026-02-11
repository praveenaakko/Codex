# Topic 02 Routing Lab — Code-First Walkthrough

You asked for code plus command-based explanation. This folder gives a **copy-ready implementation skeleton** for Laravel Routing A→Z.

## 1) Create a fresh Laravel app (on your machine)
```bash
composer create-project laravel/laravel routing-lab
cd routing-lab
```

## 2) Copy files from this lab into your app
Copy the following paths into your Laravel project:
- `routes/api.php`
- `routes/web.php`
- `app/Providers/RouteServiceProvider.php`
- `app/Http/Middleware/EnsureTenantSubdomain.php`
- `app/Http/Controllers/**`
- `app/Models/Post.php`
- `app/Models/Comment.php`
- `tests/Feature/Routing/**`

## 3) Register middleware alias
In `app/Http/Kernel.php` add:
```php
protected $routeMiddleware = [
    // ...
    'tenant.subdomain' => \App\Http\Middleware\EnsureTenantSubdomain::class,
];
```

## 4) Add database schema
```bash
php artisan make:migration create_posts_table
php artisan make:migration create_comments_table
```

Use columns:
- `posts`: id, title, slug(unique), body, status, tenant_slug(index), timestamps
- `comments`: id, post_id(fk), uuid(unique), body, timestamps

Then run:
```bash
php artisan migrate
```

## 5) Verify route topology
```bash
php artisan route:list --path=api/v1
php artisan route:list --path=api/v2
php artisan route:list --path=internal
```

## 6) Validate route cache compatibility
```bash
php artisan route:cache
php artisan route:clear
```

## 7) Run focused tests
```bash
php artisan test tests/Feature/Routing
```

## 8) Quick manual API checks
```bash
curl -i http://127.0.0.1:8000/api/v1/posts
curl -i http://127.0.0.1:8000/api/v2/posts
```

Signed URL example in Tinker:
```bash
php artisan tinker
>>> URL::temporarySignedRoute('invites.accept', now()->addMinutes(10), ['invite' => 'abc123']);
```

## 9) What this code demonstrates
1. Versioned route groups (`v1`, `v2`) with independent throttles.
2. Route model binding by slug and scoped nested resources.
3. Tenant subdomain route isolation with middleware validation.
4. Internal route hardening with auth + ability check.
5. Signed route flow and route cache-safe controller usage.
