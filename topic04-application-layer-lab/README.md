# Topic 04 Application Layer Lab — Code + Commands

## 1) Create project
```bash
composer create-project laravel/laravel app-layer-lab
cd app-layer-lab
```

## 2) Copy files
Copy all files from `topic04-application-layer-lab/` into matching paths.

## 3) Run tests
```bash
php artisan test tests/Feature/ApplicationLayer
```

## 4) Manual check
```bash
curl -i -X POST http://127.0.0.1:8000/api/orders \
  -H 'Content-Type: application/json' \
  -d '{"customer_id":55,"sku":"BOOK-001","quantity":2,"unit_price":39.5}'
```

## What you learn
- controller orchestration only,
- DTO-based use-case input,
- action class for business flow,
- repository contract binding for replaceable infrastructure.
