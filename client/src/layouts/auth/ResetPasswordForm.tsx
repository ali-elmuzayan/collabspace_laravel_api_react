import { Button } from "@/components/ui/button";
import AuthInput from "./AuthInput";
import { MdOutlineLock } from "react-icons/md";
import { Link, useSearchParams } from "react-router";

const ResetPasswordForm = () => {
  const [searchParams] = useSearchParams();
  const token = searchParams.get("token");
  const email = searchParams.get("email");

  if (!token || !email) {
    return (
      <div className="space-y-4 text-center">
        <p className="text-gray-500 text-sm font-light">
          This reset link is invalid or has expired. Request a new one to
          continue.
        </p>
        <Link
          to="/forgot-password"
          className="inline-block text-primary-500 text-sm font-medium"
        >
          Request new link
        </Link>
      </div>
    );
  }

  return (
    <form className="space-y-6">
      <AuthInput
        icon={<MdOutlineLock className="text-neutral-200 size-4" />}
        id="password"
        label="New Password"
        type="password"
        placeholder="Your New Password"
      />

      <AuthInput
        icon={<MdOutlineLock className="text-neutral-200 size-4" />}
        id="passwordConfirmation"
        label="Confirm Password"
        type="password"
        placeholder="Confirm Your Password"
      />

      <Button className="w-full rounded-full bg-primary-500 text-sm text-white font-medium">
        Reset password
      </Button>
    </form>
  );
};

export default ResetPasswordForm;
