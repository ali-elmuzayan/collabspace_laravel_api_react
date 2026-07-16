import Navbar from "./sections/Navbar";
import Hero from "./sections/Hero";
import Features from "./sections/Features";
import Collaboration from "./sections/Collaboration";
import Pricing from "./sections/Pricing";
import CtaBanner from "./sections/CtaBanner";
import Footer from "./sections/Footer";

const Home = () => {
  return (
    <div className="min-h-screen bg-white">
      <Navbar />
      <main>
        <Hero />
        <Features />
        <Collaboration />
        <Pricing />
        <CtaBanner />
      </main>
      <Footer />
    </div>
  );
};

export default Home;
