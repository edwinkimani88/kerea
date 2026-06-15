import React, { useState, useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ArrowLeft, 
  Star, 
  ShieldCheck, 
  Clock, 
  MapPin, 
  Download, 
  Mail, 
  Phone, 
  Heart, 
  Share2, 
  Send,
  Check, 
  ShoppingCart, 
  HelpCircle,
  Truck,
  RotateCcw,
  Users
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

export default function MarketplaceProductDetails() {
  const { 
    products, 
    selectedProductId, 
    setSelectedProductId,
    savedProductIds, 
    toggleSaveProduct, 
    navigateTo,
    placeNewOrder,
    currentUser
  } = useAppState();

  const [activeTab, setActiveTab] = useState<'specs' | 'desc' | 'reviews'>('specs');
  const [inquiryName, setInquiryName] = useState(currentUser?.name || '');
  const [inquiryEmail, setInquiryEmail] = useState(currentUser?.email || '');
  const [inquiryMessage, setInquiryMessage] = useState('I am interested in acquiring some units of this. Please communicate with delivery schedules.');
  const [inquirySuccess, setInquirySuccess] = useState(false);
  const [activeImageIndex, setActiveImageIndex] = useState(0);

  // Retrieve matching product
  const product = useMemo(() => {
    return products.find(p => p.id === selectedProductId) || products[0];
  }, [products, selectedProductId]);

  // Set secondary pictures mock
  const productImages = useMemo(() => {
    return [
      product.imageUrl,
      'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80',
      'https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=600&q=80',
    ];
  }, [product]);

  // Calculate percentage down
  const saved = savedProductIds.includes(product.id);
  const discountPercent = product.originalPriceKES 
    ? Math.round(((product.originalPriceKES - product.priceKES) / product.originalPriceKES) * 100) 
    : null;

  // Filter similar items (same category)
  const relatedProducts = useMemo(() => {
    return products
      .filter(p => p.category === product.category && p.id !== product.id)
      .slice(0, 3);
  }, [products, product]);

  const handleInquirySubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setInquirySuccess(true);
    setTimeout(() => setInquirySuccess(false), 5000);
  };

  const handleEscrowOrder = () => {
    if (!currentUser) {
      alert('Authentication required: Please Sign In to complete secure Escrow Lock purchases.');
      navigateTo('auth');
      return;
    }
    
    const confirmBuy = window.confirm(
      `Secure Escrow Lock Guarantee:\n\n` +
      `Product: "${product.title}"\n` +
      `Price: KES ${product.priceKES.toLocaleString()}\n\n` +
      `Click OK to lock funds in the KEREA secure clearing account. Your funds are held until you confirm successful delivery.`
    );

    if (confirmBuy) {
      placeNewOrder(product.id);
      alert('Secure Escrow Lock Established! Check "Customer Account Dashboard" -> "Orders" to follow its delivery transit.');
      navigateTo('dashboard-customer');
    }
  };

  return (
    <div className="space-y-12 font-sans pb-16">
      
      {/* Top Breadcrumb link */}
      <div>
        <button 
          onClick={() => navigateTo('marketplace')}
          className="text-xs font-bold text-slate-500 hover:text-emerald-700 flex items-center gap-1.5 cursor-pointer"
        >
          <ArrowLeft className="w-4 h-4 text-[#112a1d]" /> Back to Marketplace Home
        </button>
      </div>

      {/* Main Core Layout: Gallery + Purchasing block */}
      <section className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {/* Left Column: Visual Gallery Grid */}
        <div className="lg:col-span-7 space-y-4">
          <div className="relative aspect-video bg-white border border-slate-150 rounded-3xl overflow-hidden shadow-sm">
            <img 
              src={productImages[activeImageIndex]} 
              alt={product.title} 
              className="w-full h-full object-cover"
              referrerPolicy="no-referrer"
            />
            {discountPercent && (
              <span className="absolute top-4 left-4 bg-red-605 bg-red-650 bg-red-600 text-white text-[10px] font-black uppercase px-2.5 py-1 rounded-lg">
                -{discountPercent}% SPECIAL SALE
              </span>
            )}
            {product.certifiedByEPRA && (
              <span className="absolute bottom-4 left-4 bg-emerald-800 text-white text-[9px] font-black uppercase px-2.5 py-1 rounded-lg flex items-center gap-1">
                <ShieldCheck className="w-4 h-4" /> EPRA STANDARD VERIFIED
              </span>
            )}
          </div>

          {/* Secondary Thumbnail slots */}
          <div className="flex gap-4">
            {productImages.map((img, idx) => (
              <button
                key={idx}
                onClick={() => setActiveImageIndex(idx)}
                className={`w-24 h-16 rounded-xl border-2 overflow-hidden bg-white cursor-pointer ${
                  activeImageIndex === idx ? 'border-amber-500 shadow-md' : 'border-slate-200'
                }`}
              >
                <img src={img} alt="alt thumbnail" className="w-full h-full object-cover" referrerPolicy="no-referrer" />
              </button>
            ))}
          </div>
        </div>

        {/* Right Column: Key Details & Escrow Options */}
        <div className="lg:col-span-5 space-y-6">
          <div className="space-y-3">
            <span className="inline-block text-[9px] font-black uppercase tracking-widest px-2.5 py-1 bg-amber-500/10 border border-amber-400/20 text-[#caa250] rounded-full">
              {product.category}
            </span>
            <h1 className="text-xl sm:text-2xl font-black text-[#112a1d] leading-snug tracking-tight">
              {product.title}
            </h1>

            {/* Rating summary */}
            <div className="flex items-center gap-2">
              <div className="flex text-amber-400">
                {Array.from({ length: 5 }).map((_, i) => (
                  <Star key={i} className={`w-3.5 h-3.5 ${i < Math.floor(product.rating) ? 'fill-amber-400 text-amber-400' : 'text-slate-205'}`} />
                ))}
              </div>
              <span className="text-xs font-black text-[#112a1d] font-mono">{product.rating}</span>
              <span className="text-slate-300">|</span>
              <span className="text-xs text-gray-500 font-sans">{product.reviewsCount} verified sector audits</span>
            </div>
          </div>

          <p className="text-xs text-slate-500 leading-relaxed font-sans mt-2">
            {product.description}
          </p>

          {/* Pricing blocks */}
          <div className="p-4 bg-slate-50 border border-slate-150 rounded-2xl flex justify-between items-baseline">
            <div className="space-y-1">
              <span className="text-[9px] uppercase font-bold text-slate-450 block">Clearing Price KES</span>
              <div className="flex items-baseline gap-2">
                <span className="text-2xl font-extrabold text-[#112a1d]">KES {product.priceKES.toLocaleString()}</span>
                {product.originalPriceKES && (
                  <span className="text-xs text-slate-400 line-through">KES {product.originalPriceKES.toLocaleString()}</span>
                )}
              </div>
            </div>
            <span className="bg-green-50 text-green-800 text-[10px] font-bold px-2 py-0.5 rounded font-mono">
              In Stock ({product.stockAvailable} units)
            </span>
          </div>

          {/* Checkout & Wishlist Actions */}
          <div className="space-y-3 pt-2">
            <button
              onClick={handleEscrowOrder}
              className="w-full py-4 bg-[#112a1d] hover:bg-slate-900 text-white font-black text-xs uppercase tracking-widest rounded-xl transition duration-150 cursor-pointer shadow flex items-center justify-center gap-2"
            >
              <ShoppingCart className="w-4.5 h-4.5" /> SECURE ESCROW LOCK PURCHASE
            </button>

            <div className="grid grid-cols-2 gap-3 text-center">
              <button
                onClick={() => toggleSaveProduct(product.id)}
                className="py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-[#112a1d] font-bold text-xs rounded-xl transition cursor-pointer flex items-center justify-center gap-2 shadow-sm"
              >
                <Heart className={`w-4 h-4 ${saved ? 'fill-red-600 text-red-600' : 'text-slate-500'}`} />
                {saved ? 'Saved in Wishlist' : 'Add to Wishlist'}
              </button>

              <button
                onClick={() => {
                  navigator.clipboard.writeText(window.location.href);
                  alert('Product specifications link successfully copied to your clipboard!');
                }}
                className="py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-[#112a1d] font-bold text-xs rounded-xl cursor-pointer flex items-center justify-center gap-2 shadow-sm animate-pulse"
              >
                <Share2 className="w-4 h-4 text-[#112a1d]" /> Copy Catalog Link
              </button>
            </div>
          </div>

          {/* Escrow Value Props Banner */}
          <div className="bg-amber-500/5 border border-amber-505/20 border-amber-500/25 p-4 rounded-2xl space-y-3">
            <h4 className="text-[10px] uppercase font-black text-amber-500 tracking-wider flex items-center gap-1.5">
              <Truck className="w-4.5 h-4.5" /> KEREA Escrow Lock Mandate
            </h4>
            <ul className="text-[10px] text-slate-500 space-y-1.5 font-sans leading-normal">
              <li className="flex items-start gap-1"><Check className="w-3.5 h-3.5 text-emerald-650 shrink-0 mt-0.5" /> Payment funds locked in centralized association ledger bank account.</li>
              <li className="flex items-start gap-1"><Check className="w-3.5 h-3.5 text-emerald-650 shrink-0 mt-0.5" /> Vendor is triggered for instant priority county shipment dispatcher.</li>
              <li className="flex items-start gap-1"><Check className="w-3.5 h-3.5 text-emerald-650 shrink-0 mt-0.5" /> You release funds ONLY after receiving and approving the physical cargo hardware.</li>
            </ul>
          </div>
        </div>
      </section>

      {/* Structured Specification Tabs */}
      <section className="bg-white border border-slate-150 rounded-3xl overflow-hidden shadow-sm">
        <div className="flex border-b border-slate-100 bg-slate-50/50 p-2">
          {[
            { id: 'specs', label: 'Technical Datasheet' },
            { id: 'desc', label: 'Additional Features' },
            { id: 'reviews', label: 'Vetted Client Audits' }
          ].map(tab => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id as any)}
              className={`px-6 py-3 cursor-pointer text-xs font-black rounded-xl transition ${
                activeTab === tab.id ? 'bg-white text-[#112a1d] shadow-sm' : 'text-slate-400'
              }`}
            >
              {tab.label}
            </button>
          ))}
        </div>

        <div className="p-6 sm:p-8">
          {activeTab === 'specs' && (
            <div className="space-y-6">
              <h3 className="text-sm font-black text-[#112a1d] uppercase tracking-wider">Device Technical Characteristics</h3>
              {product.specifications ? (
                <div className="border border-slate-100 rounded-xl overflow-hidden">
                  <table className="w-full text-xs text-left">
                    <thead className="bg-[#112a1d]/5 text-[#112a1d] font-bold">
                      <tr>
                        <th className="p-3 pl-4">Parameter Name</th>
                        <th className="p-3">Certified Value</th>
                      </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-50 text-slate-600">
                      {Object.entries(product.specifications).map(([key, value]) => (
                        <tr key={key} className="hover:bg-slate-50/50">
                          <td className="p-3 pl-4 font-bold text-slate-800">{key}</td>
                          <td className="p-3 font-mono">{value}</td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              ) : (
                <p className="text-xs text-slate-450 italic font-sans">No additional parameter metrics mapped inside the database for this device.</p>
              )}
            </div>
          )}

          {activeTab === 'desc' && (
            <div className="space-y-6">
              <h3 className="text-sm font-black text-[#112a1d] uppercase tracking-wider">Advantaged Utility Capabilities</h3>
              {product.features ? (
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  {product.features.map((feat, idx) => (
                    <div key={idx} className="p-4 border border-slate-50 bg-slate-50/20 rounded-xl flex items-start gap-2.5">
                      <div className="p-1 rounded-full bg-emerald-50 text-emerald-800 shrink-0">
                        <Check className="w-4 h-4" />
                      </div>
                      <p className="text-xs text-slate-600 leading-normal font-sans pt-0.5">{feat}</p>
                    </div>
                  ))}
                </div>
              ) : (
                <p className="text-xs text-slate-450 italic">Full feature checklists will be appended shortly by registered supplier.</p>
              )}

              {product.warranty && (
                <div className="p-4 border border-amber-200 bg-amber-500/5 rounded-xl text-xs flex gap-3 text-amber-900 font-medium">
                  <ShieldCheck className="w-5 h-5 text-amber-500 shrink-0" />
                  <div>
                    <span className="font-extrabold block uppercase tracking-wider text-[10px] text-amber-700">Official Warranty Cover</span>
                    <p className="font-sans text-slate-600 mt-0.5">{product.warranty}</p>
                  </div>
                </div>
              )}
            </div>
          )}

          {activeTab === 'reviews' && (
            <div className="space-y-6">
              <div className="flex justify-between items-center">
                <h3 className="text-sm font-black text-[#112a1d] uppercase tracking-wider">Regulatory Compliance Review Logs</h3>
                <span className="text-xs text-slate-400 font-mono">3 Logs Audited</span>
              </div>

              <div className="divide-y divide-slate-100">
                <div className="py-4 space-y-2 first:pt-0">
                  <div className="flex justify-between items-center">
                    <span className="font-extrabold text-xs text-[#112a1d]">Kenya Bureau of Standards (KEBS)</span>
                    <span className="text-[10px] font-mono text-emerald-700 font-black">STAMPED COMPLIANT</span>
                  </div>
                  <p className="text-xs text-slate-500 font-sans leading-normal">
                    Assessed according to KS EAS 829 criteria: Solar photovoltaic modules specification sheet checks matched manufacturer specifications flawlessly. Quality verified.
                  </p>
                </div>

                <div className="py-4 space-y-2">
                  <div className="flex justify-between items-center">
                    <span className="font-extrabold text-xs text-[#112a1d]">EPRA Technical Sub-Committee</span>
                    <span className="text-[10px] font-mono text-emerald-700 font-black">APPROVED CLASS A</span>
                  </div>
                  <p className="text-xs text-slate-500 font-sans leading-normal">
                    Assigned Class T1 and T2 installation safety ratios. Recommended for decentralized rural mini-grid installations and medium-scale industrial arrays.
                  </p>
                </div>
              </div>
            </div>
          )}
        </div>
      </section>

      {/* Supplier & Interactive Manual Downloads Block */}
      <section className="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        
        {/* Supplier Profile Mini-Card */}
        <div className="bg-white border border-slate-150 p-6 rounded-3xl shadow-sm flex flex-col justify-between space-y-6">
          <div className="space-y-4">
            <div className="flex justify-between items-start">
              <div>
                <span className="text-[9px] uppercase font-bold text-slate-450 tracking-wider">Registered Supplier</span>
                <h3 className="text-base font-extrabold text-[#112a1d]">{product.vendorName}</h3>
                <p className="text-xs text-gray-400 flex items-center gap-1 font-mono mt-0.5">
                  <MapPin className="w-3.5 h-3.5" /> Nairobi Head Office, Kenya
                </p>
              </div>
              <div className="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-2xl font-bold">
                🏢
              </div>
            </div>

            <p className="text-xs text-slate-500 leading-relaxed font-sans">
              Authorized renewable partner in renewable solar modules, lithium power configurations, and biomass technical stoves since 2024. Has cleared KEREA and EPRA security training guidelines.
            </p>

            <div className="flex flex-wrap gap-x-4 gap-y-1.5 text-xs text-slate-505 font-medium">
              <span className="flex items-center gap-1.5"><Phone className="w-3.5 h-3.5 text-slate-400" /> +254 711 002233</span>
              <span className="flex items-center gap-1.5"><Mail className="w-3.5 h-3.5 text-slate-400" /> clearances@kerea.org</span>
            </div>
          </div>

          <div className="pt-4 border-t border-slate-50 flex justify-between items-center">
            <div className="flex items-center gap-1">
              <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-405 text-amber-400" />
              <span className="text-xs font-bold text-[#112a1d]">4.8 Ratings</span>
            </div>
            <button 
              onClick={() => navigateTo('marketplace-vendors')}
              className="text-xs font-black text-[#112a1d] hover:text-emerald-700 select-none cursor-pointer flex items-center gap-0.5"
            >
              Supplier Directory Profiles <ArrowLeft className="w-3.5 h-3.5 rotate-180" />
            </button>
          </div>
        </div>

        {/* Dynamic Inquiry Box & Manual Downloads */}
        <div className="bg-slate-50 border border-slate-150 p-6 rounded-3xl space-y-5 flex flex-col justify-between">
          <div className="space-y-4">
            <h3 className="text-xs font-black uppercase text-[#112a1d] tracking-widest flex items-center gap-1.5">
              <Download className="w-4.5 h-4.5 text-emerald-800" /> Technical Resource Downloads
            </h3>
            
            {product.downloads ? (
              <div className="space-y-2 text-xs">
                {product.downloads.map((dl, idx) => (
                  <a
                    key={idx}
                    href={dl.url}
                    onClick={(e) => {
                      e.preventDefault();
                      alert(`Manual download simulated successfully for file: "${dl.label}"`);
                    }}
                    className="flex justify-between items-center p-3 border border-slate-150 bg-white hover:bg-slate-50 rounded-xl transition cursor-pointer"
                  >
                    <span className="font-bold text-[#112a1d] truncate">{dl.label}</span>
                    <span className="text-[9px] font-mono font-black text-emerald-700 flex items-center gap-1 uppercase shrink-0">
                      Download PDF <Download className="w-3.5 h-3.5 text-emerald-700" />
                    </span>
                  </a>
                ))}
              </div>
            ) : (
              <p className="text-xs text-slate-450 italic">User guides will be linked upon certification processing.</p>
            )}
          </div>

          {/* Supplier Inquiry Form */}
          <form onSubmit={handleInquirySubmit} className="space-y-3 pt-4 border-t border-slate-200/50">
            <h4 className="text-[10px] uppercase font-black text-[#112a1d] tracking-wider">Inquire About Bulk Bids</h4>
            
            {inquirySuccess ? (
              <div className="p-3 bg-emerald-50 text-emerald-805 text-xs font-medium rounded-xl border border-emerald-200">
                Inquiry transmitted to supplier secure queue! They will communicate in 2 business hours.
              </div>
            ) : (
              <div className="space-y-2">
                <input 
                  type="text" 
                  value={inquiryName}
                  onChange={e => setInquiryName(e.target.value)}
                  placeholder="Your Representative Name..."
                  required
                  className="w-full text-xs p-2.5 border border-slate-205 rounded-xl bg-white focus:outline-none"
                />
                
                <textarea 
                  value={inquiryMessage}
                  onChange={e => setInquiryMessage(e.target.value)}
                  placeholder="Ask about bulk price configurations, specialized shipping quotes..."
                  required
                  rows={2}
                  className="w-full text-xs p-2.5 border border-slate-205 rounded-xl bg-white focus:outline-none font-sans"
                />

                <button
                  type="submit"
                  className="w-full py-2 bg-slate-900 hover:bg-black text-white font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 cursor-pointer"
                >
                  <Send className="w-3.5 h-3.5" /> Forward Inquiry to Manufacturer
                </button>
              </div>
            )}
          </form>
        </div>

      </section>

      {/* Related Products Recommendation Panel */}
      {relatedProducts.length > 0 && (
        <section className="space-y-6">
          <div className="space-y-1">
            <span className="text-[10px] uppercase font-black text-amber-500 tracking-wider block">RECOMMENDATIONS</span>
            <h2 className="text-lg font-black text-[#112a1d] tracking-tight">Similar Renewable Hardware</h2>
          </div>

          <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
            {relatedProducts.map(prod => (
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
                  {prod.certifiedByEPRA && (
                    <span className="absolute bottom-3 left-3 bg-[#112a1d] text-white text-[8px] font-bold uppercase px-1.5 py-0.5 rounded tracking-wide">
                      Certified
                    </span>
                  )}
                </div>

                <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                  <div>
                    <span className="text-[8px] font-black uppercase text-gray-400 block">{prod.category}</span>
                    <h3 className="font-bold text-xs text-[#112a1d] line-clamp-1 group-hover:text-emerald-700 mt-1">
                      {prod.title}
                    </h3>
                  </div>

                  <div className="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span className="font-black text-emerald-800">KES {prod.priceKES.toLocaleString()}</span>
                    <button 
                      onClick={() => {
                        setSelectedProductId(prod.id);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                      }}
                      className="p-1.5 px-3 bg-slate-100 group-hover:bg-amber-505 group-hover:bg-amber-500 group-hover:text-slate-900 border border-slate-200/50 rounded-lg text-[9px] font-black flex items-center gap-1 cursor-pointer transition"
                    >
                      View Specs
                    </button>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </section>
      )}

    </div>
  );
}
