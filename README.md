1. Laravel E-Commerce Integration Backend

This repository contains the **Laravel 9 backend** for the E-Commerce integration task with Magento 2. It handles product synchronization, order management, and API endpoints to communicate with Magento.

---

2. Requirements

- PHP 8.1.17  
- Composer  
- Laravel 9  
- MySQL or compatible database  
- Queue driver (database or Redis) for asynchronous tasks  
- Postman for API testing  

---

3. Setup Instructions

3.1 Clone the repository

```bash
git clone https://github.com/Seif-Moustafa-Hassan/laravel-ecommerce-task.git
cd laravel-ecommerce-task

3.2 Install dependencies

```bash
composer install

3.3 Copy environment file

```bash
cp .env.example .env

3.4 Configure environment

APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ecommerce
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

3.5 Generate application key

```bash
php artisan key:generate

3.6 Run migrations

```bash
php artisan migrate

3.7 Seed sample data

```bash
php artisan db:seed

4. Artisan Commands

4.1 Sync products from Magento

```bash
php artisan products:sync
-- Fetches products from Magento and stores/updates them in Laravel.

4.2 Run queue worked

```bash
php artisan queue:work
-- Fetches products from Magento and stores/updates them in Laravel.

5. API Endpoints

5.1 Trigger Product Sync

Endpoint: GET /api/products/sync
Description: Manually triggers a product sync from Magento.
Sample Response:
{
  "message": "Product sync triggered successfully",
  "output": "3 products dispatched to queue."
}

5.2 List Products

Endpoint: GET /api/products
Description: Returns a list of products in Laravel.
Sample Response:
[
  {
    "id": 1,
    "sku": "ABC123",
    "name": "Product 1",
    "price": 100,
    "qty": 20,
    "external_product_id": "MAG-001"
  },
  {
    "id": 2,
    "sku": "DEF456",
    "name": "Product 2",
    "price": 150,
    "qty": 10,
    "external_product_id": "MAG-002"
  }
]

5.3 Order Webhook (Receive Magento Order Updates)

Endpoint: POST /api/orders/webhook
Description: Receives order events from Magento.
Sample Payload:
{
  "order_id": 101,
  "increment_id": "000000101",
  "customer": {
    "name": "John Doe",
    "email": "john@example.com"
  },
  "items": [
    {"sku": "ABC123", "qty": 1, "price": 100},
    {"sku": "DEF456", "qty": 2, "price": 150}
  ],
  "subtotal": 400,
  "grand_total": 420,
  "status": "processing",
  "created_at": "2026-03-12T10:00:00Z"
}

6. Queue and Background Processing

Products and orders are processed asynchronously using Laravel queues.
Ensure a queue worker is running:
```bash
php artisan queue:work
-- For production, use a process manager like supervisor to keep the worker running continuously.

7. API Testing

Use Postman to test all endpoints.
Endpoints available for testing:
Product sync
Product listing
Order webhook

8. Notes

This repository is the Laravel backend only. Magento 2 integration will be handled in a separate repository.
Artisan commands allow manual triggering and testing of product sync and queued jobs.
Ensure QUEUE_CONNECTION is properly configured in .env to process asynchronous tasks.

9. Author
Seif Moustafa
GitHub: https://github.com/Seif-Moustafa-Hassan
Email: seif.moustafa2001@gmail.com
