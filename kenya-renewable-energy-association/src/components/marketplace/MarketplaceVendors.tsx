import React, { useState, useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  Search, 
  MapPin, 
  Star, 
  ShieldCheck, 
  ArrowLeft, 
  ChevronRight, 
  Users, 
  Mail, 
  Phone,
  Bookmark
} from 'lucide-react';
import { AppView } from '../../types';

export default function MarketplaceVendors() {
  const { 
    allUsers, 
    navigateTo, 
    setSelectedVendorId,
    products 
  } = useAppState();

  const [searchQuery, setSearchQuery] = useState('');
  const [selectedCity, setSelectedCity] = useState('');

  // Extract all users with role 'vendor'
  const vendors = useMemo(() => {
    return allUsers.filter(u => u.role === 'vendor');
  }, [allUsers]);

  // Apply search query and location filters
  const filteredVendors = useMemo(() => {
    return vendors.filter(v => {
      const nameMatch = v.companyName?.toLowerCase().includes(searchQuery.toLowerCase()) || 
                        v.name.toLowerCase().includes(searchQuery.toLowerCase());
      
      const cityMatch = selectedCity ? v.location === selectedCity : true;
      
      return nameMatch && cityMatch;
    });
  }, [vendors, searchQuery, selectedCity]);

  // Extract unique cities from profile data
  const vendorCities = useMemo(() => {
    const list = new Set<string>();
    vendors.forEach(v => {
      if (v.location) list.add(v.location);
    });
    return Array.from(list);
  }, [vendors]);

  const handleVendorSelect = (id: string) => {
    setSelectedVendorId(id);
    navigateTo('marketplace-vendor-profile');
  };

  return (
    <div className="space-y-8 font-sans pb-16">
      
      {/* Page Header */}
      <section className="bg-slate-900 text-white rounded-3xl p-6 sm:p-10 relative overflow-hidden flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div className="absolute right-0 top-0 bottom-0 w-1/3 bg-radial from-[#caa250]/10 to-transparent pointer-events-none"></div>
        <div className="space-y-2">
          <button 
            onClick={() => navigateTo('marketplace')}
            className="text-[10px] uppercase font-black tracking-widest text-[#caa250] hover:underline flex items-center gap-1.5 cursor-pointer"
          >
            <ArrowLeft className="w-3.5 h-3.5" /> Back to Marketplace Home
          </button>
          <h1 className="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-normal">Registered Suppliers</h1>
          <p className="text-xs text-slate-350 leading-relaxed max-w-lg">
            Direct directories of EPRA-accredited technical solar companies and carbonized briquette manufacturers vetted by KEREA.
          </p>
        </div>
        <div className="bg-slate-800 px-4 py-2 border border-slate-700 rounded-2xl shrink-0 text-xs text-slate-300 font-mono">
          <span className="text-[#caa250] font-black">{filteredVendors.length}</span> Active Partners
        </div>
      </section>

      {/* Searching Controllers */}
      <section className="bg-white p-5 border border-slate-150 rounded-2xl shadow-sm flex flex-col sm:flex-row gap-4 items-center">
        
        {/* Search supplier text input */}
        <div className="relative flex-1 w-full">
          <Search className="absolute left-3.5 top-3.5 w-4.5 h-4.5 text-slate-400" />
          <input 
            type="text" 
            value={searchQuery}
            onChange={e => setSearchQuery(e.target.value)}
            placeholder="Search manufacturers, engineering firms, installers..." 
            className="w-full text-xs text-slate-900 bg-slate-50 border border-slate-150 pl-11 pr-4 py-3.5 rounded-xl focus:outline-none focus:ring-1 focus:ring-emerald-700 font-sans"
          />
        </div>

        {/* Location Select */}
        <div className="w-full sm:w-64 shrink-0">
          <select
            value={selectedCity}
            onChange={e => setSelectedCity(e.target.value)}
            className="w-full text-xs p-3.5 border border-slate-205 rounded-xl bg-white focus:outline-none font-sans"
          >
            <option value="">-- Check All Regions --</option>
            {vendorCities.map(city => (
              <option key={city} value={city}>{city}, Kenya</option>
            ))}
          </select>
        </div>

      </section>

      {/* Directory Grid */}
      {filteredVendors.length > 0 ? (
        <section className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {filteredVendors.map(vendor => {
            const hasJoined = vendor.joinedDate || '2024';
            const locationStr = vendor.location || 'Nairobi Office';
            const companyTitle = vendor.companyName || vendor.name;
            const liveProductsCount = products.filter(p => p.vendorId === vendor.id).length;

            return (
              <div 
                key={vendor.id}
                className="bg-white border border-slate-150 rounded-2xl p-6 shadow-sm hover:shadow-md hover:border-emerald-700/20 transition flex flex-col justify-between space-y-6"
              >
                
                {/* Header info */}
                <div className="flex gap-4 items-start">
                  <div className="w-14 h-14 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-2xl font-black shrink-0 shadow-sm">
                    {vendor.id === 'usr-2' ? '☀️' : '🍃'}
                  </div>

                  <div className="space-y-1.5 flex-1">
                    <div className="flex items-center gap-2">
                      <span className={`text-[8px] font-black uppercase tracking-wider px-2 py-0.5 rounded ${
                        vendor.status === 'active' ? 'bg-emerald-50 text-emerald-800 border border-emerald-100/50' : 'bg-red-50 text-red-800'
                      }`}>
                        {vendor.status === 'active' ? 'Verified Partner' : 'Awaiting Audit'}
                      </span>
                      <span className="text-[10px] text-slate-400 font-mono">Since {hasJoined}</span>
                    </div>

                    <h3 className="text-base font-black text-[#112a1d] leading-tight">
                      {companyTitle}
                    </h3>

                    <p className="text-[11px] text-gray-400 font-mono flex items-center gap-1">
                      <MapPin className="w-3.5 h-3.5 text-slate-400 shrink-0" /> {locationStr}, Kenya
                    </p>
                  </div>
                </div>

                {/* Sub-details */}
                <div className="space-y-3">
                  <p className="text-xs text-slate-500 leading-normal font-sans">
                    {vendor.id === 'usr-2' 
                      ? 'Specialized supplier of multi-plate solar home systems, hybrid charge controllers, and lithium backing packs. Holds Class T1/T2 EPRA certified installers licenses.' 
                      : 'Manufacturer of high-calorific briquettes, biomass gasifier technology, and dome PVC biogas digester assemblies. Serves cooperatives and institutions across Kenya.'}
                  </p>

                  <div className="flex flex-wrap gap-x-4 gap-y-1 text-xs text-slate-505 font-medium border-t border-slate-50 pt-3">
                    <span className="flex items-center gap-1.5"><Phone className="w-3.5 h-3.5 text-slate-400" /> {vendor.phone || '+254 700 000000'}</span>
                    <span className="flex items-center gap-1.5"><Mail className="w-3.5 h-3.5 text-slate-400" /> {vendor.email}</span>
                  </div>
                </div>

                {/* Footer links */}
                <div className="pt-4 border-t border-slate-50 flex items-center justify-between">
                  <div className="flex items-center gap-3">
                    <div className="flex items-center gap-1">
                      <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-450 text-amber-400" />
                      <span className="text-xs font-mono font-black text-[#112a1d]">4.8 Ratings</span>
                    </div>
                    <span className="text-slate-300">|</span>
                    <span className="text-[10px] font-mono text-emerald-800 font-black">{liveProductsCount} catalog items</span>
                  </div>

                  <button 
                    onClick={() => handleVendorSelect(vendor.id)}
                    className="px-4 py-2 bg-slate-900 hover:bg-[#112a1d] text-white text-[10px] uppercase font-black tracking-wider rounded-xl cursor-pointer flex items-center gap-0.5"
                  >
                    Enter Shop <ChevronRight className="w-3.5 h-3.5 text-amber-400" />
                  </button>
                </div>

              </div>
            );
          })}
        </section>
      ) : (
        <div className="text-center py-16 p-8 border border-dashed border-slate-205 rounded-xl bg-white space-y-3 shadow-sm max-w-md mx-auto">
          <Users className="w-12 h-12 text-slate-350 mx-auto" />
          <h3 className="font-extrabold text-[#112a1d] text-sm">No suppliers found</h3>
          <p className="text-xs text-slate-450 font-sans leading-relaxed">
            There are no registered clean energy suppliers who match your search requirements currently matching that region.
          </p>
        </div>
      )}

    </div>
  );
}
