# Laravel Mastery Roadmap (A-Z)

This roadmap is designed for **complete mastery** (conceptual depth + architecture + production readiness), not just beginner/advanced checklists.

## How to use this roadmap
For each topic, master it in 5 dimensions:
1. **Internals** (how Laravel/PHP actually executes it)
2. **Design** (SOLID, boundaries, coupling/cohesion)
3. **Implementation** (idiomatic Laravel + alternatives)
4. **Testing** (unit/feature/integration/contract/performance)
5. **Production** (security, observability, scalability, failure modes)

---


## Program Modules in This Repository
1. Topic 01: [Core Runtime & Internals](TOPIC_01_CORE_RUNTIME_AND_INTERNALS.md)
2. Topic 02: [Routing A→Z](TOPIC_02_ROUTING_A_TO_Z.md)
3. Topic 03: [Middleware & HTTP Pipeline A→Z](TOPIC_03_MIDDLEWARE_HTTP_PIPELINE_A_TO_Z.md)
4. Topic 04: [Controllers, Actions & Application Layer Patterns A→Z](TOPIC_04_CONTROLLERS_ACTIONS_APPLICATION_LAYER_A_TO_Z.md)

### Cookbook Guides
- [Topic 02 Cookbook](TOPIC_02_ROUTING_COOKBOOK.md)
- [Topic 03 Cookbook](TOPIC_03_MIDDLEWARE_COOKBOOK.md)
- [Topic 04 Cookbook](TOPIC_04_APPLICATION_LAYER_COOKBOOK.md)

---

## 0) Prerequisite Foundations (language + platform)
1. Modern PHP (8.2+): OOP, traits, enums, attributes, generators
2. Composer deep dive: autoloading, scripts, version constraints
3. HTTP fundamentals: methods, status codes, caching semantics
4. SQL fundamentals: indexes, joins, execution plans, transactions
5. Linux/runtime basics: process model, env vars, file permissions
6. Git workflows: trunk-based, rebasing, release branching

---

## 1) Laravel Core Runtime & Framework Internals
1. Request lifecycle end-to-end
2. Service container internals (bindings, scopes, contextual binding)
3. Service providers (boot/register patterns)
4. Facades under the hood
5. Config system + env resolution + caching impact
6. Application bootstrapping and kernel flow
7. Package architecture and auto-discovery
8. Artisan internals and custom command design

---

## 2) Routing (A-Z)
1. Route definitions (web/api/console)
2. Named routes and URL generation
3. Parameters, constraints, optional segments
4. Route groups: prefix, name, middleware, namespace
5. Domain/subdomain routing
6. Resource and API resource routing
7. Route model binding (implicit, explicit, scoped)
8. Fallback routes and exception interplay
9. Signed and temporary signed URLs
10. Rate limiting integration
11. Route caching strategy and caveats
12. API versioning patterns (URI/header/media type)

---

## 3) Middleware & HTTP Pipeline
1. Middleware execution order and priorities
2. Global vs route middleware trade-offs
3. Parameterized middleware
4. Cross-cutting concerns (auth, throttling, locale, tenancy)
5. Idempotency middleware patterns
6. Request/response mutation safety
7. Performance impact and optimization

---

## 4) Controllers, Actions, and Application Layer Patterns
1. Thin controller principles
2. Single-action controllers
3. Action/UseCase classes
4. Service layer boundaries
5. DTOs and input/output contracts
6. Command/query separation (CQRS-lite)
7. Validation orchestration patterns

---

## 5) Validation & Data Integrity
1. Validator internals and rule lifecycle
2. Form Request architecture
3. Conditional and contextual validation
4. Custom rule objects
5. Nested/array validation complexity
6. Localization of validation messages
7. Validation vs domain invariants

---

## 6) Eloquent ORM Mastery
1. Model design and bounded context concerns
2. Relationship types (all variants)
3. Eager/lazy loading strategies + N+1 prevention
4. Query scopes (local/global) and composition
5. Accessors, mutators, casting (value objects, enums)
6. Model events, observers, and side effects
7. Polymorphism patterns and pitfalls
8. Soft deletes, pruning, archival strategies
9. Bulk operations and mass-assignment safety
10. Performance tuning with Eloquent

---

## 7) Query Builder, SQL, and Performance Engineering
1. Query builder advanced usage
2. Raw expressions safely
3. Index strategy and migration planning
4. Explain plans and query diagnostics
5. Pagination strategies (offset/cursor)
6. Read/write splitting patterns
7. Locking: pessimistic/optimistic strategies
8. Deadlock handling and retry semantics

---

## 8) Migrations, Schema Evolution, and Data Lifecycle
1. Forward/backward compatible migrations
2. Zero-downtime migration techniques
3. Data backfills and phased rollouts
4. Seeding strategies for dev/test/prod
5. Database versioning discipline in CI/CD
6. Backup/restore validation

---

