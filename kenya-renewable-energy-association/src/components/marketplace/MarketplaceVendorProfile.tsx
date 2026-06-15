import React, { useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ArrowLeft, 
  MapPin, 
  Star, 
  ShieldCheck, 
  Mail, 
  Phone, 
  CheckCircle, 
  Clock, 
  Tag, 
  Eye, 
  Award,
  Globe
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

export default function MarketplaceVendorProfile() {
  const { 
    allUsers, 
    selectedVendorId, 
    navigateTo, 
    products,
    setSelectedProductId 
  } = useAppState();

  // Retrieve vendor user
  const vendor = useMemo(() => {
    return allUsers.find(u => u.id === selectedVendorId && u.role === 'vendor') || 
           allUsers.find(u => u.role === 'vendor')!;
  }, [allUsers, selectedVendorId]);

  // Filters product owned by this vendor
  const vendorProducts = useMemo(() => {
    return products.filter(p => p.vendorId === vendor.id);
  }, [products, vendor]);

  const companyTitle = vendor.companyName || vendor.name;
  const isSafiSolar = vendor.id === 'usr-2';

  return (
    <div className="space-y-12 font-sans pb-16">
      
      {/* Top Back Nav Link */}
      <div>
        <button 
          onClick={() => navigateTo('marketplace-vendors')}
          className="text-xs font-bold text-slate-500 hover:text-emerald-700 flex items-center gap-1.5 cursor-pointer"
        >
          <ArrowLeft className="w-4 h-4 text-[#112a1d]" /> Back to Vendor Directory
        </button>
      </div>

      {/* Corporate Profile Header Card */}
      <section className="bg-white border border-slate-150 p-6 sm:p-8 rounded-3xl shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
        
        <div className="flex flex-col sm:flex-row gap-5 items-start">
          <div className="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 shadow-sm flex items-center justify-center text-3xl font-black shrink-0">
            {isSafiSolar ? '☀️' : '🍃'}
          </div>

          <div className="space-y-2">
            <div className="flex gap-2 items-center">
              <span className="text-[9px] uppercase font-black px-2.5 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-emerald-800 tracking-wider">
                Certified KEREA Member
              </span>
              <span className="text-xs text-gray-400 font-mono">ID: {vendor.id}</span>
            </div>
            
            <h1 className="text-xl sm:text-2xl font-black text-[#112a1d] tracking-tight">{companyTitle}</h1>
            
            <div className="flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-slate-505 font-mono">
              <span className="flex items-center gap-1"><MapPin className="w-3.5 h-3.5 text-slate-400" /> {vendor.location || 'Nairobi Area'}, Kenya</span>
              <span className="text-slate-300">|</span>
              <span className="flex items-center gap-1"><Clock className="w-3.5 h-3.5 text-slate-400" /> Registered since {vendor.joinedDate || '2025-01-20'}</span>
            </div>
          </div>
        </div>

        {/* Highlighted stats */}
        <div className="flex gap-6 sm:gap-8 bg-slate-50 p-4 border border-slate-150 rounded-2xl shrink-0 w-full md:w-auto font-mono">
          <div className="space-y-0.5">
            <span className="text-[9px] uppercase text-gray-400 font-bold block">Star Audits</span>
            <span className="text-base font-black text-[#112a1d] flex items-center gap-1">
              4.8 <Star className="w-4 h-4 fill-amber-400 text-amber-400" />
            </span>
          </div>
          <div className="w-px bg-slate-200"></div>
          <div className="space-y-0.5">
            <span className="text-[9px] uppercase text-gray-400 font-bold block">Live Catalog</span>
            <span className="text-base font-black text-[#112a1d]">{vendorProducts.length} Devices</span>
          </div>
          <div className="w-px bg-slate-200"></div>
          <div className="space-y-0.5">
            <span className="text-[9px] uppercase text-gray-400 font-bold block">Cleared Escrows</span>
            <span className="text-base font-black text-emerald-700">100% OK</span>
          </div>
        </div>
      </section>

      {/* Main Row: About portfolio vs Certified licensing */}
      <section className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {/* Left main Column: Corporate details & Certifications */}
        <div className="lg:col-span-8 space-y-8">
          
          {/* About description */}
          <div className="bg-white border border-slate-150 p-6 sm:p-8 rounded-3xl shadow-sm space-y-4">
            <h2 className="text-sm font-black text-[#112a1d] uppercase tracking-wider">Corporate Statement & Focus Areas</h2>
            
            <p className="text-xs text-slate-600 leading-relaxed font-sans">
              {isSafiSolar 
                ? 'Safi Solar Solutions Ltd is a leading engineering enterprise specialized in engineering, designing, and distributing sub-systems for grid-connected high efficiency solar solutions. With an authorized class licensing from the EPRA, we design customized hybrid inverter setups and scalable lithium battery integrations for residential housing, agriculture cooperatives, and industrial warehouses.'
                : 'EcoPower Bioenergy Systems specializes in ecological agricultural recycling loops. We build high performance domestic dome biodigesters, and construct heavy carbonized block briquettes from zero-emission biomass coffee husks and coconut shells. Over the last three years in service, we have converted dozens of kitchens to high efficiency cookstoves.'}
            </p>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 text-xs leading-normal font-sans text-slate-650">
              <div className="space-y-2">
                <span className="font-extrabold text-[#112a1d] block uppercase tracking-wider text-[10px]">Primary Product Lines</span>
                <ul className="list-disc pl-4 space-y-1">
                  {isSafiSolar 
                    ? ['Monocrystalline PERC Panels', 'STS Prepaid electric meters', 'Digital Pressure Cookers (EPCs)', 'Commercial Induction plates'] 
                    : ['Carbonized bio briquettes', 'Prefabricated PVC biogas digesters', 'SuperSaver rocket stoves', 'Briquette thermal conversion boilers']}
                </ul>
              </div>

              <div className="space-y-2">
                <span className="font-extrabold text-[#112a1d] block uppercase tracking-wider text-[10px]">Vetted Facilities</span>
                <ul className="list-disc pl-4 space-y-1">
                  {isSafiSolar 
                    ? ['Technical diagnostic lab in Westlands, Nairobi', 'Assembly depot in Industrial Area, Mombasa'] 
                    : ['Biofuel carbonization center in Kisumu', 'Composite materials factory in Kakamega']}
                </ul>
              </div>
            </div>
          </div>

          {/* Licensing Credentials display */}
          <div className="bg-white border border-slate-150 p-6 sm:p-8 rounded-3xl shadow-sm space-y-4">
            <h3 className="text-sm font-black text-[#112a1d] uppercase tracking-wider">Vetted Accreditation Stands</h3>
            
            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div className="p-4 border border-slate-50 bg-slate-50/30 rounded-2xl flex items-start gap-3">
                <Award className="w-5 h-5 text-emerald-800 shrink-0" />
                <div>
                  <span className="font-extrabold text-xs text-[#112a1d] block">EPRA Licensing Stand</span>
                  <p className="text-[11px] text-slate-500 font-sans leading-normal mt-0.5">
                    {isSafiSolar 
                      ? 'Certified Class T1, T2, T3 installer under EPRA statutory mandates. Permitted to design medium Commercial & Industrial arrays.' 
                      : 'NEMA accredited composite factory compliant. Cleared for biosafety emissions and solid fuel distribution codes.'}
                  </p>
                </div>
              </div>

              <div className="p-4 border border-slate-50 bg-slate-50/30 rounded-2xl flex items-start gap-3">
                <Award className="w-5 h-5 text-emerald-800 shrink-0" />
                <div>
                  <span className="font-extrabold text-xs text-[#112a1d] block">KEBS Standard Badging</span>
                  <p className="text-[11px] text-slate-500 font-sans leading-normal mt-0.5">
                    All listed products bear authentic KEBS diamond standardization stamps. Tested for electrical and mechanical tolerances.
                  </p>
                </div>
              </div>
            </div>
          </div>

        </div>

        {/* Right Column: Contact Coordinate card */}
        <aside className="lg:col-span-4 bg-[#112a1d] text-white p-6 sm:p-8 rounded-3xl space-y-6">
          <h3 className="text-xs font-black uppercase tracking-widest text-[#caa250] flex items-center gap-1.5">
            <Globe className="w-4 h-4 text-[#caa250]" /> Direct Contact Hub
          </h3>

          <p className="text-xs text-slate-300 leading-relaxed font-sans">
            Transmit custom bulk queries or installation consult plans directly to the verified company queue.
          </p>

          <div className="space-y-4 text-xs font-medium border-t border-white/5 pt-4">
            <div className="flex items-center gap-2.5">
              <Phone className="w-4.5 h-4.5 text-amber-500 shrink-0" />
              <span className="font-mono">{vendor.phone || '+254 711 002233'}</span>
            </div>
            
            <div className="flex items-center gap-2.5">
              <Mail className="w-4.5 h-4.5 text-amber-500 shrink-0" />
              <span>{vendor.email}</span>
            </div>

            <div className="flex items-center gap-2.5">
              <MapPin className="w-4.5 h-4.5 text-amber-500 shrink-0" />
              <span>{vendor.location || 'Nairobi area office'}, Kenya</span>
            </div>
          </div>

          <div className="p-3 bg-white/5 rounded-xl border border-white/10 text-[10px] text-slate-400 leading-normal font-sans">
            ⚠️ Standard escrow billing applies inside this supplier store. Never pay suppliers directly outside the platform to retain protection.
          </div>
        </aside>

      </section>

      {/* Supplier Products List Section */}
      <section className="space-y-6">
        <div className="space-y-1">
          <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block">STORE CATALOG</span>
          <h2 className="text-xl font-extrabold text-[#112a1d] tracking-tight">Active Hardware Listings ({vendorProducts.length})</h2>
        </div>

        {vendorProducts.length > 0 ? (
          <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
            {vendorProducts.map((prod) => {
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
                      <span className="absolute top-3 left-3 bg-red-650 bg-red-600 text-white text-[9px] font-black px-2 py-0.5 rounded-md">
                        -{discountPercent}% OFF
                      </span>
                    )}

                    {prod.certifiedByEPRA && (
                      <span className="absolute bottom-3 left-3 bg-emerald-700 text-white text-[8px] font-bold px-1.5 py-0.5 rounded tracking-wide">
                        Vetted Certified
                      </span>
                    )}
                  </div>

                  <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                    <div>
                      <span className="text-[8px] font-black uppercase text-gray-400 block">{prod.category}</span>
                      <h3 className="font-bold text-xs text-[#112a1d] line-clamp-1 mt-1 group-hover:text-emerald-700 transition">
                        {prod.title}
                      </h3>
                      
                      <div className="flex items-center gap-1 mt-1">
                        <div className="flex text-amber-400">
                          {Array.from({ length: 5 }).map((_, i) => (
                            <Star key={i} className={`w-3 h-3 ${i < Math.floor(prod.rating) ? 'fill-amber-400 text-amber-400' : 'text-slate-205'}`} />
                          ))}
                        </div>
                        <span className="text-[9px] text-gray-400">({prod.reviewsCount})</span>
                      </div>
                    </div>

                    <div className="pt-2 border-t border-slate-50 flex items-center justify-between">
                      <span className="text-xs font-black text-emerald-805">KES {prod.priceKES.toLocaleString()}</span>
                      <button 
                        onClick={() => {
                          setSelectedProductId(prod.id);
                          navigateTo('marketplace-product-details');
                        }}
                        className="p-1.5 px-3 bg-slate-900 border border-slate-100 rounded-lg text-white text-[9px] font-bold flex items-center gap-1 cursor-pointer"
                      >
                        <Eye className="w-3.5 h-3.5" /> Details
                      </button>
                    </div>
                  </div>
                </div>
              );
            })}
          </div>
        ) : (
          <div className="p-12 text-center text-slate-450 italic border border-dashed rounded-xl bg-white max-w-sm mx-auto">
            This vendor store does not hold any live certified products listed in our database today.
          </div>
        )}
      </section>

    </div>
  );
}
