import AuthLayout from "@/layouts/AuthLayout";
import { Link } from "react-router/internal/react-server-client";
import SignWithGoogleBtn from "@/layouts/auth/SignWithGoogleBtn";
import OrSeperator from "@/layouts/auth/OrSeperator";
import SignInForm from "@/layouts/auth/SignInForm";

const Login = () => {
  return (
    <AuthLayout>
      <div className="text-center space-y-6">
        <div className="space-y-1">
          <h1 className="text-2xl font-semibold text-center">Sign In</h1>
          <p className="text-gray-500 text-sm font-light">
            Welcome back, you've been missed!
          </p>
        </div>

        {/* sign in with google */}
        <div className="flex justify-center">
          <SignWithGoogleBtn />
        </div>

        {/* seperator with or text on the middle */}
        <OrSeperator />
        {/* Sign in with email */}
        <SignInForm />

        {/* sign up link */}
        <p className="text-neutral-400 text-sm font-light">
          Don't have an account?{" "}
          <Link to="/register" className="text-primary-500 text-sm font-medium">
            Sign up
          </Link>
        </p>
      </div>
    </AuthLayout>
  );
};

export default Login;
