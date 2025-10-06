# Event Booking System (Backend)

## Overview
This is a Laravel 12 backend for an Event Booking System. It includes:

- User authentication (Sanctum)
- Event & ticket management
- Booking & payments (mocked)
- Role-based access control
- Middleware, services, and traits
- Notifications & caching
- REST API with standardized responses

---

## Setup Instructions

### 1. Clone the project
```bash
git clone <your-repo-link>
cd event-booking-system
```
### 2. Install Dependencies
```bash
composer install
```
### 3.Configure Environment
```
Copy .env.example to .env and update database config so you connect to a database:
cp .env.example .env
php artisan key:generate
```
### 4.Run Migrations & seeders
```bash
php artisan migrate --seed

Seeded data includes:

2 Admins

3 Organizers

10 Customers

5 Events

15 Tickets

20 Bookings

20 Payments
```

### 5.Serve the Application
```bash
php artisan serve
```

### 6.Postman Apis Collection
```
you can find it in this directory path
/postman/EventBookingAPI.postman_collection.json
```

### 7.Features
```
Authentication & Authorization

Implemented via Laravel Sanctum

Role-based access control:

Admin → Manage all events, tickets, bookings

Organizer → Manage own events & tickets

Customer → Book tickets & view bookings

Middleware 

Authenticate → Checks if user is logged in

RoleMiddleware → Checks if user has the required role

PreventDoubleBookingMiddleware → Prevents booking same ticket twice

Notifications & Queues

Booking confirmation notification to customers

Frequently accessed events are cached for faster responses

Factories & Seeders

Seeders populate database with sample users, events, tickets, and bookings
````

### 8.Standardized Api Responses
```
{
    "success": true,
    "data": {...},
    "message": "Success",
    "timestamp": "2025-10-06 18:00:00"
}
```

### 9.Note
```
After logging in, the API will return an access token, save it.  
Use this token as a **Bearer Token** in the
**Authorization header** 
when testing protected API endpoints.
```
### Author
    Developed by : Dimitri Zakkour
    Email : DimitriZakkour@gmail.com
    Date: 2025-10-06

