import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  FolderKanban,
  LayoutList,
  MessageSquare,
  Plug,
  Users,
  Video,
} from "lucide-react";

const features = [
  {
    icon: FolderKanban,
    title: "Project management",
    description:
      "Plan milestones, track progress, and keep every deliverable visible from kickoff to launch.",
  },
  {
    icon: Users,
    title: "Team workspaces",
    description:
      "Organize people by department or squad with roles, permissions, and shared context.",
  },
  {
    icon: LayoutList,
    title: "Task tracking",
    description:
      "Assign work, set priorities, and move tasks through boards so nothing slips through.",
  },
  {
    icon: MessageSquare,
    title: "Team chat",
    description:
      "Discuss work in channels and direct messages without leaving the project you're in.",
  },
  {
    icon: Video,
    title: "Built-in meetings",
    description:
      "Jump from a task into a video call — standups, reviews, and syncs in one click.",
  },
  {
    icon: Plug,
    title: "App integrations",
    description:
      "Connect Slack, GitHub, Figma, and more so updates flow into the workspace automatically.",
  },
];

const Features = () => {
  return (
    <section id="features" className="bg-white py-20 lg:py-28">
      <div className="mx-auto max-w-6xl px-6">
        <div className="mx-auto mb-14 max-w-2xl text-center">
          <p className="mb-3 text-sm font-medium uppercase tracking-wider text-primary-500">
            Features
          </p>
          <h2 className="text-3xl font-bold text-neutral-600 sm:text-4xl">
            Everything your team needs to work together
          </h2>
          <p className="mt-4 text-neutral-400">
            Subscribe once and get the full toolkit — projects, people, tasks,
            conversations, and meetings in a single platform.
          </p>
        </div>

        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          {features.map(({ icon: Icon, title, description }) => (
            <Card
              key={title}
              className="border-gray-100 shadow-none transition-shadow hover:shadow-card"
            >
              <CardHeader>
                <div className="mb-2 flex size-10 items-center justify-center rounded-lg bg-primary-50 text-primary-500">
                  <Icon className="size-5" />
                </div>
                <CardTitle className="text-neutral-600">{title}</CardTitle>
                <CardDescription className="leading-relaxed">
                  {description}
                </CardDescription>
              </CardHeader>
              <CardContent />
            </Card>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Features;
