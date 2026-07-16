import AuthLayout from "@/layouts/AuthLayout";
import OrSeperator from "@/layouts/auth/OrSeperator";
import SignUpForm from "@/layouts/auth/SignUpForm";
import SignWithGoogleBtn from "@/layouts/auth/SignWithGoogleBtn";
import { Link } from "react-router/internal/react-server-client";

const Register = () => {
  return (
    <AuthLayout>
      <div className="text-center space-y-6">
        <div className="space-y-2">
          <h1 className="text-2xl font-semibold text-center">Sign Up</h1>
          <p className="text-gray-500 text-sm font-light">
            Connect with every application.
          </p>
        </div>

        {/* sign in with google */}
        <div className="flex justify-center">
          <SignWithGoogleBtn />
        </div>

        {/* seperator with or text on the middle */}
        <OrSeperator />
        {/* Sign in with email */}
        <SignUpForm />

        {/* sign up link */}
        <p className="text-neutral-400 text-sm font-light">
          Already have an account?{" "}
          <Link to="/login" className="text-primary-500 text-sm font-medium">
            Sign in
          </Link>
        </p>
      </div>
    </AuthLayout>
  );
};

export default Register;
