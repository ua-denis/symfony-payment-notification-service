# Payment Notification Service

## Overview

The Payment Notification Service is designed to handle notifications from various payment systems, process the payment data, and store it in a database. It adheres to Clean Architecture and Hexagonal Architecture principles to ensure maintainability, scalability, and high performance.

## Features

- Handles notifications from multiple payment systems (OnePay, TwoPay, ThreePay, etc.).
- Uses JWT for authentication.
- Validates input data for each payment system.
- Processes payment data and stores it in a MySQL database.
- Implements caching to reduce database load.
- Supports asynchronous processing with RabbitMQ.
- Encrypts sensitive data.

## Requirements

- PHP 8.2
- Symfony 7.1
- MySQL
- Redis (for caching)
- RabbitMQ (for asynchronous processing)
- Composer

## Installation
1. **Install dependencies:**
   ```bash
   composer install
   ```
2. **Configure environment variables:**
   Create a `.env.local` file and set the necessary environment variables:
   ```env
   DATABASE_URL="mysql://username:password@127.0.0.1:3306/database_name"
   JWT_SECRET="your_jwt_secret"
   MESSENGER_TRANSPORT_DSN="amqp://guest:guest@localhost:5672/%2f"
   REDIS_URL="redis://localhost:6379"
   ```
3. **Run database migrations:**
   ```bash
   php bin/console doctrine:migrations:migrate
   ```
4. **Set up RabbitMQ:**
   Make sure RabbitMQ is running and accessible with the provided DSN.

## Usage

### Authentication

The service uses JWT for authentication. Make sure to include the JWT token in the `Authorization` header for all requests.

### Endpoints

#### 1. Handle Payment Notifications

**Endpoint:**
```
POST /payment/{paymentSystem}
```

**Description:**
Handles payment notifications from the specified payment system.

**Parameters:**
- `paymentSystem`: The name of the payment system (e.g., `onepay`, `twopay`, `threepay`).

**Request Body:**
The request body should contain the payment data in JSON format, specific to the payment system.

**Example:**
```bash
curl -X POST http://localhost/payment/onepay -H "Authorization: Bearer your_jwt_token" -H "Content-Type: application/json" -d '{
    "transactionId": "9cb3a8a0-1837-1829-9483-704e9013275c",
    "userOrderId": "12345",
    "amount": "50",
    "currency": "USD",
    "status": "complete",
    "orderCreatedAt": "2020-06-02T00:09:09+00:00",
    "orderCompleteAt": "2020-06-02T00:09:53+00:00",
    "refundedAmount": "0",
    "provisionAmount": "0",
    "hash": "5b28c51bb32776e648c94f255ada4cc82212f6b5a785ab37439fcb236a45b03a",
    "email": "patrik@gmail.com",
    "paymentMethod": "creditcard",
    "paymentMethodGroup": "cps",
    "isCash": "0",
    "sendPush": "1",
    "processingTime": "0"
}'
```

### Services and Architecture

The application follows Clean Architecture and Hexagonal Architecture principles, structured as follows:

- **Application Layer**: Contains use cases (`ProcessPaymentUseCase`) that handle the business logic.
- **Domain Layer**: Contains domain models (`Payment`) and repository interfaces (`PaymentRepositoryInterface`).
- **Infrastructure Layer**: Contains the repository implementations (`PaymentRepository`), services, and external integrations.
- **Presentation Layer**: Contains controllers (`PaymentController`) to handle HTTP requests.