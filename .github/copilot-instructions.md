# Copilot Instructions for AlertAppNew

## Overview
This project is a Laravel-based web application for managing alert events (e.g., panic button activations) within an organization. It uses Laravel's MVC structure, Eloquent ORM, and AdminLTE for the admin panel UI. The app is designed for extensibility and internal notification workflows.

## Architecture & Key Components
- **Controllers:** Business logic is in `app/Http/Controllers/`. Example: `AlertaPanicosController.php` handles panic alert activations and notifications.
- **Models:** Eloquent models in `app/Models/` represent core entities like `AlertaPanicos`, `Configuracion`, `Persona`, `Sede`, and `User`.
- **Views:** Blade templates in `resources/views/` (organized by feature/module) render the UI. AdminLTE is used for layout and menu configuration (`config/adminlte.php`).
- **Routes:** Web routes are defined in `routes/web.php`.
- **Migrations/Seeders:** Database schema and seed data are in `database/migrations/` and `database/seeders/`.
- **Notifications:** The app is evolving from external (Telegram) notifications to internal, database-driven notifications and event tracking.

## Developer Workflows
- **Run locally:**
  - Use XAMPP or Laragon for local development (PHP, MySQL, Composer, Node.js).
  - Start the server: `php artisan serve` or via Apache/Nginx.
- **Database:**
  - Migrate: `php artisan migrate`
  - Seed: `php artisan db:seed`
- **Assets:**
  - Compile assets: `npm install && npm run dev`
- **Testing:**
  - Run tests: `php artisan test` (tests in `tests/Feature/` and `tests/Unit/`)

## Project-Specific Patterns & Conventions
- **AdminLTE Menu:**
  - Sidebar/top navigation is configured in `config/adminlte.php` under the `'menu'` key. Use `'can'` for permission-based visibility.
- **Alert/Event Handling:**
  - Alert activations are stored in the database and can trigger notifications to specific user roles.
  - Event processing includes adding notes and changing event status (e.g., pending, processing, closed).
- **Internal Notifications:**
  - Use Laravel's notification system (`Notification::send(...)`) for in-app alerts. Store notifications in the database for audit/history.
- **Role/Permission Management:**
  - Uses Spatie's Laravel Permission package (see `config/permission.php`).
- **Session Usage:**
  - Session variables are used to track context (e.g., `sede_id`, `consultorio`, `tipo`).

## Integration Points
- **External:**
  - Telegram integration (being phased out) via HTTP requests in controllers.
- **Internal:**
  - Notifications, event logs, and user management are handled via Laravel features and Eloquent relationships.

## Examples
- To add a new admin menu item, edit `config/adminlte.php`:
  ```php
  [
    'text' => 'Eventos de Alerta',
    'url' => 'admin/eventos',
    'icon' => 'fas fa-fw fa-bell',
    'can' => 'admin.eventos.index',
  ],
  ```
- To send a notification to a user:
  ```php
  Notification::send($user, new EventoAlertaNotification($evento));
  ```

## Key Files/Directories
- `app/Http/Controllers/AlertaPanicosController.php` – Alert logic
- `config/adminlte.php` – Admin panel/menu config
- `app/Models/` – Eloquent models
- `resources/views/` – Blade templates
- `routes/web.php` – Web routes
- `database/migrations/` – DB schema

---
For more details, see the README.md or ask for specific workflow examples.
