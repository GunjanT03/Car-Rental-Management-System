# 🚗 Car Rental Management System

## Overview

The **Car Rental Management System** is a web-based application developed using **PHP, MySQL, HTML, CSS, and JavaScript**. It automates the process of renting vehicles by providing an easy-to-use platform for customers to browse, book, and manage car rentals, while enabling administrators to efficiently manage cars, users, and bookings.

The project is designed to simplify the traditional car rental process through a secure and user-friendly interface.

---

# Features

## Customer Module

* User Registration and Login
* Secure session-based authentication
* Browse available cars
* View car images and rental prices
* Book cars by selecting rental duration or booking dates
* View all personal bookings
* Cancel existing bookings
* Contact Us page for customer support
* Logout functionality

---

## Admin Module

* Secure Admin Login
* Dashboard with system statistics
* Add new cars
* Upload car images
* Edit car information
* Delete cars
* View all customer bookings
* Delete customer bookings
* Manage vehicle availability

---

# Technology Stack

### Frontend

* HTML5
* CSS3
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Server

* Apache (XAMPP)

---

# Database Tables

The project contains the following tables:

### Users

Stores customer information.

* id
* name
* email
* password

### Admin

Stores administrator credentials.

* id
* username
* password

### Cars

Stores vehicle details.

* car_id
* car_name
* model
* rent
* status
* image

### Bookings

Stores booking records.

* booking_id
* user_id
* car_id
* booking_date
* start_date
* end_date
* days
* total_amount

### Contact Messages

Stores customer queries.

* id
* email
* subject
* message
* sent_at

---

# Project Structure

```
car/
│
├── admin/
│   ├── admin_login.php
│   ├── dashboard.php
│   ├── add_car.php
│   ├── edit_car.php
│   ├── delete_car.php
│   ├── delete_booking.php
│   └── logout.php
│
├── css/
│   └── style.css
│
├── images/
│   ├── default_car.jpg
│   └── car images...
│
├── db.php
├── index.php
├── signup.php
├── available_cars.php
├── book_car.php
├── success.php
├── cancel_booking.php
├── contact.php
├── logout.php
└── README.md
```

---

# Installation

## Step 1

Install **XAMPP**.

## Step 2

Copy the project folder into:

```
htdocs/
```

Example:

```
C:\xampp\htdocs\car
```

## Step 3

Start:

* Apache
* MySQL

from the XAMPP Control Panel.

## Step 4

Open phpMyAdmin.

Create a database named:

```
car
```

## Step 5

Import the SQL database file.

## Step 6

Open your browser:

```
http://localhost/car
```

---

# Project Workflow

1. Customer registers an account.
2. Customer logs into the system.
3. Customer browses available cars.
4. Customer selects a car.
5. Customer books the car.
6. Booking information is stored in the database.
7. Customer can view or cancel bookings.
8. Administrator manages vehicles and bookings through the admin dashboard.

---

# Key Functionalities

* Secure Login Authentication
* Session Management
* CRUD Operations
* Database Connectivity using PHP MySQL
* Responsive User Interface
* Booking Management
* Image Upload for Cars
* Booking Confirmation
* Contact Support Module

---

# Future Enhancements

* Online Payment Gateway Integration
* QR Code-Based Booking Confirmation
* Email Notifications
* Password Encryption using `password_hash()`
* Advanced Search and Filters
* Customer Reviews and Ratings
* Parallel Booking Support
* Live Vehicle Tracking
* Mobile Application Integration
* AI-Based Car Recommendation System

---

# Learning Outcomes

This project demonstrates practical knowledge of:

* PHP Programming
* MySQL Database Management
* CRUD Operations
* Session Handling
* Form Validation
* Relational Database Design
* Web Application Development
* Frontend and Backend Integration

---

# Author

**Gunjan Tajane**

Bachelor of Engineering (Electronics & Telecommunication)

Savitribai Phule Pune University

---

# License

This project is developed for **educational and academic purposes**. It may be modified and extended for learning, research, and personal projects.
