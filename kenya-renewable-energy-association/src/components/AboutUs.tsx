import React from 'react';
import { Award, Zap, Heart, CheckCircle2, PhoneCall } from 'lucide-react';
import { motion } from 'motion/react';

export default function AboutUs() {
  const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
  };

  return (
    <section id="about-section" className="py-24 bg-white overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          {/* Left Hand Column: Overlapping Circle Graphics Layout */}
          <motion.div 
            initial={{ opacity: 0, x: -40 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, margin: "-100px" }}
            transition={{ duration: 0.6 }}
            className="lg:col-span-5 relative flex justify-center items-center h-[460px] sm:h-[500px]"
          >
            {/* Background Decorative Rings */}
            <div className="absolute w-80 h-80 rounded-full border border-emerald-500/10 -top-4 -left-12 animate-pulse"></div>
            <div className="absolute w-96 h-96 rounded-full border border-amber-500/5 bottom-4 -right-12"></div>

            {/* Main Rounded Circle Photo (Solar PV Grid) */}
            <div className="absolute w-64 h-64 sm:w-76 sm:h-76 rounded-full overflow-hidden border-8 border-white shadow-2xl z-10 left-4 sm:left-8 top-8 hover:scale-105 transition-transform duration-300">
              <img
                src="https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=600&q=80"
                alt="Expert solar PV array in Nairobi"
                className="w-full h-full object-cover"
                referrerPolicy="no-referrer"
              />
            </div>

            {/* Secondary Overlapping Circle Photo (Meeting / Training Group) */}
            <div className="absolute w-44 h-44 sm:w-52 sm:h-52 rounded-full overflow-hidden border-8 border-white shadow-2xl z-20 right-4 bottom-12 hover:scale-[1.05] transition-transform duration-300">
              <img
                src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=400&q=80"
                alt="KEREA renewable trainees"
                className="w-full h-full object-cover"
                referrerPolicy="no-referrer"
              />
            </div>

            {/* Floating Quality Service Badge */}
            <div className="absolute bottom-16 left-2 sm:left-6 z-30 bg-gradient-to-br from-amber-500 to-orange-500 text-white rounded-2xl p-4 shadow-xl border border-amber-400/30 max-w-[170px] hover:rotate-2 transition-transform">
              <div className="flex items-center gap-2 mb-1.5">
                <Award className="w-5 h-5 text-yellow-105" />
                <span className="text-[10px] uppercase font-bold tracking-widest text-amber-150">PIONEERING</span>
              </div>
              <p className="text-xl font-black text-white leading-none mb-1">22+ Years</p>
              <p className="text-[11px] font-medium leading-tight text-amber-50">
                Of Leading Green Innovation & Industry Accreditations
              </p>
            </div>
          </motion.div>

          {/* Right Hand Column: Copy content formatted matching the reference */}
          <motion.div 
            initial={{ opacity: 0, x: 40 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, margin: "-100px" }}
            transition={{ duration: 0.6, delay: 0.1 }}
            className="lg:col-span-7 flex flex-col justify-center"
          >
            {/* Category Tag */}
            <div className="inline-flex items-center gap-1 text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3">
              <Zap className="w-3.5 h-3.5 text-amber-500 fill-amber-500" />
              ABOUT KEREA
            </div>

            {/* Big Catchy Title */}
            <h2 className="text-3xl sm:text-4xl font-extrabold text-[#112a1d] tracking-tight leading-tight mb-5">
              Our Renewable Integration Network <br className="hidden md:inline" />
              <span className="text-emerald-600">Empowers You More.</span>
            </h2>

            {/* Description Body */}
            <p className="text-sm text-gray-500 leading-relaxed mb-6">
              Founded in 2004, the Kenya Renewable Energy Association (KEREA) represents more than 400 organizations and specialists advocating for favorable policy, robust licensing frameworks, and high-fidelity installation practices.
            </p>

            {/* Core Services Bullet Boxes stacked structured list */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-8">
              {/* Feature Item 1 */}
              <div className="flex items-start gap-3 p-3.5 rounded-xl border border-slate-100 hover:border-emerald-100 bg-slate-50/50 hover:bg-emerald-50/20 transition-colors">
                <div className="p-2.5 rounded-lg bg-emerald-500/10 text-emerald-600 shrink-0">
                  <CheckCircle2 className="w-4.5 h-4.5" />
                </div>
                <div>
                  <h4 className="text-sm font-bold text-[#112a1d] mb-1">Standards & Accreditation</h4>
                  <p className="text-[11px] text-gray-400 leading-relaxed">
                    Collaborating with KEBS and EPRA to accredit installers, solar kits, and local hardware testers.
                  </p>
                </div>
              </div>

              {/* Feature Item 2 */}
              <div className="flex items-start gap-3 p-3.5 rounded-xl border border-slate-100 hover:border-emerald-100 bg-slate-50/50 hover:bg-emerald-50/20 transition-colors">
                <div className="p-2.5 rounded-lg bg-amber-500/10 text-amber-600 shrink-0">
                  <Heart className="w-4.5 h-4.5" />
                </div>
                <div>
                  <h4 className="text-sm font-bold text-[#112a1d] mb-1">Advocacy & Tax Relief</h4>
                  <p className="text-[11px] text-gray-400 leading-relaxed">
                    Unifying private market voices to secure crucial VAT exemptions and feed-in tariff policies.
                  </p>
                </div>
              </div>
            </div>

            {/* Divider */}
            <div className="h-px bg-slate-100 w-full mb-8"></div>

            {/* Contact Row containing orange button and phone call prompt */}
            <div className="flex flex-col sm:flex-row sm:items-center gap-6">
              <button
                onClick={() => scrollToSection('membership-section')}
                className="px-6 py-3.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-xl text-xs sm:text-sm shadow-md shadow-orange-500/20 hover:from-amber-600 hover:to-orange-600 transform active:scale-95 transition-all text-center cursor-pointer"
              >
                DISCOVER MORE
              </button>

              <div className="flex items-center gap-3">
                <div className="w-11 h-11 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shadow-sm shrink-0">
                  <PhoneCall className="w-4.5 h-4.5 animate-bounce" />
                </div>
                <div>
                  <p className="text-[10px] font-bold text-gray-400 tracking-wider">CALL NOW FOR QUESTIONS</p>
                  <a href="tel:+254700882244" className="text-sm sm:text-base font-black text-[#112a1d] hover:text-emerald-600 transition-colors">
                    +254 (0) 700 882244
                  </a>
                </div>
              </div>
            </div>

          </motion.div>

        </div>
      </div>
    </section>
  );
}