## 9) Architecture & Design Principles (SOLID + Beyond)
1. SOLID in Laravel (pragmatic interpretation)
2. Repository pattern: when it helps vs harms
3. Unit of Work and transaction boundaries
4. Hexagonal/Clean Architecture mapping in Laravel
5. Domain services vs application services
6. Anti-corruption layers for external systems
7. Modular monolith structure
8. ADR (architecture decision records)

---

## 10) Authentication & Authorization
1. Auth guards/providers internals
2. Session-based auth mechanics
3. Sanctum and token strategies
4. OAuth2/Passport basics and advanced flows
5. Gates and policies at scale
6. Role/permission design (RBAC/ABAC hybrids)
7. Multi-tenant authorization boundaries
8. Security testing for authz bypass

---

## 11) API Engineering
1. REST maturity model and resource design
2. API Resources/Transformers patterns
3. Input validation + error contracts
4. Versioning/deprecation strategy
5. Idempotency keys and safe retries
6. API documentation (OpenAPI)
7. Consumer-driven contracts
8. GraphQL intro (optional comparative track)

---

## 12) Async Processing, Events, and Messaging
1. Queue architecture and drivers
2. Job design (idempotent, retry-safe)
3. Backoff/retry/dead-letter strategy
4. Event-driven design in Laravel
5. Outbox pattern and eventual consistency
6. Sagas/process managers (conceptual)
7. Scheduler reliability and drift handling

---

## 13) Caching & State Management
1. Cache store internals and trade-offs
2. Cache invalidation strategies
3. Stampede prevention (locks, jitter)
4. Tagged cache usage
5. Session storage strategies and scaling
6. HTTP caching headers and CDN interplay

---

## 14) Realtime, Broadcasting, and Notifications
1. Broadcasting architecture
2. Channel authorization patterns
3. WebSockets scaling concerns
4. Notification channel strategy (mail/SMS/slack)
5. Delivery guarantees and observability

---

## 15) Files, Storage, and Media Pipelines
1. Filesystem abstraction drivers
2. Large upload strategies (chunking, direct-to-cloud)
3. Signed URLs + secure download flows
4. Media transformation pipelines
5. Retention and lifecycle management

---

## 16) Testing Excellence
1. Testing pyramid adapted for Laravel
2. Unit vs feature vs integration boundaries
3. Database testing strategies
4. Fakes/mocks/spies and over-mocking pitfalls
5. Contract tests for external integrations
6. Snapshot testing where appropriate
7. Mutation testing concepts
8. Test performance and flakiness reduction

---

## 17) Observability & Operability
1. Structured logging and correlation IDs
2. Metrics and SLO basics
3. Tracing fundamentals
4. Error monitoring and triage workflows
5. Laravel Telescope/Pulse usage
6. Incident response playbooks

---

## 18) Security Mastery
1. OWASP Top 10 mapped to Laravel
2. CSRF/XSS/SQLi hardening beyond defaults
3. Secure headers and CSP
4. Secret management and rotation
5. Dependency and supply-chain security
6. Abuse prevention (rate limiting, bot mitigation)
7. Secure coding review checklist

---

## 19) DevEx, Tooling, and Quality Gates
1. PHPStan/Larastan at strict levels
2. Code style automation (Pint)
3. Rector and safe refactoring
4. Pre-commit/pre-push pipelines
5. CI matrix design
6. Monorepo or multi-repo trade-offs

---

## 20) Deployment, Infrastructure, and Scaling
1. Deployment models (VM/container/serverless)
2. Horizontal scaling of Laravel apps
3. Queue worker autoscaling
4. Session/cache/shared-state strategies
5. Blue-green/canary deployments
6. Rollback-safe release workflows
7. Cost/performance optimization

---

## 21) Advanced Domain Topics (choose by product type)
1. Multi-tenancy models (single DB/schema/db-per-tenant)
2. Fintech-grade auditing and ledger patterns
3. E-commerce pricing/promotions architecture
4. Workflow/state machine orchestration
5. Internationalization/localization at scale
6. Search architecture (Scout/Elasticsearch/Meilisearch)

---

## 22) Capstone Tracks (mastery validation)
1. **API Platform Capstone**: versioned APIs, authz, caching, queues, observability
2. **Modular Monolith Capstone**: domain modules + clear boundaries
3. **Multi-tenant SaaS Capstone**: tenant isolation + billing + analytics
4. **High-throughput Ingestion Capstone**: queue-heavy event pipeline

---

## Mastery Rubric (for every topic)
You are "mastered" only when you can:
1. Explain internals clearly from memory
2. Implement two architectural variants and justify trade-offs
3. Write comprehensive automated tests
4. Diagnose performance/security risks
5. Operate it in production with monitoring + runbooks
6. Teach the topic to another engineer with examples

---

## Suggested sequencing (high-impact path)
1. Core Runtime → Routing → Middleware → Validation
2. Eloquent → SQL/Performance → Migrations
3. SOLID/Architecture → Auth/Authz → API Engineering
4. Queues/Events → Caching → Testing Excellence
5. Security → Observability → Deployment/Scaling
6. Domain-specific advanced tracks + capstone

Next step after Topic 04 is Topic 05 (**Validation & Data Integrity A→Z**).
