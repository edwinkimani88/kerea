import React from 'react';
import { ShieldCheck, GraduationCap, Gavel, Radio, ArrowRight } from 'lucide-react';
import { motion } from 'motion/react';

export default function Hero() {
  const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const featureCards = [
    {
      num: '01',
      title: 'Technical Licensing',
      desc: 'Simplifying EPRA standards, licensing examinations preparation, and quality assurance.',
      icon: ShieldCheck,
      color: 'bg-emerald-500',
    },
    {
      num: '02',
      title: 'Training & Curriculum',
      desc: 'Assuring masterclass teaching guidelines for solar PV, battery systems, and biomass design.',
      icon: GraduationCap,
      color: 'bg-teal-600',
    },
    {
      num: '03',
      title: 'Lobbying & Advocacy',
      desc: 'Successfully advocating for VAT exemptions, net metering, and clean grid integration.',
      icon: Gavel,
      color: 'bg-amber-500',
    },
    {
      num: '04',
      title: 'Industry Symposia',
      desc: 'Fostering B2B linkages, networking banquets, and foreign development funding matching.',
      icon: Radio,
      color: 'bg-orange-500',
    },
  ];

  return (
    <section className="relative bg-[#0d2116] text-white pt-20 pb-36 lg:pt-28 lg:pb-48 overflow-hidden">
      {/* Background Graphic Overlay */}
      <div className="absolute inset-0 z-0 opacity-25">
        <img
          src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1920&q=80"
          alt="Lush green fields with integrated solar arrays in East Africa"
          className="w-full h-full object-cover"
          referrerPolicy="no-referrer"
        />
        <div className="absolute inset-0 bg-gradient-to-b from-[#0d2116]/95 via-[#0d2116]/85 to-[#0d2116]/95"></div>
      </div>

      {/* Hero Content Container */}
      <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="max-w-3xl text-left">
          {/* Welcome Badge */}
          <motion.div 
            initial={{ opacity: 0, y: -10 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.5 }}
            className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 text-xs font-semibold tracking-wider uppercase mb-6 animate-pulse"
          >
            <span className="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
            WELCOME TO KEREA!
          </motion.div>

          {/* Headline */}
          <motion.h1 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.1 }}
            className="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-white mb-6 leading-[1.1]"
          >
            Start Your Beautiful <br className="hidden sm:inline" />
            And <span className="text-amber-400 bg-gradient-to-r from-amber-400 to-orange-400 bg-clip-text text-transparent">Bright Future</span> with Clean Energy
          </motion.h1>

          {/* Description Paragraph */}
          <motion.p 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.2 }}
            className="text-base sm:text-lg text-emerald-100/80 mb-8 max-w-2xl leading-relaxed"
          >
            As the peak body representing the Kenya renewable energy ecosystem, we bridge the gap between policy planners, professional installers, and users of solar, wind, and biomass technologies to achieve 100% sustainable electrification.
          </motion.p>

          {/* Buttons CTA */}
          <motion.div 
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.6, delay: 0.3 }}
            className="flex flex-wrap items-center gap-4"
          >
            <button
              onClick={() => scrollToSection('membership-section')}
              className="inline-flex items-center gap-2 px-7 py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl text-sm transition-all shadow-lg shadow-orange-500/25 hover:from-amber-600 hover:to-orange-600 hover:shadow-orange-500/35 hover:-translate-y-0.5 cursor-pointer text-center"
            >
              ABOUT MEMBERSHIP <ArrowRight className="w-4 h-4" />
            </button>
            <button
              onClick={() => scrollToSection('tech-section')}
              className="inline-flex items-center gap-2 px-7 py-3.5 bg-white/10 border border-white/20 text-white font-bold rounded-xl text-sm transition-all hover:bg-white/20 backdrop-blur-sm cursor-pointer whitespace-nowrap text-center"
            >
              LEARN MORE
            </button>
          </motion.div>
        </div>
      </div>

      {/* Overlapping Quick Fact Cards Grid (Styled to match the reference graphic 01-04) */}
      <div className="absolute left-0 right-0 bottom-0 transform translate-y-24 z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {featureCards.map((card, index) => {
            const IconComponent = card.icon;
            return (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 40 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ duration: 0.6, delay: 0.15 * index + 0.3, type: 'spring', stiffness: 100 }}
                className="bg-white rounded-2xl p-6 shadow-xl border border-emerald-50/40 relative group hover:scale-[1.03] transition-all"
              >
                {/* Numeric Header Indicator on the upper right */}
                <div className="absolute top-4 right-4 text-4xl sm:text-5xl font-black text-slate-100 font-mono tracking-tighter group-hover:text-amber-100/80 transition-colors">
                  {card.num}
                </div>

                {/* Styled SVG Icon Box inside circle */}
                <div className={`w-12 h-12 ${card.color} rounded-xl flex items-center justify-center text-white mb-5 shadow-lg shadow-gray-200/50 group-hover:rotate-6 transition-transform`}>
                  <IconComponent className="w-5.5 h-5.5" />
                </div>

                {/* Card Title */}
                <h3 className="text-lg font-extrabold text-[#112a1d] mb-2 font-sans tracking-tight">
                  {card.title}
                </h3>

                {/* Card Description */}
                <p className="text-xs text-gray-500 leading-relaxed font-sans pr-4">
                  {card.desc}
                </p>
              </motion.div>
            );
          })}
        </div>
      </div>

    </section>
  );
}
