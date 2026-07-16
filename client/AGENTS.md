# Client — Agent Guidelines

React SPA for the project management app. The Laravel API lives in `../backend`. Read `../backend/AGENTS.md` when working on API contracts or auth behavior.

## Stack

- React 19 + TypeScript
- Vite 8
- React Router 8
- Redux Toolkit + React Redux (client/auth UI state)
- TanStack React Query v5 (server state)
- Tailwind CSS v4 + shadcn/ui (`base-vega` style)
- Path alias: `@/` → `src/`

## Commands

```bash
npm run dev      # start dev server
npm run build    # typecheck + production build
npm run lint     # ESLint
npm run preview  # preview production build
```

If UI changes do not appear, ensure `npm run dev` is running.

## Directory Structure

```
src/
  api/           # fetch functions only — no React hooks here
  hooks/         # React Query hooks (useQuery, useMutation)
  store/         # Redux slices + configureStore
  types/         # shared TypeScript types
  pages/         # route-level page components
  components/    # reusable UI (shadcn lives in components/ui/)
  lib/           # utilities (cn helper, etc.)
  layouts/       # AppLayout, AuthLayout (planned)
```

Do not introduce new top-level `src/` folders without good reason. Follow existing layout.

## Architecture

### Redux Toolkit — client state

Use Redux for state that is **not** server data:

- Authenticated user snapshot (`auth.user`)
- UI preferences, sidebar state, filters that should persist across routes

Register every slice in `src/store/index.ts`. Typed hooks are preferred:

```ts
// src/store/hooks.ts (create when needed)
import { useDispatch, useSelector } from "react-redux";
import type { RootState, AppDispatch } from "./index";

export const useAppDispatch = useDispatch.withTypes<AppDispatch>();
export const useAppSelector = useSelector.withTypes<RootState>();
```

### TanStack Query — server state

Use React Query for anything fetched from the API:

- Queries: `useQuery({ queryKey, queryFn })`
- Mutations: `useMutation({ mutationFn, onSuccess })`

Pattern:

1. Define plain async functions in `src/api/*.ts`
2. Wrap them in custom hooks in `src/hooks/*.ts`
3. Use hooks in pages/components — never call `fetch` directly in JSX

On auth success: update Redux **and** React Query cache.

On logout: clear Redux user and `queryClient.removeQueries`.

### API client

All HTTP calls go through `src/api/client.ts`:

- Base URL: `import.meta.env.VITE_API_URL` (see `.env`)
- Throws on non-OK responses so React Query handles errors correctly
- Add shared headers (auth token, credentials) here — not in every api file

## Backend API (Laravel Sanctum)

Base URL: `http://localhost:8000/api` (via `VITE_API_URL`).

Current backend routes (`../backend/routes/api.php`):

| Method | Path | Purpose |
|--------|------|---------|
| POST | `/v1/auth/login` | Login |
| POST | `/v1/auth/logout` | Logout (auth required) |
| GET | `/v1/auth/user` | Current user (auth required) |

**Align client paths with backend.** The frontend currently uses `/auth/*` and `/auth/me`; update to `/v1/auth/*` and `/v1/auth/user` when wiring pages.

Register may need a matching backend route before the Register page can work.

For cookie-based Sanctum SPA auth, `api/client.ts` will likely need `credentials: "include"` and CSRF setup — confirm against backend Sanctum config before shipping auth flows.

## Routing

Routes are defined in `src/App.tsx`. Pages live in `src/pages/<Name>/index.tsx`.

Planned route groups:

- **Public**: `/`, `/login`, `/register`
- **Protected**: `/dashboard`, `/profile` (require auth)

Use layout components (`AuthLayout`, `AppLayout`) for shared chrome once created.

## UI (shadcn)

- Add components: `npx shadcn@latest add <component>`
- Import from `@/components/ui/*`
- Use `cn()` from `@/lib/utils` for conditional classes
- Icons: `lucide-react`
- Do not hand-roll components that shadcn already provides

## Conventions

- Functional components only
- One default export per page component
- Descriptive names: `useGetProfile`, not `useProfile`
- Shared types in `src/types/` — import with `@/types` or relative paths consistently
- Keep pages thin; move logic into hooks
- Match formatting and import style of sibling files
- Do not change dependencies without approval
- Only create docs when explicitly asked

## Query Keys

Use stable, hierarchical keys:

```ts
["profile"]
["projects"]
["projects", projectId]
["projects", projectId, "tasks"]
```

Invalidate related keys after mutations.

## Current State / Known Gaps

When picking up work, check these first:

- [ ] `auth` reducer not yet registered in `src/store/index.ts`
- [ ] API path mismatch between `src/api/auth.ts` and backend `/v1/auth/*`
- [ ] Query key inconsistency: `useLogin` sets `["user"]`, `useGetProfile` uses `["profile"]`
- [ ] Pages are placeholders — no forms or auth guards yet
- [ ] `src/layouts/` not implemented
- [ ] `src/api/projects.ts` empty
- [ ] `useRegister` hook missing (register API function exists)
- [ ] Protected routes not implemented

## Verification

Before finishing a feature:

1. `npm run build` — must pass TypeScript + Vite build
2. `npm run lint` — fix new lint issues
3. Manually test the affected route with backend running

Do not add test infrastructure unless requested.

## Monorepo Layout

```
04_project_management/
  client/    ← this app (React)
  backend/   ← Laravel API (see backend/AGENTS.md)
```

When adding features, consider both sides: frontend hook/page + backend route/controller if the endpoint does not exist yet.
