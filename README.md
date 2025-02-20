# BlogTech

## Introduction

**BlogTech** is a modern and fully responsive blog platform built with Laravel. It provides a seamless experience for both content creators and readers, offering features such as user authentication, article management, and newsletter subscriptions.

## Features

-   User authentication (Admin & Subscribers)
-   CRUD operations for blog posts
-   Category and tag management
-   Newsletter subscription system
-   Commenting system
-   Responsive design with Bootstrap
-   Admin dashboard for managing content

## Technologies Used

-   **Backend:** Laravel (PHP Framework)
-   **Frontend:** Blade Templates, HTML, CSS, Bootstrap
-   **Database:** MySQL
-   **Authentication:** Laravel Breeze / Laravel Auth
-   **Notification:** SweetAlert2 for user notifications

## Screenshots

### Admin Dashboard

![Admin Dashboard]()

### Blog Page

![Blog Page](/images-ss/blogpage1.png)

## Installation Guide

### Prerequisites

Make sure you have the following installed:

-   PHP 8.x
-   Composer
-   Node.js & npm
-   MySQL
-   Git

### Steps to Install

1. Clone the repository:

    ```sh
    git clone https://github.com/your-username/blogtech.git
    cd blogtech
    ```

2. Install dependencies:

    ```sh
    composer install
    npm install
    npm run dev
    ```

3. Configure environment variables:

    ```sh
    cp .env.example .env
    ```

    Update the `.env` file with your database credentials.

4. Generate application key:

    ```sh
    php artisan key:generate
    ```

5. Run database migrations and seed:

    ```sh
    php artisan migrate --seed
    ```

6. Start the development server:
    ```sh
    php artisan serve
    ```

## Usage

-   Visit `http://127.0.0.1:8000` to access the blog.
-   Admin panel: `http://127.0.0.1:8000/admin` (Login required).
-   Subscribe to newsletters to receive new post updates.

## Contribution

If you want to contribute:

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch`
3. Make your changes and commit: `git commit -m "Feature description"`
4. Push to the branch: `git push origin feature-branch`
5. Create a pull request.
