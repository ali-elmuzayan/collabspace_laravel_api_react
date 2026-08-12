import { FaMoneyBill, FaShoppingCart, FaUsers } from "react-icons/fa";

const Dashboard = () => {
  return (
    <div>
      <DashboardCard
        title="Total Users"
        description="100"
        icon={<FaUsers />}
      />
      <DashboardCard
        title="Total Orders"
        description="100"
        icon={<FaShoppingCart />}
      />
      <DashboardCard
        title="Total Revenue"
        description="100"
        icon={<FaMoneyBill />}
      />
    </div>
  );
};

const DashboardCard = ({
  title,
  description,
  icon,
}: {
  title: string;
  description: string;
  icon: React.ReactNode;
}) => {
  return (
    <div>
      <h3>{title}</h3>
      <p>{description}</p>
      {icon}
    </div>
  );
};

export default Dashboard;
