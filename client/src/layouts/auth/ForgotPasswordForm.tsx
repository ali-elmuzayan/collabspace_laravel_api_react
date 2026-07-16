import { Button } from "@/components/ui/button";
import AuthInput from "./AuthInput";
import { MdOutlineEmail } from "react-icons/md";

const ForgotPasswordForm = () => {
  return (
    <form className="space-y-6">
      <AuthInput
        icon={<MdOutlineEmail className="text-neutral-200 size-4" />}
        id="email"
        label="Email"
        type="email"
        placeholder="Your Email"
      />

      <Button className="w-full rounded-full bg-primary-500 text-sm text-white font-medium">
        Send reset link
      </Button>
    </form>
  );
};

export default ForgotPasswordForm;
