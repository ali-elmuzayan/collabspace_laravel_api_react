import { Link } from "react-router/internal/react-server-client";

const Logo = () => {
  return (
    <Link
      to="/"
      className="text-md sm:text-lg md:text-xl font-heading text-neutral-600 font-medium"
    >
      CollabSpace
    </Link>
  );
};

export default Logo;
