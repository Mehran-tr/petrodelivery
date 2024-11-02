
# Fuel Delivery Management System

This project is a **SaaS-style platform** designed to help a fuel delivery company manage operations. It includes both backend and frontend components:
- **Backend**: Developed with Laravel.
- **Frontend**: Developed with React.

## Table of Contents
- [Project Structure](#project-structure)
- [Prerequisites](#prerequisites)
- [Setup Instructions](#setup-instructions)
  - [Backend Setup](#backend-setup)
  - [Frontend Setup](#frontend-setup)
- [Running the Project](#running-the-project)
- [Running Tests](#running-tests)
  - [Backend Tests](#backend-tests)
  - [Frontend Tests](#frontend-tests)
- [Available Endpoints](#available-endpoints)
- [Technologies Used](#technologies-used)

---

## Project Structure

```
project-root/
├── backend/               # Laravel Backend (API)
│   ├── app/
│   ├── config/
│   ├── database/
│   ├── .env               # Backend environment file
│   └── frontend/              # React Frontend
        ├── src/
        ├── public/
        ├── .env               # Frontend environment file
        └── ...
└── 
```

## Prerequisites

- **Node.js** (v14 or higher) and **npm** (for frontend)
- **PHP** (v8.0 or higher) and **Composer** (for backend)
- **MySQL** or another SQL database
- **Laravel** installed globally (`composer global require laravel/installer`)

---

## Setup Instructions

### Backend Setup (Laravel)



 **Install Backend Dependencies**:
   ```bash
   composer install
   ```

 **Set Up Environment Variables**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Open `.env` and configure the following settings:
     ```plaintext
     APP_NAME=FuelDeliveryManagement
     APP_URL=http://localhost:8000

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=fuel_management
     DB_USERNAME=root
     DB_PASSWORD=yourpassword
     ```

**Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

 **Run Migrations and Seed the Database**:
   ```bash
   php artisan migrate --seed
   ```

 **Start the Backend Server**:
   ```bash
   php artisan serve
   ```
   The backend will run at `http://localhost:8000`.

---

### Frontend Setup (React)

1. **Navigate to the Frontend Directory**:
   ```bash
   cd front/fuel-delivery-app
   ```

2. **Install Frontend Dependencies**:
   ```bash
   npm install
   ```

3. **Set Up Environment Variables**:
   - Create a `.env` file in the `frontend` directory.
   - Add the following environment variable to connect to the backend:
     ```plaintext
     REACT_APP_API_URL=http://localhost:8000/api
     ```

4. **Start the Frontend Server**:
   ```bash
   npm start
   ```
   The frontend will run at `http://localhost:3000`.

---

## Running the Project

To run the full project, make sure both backend and frontend servers are running:

1. Start the backend server:
   ```bash
   cd backend
   php artisan serve
   ```
   This will start the backend API server on `http://localhost:8000`.

2. Start the frontend server:
   ```bash
   cd frontend
   npm start
   ```
   This will start the React frontend on `http://localhost:3000`.

Access the full application by navigating to `http://localhost:3000`.

---

## Running Tests

### Backend Tests (Laravel)

1. **Set Up Testing Environment**:
   - Ensure your `.env.testing` file is configured for testing (usually pointing to a separate test database).
   - If needed, create a `.env.testing` by copying `.env`:
     ```bash
     cp .env .env.testing
     ```

2. **Run Backend Tests**:
   ```bash
   php artisan test
   ```
   This will run all the feature and unit tests in the `tests` directory.

3. **Specific Test Classes or Methods**:
   To run a specific test class or method:
   ```bash
   php artisan test --filter ClassName
   php artisan test --filter ClassName::methodName
   ```

### Frontend Tests (React)

The frontend uses **Jest** and **React Testing Library**.

1. **Run Frontend Tests**:
   ```bash
   cd frontend
   npm test
   ```

2. **Interactive Test Mode**:
   By default, Jest will run in interactive watch mode, allowing you to re-run tests on file changes. Press `a` to run all tests or `q` to quit the watcher.

3. **Run Tests in CI Mode**:
   To run tests once (useful for CI/CD pipelines):
   ```bash
   npm test -- --watchAll=false
   ```

---

## Available Endpoints

### Authentication Endpoints
- `POST /api/login`: Logs in a user and returns a token.
- `POST /api/logout`: Logs out the authenticated user.

### Client Management
- `GET /api/clients`: Retrieves all clients.
- `POST /api/clients`: Creates a new client.
- `DELETE /api/clients/{id}`: Deletes a client by ID.

### Location Management
- `GET /api/locations`: Retrieves all locations.
- `POST /api/locations`: Creates a new location.
- `DELETE /api/locations/{id}`: Deletes a location by ID.

### Truck Management
- `GET /api/trucks`: Retrieves all delivery trucks.
- `POST /api/trucks`: Creates a new truck.
- `DELETE /api/trucks/{id}`: Deletes a truck by ID.

### User Management (Admin Only)
- `GET /api/users`: Retrieves all users (Admin only).
- `POST /api/users`: Creates a new user (Admin only).
- `DELETE /api/users/{id}`: Deletes a user by ID (Admin only).

### Company Information
- `GET /api/company`: Retrieves the authenticated user’s company details.

---

## Technologies Used

- **Backend**: Laravel, MySQL
- **Frontend**: React
- **Authentication**: Laravel Sanctum
- **CSS Styling**: Custom CSS

---

## Additional Notes

- **Database Seeding**: The backend includes seeders for initial data setup. Run `php artisan db:seed` if needed.
- **Environment Variables**: Both the backend and frontend rely on environment variables set in `.env` files.

---
### Token Security Issues

Refresh Tokens with Sanctum

To manage token expiration securely, this project implements a refresh token mechanism alongside Laravel Sanctum's access tokens. Access tokens have a short lifespan to enhance security, and when they expire, users can use a refresh token to obtain a new access token without re-authenticating.

The process includes:

    Access Token Expiration: Access tokens are issued with an expiration time.
    Refresh Tokens: A refresh token, securely hashed and stored, is generated alongside the access token during login. When the access token expires, the refresh token can be used at the /api/refresh endpoint to request a new access token.
    Token Cleanup: During logout, both access tokens and refresh tokens are deleted to prevent unauthorized access.

This setup enhances security by limiting token lifetimes while allowing a seamless user experience through refresh tokens.

---
### Security Key Points:

- Also we can use a Strong, Consistent Signing Algorithm and Validate the Algorithm and Signature Consistently
  (we can use in high scale project)

Feel free to customize and expand this project as needed for your business requirements. Happy coding!
