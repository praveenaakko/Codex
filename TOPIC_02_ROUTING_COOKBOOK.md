# Topic 02 Cookbook — Routing A→Z (Build + Explain)

This guide explains **exactly what we are building**, **why each file exists**, and **how to implement it step by step**.

## 0) What are we building?
We are building a **Versioned Tenant API Router** with three route surfaces:
1. **Public API v1** (legacy contract, deprecation headers).
2. **Public API v2** (new contract and improved pagination/validation).
3. **Tenant subdomain routes** (`{tenant}.example.test`) with isolation checks.
4. **Internal web route** for route health diagnostics.
5. **Signed invite route** for tamper-proof links.

This project is intentionally routing-heavy so you master:
- versioning,
- route model binding,
- middleware boundaries,
- route cache compatibility,
- security-oriented routing decisions.

---

## 1) Folder walkthrough (what each file does and why)

### `routes/api.php`
**Why it exists:** Route topology is the heart of this topic. This file defines versioned APIs and tenant route boundaries.

**What to notice:**
- `v1` and `v2` prefixes are explicit contracts.
- `throttle:api-v1` and `throttle:api-v2` give different rate budgets.
- tenant domain group isolates tenant traffic.
- nested resources show scoped binding patterns.

### `routes/web.php`
**Why it exists:** Shows routing beyond API.
- internal admin route with strict middleware (`auth`, `can:*`).
- signed route for invite acceptance.

### `app/Providers/RouteServiceProvider.php`
**Why it exists:** Central place for route binding + rate limiter policy.
- custom binding for `post` by `slug`.
- model binding for `comment`.
- rate limiter definitions per API version.

### Controllers (`app/Http/Controllers/...`)
**Why they exist:** Keep route files transport-only. Controllers receive already-resolved models via binding and return versioned responses.

- `Api/V1/PostController`: legacy contract + deprecation headers.
- `Api/V2/PostController`: improved contract + v2-only fields.
- `Api/V2/TenantPostController`: ensures post belongs to tenant.
- `Api/V2/TenantCommentController`: nested resource behavior.
- `Admin/RouteHealthController`: operational route diagnostics.
- `Web/InviteAcceptanceController`: signed URL flow.

### Models (`app/Models/Post.php`, `app/Models/Comment.php`)
**Why they exist:** Encode route keys (`slug`, `uuid`) so binding is clean and explicit.

### Middleware (`EnsureTenantSubdomain.php`)
**Why it exists:** Reject invalid tenant identifiers early in pipeline.

### Tests (`tests/Feature/Routing/*`)
**Why they exist:** Prevent silent routing regressions:
- route naming breaks,
- signature vulnerabilities,
- cache incompatibilities,
- security boundary leaks.

---

## 2) Step-by-step implementation cookbook

### Step 1 — Build versioned route skeleton
1. Create `routes/api.php` groups for `/v1` and `/v2`.
2. Name routes (`api.v1.*`, `api.v2.*`) to create stable contracts.
3. Add separate rate limiters for each version.

**Reason:** versioned APIs must evolve independently with clear traffic policy.

### Step 2 — Add model binding strategy
1. Set `Post` route key to `slug`.
2. Bind `post` and `comment` explicitly in `RouteServiceProvider`.
3. Add scoped nested resources for comments under posts.

**Reason:** binding reduces lookup boilerplate and enforces URL/resource consistency.

### Step 3 — Isolate tenant traffic
1. Add domain group: `{tenant}.example.test`.
2. Add middleware to validate tenant key format.
3. In tenant controllers, assert resource ownership by tenant.

**Reason:** prevents cross-tenant data leaks.

### Step 4 — Add internal and signed routes
1. Add `/internal/route-health` web route with strict middleware.
2. Add signed invite acceptance route.

**Reason:** operational and security routing patterns are both core Laravel skills.

### Step 5 — Make route caching safe
1. Avoid closure routes in production route files.
2. Verify `php artisan route:cache` passes.
3. Add regression test for cache command.

**Reason:** route cache is common production optimization and frequent failure point.

### Step 6 — Test behavior as contracts
1. Test named route generation.
2. Test signed route generation/tampering behavior.
3. Test internal route protection.
4. Test cache-readiness.

**Reason:** routing bugs are high-impact and often break clients instantly.

---

## 3) Command execution flow (copy/paste)
```bash
# in your own environment
composer create-project laravel/laravel routing-lab
cd routing-lab

# copy lab files from this repository

php artisan migrate
php artisan route:list --path=api/v1
php artisan route:list --path=api/v2
php artisan route:list --path=internal
php artisan route:cache
php artisan route:clear
php artisan test tests/Feature/Routing
```

---

## 4) What “mastered” looks like for this topic
You can explain and demonstrate:
1. why each route group exists,
2. how bindings are resolved,
3. why versioning and throttling differ,
4. how tenant isolation is enforced,
5. how route caching impacts deploy safety.
