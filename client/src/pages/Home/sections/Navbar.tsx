import Logo from "@/components/common/Logo";
import { Button } from "@/components/ui/button";
import { Link } from "react-router";

const navLinks = [
  { label: "Features", href: "#features" },
  { label: "Collaboration", href: "#collaboration" },
  { label: "Pricing", href: "#pricing" },
];

const Navbar = () => {
  return (
    <header className="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-md">
      <div className="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <Logo />

        <nav className="hidden items-center gap-8 md:flex">
          {navLinks.map((link) => (
            <a
              key={link.href}
              href={link.href}
              className="text-sm font-medium text-neutral-400 transition-colors hover:text-neutral-600"
            >
              {link.label}
            </a>
          ))}
        </nav>

        <div className="flex items-center gap-3">
          <Button variant="ghost" size="sm" render={<Link to="/login" />}>
            Sign in
          </Button>
          <Button
            size="sm"
            className="rounded-full bg-primary-500 px-5 hover:bg-primary-600"
            render={<Link to="/register" />}
          >
            Get started
          </Button>
        </div>
      </div>
    </header>
  );
};

export default Navbar;
