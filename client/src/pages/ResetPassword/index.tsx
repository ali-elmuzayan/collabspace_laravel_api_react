import AuthLayout from "@/layouts/AuthLayout";
import ResetPasswordForm from "@/layouts/auth/ResetPasswordForm";
import { Link } from "react-router/internal/react-server-client";

const ResetPassword = () => {
  return (
    <AuthLayout>
      <div className="text-center space-y-6">
        <div className="space-y-1">
          <h1 className="text-2xl font-semibold text-center">
            Reset password
          </h1>
          <p className="text-gray-500 text-sm font-light">
            Choose a new password for your account.
          </p>
        </div>

        <ResetPasswordForm />

        <p className="text-neutral-400 text-sm font-light">
          Remember your password?{" "}
          <Link to="/login" className="text-primary-500 text-sm font-medium">
            Sign in
          </Link>
        </p>
      </div>
    </AuthLayout>
  );
};

export default ResetPassword;
