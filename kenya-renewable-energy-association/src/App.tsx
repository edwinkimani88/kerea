import React from 'react';
import Header from './components/Header';
import Footer from './components/Footer';
import { AppStateProvider, useAppState } from './context/AppStateContext';

// Import All 15 Top-Level Modular Public Screen Views
import HomeView from './components/public/HomeView';
import AboutView from './components/public/AboutView';
import LeadershipView from './components/public/LeadershipView';
import PolicyAdvocacyView from './components/public/PolicyAdvocacyView';
import StandardsView from './components/public/StandardsView';
import FinanceView from './components/public/FinanceView';
import MarketDevelopmentView from './components/public/MarketDevelopmentView';
import PartnershipsView from './components/public/PartnershipsView';
import EventsView from './components/public/EventsView';
import BlogView from './components/public/BlogView';
import PublicationsView from './components/public/PublicationsView';
import KnowledgeHubView from './components/public/KnowledgeHubView';
import DirectoryView from './components/public/DirectoryView';
import ContactView from './components/public/ContactView';
import MarketplaceView from './components/public/MarketplaceView';

// Import Secure Authentication and Dashboards views
import AuthView from './components/auth/AuthView';
import AdminDashboardView from './components/dashboard/AdminDashboardView';
import VendorDashboardView from './components/dashboard/VendorDashboardView';
import CustomerDashboardView from './components/dashboard/CustomerDashboardView';

import { ArrowRight, Home as HomeIcon } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

function AppContent() {
  const { currentView, breadcrumbs, navigateTo } = useAppState();

  const renderActiveView = () => {
    switch (currentView) {
      case 'home':
        return <HomeView />;
      case 'about':
        return <AboutView />;
      case 'leadership':
        return <LeadershipView />;
      case 'policy-advocacy':
        return <PolicyAdvocacyView />;
      case 'standards':
        return <StandardsView />;
      case 'access-to-finance':
        return <FinanceView />;
      case 'market-dev':
        return <MarketDevelopmentView />;
      case 'partnerships':
        return <PartnershipsView />;
      case 'events':
        return <EventsView />;
      case 'blog':
        return <BlogView />;
      case 'publications':
        return <PublicationsView />;
      case 'knowledge-hub':
        return <KnowledgeHubView />;
      case 'member-directory':
        return <DirectoryView />;
      case 'contact':
        return <ContactView />;
      case 'marketplace':
      case 'marketplace-category-solar':
      case 'marketplace-category-cooking':
      case 'marketplace-category-biogas':
      case 'marketplace-category-biomass':
      case 'marketplace-category-cookstoves':
      case 'marketplace-category-storage':
      case 'marketplace-category-minigrid':
      case 'marketplace-product-details':
      case 'marketplace-compare':
      case 'marketplace-vendors':
      case 'marketplace-vendor-profile':
      case 'marketplace-search-results':
        return <MarketplaceView />;
      case 'auth':
        return <AuthView />;
      case 'dashboard-admin':
        return <AdminDashboardView />;
      case 'dashboard-vendor':
        return <VendorDashboardView />;
      case 'dashboard-customer':
        return <CustomerDashboardView />;
      default:
        return <HomeView />;
    }
  };

  return (
    <div className="min-h-screen bg-slate-50 text-[#112a1d] flex flex-col selection:bg-emerald-600 selection:text-white antialiased">
      {/* 1. Header & Slogan Topbar */}
      <Header />

      {/* 2. Structured Breadcrumb Path Indicators (Not displayed on landing screen) */}
      {currentView !== 'home' && (
        <div className="bg-slate-100 border-b border-slate-200/50 py-3 px-4 sm:px-6 lg:px-8 select-none">
          <div className="max-w-7xl mx-auto flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider text-slate-500">
            <button
              onClick={() => navigateTo('home')}
              className="hover:text-emerald-700 cursor-pointer flex items-center gap-1"
            >
              <HomeIcon className="w-3.5 h-3.5" />
              <span>KEREA Home</span>
            </button>
            
            {breadcrumbs.map((crumb, idx) => (
              <React.Fragment key={idx}>
                <ArrowRight className="w-3 h-3 text-slate-400" />
                <span className={idx === breadcrumbs.length - 1 ? "text-emerald-850 font-black" : ""}>
                  {typeof crumb === 'object' ? (crumb as any).label : crumb}
                </span>
              </React.Fragment>
            ))}
          </div>
        </div>
      )}

      {/* 3. Main Route Container with Exit-fade Animations */}
      <main className="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        <AnimatePresence mode="wait">
          <motion.div
            key={currentView}
            initial={{ opacity: 0, y: 4 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -4 }}
            transition={{ duration: 0.18, ease: 'easeOut' }}
          >
            {renderActiveView()}
          </motion.div>
        </AnimatePresence>
      </main>

      {/* 4. Slate-Styled Comprehensive Footer */}
      <Footer />
    </div>
  );
}

export default function App() {
  return (
    <AppStateProvider>
      <AppContent />
    </AppStateProvider>
  );
}
