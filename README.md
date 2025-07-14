# User API Project

A RESTful API backend built with Laravel 12 and PHP 8.4, using MySQL for persistent storage. It supports user management via two controller variants: plain SQL and Eloquent ORM.

---

## Technologies Used

- Laravel 12  
- PHP 8.4  
- MySQL  
- Docker & Docker Compose  
- Postman (for API testing and documentation)

---

## Setup Instructions

## Docker Setup

### Prerequisites

- Install Docker and Docker Compose on your machine  
- [Docker Installation Guide](https://docs.docker.com/get-docker/)  
- [Docker Compose Installation Guide](https://docs.docker.com/compose/install/)

#### Build and start Docker containers (app + MySQL):

`docker-compose up -d --build`

## Manual instalation

### Installation Steps

1. Clone the repo (or download source):  
   ```bash
   git clone https://github.com/G-eat/manage-users.git` 
   cd manage-users
   ```

2. Copy `.env.example` to `.env` and update if needed:

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=company_db
- DB_USERNAME=root
- DB_PASSWORD=

3. Generate the application key:
```bash
php artisan key:generate
```

4. SQL and importing:

```bash
php artisan migrate
```

---

## Database

- Schema and stored procedures are defined in Laravel migration files:  
  - `create_users_and_sessions` migration creates tables  
  - `create_stored_procedures` migration creates stored procedures  
- You **do not need** to manually import `.sql` files; migrations handle everything.

---

## Running the Application

- API server runs inside Docker container, accessible at:  
  `http://localhost:8000/api/users`  
- Laravel built-in server listens on port 8000.

---

## API Endpoints

### User (plain SQL controller)

| Method   | Endpoint            | Action            |  
|----------|---------------------|-------------------|  
| GET      | `/api/users`        | List users        |  
| POST     | `/api/users`        | Create user       |  
| GET      | `/api/users/{user}` | Get user by ID    |  
| PUT/PATCH| `/api/users/{user}` | Update user by ID |  
| DELETE   | `/api/users/{user}` | Delete user by ID |

### User (Eloquent controller)

| Method   | Endpoint                    | Action            |  
|----------|-----------------------------|-------------------|  
| GET      | `/api/users/eloquent`       | List users (Eloquent) |  
| POST     | `/api/users/eloquent`       | Create user (Eloquent) |  
| GET      | `/api/users/eloquent/{user}`| Get user by ID    |  
| PUT/PATCH| `/api/users/eloquent/{user}`| Update user by ID |  
| DELETE   | `/api/users/eloquent/{user}`| Delete user by ID |

---

## Postman Collection

A Postman collection is included in the `public` folder:  
`User.postman_collection.json`

### How to import

1. Open Postman  
2. Click **Import** → **Upload Files** → Select the above JSON file  
3. Access all API endpoints for both variants

---

## Notes

- Make sure Docker containers are running before accessing the API  
- If migrations fail because the DB container is not ready, retry or manually run migrations inside the app container  
- Laravel environment variables control database connection and app configuration

---

If you have questions or need assistance, feel free to ask!