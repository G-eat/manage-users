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
   git clone https://github.com/G-eat/manage-users.git
   cd manage-users
   ```

2. Composer install
    ```bash
    composer install
    ```

3. Copy `.env.example` to `.env` and update if needed:
    ```bash
   cp .env.example .env
   ```

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=company_db
- DB_USERNAME=root
- DB_PASSWORD=

4. Generate the application key:
```bash
php artisan key:generate
```

5. SQL and importing:

```bash
php artisan migrate
```

5. Access:

```bash
php artisan serve
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

## Examples

1. Get All Users (Eloquent)
Endpoint: GET /api/users/eloquent?page=1&per_page=10

Response:
```bash
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "first_name": "Jane",
            "last_name": "Doe",
            "email": "jane.doe123@example.com",
            "created_at": "2025-07-14T12:29:08.000000Z",
            "updated_at": "2025-07-14T16:12:32.000000Z"
        },
        {
            "id": 5,
            "first_name": "John",
            "last_name": "Doe",
            "email": "1john.doe@example.com",
            "created_at": "2025-07-14T14:11:04.000000Z",
            "updated_at": "2025-07-14T14:11:04.000000Z"
        },
        {
            "id": 6,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe3@example.com",
            "created_at": "2025-07-14T16:12:00.000000Z",
            "updated_at": "2025-07-14T16:12:00.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/users/eloquent",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```

2. Create User (Eloquent)
Endpoint: GET /api/users/eloquent

Body: 
```bash
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "john.doe@example.com"
}
```

Response:
```bash
{
    "message": "User created successfully",
    "user": {
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "updated_at": "2025-07-14T15:50:11.000000Z",
        "created_at": "2025-07-14T15:50:11.000000Z",
        "id": 7
    }
}
```

3. Get User By ID (Eloquent)
Endpoint: GET /api/users/eloquent/4

Response:
```bash
{
    "user": {
        "id": 4,
        "first_name": "Jane",
        "last_name": "Doe",
        "email": "jane.doe123@example.com",
        "created_at": "2025-07-14T12:29:08.000000Z",
        "updated_at": "2025-07-14T16:12:32.000000Z"
    }
}
```

4. Update User (Eloquent)
Endpoint: PUT /api/users/eloquent/4

Body: 
```bash
{
  "first_name": "Jane",
  "last_name": "Doe",
  "email": "jane.doe@example.com"
}
```

Response:
```bash
{
    "message": "User updated successfully",
    "user": {
        "id": 4,
        "first_name": "Jane",
        "last_name": "Doe",
        "email": "jane.doe@example.com",
        "created_at": "2025-07-14T12:29:08.000000Z",
        "updated_at": "2025-07-14T15:55:16.000000Z"
    }
}
```

5. Delete User (Eloquent)
Endpoint: DELETE /api/users/eloquent/4

Response:
```bash
{
    "message": "User deleted successfully"
}

6. Get All Users
Endpoint: GET /api/users?page=1&per_page=10

Response:
```bash
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "first_name": "Jane",
            "last_name": "Doe",
            "email": "jane.doe123@example.com",
            "created_at": "2025-07-14T12:29:08.000000Z",
            "updated_at": "2025-07-14T16:12:32.000000Z"
        },
        {
            "id": 5,
            "first_name": "John",
            "last_name": "Doe",
            "email": "1john.doe@example.com",
            "created_at": "2025-07-14T14:11:04.000000Z",
            "updated_at": "2025-07-14T14:11:04.000000Z"
        },
        {
            "id": 6,
            "first_name": "John",
            "last_name": "Doe",
            "email": "john.doe3@example.com",
            "created_at": "2025-07-14T16:12:00.000000Z",
            "updated_at": "2025-07-14T16:12:00.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/users/eloquent?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/users/eloquent",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3
}
```

7. Create User
Endpoint: GET /api/users

Body: 
```bash
{
  "first_name": "John",
  "last_name": "Doe",
  "email": "john.doe@example.com"
}
```

Response:
```bash
{
    "message": "User created successfully",
    "user": {
        "first_name": "John",
        "last_name": "Doe",
        "email": "john.doe@example.com",
        "updated_at": "2025-07-14T15:50:11.000000Z",
        "created_at": "2025-07-14T15:50:11.000000Z",
        "id": 7
    }
}
```

8. Get User By ID 
Endpoint: GET /api/users/4

Response:
```bash
{
    "user": {
        "id": 4,
        "first_name": "Jane",
        "last_name": "Doe",
        "email": "jane.doe123@example.com",
        "created_at": "2025-07-14T12:29:08.000000Z",
        "updated_at": "2025-07-14T16:12:32.000000Z"
    }
}
```

9. Update User
Endpoint: PUT /api/users/4

Body: 
```bash
{
  "first_name": "Jane",
  "last_name": "Doe",
  "email": "jane.doe@example.com"
}
```

Response:
```bash
{
    "message": "User updated successfully",
    "user": {
        "id": 4,
        "first_name": "Jane",
        "last_name": "Doe",
        "email": "jane.doe@example.com",
        "created_at": "2025-07-14T12:29:08.000000Z",
        "updated_at": "2025-07-14T15:55:16.000000Z"
    }
}
```

10. Delete User
Endpoint: DELETE /api/users/4

Response:
```bash
{
    "message": "User deleted successfully"
}
```


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