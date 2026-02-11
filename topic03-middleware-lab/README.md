# Topic 03 Middleware Lab — Code + Commands

This lab gives production-style middleware examples: correlation ID, API key auth, and idempotency protection.

## 1) Create project
```bash
composer create-project laravel/laravel middleware-lab
cd middleware-lab
```

## 2) Copy lab files
Copy everything from `topic03-middleware-lab/` into matching paths in your Laravel app.

## 3) Register middleware aliases in `app/Http/Kernel.php`
```php
protected $routeMiddleware = [
    // ...
    'correlation.id' => \App\Http\Middleware\AssignCorrelationId::class,
    'api.key' => \App\Http\Middleware\RequireApiKey::class,
    'idempotency' => \App\Http\Middleware\PreventDuplicateRequests::class,
];
```

## 4) Configure pipeline API key in `.env`
```env
PIPELINE_API_KEY=local-dev-key
```

In `config/services.php`:
```php
'pipeline' => [
    'api_key' => env('PIPELINE_API_KEY', 'local-dev-key'),
],
```

## 5) Run and test
```bash
php artisan serve
php artisan route:list --path=pipeline
php artisan test tests/Feature/Middleware
```

## 6) Manual verification
```bash
curl -i -X POST http://127.0.0.1:8000/api/pipeline/orders \
  -H 'X-Api-Key: local-dev-key' \
  -H 'Idempotency-Key: idem-100' \
  -H 'Content-Type: application/json' \
  -d '{"sku":"book"}'
```

Repeat same request with same `Idempotency-Key` to get `409 Duplicate request`.
