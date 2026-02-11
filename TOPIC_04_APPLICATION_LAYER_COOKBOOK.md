# Topic 04 Cookbook — Controllers, Actions & Application Layer

## What we are building
A minimal **Order Placement API** that demonstrates clean architecture inside Laravel:
- Controller = HTTP adapter,
- Action = use-case orchestration,
- DTO = typed input contract,
- Repository contract = persistence abstraction.

## Why this topic matters
Most Laravel codebases become hard to change because controllers accumulate business logic. This topic trains a repeatable structure that scales with team size.

## File-by-file rationale
- `routes/api.php`: exposes one API use-case route.
- `CreateOrderController.php`: maps request to DTO, calls action, formats response.
- `PlaceOrderData.php`: immutable typed input for application layer.
- `PlaceOrderAction.php`: business flow orchestration.
- `OrderRepository.php`: contract for persistence.
- `EloquentOrderRepository.php`: current DB implementation.
- `AppServiceProvider.php`: container binding from contract to implementation.
- `PlaceOrderControllerTest.php`: verifies endpoint + orchestration outcomes.

## Step-by-step build
1. Create route and invokable controller.
2. Add request validation in controller.
3. Map payload into DTO.
4. Call action with DTO.
5. Bind repository interface to concrete class.
6. Return 201 response with created entity.
7. Add tests for success and validation failures.

## Commands (local machine)
```bash
composer create-project laravel/laravel app-layer-lab
cd app-layer-lab
# copy topic04-application-layer-lab/* to your app
php artisan test tests/Feature/ApplicationLayer
```

## Mastery check
You can explain why each layer exists and replace repository implementation without touching controller/action code.
