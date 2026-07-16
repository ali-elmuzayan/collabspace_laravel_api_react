import SwitchLanguage from "./SwitchLanguage";
import Logo from "@/components/common/Logo";

const Header = () => {
  return (
    <header className="flex justify-between items-center py-4 px-6">
      <Logo />
      <SwitchLanguage />
    </header>
  );
};

export default Header;
