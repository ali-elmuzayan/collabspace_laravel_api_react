import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";

const AuthInput = ({
  id,
  label,
  type,
  placeholder,
  icon,
  ...props
}: {
  id: string;
  label: string;
  type: string;
  placeholder: string;
  icon?: React.ReactNode;
  [key: string]: unknown;
}) => {
  return (
    <div className="relative">
      <Label
        htmlFor={id}
        className="absolute -top-2 left-3 px-1 bg-background text-neutral-300 text-xs font-medium"
      >
        {label}
      </Label>
      {icon && (
        <div className="absolute inset-y-0 left-3 flex items-center">
          {icon}
        </div>
      )}
      <Input
        type={type}
        name={id}
        placeholder={placeholder}
        id={id}
        {...props}
        className="w-full h-12 pl-10 pr-4 bg-background border border-gray-200 text-neutral-500 font-heading text-sm rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 placeholder:text-neutral-200 placeholder:font-heading placeholder:text-sm"
      />
    </div>
  );
};

export default AuthInput;
