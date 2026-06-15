import React, { useState, useEffect } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  Search, 
  MapPin, 
  ChevronRight, 
  Star, 
  Tag, 
  Flame, 
  Zap, 
  Sparkles, 
  TrendingUp, 
  Clock, 
  Quote, 
  Mail, 
  ShieldCheck, 
  CheckCircle, 
  Cpu, 
  Users, 
  ShoppingCart, 
  Heart, 
  Eye, 
  Compass, 
  Award,
  DollarSign,
  ArrowRight
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

export default function MarketplaceHome() {
  const { 
    products, 
    savedProductIds, 
    toggleSaveProduct, 
    navigateTo, 
    setSearchMarketQuery,
    allUsers,
    setSelectedVendorId,
    setSelectedProductId
  } = useAppState();

  const [localSearch, setLocalSearch] = useState('');
  const [countdown, setCountdown] = useState({ hours: 14, minutes: 42, seconds: 18 });

  // Countdown timer simulation for Deal of the Day
  useEffect(() => {
    const interval = setInterval(() => {
      setCountdown(prev => {
        if (prev.seconds > 0) {
          return { ...prev, seconds: prev.seconds - 1 };
        } else if (prev.minutes > 0) {
          return { ...prev, minutes: prev.minutes - 1, seconds: 59 };
        } else if (prev.hours > 0) {
          return { hours: prev.hours - 1, minutes: 59, seconds: 59 };
        } else {
          return { hours: 24, minutes: 0, seconds: 0 };
        }
      });
    }, 1000);
    return () => clearInterval(interval);
  }, []);

  const handleSearchSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!localSearch.trim()) return;
    setSearchMarketQuery(localSearch);
    navigateTo('marketplace-search-results');
  };

  const handleCategoryNav = (cat: string) => {
    const viewMap: Record<string, AppView> = {
      'Solar Technologies': 'marketplace-category-solar',
      'Electric Cooking': 'marketplace-category-cooking',
      'Biogas Systems': 'marketplace-category-biogas',
      'Biomass Technologies': 'marketplace-category-biomass',
      'Improved Cookstoves': 'marketplace-category-cookstoves',
      'Energy Storage': 'marketplace-category-storage',
      'Mini-grid Technologies': 'marketplace-category-minigrid',
    };
    const target = viewMap[cat];
    if (target) navigateTo(target);
  };

  // Filter products for trending & recently added lists
  const trendingProducts = products.filter((_, idx) => idx % 2 === 0).slice(0, 3);
  const recentlyAdded = products.filter((_, idx) => idx % 2 !== 0).slice(0, 3);
  const dealProduct = products[2]; // Using storage battery

  // List of Categories with custom graphics description
  const categoriesList = [
    { name: 'Solar Technologies', count: '50+ products', color: 'from-amber-500/10 to-amber-600/10', icon: Zap, border: 'border-amber-200 hover:border-amber-500', iconColor: 'text-amber-500', desc: 'Solar panels, home systems, grid-tie units' },
    { name: 'Electric Cooking', count: '18+ products', color: 'from-emerald-500/10 to-emerald-600/10', icon: Flame, border: 'border-emerald-200 hover:border-emerald-500', iconColor: 'text-emerald-500', desc: 'EPC induction tables, electric cookstoves' },
    { name: 'Biogas Systems', count: '12+ products', color: 'from-blue-500/10 to-blue-600/10', icon: Compass, border: 'border-blue-200 hover:border-blue-500', iconColor: 'text-blue-500', desc: 'Modular PVC digesters, farm manure gas' },
    { name: 'Biomass Technologies', count: '8+ products', color: 'from-orange-500/10 to-orange-600/10', icon: Cpu, border: 'border-orange-200 hover:border-orange-500', iconColor: 'text-orange-500', desc: 'Eco briquettes, biomass gasifier systems' },
    { name: 'Improved Cookstoves', count: '24+ products', color: 'from-red-500/10 to-red-600/10', icon: Tag, border: 'border-red-200 hover:border-red-500', iconColor: 'text-red-500', desc: 'SuperSaver rocket stoves, thermal jikos' },
    { name: 'Energy Storage', count: '15+ products', color: 'from-purple-500/10 to-purple-600/10', icon: ShieldCheck, border: 'border-purple-200 hover:border-purple-500', iconColor: 'text-purple-500', desc: 'Lithium iron arrays, cycle gel packs' },
    { name: 'Mini-grid Technologies', count: '11+ products', color: 'from-teal-500/10 to-teal-600/10', icon: Users, border: 'border-teal-200 hover:border-teal-500', iconColor: 'text-teal-500', desc: 'STS pre-paid utility meters, telemetry' },
  ];

  const vendorsList = [
    { id: 'usr-2', name: 'Safi Solar Solutions Ltd', logo: '☀️', location: 'Nairobi, Kenya', rating: 4.8, membersSince: '2025', count: 'Solar PV & Cookers', desc: 'Registered Class T1/T2 installer with the EPRA.' },
    { id: 'usr-3', name: 'EcoPower Bioenergy Systems', logo: '🍃', location: 'Kisumu-Mombasa', rating: 4.9, membersSince: '2026', count: 'Biomass & Biogas', desc: 'Premier manufacturer of organic farm digestables and briquettes.' }
  ];

  return (
    <div className="space-y-16 pb-16 font-sans">
      
      {/* 1. HERO PROMOTIONAL BANNER */}
      <section className="relative bg-[#112a1d] min-h-[460px] sm:min-h-[500px] rounded-3xl overflow-hidden flex flex-col justify-center px-6 sm:px-12 py-12 text-white">
        {/* Background Overlay Shapes mimicking the furnmart design's premium editorial look */}
        <div className="absolute right-0 top-0 bottom-0 w-full sm:w-1/2 bg-[url('https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center h-full opacity-35 sm:opacity-90 transform skew-x-3 origin-top-right transition duration-700"></div>
        <div className="absolute inset-0 bg-gradient-to-r from-[#112a1d] via-[#112a1d]/85 to-transparent"></div>

        {/* Decorative Badge */}
        <div className="relative z-10 max-w-xl space-y-6">
          <div className="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-500/20 border border-amber-400/30 rounded-full text-amber-400 text-xs font-bold uppercase tracking-wider">
            <Sparkles className="w-3.5 h-3.5" /> EAST AFRICA RENEWABLES SELECTION
          </div>
          
          <h1 className="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
            Guaranteed Quality <br />
            <span className="text-amber-400">Clean Tech Products</span>
          </h1>
          
          <p className="text-sm sm:text-base text-slate-300 leading-relaxed max-w-md">
            Direct access to EPRA-certified solar subsystems, carbonized briquettes, clean cookstoves, and rural energy appliances from vetted corporate members.
          </p>

          {/* Interactive Search Bar inside Hero */}
          <form onSubmit={handleSearchSubmit} className="flex flex-col sm:flex-row gap-2 max-w-lg">
            <div className="relative flex-1">
              <Search className="absolute left-4 top-3.5 w-4.5 h-4.5 text-slate-400" />
              <input 
                type="text" 
                required
                value={localSearch}
                onChange={e => setLocalSearch(e.target.value)}
                placeholder="Search solar panels, cookers, meters..." 
                className="w-full text-xs text-slate-900 bg-white placeholder-slate-400 rounded-xl sm:rounded-2xl pl-11 pr-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-amber-500 font-sans"
              />
            </div>
            <button 
              type="submit" 
              className="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-[#112a1d] font-black text-xs uppercase tracking-wider rounded-xl sm:rounded-2xl transition duration-150 cursor-pointer text-center"
            >
              Search Catalog
            </button>
          </form>

          {/* Quick Stats banner */}
          <div className="flex flex-wrap items-center gap-x-6 gap-y-2 pt-4 border-t border-slate-750 text-xs text-slate-350">
            <span className="flex items-center gap-1.5"><CheckCircle className="w-4 h-4 text-emerald-450" /> 100% Verified Members</span>
            <span className="flex items-center gap-1.5"><ShieldCheck className="w-4 h-4 text-emerald-450" /> EPRA Safety Compliant</span>
            <span className="flex items-center gap-1.5"><Users className="w-4 h-4 text-emerald-450" /> Escrow Fund Covered</span>
          </div>
        </div>
      </section>

      {/* 2. RETAIL-MAPPED FEATURED CATEGORIES (Bento layout style matches furnmart) */}
      <section className="space-y-6">
        <div className="flex justify-between items-end">
          <div className="space-y-1">
            <span className="text-[10px] uppercase font-black text-amber-500 tracking-widest block">EXPLORE THE MATRIX</span>
            <h2 className="text-2xl font-extrabold text-[#112a1d] tracking-tight">Vetted Renewable Categories</h2>
          </div>
          <span className="text-xs text-slate-500 font-mono hidden sm:inline">Certified Technical Tiers</span>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          {categoriesList.map((cat, idx) => {
            const IconComponent = cat.icon;
            return (
              <div 
                key={idx}
                onClick={() => handleCategoryNav(cat.name)}
                className={`group p-6 bg-white border ${cat.border} rounded-2xl cursor-pointer transition shadow-sm hover:shadow-md flex flex-col justify-between h-[200px]`}
              >
                <div className="space-y-3">
                  <div className={`p-3 rounded-xl w-fit bg-gradient-to-br ${cat.color} ${cat.iconColor}`}>
                    <IconComponent className="w-6 h-6" />
                  </div>
                  <div>
                    <h3 className="font-bold text-sm text-[#112a1d] group-hover:text-emerald-700 transition">{cat.name}</h3>
                    <p className="text-[11px] text-gray-500 mt-1 leading-normal font-sans">{cat.desc}</p>
                  </div>
                </div>
                <div className="flex justify-between items-center pt-4 border-t border-slate-50">
                  <span className="text-[10px] font-mono text-gray-400">{cat.count}</span>
                  <div className="p-1 px-2 rounded-lg bg-slate-50 text-[#112a1d] group-hover:bg-amber-500 group-hover:text-white transition text-[10px] font-black uppercase flex items-center gap-0.5">
                    Browse <ChevronRight className="w-3 h-3" />
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </section>

      {/* 3. CORE STATISTICS & SOCIAL PROOF STRIP */}
      <section className="bg-slate-900 text-white rounded-3xl p-8 sm:p-10 grid grid-cols-2 lg:grid-cols-4 gap-8">
        <div className="space-y-1 text-center lg:text-left">
          <p className="text-3xl sm:text-4xl font-extrabold text-amber-400">450+</p>
          <p className="text-xs font-bold uppercase tracking-wider text-slate-400">Corporate Members</p>
          <p className="text-[10px] text-slate-500 leading-normal font-sans">Vetted tech providers nationwide</p>
        </div>
        <div className="space-y-1 text-center lg:text-left">
          <p className="text-3xl sm:text-4xl font-extrabold text-amber-400">1,200+</p>
          <p className="text-xs font-bold uppercase tracking-wider text-slate-400">Certified Installers</p>
          <p className="text-[10px] text-slate-500 leading-normal font-sans">EPRA licensed installers registered</p>
        </div>
        <div className="space-y-1 text-center lg:text-left">
          <p className="text-3xl sm:text-4xl font-extrabold text-amber-400">Kes 10M+</p>
          <p className="text-xs font-bold uppercase tracking-wider text-slate-400">Escrow Protected</p>
          <p className="text-[10px] text-slate-500 leading-normal font-sans">Securing reliable rural purchases</p>
        </div>
        <div className="space-y-1 text-center lg:text-left">
          <p className="text-3xl sm:text-4xl font-extrabold text-amber-400">22+ Years</p>
          <p className="text-xs font-bold uppercase tracking-wider text-slate-400">Sector Leadership</p>
          <p className="text-[10px] text-slate-500 leading-normal font-sans">Kenya premier renewable body (est. 2004)</p>
        </div>
      </section>

      {/* 4. SPRING EXCLUSIVES MAPPED: TRENDING PRODUCTS SECTION */}
      <section className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div className="lg:col-span-8 space-y-6">
          <div className="flex justify-between items-end">
            <div>
              <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block">THE COOLEST RELEASES</span>
              <h2 className="text-xl font-extrabold text-[#112a1d] tracking-tight">Trending Solar & Energy Hardware</h2>
            </div>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
            {trendingProducts.map((prod) => {
              const saved = savedProductIds.includes(prod.id);
              const discountPercent = prod.originalPriceKES 
                ? Math.round(((prod.originalPriceKES - prod.priceKES) / prod.originalPriceKES) * 100) 
                : null;

              return (
                <div 
                  key={prod.id} 
                  className="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:shadow-lg transition flex flex-col"
                >
                  <div className="relative aspect-video bg-slate-100 overflow-hidden">
                    <img 
                      src={prod.imageUrl} 
                      alt={prod.title} 
                      className="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                      referrerPolicy="no-referrer"
                    />
                    
                    {/* Discount badge like the furnmart style */}
                    {discountPercent && (
                      <span className="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black uppercase px-2 py-0.5 rounded-md">
                        -{discountPercent}% OFF
                      </span>
                    )}

                    {prod.certifiedByEPRA && (
                      <span className="absolute bottom-3 left-3 bg-emerald-700 text-white text-[8px] font-bold uppercase px-1.5 py-0.5 rounded tracking-wide">
                        EPRA Certified
                      </span>
                    )}

                    <button 
                      onClick={() => toggleSaveProduct(prod.id)}
                      className="absolute top-3 right-3 p-2 bg-white/95 rounded-full hover:bg-amber-400 group-hover:scale-105 transition duration-150 text-slate-800 cursor-pointer shadow"
                    >
                      <Heart className={`w-3.5 h-3.5 ${saved ? 'fill-red-600 text-red-600' : 'text-slate-500'}`} />
                    </button>
                  </div>

                  <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                    <div>
                      <span className="text-[8px] font-black uppercase tracking-wider text-slate-400 block">{prod.category}</span>
                      <h3 className="font-bold text-xs text-[#112a1d] line-clamp-1 group-hover:text-emerald-700 transition mt-1">
                        {prod.title}
                      </h3>
                      
                      <div className="flex items-center gap-1 mt-1">
                        <div className="flex text-amber-405">
                          {Array.from({ length: 5 }).map((_, i) => (
                            <Star key={i} className={`w-3 h-3 ${i < Math.floor(prod.rating) ? 'fill-amber-400 text-amber-400' : 'text-slate-250'}`} />
                          ))}
                        </div>
                        <span className="text-[9px] text-gray-400 font-mono">({prod.reviewsCount} reviews)</span>
                      </div>
                    </div>

                    <div className="pt-2 border-t border-slate-50 flex items-center justify-between">
                      <div className="flex flex-col">
                        {prod.originalPriceKES && (
                          <span className="text-[10px] text-slate-400 line-through">
                            KES {prod.originalPriceKES.toLocaleString()}
                          </span>
                        )}
                        <span className="text-xs font-black text-emerald-805">
                          KES {prod.priceKES.toLocaleString()}
                        </span>
                      </div>

                      <button 
                        onClick={() => {
                          setSelectedProductId(prod.id);
                          navigateTo('marketplace-product-details');
                        }}
                        className="p-2 bg-slate-900 text-white rounded-lg hover:bg-[#112a1d] text-[9px] font-black flex items-center gap-1 cursor-pointer"
                      >
                        <Eye className="w-3.5 h-3.5" /> Details
                      </button>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        </div>

        {/* 5. DEAL OF THE DAY COUNTDOWN BANNER (furnmart style alignment) */}
        <div className="lg:col-span-4 bg-gradient-to-b from-[#112a1d] to-[#1c3e2e] text-white p-6 rounded-3xl space-y-6 shadow-md relative overflow-hidden">
          <div className="absolute -right-12 -top-12 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl"></div>
          
          <div className="flex justify-between items-center">
            <span className="text-[9px] font-black uppercase tracking-widest px-2.5 py-1 bg-amber-500 text-slate-955 rounded-full">
              DEAL OF THE DAY
            </span>
            <div className="flex items-center gap-1.5 text-xs text-amber-400 font-mono">
              <Clock className="w-4 h-4 animate-spin text-amber-400" />
              <span>Limited Stock</span>
            </div>
          </div>

          <div className="space-y-2">
            <p className="text-lg font-black tracking-tight text-white leading-snug">
              {dealProduct.title}
            </p>
            <p className="text-xs text-slate-350 leading-relaxed font-sans line-clamp-2">
              {dealProduct.description}
            </p>
          </div>

          <div className="aspect-video bg-white/5 rounded-2xl overflow-hidden shadow">
            <img 
              src={dealProduct.imageUrl} 
              alt={dealProduct.title} 
              className="w-full h-full object-cover opacity-90"
              referrerPolicy="no-referrer"
            />
          </div>

          <div className="space-y-2">
            <span className="text-gray-400 text-[10px] uppercase font-mono block">Special Event Price</span>
            <div className="flex items-baseline gap-2">
              <span className="text-xl font-extrabold text-amber-400">KES {dealProduct.priceKES.toLocaleString()}</span>
              {dealProduct.originalPriceKES && (
                <span className="text-xs text-slate-400 line-through">KES {dealProduct.originalPriceKES.toLocaleString()}</span>
              )}
            </div>
          </div>

          {/* Countdown Clock Layout */}
          <div className="grid grid-cols-3 gap-2 text-center pt-2 border-t border-white/5">
            <div className="bg-white/10 p-2.5 rounded-xl">
              <span className="text-xs font-black block text-amber-450">{countdown.hours}</span>
              <span className="text-[8px] text-slate-300 uppercase tracking-wider font-mono">Hours</span>
            </div>
            <div className="bg-white/10 p-2.5 rounded-xl">
              <span className="text-xs font-black block text-amber-450">{countdown.minutes}</span>
              <span className="text-[8px] text-slate-300 uppercase tracking-wider font-mono">Min</span>
            </div>
            <div className="bg-white/10 p-2.5 rounded-xl">
              <span className="text-xs font-black block text-amber-450">{countdown.seconds}</span>
              <span className="text-[8px] text-slate-300 uppercase tracking-wider font-mono">Sec</span>
            </div>
          </div>

          <button 
            onClick={() => {
              setSelectedProductId(dealProduct.id);
              navigateTo('marketplace-product-details');
            }}
            className="w-full py-3 bg-amber-500 hover:bg-amber-600 text-[#112a1d] font-black text-xs uppercase tracking-widest rounded-xl transition cursor-pointer"
          >
            Claim This Offer
          </button>
        </div>
      </section>

      {/* 6. FEATURED TECHNOLOGIES SEGMENT */}
      <section className="bg-amber-500/5 border border-amber-500/15 rounded-3xl p-6 sm:p-8 space-y-6">
        <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
          <div className="space-y-1">
            <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block flex items-center gap-1.5">
              <Sparkles className="w-4 h-4 text-amber-500" /> Featured Clean Tech Segment: Productivity-Driven Use (PURE)
            </span>
            <h2 className="text-lg font-extrabold text-[#112a1d] tracking-tight">Solar Water Pumps & Farm Agri-Milling Solutions</h2>
          </div>
          <button 
            onClick={() => navigateTo('marketplace-category-solar')}
            className="px-4 py-2 bg-[#112a1d] hover:bg-slate-900 text-white rounded-xl text-xs font-bold flex items-center gap-1 cursor-pointer"
          >
            Browse Products <ArrowRight className="w-3.5 h-3.5" />
          </button>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div className="bg-white border border-[#112a1d]/10 rounded-2xl p-5 flex flex-col sm:flex-row gap-4">
            <img 
              src="https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=300&q=80" 
              alt="agri pump" 
              className="w-full sm:w-28 h-28 object-cover rounded-xl"
            />
            <div className="space-y-2">
              <h3 className="font-extrabold text-sm text-[#112a1d]">Submersible Solar Pumping Kits</h3>
              <p className="text-[11px] text-gray-500 leading-normal font-sans">
                Vetted pumping kits designed for deep water borehole wells and crop microgrid irrigation. Fully compliant with EPRA class guidelines.
              </p>
              <div className="text-xs font-black text-amber-700">Starting from KES 45,000</div>
            </div>
          </div>

          <div className="bg-white border border-[#112a1d]/10 rounded-2xl p-5 flex flex-col sm:flex-row gap-4">
            <img 
              src="https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=300&q=80" 
              alt="water heaters" 
              className="w-full sm:w-28 h-28 object-cover rounded-xl"
            />
            <div className="space-y-2">
              <h3 className="font-extrabold text-sm text-[#112a1d]">High Performance Solar Water Heaters</h3>
              <p className="text-[11px] text-gray-500 leading-normal font-sans">
                EPRA certified evacuated tubes with high heat retention capabilities. Saves average households up to 50% on utility billing.
              </p>
              <div className="text-xs font-black text-amber-700">Starting from KES 55,000</div>
            </div>
          </div>
        </div>
      </section>

      {/* 7. RECENTLY ADDED ARTIFACTS SECTION */}
      <section className="space-y-6">
        <div className="flex justify-between items-end">
          <div>
            <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block">NEW SYSTEM ARRIVALS</span>
            <h2 className="text-xl font-extrabold text-[#112a1d] tracking-tight">Newly Certified Catalog Items</h2>
          </div>
          <button 
            onClick={() => navigateTo('marketplace-category-cooking')}
            className="text-xs font-bold text-[#112a1d] hover:text-emerald-700 select-none flex items-center gap-1 cursor-pointer"
          >
            See All Additions <ChevronRight className="w-4 h-4 text-emerald-700" />
          </button>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
          {recentlyAdded.map((prod) => {
            const saved = savedProductIds.includes(prod.id);
            const discountPercent = prod.originalPriceKES 
              ? Math.round(((prod.originalPriceKES - prod.priceKES) / prod.originalPriceKES) * 100) 
              : null;

            return (
              <div 
                key={prod.id} 
                className="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:shadow-lg transition flex flex-col"
              >
                <div className="relative aspect-video bg-slate-100 overflow-hidden">
                  <img 
                    src={prod.imageUrl} 
                    alt={prod.title} 
                    className="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                    referrerPolicy="no-referrer"
                  />
                  {discountPercent && (
                    <span className="absolute top-3 left-3 bg-[#112a1d] text-white text-[9px] font-black uppercase px-2 py-0.5 rounded-md">
                      -{discountPercent}% OFF
                    </span>
                  )}
                  {prod.certifiedByEPRA && (
                    <span className="absolute bottom-3 left-3 bg-amber-500 text-slate-950 text-[8px] font-bold uppercase px-1.5 py-0.5 rounded tracking-wide">
                      Certified
                    </span>
                  )}
                  <button 
                    onClick={() => toggleSaveProduct(prod.id)}
                    className="absolute top-3 right-3 p-2 bg-white/95 rounded-full hover:bg-amber-400 group-hover:scale-105 transition duration-150 text-slate-800 cursor-pointer shadow"
                  >
                    <Heart className={`w-3.5 h-3.5 ${saved ? 'fill-red-600 text-red-600' : 'text-slate-500'}`} />
                  </button>
                </div>

                <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                  <div>
                    <span className="text-[8px] font-black uppercase tracking-wider text-slate-400 block">{prod.category}</span>
                    <h3 className="font-bold text-xs text-[#112a1d] line-clamp-1 group-hover:text-emerald-700 mt-1">
                      {prod.title}
                    </h3>
                    <div className="flex items-center gap-1 mt-1">
                      <div className="flex text-amber-405">
                        {Array.from({ length: 5 }).map((_, i) => (
                          <Star key={i} className={`w-3 h-3 ${i < Math.floor(prod.rating) ? 'fill-amber-400 text-amber-405' : 'text-slate-250'}`} />
                        ))}
                      </div>
                      <span className="text-[9px] font-mono text-slate-400">({prod.reviewsCount})</span>
                    </div>
                  </div>

                  <div className="pt-2 border-t border-slate-50 flex items-center justify-between text-xs">
                    <span className="font-black text-[#112a1d]">KES {prod.priceKES.toLocaleString()}</span>
                    <button 
                      onClick={() => {
                        setSelectedProductId(prod.id);
                        navigateTo('marketplace-product-details');
                      }}
                      className="p-2 bg-slate-900 hover:bg-black text-white rounded-lg text-[9px] font-bold flex items-center gap-1 cursor-pointer"
                    >
                      <Eye className="w-3.5 h-3.5" /> Specifications
                    </button>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </section>

      {/* 8. FEATURED VENDORS (Vetted Suppliers Profile Showcase) */}
      <section className="space-y-6">
        <div className="flex justify-between items-end">
          <div>
            <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block">SUPPORT REPUTABLE SME PARTNERS</span>
            <h2 className="text-xl font-extrabold text-[#112a1d] tracking-tight">KEREA Vetted Corporate Vendors</h2>
          </div>
          <button 
            onClick={() => navigateTo('marketplace-vendors')}
            className="text-xs font-bold text-[#112a1d] hover:text-emerald-700 flex items-center gap-1 cursor-pointer"
          >
            Vendor Directory <ChevronRight className="w-4 h-4 text-emerald-700" />
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {vendorsList.map((vendor) => (
            <div 
              key={vendor.id} 
              className="p-6 bg-white border border-slate-150 rounded-2xl shadow-sm hover:shadow-md hover:border-emerald-750/30 transition flex flex-col sm:flex-row gap-5 items-start"
            >
              <div className="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-3xl font-bold shrink-0 shadow-sm">
                {vendor.logo}
              </div>
              <div className="space-y-3 flex-1">
                <div className="space-y-1">
                  <div className="flex items-center gap-2">
                    <span className="text-[9px] px-2 py-0.5 rounded bg-amber-100 text-amber-800 font-bold uppercase tracking-wider">
                      Verified Member
                    </span>
                    <span className="text-[10px] text-gray-400 font-mono">Since {vendor.membersSince}</span>
                  </div>
                  <h3 className="text-base font-black text-[#112a1d]">{vendor.name}</h3>
                  <p className="text-[11px] text-gray-400 flex items-center gap-1 font-mono">
                    <MapPin className="w-3.5 h-3.5" /> {vendor.location}
                  </p>
                </div>

                <p className="text-xs text-slate-500 font-sans leading-relaxed">
                  {vendor.desc}
                </p>

                <div className="flex justify-between items-center pt-3 border-t border-slate-50">
                  <div className="flex items-center gap-1">
                    <Star className="w-3.5 h-3.5 fill-amber-450 text-amber-450 text-amber-400" />
                    <span className="text-xs text-[#112a1d] font-black">{vendor.rating} Ratings</span>
                  </div>
                  <button 
                    onClick={() => {
                      setSelectedVendorId(vendor.id);
                      navigateTo('marketplace-vendor-profile');
                    }}
                    className="text-xs font-black text-[#112a1d] hover:text-emerald-700 hover:underline flex items-center gap-0.5 cursor-pointer"
                  >
                    View Supplier Store <ChevronRight className="w-4 h-4 text-emerald-700" />
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* 9. TESTIMONIALS (Adhering to furnmart style showcase) */}
      <section className="bg-slate-50 border border-slate-200/50 rounded-3xl p-8 sm:p-10 space-y-8">
        <div className="text-center max-w-xl mx-auto space-y-2">
          <span className="text-[10px] uppercase font-black text-amber-500 tracking-widest block">TRUSTED FEEDBACK</span>
          <h2 className="text-xl sm:text-2xl font-black text-[#112a1d] tracking-tight">Customer Experiences</h2>
          <p className="text-xs text-slate-500 font-sans">
            Hear from farm cooperatives, home installers, and institutional managers using our procurement systems.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div className="bg-white p-6 border border-slate-100 rounded-2xl shadow-sm relative space-y-4">
            <Quote className="absolute right-6 top-6 w-8 h-8 text-slate-150" />
            <div className="flex text-amber-400">
              {Array.from({ length: 5 }).map((_, i) => <Star key={i} className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />)}
            </div>
            <p className="text-xs text-slate-600 leading-relaxed font-sans">
              "Buying our solar system battery arrays via KEREA gave us perfect safety compliance peace of mind. Our local installer verified their credentials in the directory before matching, and delivery escrow was settled quickly."
            </p>
            <div className="flex items-center gap-3 pt-4 border-t border-slate-50">
              <div className="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-xs">SM</div>
              <div>
                <p className="text-xs font-extrabold text-[#112a1d]">Stephen Mwangi</p>
                <p className="text-[9px] text-gray-400">Agri-Farm Manager, Nakuru</p>
              </div>
            </div>
          </div>

          <div className="bg-white p-6 border border-slate-100 rounded-2xl shadow-sm relative space-y-4">
            <Quote className="absolute right-6 top-6 w-8 h-8 text-slate-150" />
            <div className="flex text-amber-400">
              {Array.from({ length: 5 }).map((_, i) => <Star key={i} className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />)}
            </div>
            <p className="text-xs text-slate-600 leading-relaxed font-sans">
              "As a certified technician, registering as a vendor took only a few hours. The administrative panel provides streamlined tools to track our carbonized wood briquettes orders and release payments. Recommend it."
            </p>
            <div className="flex items-center gap-3 pt-4 border-t border-slate-50">
              <div className="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-xs">JK</div>
              <div>
                <p className="text-xs font-extrabold text-[#112a1d]">Dr. Jane Kamau</p>
                <p className="text-[9px] text-gray-450">Renewable Energy Assessor, Nyandarua</p>
              </div>
            </div>
          </div>

          <div className="bg-white p-6 border border-slate-100 rounded-2xl shadow-sm relative space-y-4">
            <Quote className="absolute right-6 top-6 w-8 h-8 text-slate-150" />
            <div className="flex text-amber-400">
              {Array.from({ length: 5 }).map((_, i) => <Star key={i} className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />)}
            </div>
            <p className="text-xs text-slate-600 leading-relaxed font-sans">
              "We converted our corporate kitchen to smart electric cooking plates from Safi Solar solutions details page. The efficiency calculations were accurate, and our bills are cut in half."
            </p>
            <div className="flex items-center gap-3 pt-4 border-t border-slate-50">
              <div className="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-xs text-slate-500">EK</div>
              <div>
                <p className="text-xs font-extrabold text-[#112a1d]">Eunice Kimani</p>
                <p className="text-[9px] text-gray-400">Lead Chef, Green Catering Ltd</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* 10. NEWSLETTER & MAILING LIST WITH BLUR GLOW GRAPHICS (furnmart style alignment) */}
      <section className="relative bg-[#112a1d] text-white p-8 sm:p-12 rounded-3xl overflow-hidden flex flex-col md:flex-row justify-between items-center gap-8 shadow-sm">
        {/* Glow Spheres */}
        <div className="absolute top-1/2 left-0 w-72 h-72 bg-amber-405 opacity-10 rounded-full blur-3xl transform -translate-y-1/2"></div>
        <div className="absolute top-0 right-1/4 w-48 h-48 bg-emerald-500 opacity-10 rounded-full blur-2xl"></div>

        <div className="relative z-10 max-w-lg space-y-3 shrink-0">
          <span className="text-[10px] uppercase font-black text-amber-400 tracking-widest block">SUBSCRIBE FOR DEALS</span>
          <h2 className="text-xl sm:text-2xl font-black text-white tracking-tight leading-snug">
            Get 20% Off Your 1st Technical Audit
          </h2>
          <p className="text-xs text-slate-300 leading-relaxed font-sans max-w-sm">
            Receive updates on certified hardware additions, KRA solar taxes updates, and net-metering regulatory changes.
          </p>
        </div>

        <form 
          onSubmit={e => {
            e.preventDefault();
            alert('Congratulations! Registered in KEREA secure mailing registry.');
          }}
          className="relative z-10 w-full max-w-md flex flex-col sm:flex-row gap-2 bg-white/5 p-2 rounded-2xl border border-white/10"
        >
          <div className="relative flex-1">
            <Mail className="absolute left-3 top-3.5 w-4 h-4 text-slate-400" />
            <input 
              type="text" 
              placeholder="Enter corporate email address..." 
              required
              className="w-full text-xs text-white bg-transparent pl-10 pr-4 py-3 placeholder-slate-400 focus:outline-none font-sans"
            />
          </div>
          <button 
            type="submit" 
            className="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-[#112a1d] font-black text-xs uppercase tracking-wider rounded-xl transition duration-150 cursor-pointer shrink-0"
          >
            Subscribe Now
          </button>
        </form>
      </section>

    </div>
  );
}
