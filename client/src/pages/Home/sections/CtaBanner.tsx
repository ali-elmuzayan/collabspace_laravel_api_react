import { Button } from "@/components/ui/button";
import { ArrowRight } from "lucide-react";
import { Link } from "react-router";

const CtaBanner = () => {
  return (
    <section className="bg-gray-50 py-20">
      <div className="mx-auto max-w-6xl px-6">
        <div className="relative overflow-hidden rounded-3xl bg-primary-500 px-8 py-14 text-center sm:px-16">
          <div className="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.15),transparent_50%)]" />

          <div className="relative space-y-6">
            <h2 className="text-3xl font-bold text-white sm:text-4xl">
              Ready to bring your team together?
            </h2>
            <p className="mx-auto max-w-xl text-primary-100">
              Join thousands of teams using CollabSpace to manage projects,
              coordinate tasks, and collaborate in real time.
            </p>
            <div className="flex flex-wrap items-center justify-center gap-3">
              <Button
                size="lg"
                className="rounded-full bg-white px-8 text-primary-600 hover:bg-primary-50"
                render={<Link to="/register" />}
              >
                Subscribe now
                <ArrowRight className="size-4" />
              </Button>
              <Button
                variant="outline"
                size="lg"
                className="rounded-full border-white/30 bg-transparent px-8 text-white hover:bg-white/10"
                render={<Link to="/login" />}
              >
                Sign in
              </Button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default CtaBanner;
