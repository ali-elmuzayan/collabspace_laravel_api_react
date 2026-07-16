import Logo from "@/components/common/Logo";
import { Link } from "react-router";

const footerLinks = {
  Product: [
    { label: "Features", href: "#features" },
    { label: "Pricing", href: "#pricing" },
    { label: "Integrations", href: "#features" },
  ],
  Company: [
    { label: "About", href: "#" },
    { label: "Blog", href: "#" },
    { label: "Careers", href: "#" },
  ],
  Account: [
    { label: "Sign in", to: "/login" },
    { label: "Register", to: "/register" },
  ],
};

const Footer = () => {
  return (
    <footer className="border-t border-gray-100 bg-white py-12">
      <div className="mx-auto max-w-6xl px-6">
        <div className="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
          <div className="space-y-4 sm:col-span-2 lg:col-span-1">
            <Logo />
            <p className="max-w-xs text-sm leading-relaxed text-neutral-400">
              The all-in-one workspace for teams to manage projects, tasks,
              chat, and meetings.
            </p>
          </div>

          {Object.entries(footerLinks).map(([group, links]) => (
            <div key={group}>
              <p className="mb-4 text-sm font-semibold text-neutral-600">
                {group}
              </p>
              <ul className="space-y-2">
                {links.map((link) => (
                  <li key={link.label}>
                    {"to" in link ? (
                      <Link
                        to={link.to}
                        className="text-sm text-neutral-400 transition-colors hover:text-primary-500"
                      >
                        {link.label}
                      </Link>
                    ) : (
                      <a
                        href={link.href}
                        className="text-sm text-neutral-400 transition-colors hover:text-primary-500"
                      >
                        {link.label}
                      </a>
                    )}
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>

        <div className="mt-12 border-t border-gray-100 pt-6 text-center text-sm text-neutral-300">
          © {new Date().getFullYear()} CollabSpace. All rights reserved.
        </div>
      </div>
    </footer>
  );
};

export default Footer;
