import React from "react";

const AppLayout = ({ children }: { children: React.ReactNode }) => {
  return (
    <div>
      <Header />
      <main className="container mx-auto">{children}</main>
      <Footer />
    </div>
  );
};

const Header = () => {
  return <div>Header</div>;
};

const Footer = () => {
  return <div>Footer</div>;
};

export default AppLayout;
