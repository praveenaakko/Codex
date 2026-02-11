# Topic 02 — Routing A→Z (Mastery Track)

This module turns routing from “I know route syntax” into production-grade mastery.

> Goal: design, secure, version, test, and scale routing for large Laravel systems.

---


## Implementation Assets in Repo
- Code lab folder: `topic02-routing-lab/`
- Command walkthrough: `topic02-routing-lab/README.md`

---

## 1) Mastery Outcomes (Definition of Done)
By the end of this topic, you should be able to:

1. Design routing topology for monolith, modular monolith, and API-first services.
2. Apply advanced route model binding and constraints without hidden bugs.
3. Implement route versioning strategies and explain trade-offs.
4. Use route caching safely and diagnose cache-related failures.
5. Build secure internal/public route boundaries with middleware + policies.
6. Write robust feature tests for routing matrix and failure paths.

---

## 2) Scope Map (A→Z for Routing)

### A. Core Route Definitions
- `web.php`, `api.php`, and specialized route files.
- HTTP verb semantics (idempotency/safety implications).
- Named routes, URL generation, signed URLs.

### B. Parameters & Constraints
- Required/optional parameters.
- Regex constraints and global patterns.
- Encoded values, UTF-8 slugs, reserved characters.

### C. Groups and Topology
- Prefix + name grouping strategy.
- Middleware stacking and order sensitivity.
- Domain/subdomain and tenant routing.

### D. Resource Routing
- `resource`, `apiResource`, `only/except`, shallow nesting.
- Nested resources and URL design quality.
- Route naming conventions at scale.

### E. Route Model Binding
- Implicit/explicit binding.
- Custom keys and scoped bindings.
- Soft-deleted model behavior.
- Failure handling (`missing()`, 404 strategy).

### F. Security & Integrity
- Signed + temporary signed routes.
- Route-level throttling and abuse defense.
- Internal diagnostics/admin route hardening.

### G. API Versioning
- URI versioning (`/v1`), header versioning, media-type versioning.
- Backward compatibility and deprecation strategy.
- Parallel route trees and migration plans.

### H. Performance & Operability
- `route:cache` constraints (closures, dynamic registration pitfalls).
- Boot-time registration cost in large apps.
- Route list auditing and dead-route cleanup.

---

## 3) Build Project (Focused Module)

### Module Name
**Versioned Tenant API Router**

### Deliverables
1. Route architecture with:
   - public API v1 + v2,
   - internal admin routes,
   - tenant subdomain routes.
2. Model binding examples:
   - slug binding,
   - scoped nested binding,
   - custom missing behavior.
3. Security setup:
   - signed invite route,
   - per-group throttle policies,
   - strict middleware boundaries.
4. Operational tooling:
   - command/checklist for route cache compatibility.
5. Full feature test matrix for happy path + edge cases.

---

## 4) Architecture Constraints (SOLID-aligned)

1. Route files define transport concerns only; no business logic.
2. Controllers stay orchestration-only; use actions/services for behavior.
3. Keep route naming stable as contracts for frontend/clients.
4. Versioning policy must be explicit and documented.
5. Internal routes must be isolated by prefix + middleware + authz.

---

## 5) Implementation Plan (Execution Steps)

### Step 1 — Route Topology Blueprint
- Define files/groups for public API, admin, and tenant routes.
- Set naming and prefix conventions (`api.v1.*`, `api.v2.*`, `admin.*`).

### Step 2 — Binding Mastery
- Implement slug-based implicit binding.
- Add nested scoped binding for child resources.
- Implement custom missing handler with structured API response.

### Step 3 — Versioning
- Build `v1` and `v2` route trees for 1 resource.
- Keep shared logic in application layer, not duplicated controllers.
- Add deprecation headers for v1 endpoints.

### Step 4 — Security Hardening
- Add signed route for invitation flow with expiry.
- Add throttle rules by route group and actor type.
- Ensure admin/internal groups require strict middleware and policies.

### Step 5 — Route Cache Readiness
- Remove closure routes from production path.
- Validate `route:cache` compatibility.
- Add deployment note on cache clear/build ordering.

### Step 6 — Testing Matrix
- Route resolution tests (name → URL, URL → action).
- Middleware enforcement tests (authz/throttle/signature).
- Binding failure tests (404, missing behavior, soft-delete behavior).
- Version parity tests (v1 vs v2 expected differences).

---

## 6) Testing Checklist (Non-Negotiable)

### Feature tests
- Named route generation matches expected URLs.
- Middleware stack protects internal/admin routes.
- Signed URLs reject tampered and expired signatures.
- Throttling behaves per group definition.
- Model binding resolves correct models and scopes.
- Versioned endpoints return expected response contracts.

### Regression tests
- Route cache command succeeds in CI.
- No closure routes in production routing files.
- Deprecated routes emit expected warning/deprecation metadata.

### Quality gates
- PHPStan/Larastan passes on routing/controller layer.
- Pint passes.

---

## 7) Pitfalls You Must Intentionally Learn

1. Hidden breaking changes via route name changes.
2. Route model binding leaking cross-tenant data.
3. Over-nesting resource routes causing poor API UX.
4. Route cache breaks due to closures.
5. Inconsistent versioning between docs and code.
6. Misordered middleware causing auth/throttle bugs.

For each pitfall, document:
- symptom,
- root cause,
- fix,
- prevention rule.

---

## 8) Production Readiness Checks

1. Route naming/versioning convention documented and enforced.
2. `route:cache` part of release pipeline with rollback plan.
3. Tenant routes validated for isolation and authorization.
4. Signed routes audited for expiry and replay risks.
5. Dead/unused routes reviewed each release cycle.

---

## 9) Review Rubric (Score Yourself 0–3)

Categories:
1. Route architecture clarity
2. Binding correctness and safety
3. Versioning strategy quality
4. Security and middleware boundary correctness
5. Test depth and regression coverage
6. Operability (`route:cache`, auditing, release safety)

Target: **at least 15/18** before moving to Topic 03.

---

## 10) What We Do Next (after this)
Topic 03 will be **Middleware & HTTP Pipeline A→Z** with:
- middleware priority internals,
- idempotency patterns,
- request/response mutation safety,
- performance profiling,
- cross-cutting architecture design.
