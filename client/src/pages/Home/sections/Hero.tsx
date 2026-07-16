import { Button } from "@/components/ui/button";
import {
  CheckCircle2,
  MessageSquare,
  Users,
  Video,
} from "lucide-react";
import { Link } from "react-router";

const highlights = [
  "Unlimited projects on every plan",
  "Real-time chat & video meetings",
  "Connect your favorite apps",
];

const Hero = () => {
  return (
    <section className="relative overflow-hidden bg-gray-50">
      <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_right,var(--color-primary-100),transparent_55%)]" />

      <div className="relative mx-auto grid max-w-6xl gap-12 px-6 py-20 lg:grid-cols-2 lg:items-center lg:py-28">
        <div className="space-y-8">
          <div className="inline-flex items-center gap-2 rounded-full border border-primary-100 bg-primary-50 px-4 py-1.5 text-xs font-medium text-primary-700">
            <span className="size-1.5 rounded-full bg-primary-500" />
            All-in-one workspace for modern teams
          </div>

          <div className="space-y-4">
            <h1 className="text-4xl font-bold leading-tight tracking-tight text-neutral-600 sm:text-5xl lg:text-[3.25rem]">
              Manage projects.{" "}
              <span className="text-primary-500">Unite teams.</span> Ship
              faster.
            </h1>
            <p className="max-w-lg text-base leading-relaxed text-neutral-400 sm:text-lg">
              CollabSpace brings projects, tasks, chat, and meetings into one
              place — so your team stays aligned without switching between apps.
            </p>
          </div>

          <div className="flex flex-wrap gap-3">
            <Button
              size="lg"
              className="rounded-full bg-primary-500 px-8 hover:bg-primary-600"
              render={<Link to="/register" />}
            >
              Start free trial
            </Button>
            <Button
              variant="outline"
              size="lg"
              className="rounded-full px-8"
              render={<Link to="#pricing" />}
            >
              View pricing
            </Button>
          </div>

          <ul className="space-y-2">
            {highlights.map((item) => (
              <li
                key={item}
                className="flex items-center gap-2 text-sm text-neutral-400"
              >
                <CheckCircle2 className="size-4 shrink-0 text-primary-500" />
                {item}
              </li>
            ))}
          </ul>
        </div>

        <div className="relative">
          <div className="rounded-2xl border border-gray-200 bg-white p-4 shadow-card">
            <div className="mb-4 flex items-center justify-between border-b border-gray-100 pb-3">
              <div>
                <p className="text-xs font-medium text-neutral-300">
                  Active project
                </p>
                <p className="font-heading text-sm font-semibold text-neutral-600">
                  Product Launch Q3
                </p>
              </div>
              <span className="rounded-full bg-primary-50 px-3 py-1 text-xs font-medium text-primary-600">
                On track
              </span>
            </div>

            <div className="grid gap-3 sm:grid-cols-2">
              <div className="rounded-xl bg-gray-50 p-4">
                <div className="mb-3 flex items-center gap-2 text-primary-500">
                  <Users className="size-4" />
                  <span className="text-xs font-medium">Team</span>
                </div>
                <div className="flex -space-x-2">
                  {["A", "B", "C", "D"].map((initial) => (
                    <div
                      key={initial}
                      className="flex size-8 items-center justify-center rounded-full border-2 border-white bg-primary-100 text-xs font-semibold text-primary-700"
                    >
                      {initial}
                    </div>
                  ))}
                </div>
                <p className="mt-3 text-xs text-neutral-400">
                  12 members · 3 online
                </p>
              </div>

              <div className="rounded-xl bg-gray-50 p-4">
                <div className="mb-3 flex items-center gap-2 text-primary-500">
                  <MessageSquare className="size-4" />
                  <span className="text-xs font-medium">Team chat</span>
                </div>
                <div className="space-y-2">
                  <div className="rounded-lg bg-white px-3 py-2 text-xs text-neutral-500">
                    Design review is ready 🎨
                  </div>
                  <div className="ml-4 rounded-lg bg-primary-500 px-3 py-2 text-xs text-white">
                    Great — shipping the sprint today!
                  </div>
                </div>
              </div>

              <div className="rounded-xl bg-gray-50 p-4 sm:col-span-2">
                <div className="mb-3 flex items-center justify-between">
                  <div className="flex items-center gap-2 text-primary-500">
                    <Video className="size-4" />
                    <span className="text-xs font-medium">Standup meeting</span>
                  </div>
                  <span className="text-xs text-neutral-300">Starts in 5 min</span>
                </div>
                <div className="flex gap-2">
                  {["Design", "Dev", "QA", "Marketing"].map((task) => (
                    <div
                      key={task}
                      className="flex-1 rounded-lg border border-gray-200 bg-white px-2 py-2 text-center text-[10px] font-medium text-neutral-500"
                    >
                      {task}
                    </div>
                  ))}
                </div>
              </div>
            </div>
          </div>

          <div className="absolute -bottom-4 -left-4 hidden rounded-xl border border-gray-200 bg-white px-4 py-3 shadow-card sm:block">
            <p className="text-2xl font-bold text-primary-500">98%</p>
            <p className="text-xs text-neutral-400">Tasks completed on time</p>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Hero;
