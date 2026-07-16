import { MessageSquare, Share2, Video, Zap } from "lucide-react";

const points = [
  {
    icon: MessageSquare,
    title: "Chat in context",
    description:
      "Talk about a task, file, or sprint right where the work lives — no more lost threads in email.",
  },
  {
    icon: Video,
    title: "Meet without leaving",
    description:
      "Schedule standups and reviews inside CollabSpace. Join from any device with one link.",
  },
  {
    icon: Share2,
    title: "Share across apps",
    description:
      "Push notifications and updates to Slack, Teams, or email so everyone stays in the loop.",
  },
  {
    icon: Zap,
    title: "Automate handoffs",
    description:
      "When a task moves to Done, notify the team, update the board, and trigger the next step.",
  },
];

const Collaboration = () => {
  return (
    <section id="collaboration" className="bg-gray-50 py-20 lg:py-28">
      <div className="mx-auto max-w-6xl px-6">
        <div className="grid items-center gap-12 lg:grid-cols-2">
          <div>
            <p className="mb-3 text-sm font-medium uppercase tracking-wider text-primary-500">
              Collaboration
            </p>
            <h2 className="text-3xl font-bold text-neutral-600 sm:text-4xl">
              Chat, meet, and build — together
            </h2>
            <p className="mt-4 text-neutral-400">
              Stop juggling five different tools. CollabSpace keeps conversations,
              meetings, and project updates connected so your team moves as one.
            </p>

            <div className="mt-10 space-y-6">
              {points.map(({ icon: Icon, title, description }) => (
                <div key={title} className="flex gap-4">
                  <div className="flex size-10 shrink-0 items-center justify-center rounded-lg bg-white text-primary-500 shadow-xs ring-1 ring-gray-100">
                    <Icon className="size-5" />
                  </div>
                  <div>
                    <h3 className="font-heading font-semibold text-neutral-600">
                      {title}
                    </h3>
                    <p className="mt-1 text-sm leading-relaxed text-neutral-400">
                      {description}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div className="rounded-2xl border border-gray-200 bg-white p-6 shadow-card">
            <div className="mb-4 flex items-center justify-between">
              <p className="font-heading text-sm font-semibold text-neutral-600">
                # product-launch
              </p>
              <span className="rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700">
                Live
              </span>
            </div>

            <div className="space-y-4">
              {[
                {
                  user: "Sarah",
                  time: "10:02 AM",
                  message: "Updated the landing page copy in the sprint board.",
                  color: "bg-primary-100 text-primary-700",
                },
                {
                  user: "Alex",
                  time: "10:05 AM",
                  message: "Nice! I'll review and merge before standup.",
                  color: "bg-neutral-100 text-neutral-600",
                },
                {
                  user: "Jordan",
                  time: "10:08 AM",
                  message: "Starting the demo call in 2 minutes — join from the task.",
                  color: "bg-primary-500 text-white",
                },
              ].map(({ user, time, message, color }) => (
                <div key={time} className="flex gap-3">
                  <div
                    className={`flex size-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold ${color}`}
                  >
                    {user[0]}
                  </div>
                  <div className="flex-1 rounded-xl bg-gray-50 px-4 py-3">
                    <div className="mb-1 flex items-center gap-2">
                      <span className="text-xs font-semibold text-neutral-600">
                        {user}
                      </span>
                      <span className="text-[10px] text-neutral-300">{time}</span>
                    </div>
                    <p className="text-sm text-neutral-500">{message}</p>
                  </div>
                </div>
              ))}
            </div>

            <div className="mt-6 rounded-xl border border-dashed border-gray-200 bg-gray-50 px-4 py-3 text-sm text-neutral-300">
              Message your team…
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Collaboration;
