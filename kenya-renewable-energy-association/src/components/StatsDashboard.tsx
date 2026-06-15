import React from 'react';
import { Users, Award, Zap, ShieldCheck } from 'lucide-react';
import { motion } from 'motion/react';

export default function StatsDashboard() {
  const stats = [
    {
      id: 'corporate-members',
      value: '450+',
      label: 'Accredited Members',
      desc: 'Local solar suppliers, wind energy advisors, and academic bodies.',
      icon: Users,
      color: 'text-amber-400',
    },
    {
      id: 'certified-installers',
      value: '1,200+',
      label: 'Licensed Installers',
      desc: 'Technicians verified under strict EPRA guidelines and solar curricula.',
      icon: Award,
      color: 'text-emerald-400',
    },
    {
      id: 'microgrids-enabled',
      value: '85%',
      label: 'Off-Grid Access Gain',
      desc: 'Subsidized rural solar solutions across the northern frontier counties.',
      icon: Zap,
      color: 'text-yellow-400',
    },
    {
      id: 'advocacy-wins',
      value: '22+',
      label: 'Years advocacy wins',
      desc: 'Assuring exemptions of VAT, tax relieves, and solar standard revisions.',
      icon: ShieldCheck,
      color: 'text-orange-400',
    },
  ];

  return (
    <section className="relative py-16 bg-[#112a1d] overflow-hidden">
      {/* Absolute faint background overlays for visual richness */}
      <div className="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.08),transparent_40%)]"></div>
      
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-2 lg:grid-cols-4 gap-8 md:gap-12 text-center">
          {stats.map((stat, idx) => {
            const IconComponent = stat.icon;
            return (
              <motion.div 
                key={stat.id}
                initial={{ opacity: 0, y: 30 }}
                whileInView={{ opacity: 1, y: 0 }}
                viewport={{ once: true, margin: "-50px" }}
                transition={{ duration: 0.5, delay: idx * 0.1 }}
                className="flex flex-col items-center justify-center p-4 rounded-xl bg-white/5 border border-white/5 hover:border-emerald-500/20 hover:bg-white/10 transition-all duration-300"
              >
                {/* Icons inside circular frame */}
                <div className="w-14 h-14 rounded-full bg-emerald-950/40 border-2 border-emerald-500/30 flex items-center justify-center mb-4 text-emerald-400">
                  <IconComponent className="w-6 h-6 animate-pulse" />
                </div>

                {/* Stat value */}
                <div className={`text-3xl sm:text-4xl lg:text-5xl font-black ${stat.color} font-mono mb-2`}>
                  {stat.value}
                </div>

                {/* Stat label */}
                <div className="text-xs sm:text-sm font-extrabold text-[#f3fbf7] mb-1 font-sans tracking-tight">
                  {stat.label}
                </div>

                {/* Stat short description */}
                <p className="text-[10px] sm:text-xs text-emerald-200/60 font-sans max-w-[170px] leading-relaxed">
                  {stat.desc}
                </p>
              </motion.div>
            );
          })}

        </div>
      </div>
    </section>
  );
}
