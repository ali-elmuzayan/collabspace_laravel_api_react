import { Button } from "@/components/ui/button";
import { Link } from "react-router/internal/react-server-client";
import AuthInput from "./AuthInput";
import { MdOutlineLock, MdOutlineEmail } from "react-icons/md";
import { Checkbox } from "@/components/ui/checkbox";

const SignInForm = () => {
  return (
    <form className="space-y-6">
      <AuthInput
        icon={<MdOutlineEmail className="text-neutral-200 size-4" />}
        id="email"
        label="Email"
        type="email"
        placeholder="Your Email"
      />

      <AuthInput
        icon={<MdOutlineLock className="text-neutral-200 size-4" />}
        id="password"
        label="Password"
        type="password"
        placeholder="Your Password"
      />

      {/* remember me and forgot password */}
      <div className="flex justify-between align-itmes">
        <div className="flex items-center gap-2">
          <Checkbox id="remember" />
          <label
            htmlFor="remember"
            className="text-gray-500 text-sm font-light"
          >
            Remember me
          </label>
        </div>
        <Link
          to="/forgot-password"
          className="text-primary-500 text-sm font-heading"
        >
          Forgot password?
        </Link>
      </div>
      {/* login button */}
      <Button className="w-full rounded-full bg-primary-500 text-sm text-white font-medium">
        Log in
      </Button>
    </form>
  );
};

export default SignInForm;
