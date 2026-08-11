# Project Management Platform

A full-stack project management application for teams. Collaborate on projects and tasks, share files, chat with teammates, talk to an internal AI assistant, and keep meetings on a shared calendar.

## Features

- **Teams & projects** — Organize work by team and project
- **Task management** — Create, assign, and track tasks across projects
- **File management** — Upload, share, and manage project files
- **Team chat** — Real-time internal messaging between team members
- **AI chat** — Built-in AI assistant for project-related help
- **Calendar** — View meetings, deadlines, and team events in one place

## Tech Stack

| Layer | Technologies |
|--------|----------------|
| **Frontend** | React 19, TypeScript, Vite, Tailwind CSS, shadcn/ui, React Router, Redux Toolkit, TanStack React Query |
| **Backend** | Laravel 13, PHP 8.3+, Laravel Sanctum (API auth) |
| **Database** | MySQL (configurable via `.env`) |

## Project Structure

```
04_project_management/
├── client/                 # React frontend (Vite SPA)
│   ├── public/
│   ├── src/
│   │   ├── api/            # HTTP helpers (fetch wrappers)
│   │   ├── components/     # UI & shared components (shadcn in ui/)
│   │   ├── Guard/          # Route protection
│   │   ├── hooks/          # React Query & custom hooks
│   │   ├── layouts/        # App & auth layouts
│   │   ├── lib/            # Utilities (cn, tokens, etc.)
│   │   ├── pages/          # Route-level pages
│   │   ├── store/          # Redux store & slices
│   │   ├── types/          # Shared TypeScript types
│   │   ├── App.tsx         # Routes
│   │   └── main.tsx
│   ├── .env                # VITE_API_URL
│   └── package.json
│
└── backend/                # Laravel API
    ├── app/
    │   ├── Actions/        # Application actions
    │   ├── Http/
    │   │   ├── Controllers/Api/V1/
    │   │   └── Requests/Api/V1/
    │   ├── Models/
    │   └── Providers/
    ├── config/
    ├── database/
    │   ├── migrations/
    │   ├── factories/
    │   └── seeders/
    ├── routes/
    │   ├── api.php         # API routes
    │   └── web.php
    ├── tests/
    └── composer.json
```

## Prerequisites

- **Node.js** 20+ and npm
- **PHP** 8.3+
- **Composer**
- **MySQL** (or another DB configured in Laravel)

## Getting Started

### 1. Clone the repository

```bash
git clone <repository-url>
cd 04_project_management
```

### 2. Backend (Laravel)

```bash
cd backend

# Install PHP dependencies
composer install

# Environment
cp .env.example .env
php artisan key:generate

# Configure database in .env (MySQL example):
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=backend
# DB_USERNAME=root
# DB_PASSWORD=

# Run migrations
php artisan migrate

# Start the API (default: http://localhost:8000)
php artisan serve
```

Optional: run the full Laravel local stack (server, queue, logs, Vite for backend assets):

```bash
composer run dev
```

### 3. Frontend (React + Vite)

Open a second terminal:

```bash
cd client

# Install dependencies
npm install

# Ensure API URL points at the Laravel API
# client/.env → VITE_API_URL=http://localhost:8000/api

# Start the dev server (default: http://localhost:5173)
npm run dev
```

### 4. Open the app

| Service | URL |
|---------|-----|
| Frontend | [http://localhost:5173](http://localhost:5173) |
| Backend API | [http://localhost:8000/api](http://localhost:8000/api) |

## Useful Commands

### Frontend (`client/`)

```bash
npm run dev       # Development server
npm run build     # Typecheck + production build
npm run lint      # ESLint
npm run preview   # Preview production build
```

### Backend (`backend/`)

```bash
php artisan serve           # Start API server
php artisan migrate         # Run migrations
php artisan test            # Run Pest tests
composer run setup          # Install, env, migrate, build
composer run dev            # Server + queue + logs + Vite
```

## API Overview

Auth endpoints are versioned under `/api/v1/auth`:

| Method | Path | Description |
|--------|------|-------------|
| `POST` | `/api/v1/auth/login` | Sign in |
| `POST` | `/api/v1/auth/logout` | Sign out |
| `GET` | `/api/v1/auth/user` | Current authenticated user |

Authentication uses **Laravel Sanctum**. The frontend talks to the API via `VITE_API_URL` (see `client/src/api/client.ts`).

## Architecture Notes

- **Frontend**: React Query for server state; Redux for auth/UI client state. Pages stay thin; logic lives in hooks and API modules.
- **Backend**: Versioned JSON API (`Api/V1`), form requests for validation, Sanctum for auth.
- **UI**: Tailwind CSS v4 + shadcn/ui. Add components with `npx shadcn@latest add <component>`.

## License

MIT
