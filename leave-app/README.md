cat > /workspaces/leave-app/leave-app/README.md << 'EOF'
# Leave Management System

A simple leave application module built with Laravel and SQLite. Employees can submit leave requests, view their leave history, and cancel pending applications.

## Tech Stack

- **Laravel** — PHP framework
- **SQLite** — database (no setup required)
- **Bootstrap 5** — frontend styling
- **Blade** — Laravel templating engine

## Features

- Submit leave applications (Annual, Medical, Casual)
- View leave balance cards
- See all past applications in a table
- Filter applications by status (Pending / Approved / Rejected)
- Cancel pending applications
- Working days calculator (excludes weekends)

## Project Structure

leave-app/
├── app/
│   ├── Http/Controllers/LeaveController.php
│   └── Models/LeaveApplication.php
├── database/
│   ├── migrations/
│   └── database.sqlite
├── resources/views/leaves/
│   └── index.blade.php
├── routes/web.php
└── .env

## Getting Started

### Prerequisites

- PHP 8.1+
- Composer

### Installation

1. Clone the repository
```bash
   git clone https://github.com/your-username/leave-app.git
   cd leave-app
```

2. Install dependencies
```bash
   composer install
```

3. Set up environment
```bash
   cp .env.example .env
   php artisan key:generate
```

4. Set up the database
```bash
   touch database/database.sqlite
   php artisan migrate
```

5. Start the server
```bash
   php artisan serve
```

6. Visit `http://127.0.0.1:8000` in your browser

## Running on GitHub Codespaces

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

Then open the **Ports** tab and click the globe icon next to port 8000.

## Routes

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/` | View all leave applications |
| POST | `/leaves` | Submit a new application |
| DELETE | `/leaves/{id}` | Cancel a pending application |

## Database

Uses SQLite by default. The `.env` file should have:
DB_CONNECTION=sqlite

Author : Brendan Francis
