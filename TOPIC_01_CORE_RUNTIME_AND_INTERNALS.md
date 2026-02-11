# Topic 01 — Laravel Core Runtime & Internals (Mastery Track)

This is the first hands-on module in your Laravel mastery program.

> Goal: move from “I can use Laravel” to “I can explain and shape framework behavior in production systems.”

---

## 1) Mastery Outcomes (Definition of Done)
By the end of this topic, you should be able to:

1. Explain Laravel request lifecycle from `public/index.php` to response emission.
2. Trace service container resolution and debug binding conflicts quickly.
3. Design clean provider registration patterns for app modules/packages.
4. Explain facades vs dependency injection trade-offs with confidence.
5. Use config/env caching safely across local/staging/production.
6. Implement and test custom Artisan commands with good DX.

If you cannot teach these with examples from your own code, topic is not done.

---

## 2) Scope Map (A→Z for this Topic)

### A. Request Lifecycle
- Front controller and bootstrap process.
- HTTP kernel and middleware pipeline.
- Router dispatch and controller/action execution.
- Exception handling and response serialization.
- Terminable middleware and post-response work.

### B. Service Container Internals
- Bindings: `bind`, `singleton`, `scoped`, `instance`.
- Zero-config autowiring and constructor resolution.
- Interface-to-implementation mapping.
- Contextual bindings for module-specific behavior.
- Tagged services and iterable strategies.
- Extenders, rebinding events, and resolving callbacks.

### C. Service Providers
- `register()` vs `boot()` responsibilities.
- Provider loading order and side-effect safety.
- Deferred providers and lazy loading considerations.
- Splitting providers by domain/module.
- Package provider conventions.

### D. Facades & Contracts
- How facade root resolution works.
- Why facades can still be testable.
- Replacing static calls with contracts where appropriate.
- Anti-patterns (hidden dependencies, facade overuse).

### E. Config + Environment
- Config files as app contracts.
- `env()` usage rules and runtime caveats.
- `config:cache` behavior and deployment implications.
- Feature flags and environment-aware composition.

### F. Artisan Internals
- Command signature design for usability.
- Input/output ergonomics.
- Command bus integration and domain actions.
- Scheduling integration.

---

## 3) Build Project (Focused Module)

### Module Name
**Runtime Inspector + Container Playground**

### Why this module
Instead of a broad app, this module forces you to inspect Laravel internals through code and logs.

### Deliverables
1. `/internal/health/runtime` endpoint
   - Returns boot metadata: app env, config cache state, loaded providers summary.
2. `/internal/diagnostics/container` endpoint
   - Demonstrates container resolution paths for selected contracts.
3. Custom command: `php artisan internal:probe`
   - Runs runtime checks and prints diagnosis table.
4. Middleware: `TraceRequestLifecycle`
   - Captures request timing, middleware chain timing, correlation ID.
5. Test suite for all above (feature + unit)

---

## 4) Architecture Constraints (SOLID-aligned)

1. Keep controllers thin; orchestration only.
2. Put runtime introspection logic in application services.
3. Use interfaces for probe engines (`ProbeContract`).
4. Wire implementations in dedicated provider (`InternalDiagnosticsServiceProvider`).
5. No facade calls in domain-level services.
6. Keep all internal routes under auth + role/permission gate in real projects.

---

## 5) Implementation Plan (Execution Steps)

### Step 1 — Bootstrap Observability
- Add correlation ID middleware.
- Ensure ID is attached to logs and response headers.
- Add request duration metric in logs.

### Step 2 — Container Playground
- Create 2–3 contracts with multiple implementations.
- Bind default + contextual binding variants.
- Build endpoint that resolves and displays active concrete classes.

### Step 3 — Provider Discipline
- Create dedicated provider for this module.
- Move all bindings out of random files into the provider.
- Add comments documenting why each binding exists.

### Step 4 — Runtime Probe Command
- Implement checks:
  - config cached?
  - route cached?
  - queue connection reachable? (mock in tests)
  - expected bindings resolvable?
- Print clear pass/fail summary and actionable hints.

### Step 5 — Facade vs Contract Refactor Drill
- Pick one service initially called with facade.
- Refactor to contract-based DI.
- Compare testability and readability in notes.

### Step 6 — Hardening
- Add exception mapping for probe failures.
- Ensure internal endpoints are protected.
- Add rate limiter for internal diagnostics routes.

---

## 6) Testing Checklist (Non-Negotiable)

### Unit tests
- Provider registers expected bindings.
- Contextual binding returns correct implementation.
- Probe services classify states correctly.

### Feature tests
- Internal endpoints return expected schema.
- Middleware adds correlation header.
- Unauthorized access to internal routes is denied.
- `internal:probe` exits with expected status codes.

### Quality gates
- Static analysis (Larastan/PHPStan) passes.
- Code style (Pint) passes.
- Mutation testing optional bonus for probe logic.

---

## 7) Pitfalls You Must Intentionally Learn

1. Using `env()` outside config files in production code.
2. Overusing facades and hiding dependencies.
3. Registering side effects in `register()` incorrectly.
4. Circular dependencies inside container bindings.
5. Depending on non-cached behavior in deployment pipelines.

Create one short note for each pitfall with:
- symptom,
- root cause,
- fix,
- prevention rule.

---

## 8) Production Readiness Checks

1. Internal routes behind strict auth and IP/rate policies.
2. Correlation IDs available in all logs.
3. Probe command integrated in pre-deploy checklist.
4. Config/route cache strategy documented.
5. Rollback steps documented for container/provider changes.

---

## 9) Review Rubric (Score Yourself 0–3)

Score each category:
- 0 = weak, 1 = partial, 2 = good, 3 = production-ready

Categories:
1. Lifecycle explanation accuracy
2. Container mastery and debugging speed
3. Provider architecture quality
4. Test quality and coverage depth
5. Security posture of internal tooling
6. Clarity of trade-off decisions (facade vs DI, singleton vs scoped)

Target: **at least 14/18** before moving to Topic 02.

---

## 10) What We Do Next (after you complete this)
Topic 02 will be **Routing A→Z** with:
- advanced routing matrix,
- route model binding edge-cases,
- versioning strategies,
- route caching constraints,
- full route testing harness.

If you want, I can generate Topic 02 immediately in the same format once this is done.
