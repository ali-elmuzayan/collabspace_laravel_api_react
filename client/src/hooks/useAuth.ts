import { getProfile, login, logout } from "@/api/auth";
import { setUser } from "@/store/auth/authSlice";
import { useMutation, useQuery, useQueryClient } from "@tanstack/react-query";
import { useDispatch } from "react-redux";

/**
 * Login to the application
 */
export function useLogin() {
  const dispatch = useDispatch();
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: ({ email, password }: { email: string; password: string }) =>
      login(email, password),
    onSuccess: (data) => {
      dispatch(setUser(data));
      queryClient.setQueryData(["user"], data);
    },
    onError: (error) => {
      console.error(error);
    },
  });
}

/**
 * profile of the current user
 */
export function useGetProfile() {
  return useQuery({
    queryKey: ["user"],
    queryFn: getProfile,
  });
}

/**
 * Logout the current user
 */
export function useLogout() {
  const dispatch = useDispatch();
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: logout,
    onSuccess: () => {
      dispatch(setUser(null));
      queryClient.removeQueries({ queryKey: ["user"] });
    },
    onError: (error) => {
      console.error(error);
    },
  });
}
