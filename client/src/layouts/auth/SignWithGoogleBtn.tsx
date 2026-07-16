import { FcGoogle } from "react-icons/fc";

const SignWithGoogleBtn = () => {
  return (
    <button className="w-full bg-background text-sm text-neutral-300 px-4 py-2.5 rounded-md border border-gray-200 hover:bg-gray-100 transition-colors">
      <span className="flex items-center justify-center gap-2">
        <FcGoogle className="size-5" />
        Sign with Google
      </span>
    </button>
  );
};

export default SignWithGoogleBtn;
