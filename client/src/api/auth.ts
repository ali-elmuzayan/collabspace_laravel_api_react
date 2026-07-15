import { api } from "./client";
import type { User } from "../types";

/**
 * Login to the application
 */
export function login(email: string, password: string) {
  return api<User>("/auth/login", {
    method: "POST",
    body: JSON.stringify({ email, password }),
  });
}

/**
 * Register a new user
 */
export function register(
  email: string,
  password: string,
  confirmPassword: string,
) {
  return api<User>("/auth/register", {
    method: "POST",
    body: JSON.stringify({ email, password, confirmPassword }),
  });
}

/**
 * Get the profile of the current user
 */
export function getProfile() {
  return api<User>("/auth/me");
}

/**
 * Logout the current user
 */
export function logout() {
  return api<void>("/auth/logout", {
    method: "POST",
  });
}
