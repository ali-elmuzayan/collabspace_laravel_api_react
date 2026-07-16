import Header from "./auth/Header";

const AuthLayout = ({ children }: { children: React.ReactNode }) => {
  return (
    <div className="flex flex-col gap-16 min-h-screen bg-gray-50">
      <Header />
      <main className="flex-1">
        {/* the shadow should be on the hole card even above the border */}
        <div className="max-w-md mx-auto py-10 px-8 bg-background rounded-lg shadow-card">
          {children}
        </div>
      </main>
    </div>
  );
};

export default AuthLayout;
