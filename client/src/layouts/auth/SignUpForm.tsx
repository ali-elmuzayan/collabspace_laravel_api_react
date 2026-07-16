import { Button } from "@/components/ui/button";
import AuthInput from "./AuthInput";
import { MdOutlineEmail, MdOutlineLock, MdOutlinePerson } from "react-icons/md";
import { Checkbox } from "@/components/ui/checkbox";

const SignUpForm = () => {
  return (
    <form className="space-y-6">
      <AuthInput
        icon={<MdOutlinePerson className="text-neutral-200 size-4" />}
        id="fullName"
        label="Full Name"
        type="text"
        placeholder="Your Full Name"
      />
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
      </div>
      {/* login button */}
      <Button className="w-full rounded-full bg-primary-500 text-sm text-white font-medium">
        Sign up
      </Button>
    </form>
  );
};

export default SignUpForm;
