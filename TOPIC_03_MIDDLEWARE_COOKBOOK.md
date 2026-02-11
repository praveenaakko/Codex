# Topic 03 Cookbook — Middleware & HTTP Pipeline (Build + Explain)

This guide makes Topic 03 cookbook-level: **what we build, why each file exists, and how to implement in sequence**.

## 0) What are we building?
We are building a **Pipeline Guard API** for a write endpoint (`POST /api/pipeline/orders`) that is protected by middleware chain:
1. Correlation ID assignment,
2. API key validation,
3. Idempotency/replay protection.

This simulates real production requirements for payment/order APIs.

---

## 1) Middleware order and why it matters
The route uses:
`['api', 'correlation.id', 'api.key', 'idempotency']`

Execution logic:
1. `correlation.id` runs first so all logs/errors carry a request ID.
2. `api.key` rejects unauthorized traffic early.
3. `idempotency` runs only for authorized calls and blocks duplicates.

If order changes, behavior and observability quality change.

---

## 2) File-by-file rationale

### `routes/api.php`
Defines the protected endpoint and exact middleware order.

### `app/Http/Middleware/AssignCorrelationId.php`
Adds `X-Correlation-ID` to request + response and log context.

### `app/Http/Middleware/RequireApiKey.php`
Validates `X-Api-Key` against config and returns `401` for invalid key.

### `app/Http/Middleware/PreventDuplicateRequests.php`
Requires `Idempotency-Key` header and uses cache lock to reject duplicate writes (`409`).

### `app/Http/Controllers/Api/PipelineOrderController.php`
Simple orchestration-only endpoint to demonstrate middleware-protected write flow.

### `tests/Feature/Middleware/PipelineMiddlewareTest.php`
Regression coverage for:
- missing key,
- missing idempotency header,
- success with correlation ID,
- duplicate request conflict.

### `app/Providers/RouteServiceProvider.php`
Keeps route registration explicit in this mini lab.

### `README.md`
Command-first setup for practicing in a fresh Laravel app.

---

## 3) Step-by-step implementation cookbook

### Step 1 — Correlation first
Create `AssignCorrelationId` middleware.
- read incoming correlation ID if present,
- else generate UUID,
- attach to request/response,
- inject into log context.

**Why:** without correlation IDs, debugging distributed failures is painful.

### Step 2 — Protect with API key
Create `RequireApiKey` middleware.
- read `X-Api-Key`,
- compare with `config('services.pipeline.api_key')`,
- reject unauthorized requests with clear JSON.

**Why:** quick perimeter protection for internal/private APIs.

### Step 3 — Enforce idempotency
Create `PreventDuplicateRequests` middleware.
- require `Idempotency-Key`,
- compose cache key (`method:path:key`),
- use `Cache::add` TTL lock,
- reject repeats with `409`.

**Why:** prevents duplicate order/payment creation on retries.

### Step 4 — Wire route group
Bind endpoint under `/api/pipeline/orders` with middleware chain.

**Why:** route group communicates policy at transport layer.

### Step 5 — Add tests as safety net
Write feature tests for all critical outcomes.

**Why:** middleware regressions can silently break security and data integrity.

---

## 4) Command execution flow
```bash
# in your own environment
composer create-project laravel/laravel middleware-lab
cd middleware-lab

# copy topic03-middleware-lab files

# register middleware aliases in app/Http/Kernel.php
# set PIPELINE_API_KEY in .env and services.php

php artisan route:list --path=pipeline
php artisan test tests/Feature/Middleware
```

---

## 5) Production hardening notes
1. Use Redis for idempotency keys.
2. Store response payload by idempotency key for safe replay.
3. Propagate correlation ID into jobs and outgoing HTTP clients.
4. Add per-client throttling and audit logging.
