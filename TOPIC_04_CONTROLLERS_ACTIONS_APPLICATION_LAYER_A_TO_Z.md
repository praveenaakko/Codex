# Topic 04 — Controllers, Actions & Application Layer Patterns A→Z

> Goal: design clean Laravel application flow where controllers orchestrate, actions execute use-cases, and infrastructure stays replaceable.

## Implementation Assets in Repo
- Code lab folder: `topic04-application-layer-lab/`
- Command walkthrough: `topic04-application-layer-lab/README.md`
- Cookbook walkthrough (why + file-by-file): `TOPIC_04_APPLICATION_LAYER_COOKBOOK.md`

---

## 1) Mastery Outcomes
1. Build thin controllers with strict request/response responsibilities.
2. Use Action classes for application use-cases.
3. Introduce DTOs to isolate transport input from domain behavior.
4. Depend on repository contracts rather than concrete persistence.
5. Test controller orchestration and action behavior independently.

## 2) Scope Map
- Controller responsibilities and anti-patterns.
- Action/use-case class boundaries.
- DTO mapping and validation handoff.
- Repository contracts and implementation swapping.
- Transaction boundaries and exception mapping.
- Feature vs unit testing for application layer.

## 3) Build Project
**Order Placement API (Application Layer Focus)**

Deliverables:
1. `POST /api/orders` endpoint.
2. `PlaceOrderAction` use-case class.
3. `PlaceOrderData` DTO.
4. `OrderRepository` contract + Eloquent implementation.
5. Feature tests for endpoint behavior + unit test seam for action.

## 4) Architecture Constraints
1. No business logic inside controllers.
2. No request object in action signatures (use DTO).
3. Repository interface used in action constructor.
4. Controller handles HTTP concerns only.

## 5) Next Step
Topic 05: **Validation & Data Integrity A→Z**.
