import AuthLayout from "@/layouts/AuthLayout";
import ForgotPasswordForm from "@/layouts/auth/ForgotPasswordForm";
import { Link } from "react-router/internal/react-server-client";

const ForgotPassword = () => {
  return (
    <AuthLayout>
      <div className="text-center space-y-6">
        <div className="space-y-1">
          <h1 className="text-2xl font-semibold text-center">
            Forgot password?
          </h1>
          <p className="text-gray-500 text-sm font-light">
            Enter your email and we&apos;ll send you a link to reset your
            password.
          </p>
        </div>

        <ForgotPasswordForm />

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

export default ForgotPassword;
