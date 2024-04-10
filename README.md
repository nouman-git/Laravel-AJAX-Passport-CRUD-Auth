# Student CRUD with Passport Authentication using Laravel

This repository contains a Laravel project implementing a basic CRUD (Create, Read, Update, Delete) functionality for managing student records. Additionally, it incorporates Passport for API authentication and uses AJAX calls to interact with the backend.

## Demo Video
https://youtu.be/MhAJCL3oHgA

## Key Features:

### Student CRUD Operations

### Authentication:
1. **User Registration**:
    - Allows new users to register with their name, email, and password.
2. **User Login**:
    - Authentication of existing users using email and password.
3. **User Logout**:
    - Provides functionality to log out authenticated users.

### Passport Integration:
1. **Authentication with Passport**:
    - Utilizes Laravel Passport for user authentication.
2. **Access Token Generation**:
    - Generates access tokens upon successful authentication.

### AJAX Requests:
1. **Asynchronous Data Fetching**:
    - Utilizes AJAX for asynchronous loading of data from the backend.
2. **Dynamic Content Updates**:
    - Updates the UI dynamically without requiring a full page reload.

## Project Structure:

### Controllers:
- **UserController**:
    - Manages user authentication, registration, and logout functionalities.
- **StudentController**:
    - Handles CRUD operations for managing student records.

### Models:
- **User**:
    - Represents user data.
- **Student**:
    - Represents student data.

### Views:
- **login/login.blade.php**:
    - Login page view.
- **students/index.blade.php**:
    - View for displaying student records and performing CRUD operations.

### Routes:
- **web.php**:
    - Defines web routes for the application.

### Database:
- **Factories/StudentFactory.php**:
    - Factory for generating fake student data for testing purposes.

## Setup Instructions:

1. Clone the repository: `git clone <repository-url>`
2. Navigate to the project directory: `cd <project-directory>`
3. Install dependencies: `composer install`
4. Create a copy of the `.env.example` file and rename it to `.env`
5. Generate application key: `php artisan key:generate`
6. Set up your database connection in the `.env` file
7. Run migrations: `php artisan migrate`
9. Serve the application: `php artisan serve`

## Usage:

1. Register a new user using the provided registration form.
2. Log in with the registered credentials.
3. Perform CRUD operations on student records.
4. Log out from the application when done.

## Author:

- Nouman Yousaf

