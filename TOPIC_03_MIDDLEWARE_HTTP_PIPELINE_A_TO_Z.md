# Topic 03 — Middleware & HTTP Pipeline A→Z (Mastery Track)

> Goal: master cross-cutting architecture through middleware design, ordering, safety, and observability.

## Implementation Assets in Repo
- Code lab folder: `topic03-middleware-lab/`
- Command walkthrough: `topic03-middleware-lab/README.md`
- Cookbook walkthrough (why + file-by-file): `TOPIC_03_MIDDLEWARE_COOKBOOK.md`

---

## 1) Mastery Outcomes
1. Explain middleware execution flow and priority impacts.
2. Build idempotency protection for write endpoints.
3. Add request correlation and structured timing logs.
4. Enforce tenant + API-key boundaries in middleware.
5. Test middleware behavior with feature tests and failure cases.

## 2) Scope Map (A→Z)
- Global vs route middleware.
- Middleware ordering and short-circuit behavior.
- Before/after middleware response mutation.
- Parameterized middleware and policy wiring.
- Idempotency keys and replay-safe writes.
- Correlation IDs and observability hooks.
- Security middleware: API key + tenant assertions.
- Performance concerns and exception mapping.

## 3) Build Project (Focused Module)
**Pipeline Guard Lab**

Deliverables:
1. `AssignCorrelationId` middleware.
2. `RequireApiKey` middleware for protected groups.
3. `PreventDuplicateRequests` idempotency middleware.
4. `/api/pipeline/orders` demo endpoint protected by middleware chain.
5. Feature tests for success, replay, missing key, and ordering behavior.

## 4) Architecture Constraints
1. Middleware does transport/security concerns only.
2. No domain logic inside middleware.
3. Idempotency storage abstraction via contract/service.
4. Controller remains orchestration-only.

## 5) Execution Plan
1. Add middleware classes and aliases in `Kernel.php`.
2. Build route group with explicit middleware order.
3. Implement replay lock key using request fingerprint + key header.
4. Add correlation ID response header + log context.
5. Add tests for all boundary conditions.

## 6) Testing Checklist
- Missing API key returns 401.
- Duplicate idempotency key returns 409.
- Valid request returns 201 with correlation header.
- Middleware order verified through side effects/log markers.

## 7) Production Readiness
- Redis-backed idempotency store.
- Key expiration policy documented.
- Correlation IDs propagated to queue jobs/downstream calls.
- Abuse limits via throttling + API gateway.

## 8) Next Step
Topic 04: **Controllers, Actions & Application Layer Patterns A→Z**.
