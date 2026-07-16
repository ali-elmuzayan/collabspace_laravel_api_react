import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Check } from "lucide-react";
import { Link } from "react-router";

const plans = [
  {
    name: "Starter",
    price: "Free",
    period: "forever",
    description: "For individuals and small teams getting started.",
    features: [
      "Up to 3 projects",
      "5 team members",
      "Task boards & lists",
      "Team chat",
      "1 GB storage",
    ],
    cta: "Get started free",
    highlighted: false,
  },
  {
    name: "Pro",
    price: "$12",
    period: "per user / month",
    description: "For growing teams that need more power and integrations.",
    features: [
      "Unlimited projects",
      "Unlimited members",
      "Video meetings",
      "App integrations",
      "Priority support",
      "10 GB storage",
    ],
    cta: "Start 14-day trial",
    highlighted: true,
  },
  {
    name: "Business",
    price: "$29",
    period: "per user / month",
    description: "For organizations with advanced security and control.",
    features: [
      "Everything in Pro",
      "SSO & admin controls",
      "Advanced analytics",
      "Custom workflows",
      "Dedicated success manager",
      "Unlimited storage",
    ],
    cta: "Contact sales",
    highlighted: false,
  },
];

const Pricing = () => {
  return (
    <section id="pricing" className="bg-white py-20 lg:py-28">
      <div className="mx-auto max-w-6xl px-6">
        <div className="mx-auto mb-14 max-w-2xl text-center">
          <p className="mb-3 text-sm font-medium uppercase tracking-wider text-primary-500">
            Pricing
          </p>
          <h2 className="text-3xl font-bold text-neutral-600 sm:text-4xl">
            Simple plans that scale with your team
          </h2>
          <p className="mt-4 text-neutral-400">
            Subscribe in minutes. Upgrade as you grow. No hidden fees, cancel
            anytime.
          </p>
        </div>

        <div className="grid gap-6 lg:grid-cols-3">
          {plans.map((plan) => (
            <Card
              key={plan.name}
              className={
                plan.highlighted
                  ? "relative border-primary-200 shadow-card ring-2 ring-primary-500"
                  : "border-gray-100 shadow-none"
              }
            >
              {plan.highlighted && (
                <div className="absolute -top-3 left-1/2 -translate-x-1/2 rounded-full bg-primary-500 px-3 py-0.5 text-xs font-medium text-white">
                  Most popular
                </div>
              )}
              <CardHeader>
                <CardTitle className="text-neutral-600">{plan.name}</CardTitle>
                <CardDescription>{plan.description}</CardDescription>
                <div className="pt-2">
                  <span className="text-4xl font-bold text-neutral-600">
                    {plan.price}
                  </span>
                  {plan.price !== "Free" && (
                    <span className="ml-1 text-sm text-neutral-400">
                      {plan.period}
                    </span>
                  )}
                </div>
              </CardHeader>
              <CardContent>
                <ul className="space-y-3">
                  {plan.features.map((feature) => (
                    <li
                      key={feature}
                      className="flex items-center gap-2 text-sm text-neutral-500"
                    >
                      <Check className="size-4 shrink-0 text-primary-500" />
                      {feature}
                    </li>
                  ))}
                </ul>
              </CardContent>
              <CardFooter>
                <Button
                  className={
                    plan.highlighted
                      ? "w-full rounded-full bg-primary-500 hover:bg-primary-600"
                      : "w-full rounded-full"
                  }
                  variant={plan.highlighted ? "default" : "outline"}
                  render={<Link to="/register" />}
                >
                  {plan.cta}
                </Button>
              </CardFooter>
            </Card>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Pricing;
