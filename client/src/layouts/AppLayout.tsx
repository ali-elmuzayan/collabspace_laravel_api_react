import React from "react";

const AppLayout = ({ children }: { children: React.ReactNode }) => {
  return (
    <div>
      <Header />
      <main className="container mx-auto bg-gray-50">{children}</main>
      <Footer />
    </div>
  );
};

const Header = () => {
  return (
    <header className="border-b border-gray-200 shadow-sm shadow-b">
      <div>Logo</div>
      <nav>Navigation</nav>
      <div>search input </div>
      <div>User menu & notification button</div>
    </header>
  );
};

const Footer = () => {
  return <div>Footer</div>;
};

export default AppLayout;
