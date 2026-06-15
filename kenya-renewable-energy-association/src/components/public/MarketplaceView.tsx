import React from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ShoppingBag, 
  MapPin, 
  Sparkles, 
  Scale, 
  Compass, 
  Award, 
  Grid, 
  ChevronRight, 
  BookOpen, 
  ChevronLeft
} from 'lucide-react';
import { AppView } from '../../types';

// Import our modular marketplace pages
import MarketplaceHome from '../marketplace/MarketplaceHome';
import MarketplaceCategory from '../marketplace/MarketplaceCategory';
import MarketplaceProductDetails from '../marketplace/MarketplaceProductDetails';
import MarketplaceCompare from '../marketplace/MarketplaceCompare';
import MarketplaceVendors from '../marketplace/MarketplaceVendors';
import MarketplaceVendorProfile from '../marketplace/MarketplaceVendorProfile';
import MarketplaceSearchResults from '../marketplace/MarketplaceSearchResults';

export default function MarketplaceView() {
  const { currentView, navigateTo } = useAppState();

  // Helper function to see if a link is active based on currentView name
  const isActive = (view: AppView) => {
    if (view === 'marketplace') {
      return currentView === 'marketplace';
    }
    return currentView.startsWith(view);
  };

  // Render the appropriate sub-page based on currentView
  const renderActiveMarketPage = () => {
    switch (currentView) {
      case 'marketplace-category-solar':
        return <MarketplaceCategory categoryName="Solar Technologies" />;
      case 'marketplace-category-cooking':
        return <MarketplaceCategory categoryName="Electric Cooking" />;
      case 'marketplace-category-biogas':
        return <MarketplaceCategory categoryName="Biogas Systems" />;
      case 'marketplace-category-biomass':
        return <MarketplaceCategory categoryName="Biomass Technologies" />;
      case 'marketplace-category-cookstoves':
        return <MarketplaceCategory categoryName="Improved Cookstoves" />;
      case 'marketplace-category-storage':
        return <MarketplaceCategory categoryName="Energy Storage" />;
      case 'marketplace-category-minigrid':
        return <MarketplaceCategory categoryName="Mini-grid Technologies" />;
      case 'marketplace-product-details':
        return <MarketplaceProductDetails />;
      case 'marketplace-compare':
        return <MarketplaceCompare />;
      case 'marketplace-vendors':
        return <MarketplaceVendors />;
      case 'marketplace-vendor-profile':
        return <MarketplaceVendorProfile />;
      case 'marketplace-search-results':
        return <MarketplaceSearchResults />;
      case 'marketplace':
      default:
        return <MarketplaceHome />;
    }
  };

  return (
    <div className="space-y-8 font-sans">
      
      {/* 1. SECTOR BRAND HEADER (Anti-slop, clean human branding) */}
      <section className="border-b border-slate-100 pb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div className="space-y-1">
          <div className="flex items-center gap-2">
            <span className="w-2.5 h-2.5 rounded-full bg-emerald-700 animate-pulse"></span>
            <span className="text-[10px] font-mono uppercase tracking-widest text-slate-400">KEREA Unified Procurement Network</span>
          </div>
          <h1 className="text-xl font-extrabold text-[#112a1d] tracking-tight">Solar & Biomass Clearing House</h1>
        </div>

        {/* 2. PERSISTENT SUB-NAVIGATION LINKS BAR */}
        <nav className="flex flex-wrap gap-1.5 p-1 bg-slate-100 rounded-xl border border-slate-200">
          <button
            onClick={() => navigateTo('marketplace')}
            className={`px-4 py-2 cursor-pointer text-[10px] font-black uppercase tracking-wider rounded-lg transition-all ${
              isActive('marketplace') && !currentView.includes('compare') && !currentView.includes('vendor') && !currentView.includes('search')
                ? 'bg-[#112a1d] text-white shadow'
                : 'text-slate-500 hover:text-emerald-800 hover:bg-white/50'
            }`}
          >
            Marketplace Home
          </button>

          <button
            onClick={() => navigateTo('marketplace-compare')}
            className={`px-4 py-2 cursor-pointer text-[10px] font-black uppercase tracking-wider rounded-lg transition-all flex items-center gap-1.5 ${
              isActive('marketplace-compare')
                ? 'bg-[#112a1d] text-white shadow'
                : 'text-slate-500 hover:text-emerald-800 hover:bg-white/50'
            }`}
          >
            <Scale className="w-3.5 h-3.5 shrink-0" /> Spec Comparator
          </button>

          <button
            onClick={() => navigateTo('marketplace-vendors')}
            className={`px-4 py-2 cursor-pointer text-[10px] font-black uppercase tracking-wider rounded-lg transition-all flex items-center gap-1.5 ${
              isActive('marketplace-vendors') || isActive('marketplace-vendor-profile')
                ? 'bg-[#112a1d] text-white shadow'
                : 'text-slate-500 hover:text-emerald-800 hover:bg-white/50'
            }`}
          >
            <MapPin className="w-3.5 h-3.5 shrink-0" /> Suppliers Directory
          </button>
        </nav>
      </section>

      {/* 3. CORE ACTIVE PAGE RENDERING CONTENT AREA */}
      <div className="relative animate-fade-in">
        {renderActiveMarketPage()}
      </div>

    </div>
  );
}
