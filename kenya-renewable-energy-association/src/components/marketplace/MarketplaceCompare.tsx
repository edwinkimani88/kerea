import React, { useState, useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ArrowLeft, 
  Trash2, 
  Plus, 
  ShoppingCart, 
  ShieldCheck, 
  Cpu, 
  Sparkles, 
  Percent,
  Check,
  ChevronRight,
  Star
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

export default function MarketplaceCompare() {
  const { 
    products, 
    compareProductIds, 
    navigateTo, 
    placeNewOrder,
    currentUser,
    setSelectedProductId 
  } = useAppState();

  const [selectCandidateId1, setSelectCandidateId1] = useState(products[0]?.id || '');
  const [selectCandidateId2, setSelectCandidateId2] = useState(products[1]?.id || '');
  const [selectCandidateId3, setSelectCandidateId3] = useState(products[2]?.id || '');

  // Retrieve comparable products
  const selectedProducts = useMemo(() => {
    const list: MarketplaceProduct[] = [];
    const ids = [selectCandidateId1, selectCandidateId2, selectCandidateId3].filter(Boolean);
    
    ids.forEach(id => {
      const found = products.find(p => p.id === id);
      if (found && !list.some(p => p.id === id)) {
        list.push(found);
      }
    });

    return list;
  }, [products, selectCandidateId1, selectCandidateId2, selectCandidateId3]);

  const handleEscrowBuy = (productId: string, title: string, price: number) => {
    if (!currentUser) {
      alert('Authentication required: Sign In to complete secure Escrow transactions.');
      navigateTo('auth');
      return;
    }
    
    if (window.confirm(`Are you sure you want to purchase a unit of:\n"${title}"?\nKES ${price.toLocaleString()} will be locked until delivery approval.`)) {
      placeNewOrder(productId);
      alert('Transaction logged successfully! Funding locks active.');
      navigateTo('dashboard-customer');
    }
  };

  const allSpecifications = useMemo(() => {
    const specKeysSet = new Set<string>();
    selectedProducts.forEach(p => {
      if (p.specifications) {
        Object.keys(p.specifications).forEach(k => specKeysSet.add(k));
      }
    });
    return Array.from(specKeysSet);
  }, [selectedProducts]);

  return (
    <div className="space-y-8 font-sans pb-16">
      
      {/* Page Header */}
      <section className="bg-slate-900 text-white rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 relative overflow-hidden">
        <div className="absolute inset-0 bg-radial from-amber-500/5 to-transparent pointer-events-none"></div>
        <div className="space-y-2">
          <button 
            onClick={() => navigateTo('marketplace')}
            className="text-[10px] uppercase font-black tracking-widest text-[#caa250] hover:underline flex items-center gap-1.5 cursor-pointer"
          >
            <ArrowLeft className="w-3.5 h-3.5" /> Back to Marketplace Home
          </button>
          <h1 className="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-normal">Renewable Hardware Comparator</h1>
          <p className="text-xs text-slate-350 leading-relaxed max-w-lg">
            Juxtapose specifications, regulatory certification standings, system weights, prices, and warranties across vetted candidate devices.
          </p>
        </div>
        <div className="inline-flex gap-1.5 px-3 py-1 bg-amber-500/20 border border-amber-400/30 rounded-full text-amber-400 text-xs font-bold uppercase tracking-wider items-center">
          <Sparkles className="w-3.5 h-3.5" /> Spec Matrix Sync Live
        </div>
      </section>

      {/* Interactive Selection Bar */}
      <section className="bg-white p-5 border border-slate-150 rounded-2xl shadow-sm space-y-4">
        <h3 className="text-xs font-black uppercase text-[#112a1d] tracking-widest">Select Comparative Targets</h3>
        
        <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div className="space-y-1">
            <label className="block text-[9px] font-bold text-gray-400 uppercase tracking-wider">Device Slot 1</label>
            <select
              value={selectCandidateId1}
              onChange={e => setSelectCandidateId1(e.target.value)}
              className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-slate-50 focus:outline-none focus:ring-1 focus:ring-emerald-700"
            >
              {products.map(p => (
                <option key={p.id} value={p.id}>{p.title}</option>
              ))}
            </select>
          </div>

          <div className="space-y-1">
            <label className="block text-[9px] font-bold text-gray-400 uppercase tracking-wider">Device Slot 2</label>
            <select
              value={selectCandidateId2}
              onChange={e => setSelectCandidateId2(e.target.value)}
              className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-slate-50 focus:outline-none focus:ring-1 focus:ring-emerald-700"
            >
              <option value="">-- Choose Target --</option>
              {products.map(p => (
                <option key={p.id} value={p.id}>{p.title}</option>
              ))}
            </select>
          </div>

          <div className="space-y-1">
            <label className="block text-[9px] font-bold text-gray-400 uppercase tracking-wider">Device Slot 3</label>
            <select
              value={selectCandidateId3}
              onChange={e => setSelectCandidateId3(e.target.value)}
              className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-slate-50 focus:outline-none focus:ring-1 focus:ring-emerald-700"
            >
              <option value="">-- Choose Target --</option>
              {products.map(p => (
                <option key={p.id} value={p.id}>{p.title}</option>
              ))}
            </select>
          </div>
        </div>
      </section>

      {/* Comparison Grid Table Display */}
      {selectedProducts.length > 0 ? (
        <section className="bg-white border border-slate-150 rounded-3xl overflow-hidden shadow-sm">
          <div className="overflow-x-auto">
            <table className="w-full text-xs text-left min-w-[700px] border-collapse divide-y divide-slate-150">
              
              {/* Product Card Headers */}
              <thead className="bg-slate-50/50">
                <tr>
                  <th className="p-4 sm:p-5 w-1/4 font-black uppercase text-[#112a1d] tracking-wider bg-slate-100/20">
                    Product Parameters
                  </th>
                  {selectedProducts.map(p => (
                    <th key={p.id} className="p-4 sm:p-5 w-1/4 border-l border-slate-150">
                      <div className="space-y-3">
                        <div className="aspect-video bg-slate-50 border border-slate-100 rounded-xl overflow-hidden">
                          <img src={p.imageUrl} alt={p.title} className="w-full h-full object-cover" referrerPolicy="no-referrer" />
                        </div>
                        <div className="space-y-1">
                          <span className="text-[8px] font-black uppercase text-[#caa250]">{p.category}</span>
                          <h4 
                            onClick={() => {
                              setSelectedProductId(p.id);
                              navigateTo('marketplace-product-details');
                            }}
                            className="font-bold text-xs text-[#112a1d] hover:text-emerald-700 cursor-pointer hover:underline line-clamp-1"
                          >
                            {p.title}
                          </h4>
                          <span className="text-[9px] text-[#caa250] font-mono block">By {p.vendorName}</span>
                        </div>
                      </div>
                    </th>
                  ))}
                </tr>
              </thead>

              {/* Specifications Matrix */}
              <tbody className="divide-y divide-slate-150 text-slate-600 font-sans">
                
                {/* 1. Pricing Row */}
                <tr className="hover:bg-slate-50/50 font-bold">
                  <td className="p-4 bg-slate-50/10 font-bold text-[#112a1d] uppercase text-[9px] tracking-wider">
                    Purchasing Pricing
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150">
                      <span className="text-sm font-black text-emerald-805">KES {p.priceKES.toLocaleString()}</span>
                      {p.originalPriceKES && (
                        <span className="text-[10px] text-slate-400 line-through block mt-0.5">
                          KES {p.originalPriceKES.toLocaleString()}
                        </span>
                      )}
                    </td>
                  ))}
                </tr>

                {/* 2. EPRA Status */}
                <tr className="hover:bg-slate-50/50">
                  <td className="p-4 bg-slate-50/10 font-bold text-[#112a1d] uppercase text-[9px] tracking-wider">
                    Compliance Standing
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150">
                      {p.certifiedByEPRA ? (
                        <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-emerald-800 text-[9px] font-bold uppercase">
                          <ShieldCheck className="w-3.5 h-3.5" /> VERIFIED EPRA OK
                        </span>
                      ) : (
                        <span className="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded bg-amber-50 border border-amber-100 text-amber-805 text-[9px] font-bold uppercase">
                          PENDING ASSESS
                        </span>
                      )}
                    </td>
                  ))}
                </tr>

                {/* 3. Global Rating */}
                <tr className="hover:bg-slate-50/50">
                  <td className="p-4 bg-slate-50/10 font-bold text-[#112a1d] uppercase text-[9px] tracking-wider">
                    Client Star Score
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150">
                      <div className="flex items-center gap-1">
                        <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-450 text-amber-400" />
                        <span className="font-extrabold text-[#112a1d]">{p.rating} Stars</span>
                        <span className="text-gray-400">({p.reviewsCount})</span>
                      </div>
                    </td>
                  ))}
                </tr>

                {/* 4. Dynamic Specifications Keys */}
                {allSpecifications.map(specKey => (
                  <tr key={specKey} className="hover:bg-slate-50/50">
                    <td className="p-4 bg-slate-50/10 font-extrabold text-slate-800">
                      {specKey}
                    </td>
                    {selectedProducts.map(p => (
                      <td key={p.id} className="p-4 border-l border-slate-150 font-mono">
                        {p.specifications && p.specifications[specKey] ? p.specifications[specKey] : '--'}
                      </td>
                    ))}
                  </tr>
                ))}

                {/* 5. Warranty */}
                <tr className="hover:bg-slate-50/50">
                  <td className="p-4 bg-slate-50/10 font-bold text-[#112a1d] uppercase text-[9px] tracking-wider">
                    Warranty Duration
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150 font-sans leading-normal text-slate-650">
                      {p.warranty || '1 Year Standard Base Warranty'}
                    </td>
                  ))}
                </tr>

                {/* 6. Stock Level */}
                <tr className="hover:bg-slate-50/50">
                  <td className="p-4 bg-slate-50/10 font-bold text-[#112a1d] uppercase text-[9px] tracking-wider">
                    Instant Stock Level
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150 font-mono">
                      <span className={p.stockAvailable < 5 ? 'text-red-700 font-bold' : 'text-slate-600'}>
                        {p.stockAvailable} units available
                      </span>
                    </td>
                  ))}
                </tr>

                {/* 7. CTA Operations */}
                <tr className="bg-slate-50/30">
                  <td className="p-4 bg-slate-50/10 font-black text-slate-400">
                    ESCROW BUY MATE
                  </td>
                  {selectedProducts.map(p => (
                    <td key={p.id} className="p-4 border-l border-slate-150">
                      <button
                        onClick={() => handleEscrowBuy(p.id, p.title, p.priceKES)}
                        className="w-full py-2.5 bg-[#112a1d] hover:bg-slate-900 text-white text-[10px] uppercase tracking-wider font-black rounded-lg transition text-center cursor-pointer flex items-center justify-center gap-1"
                      >
                        <ShoppingCart className="w-3.5 h-3.5" /> Buy Escrow
                      </button>
                    </td>
                  ))}
                </tr>

              </tbody>
            </table>
          </div>
        </section>
      ) : (
        <div className="p-5 bg-white border rounded-2xl text-center italic text-gray-400">
          Selected comparable candidates empty. Please designate candidates in sliders above.
        </div>
      )}

    </div>
  );
}
