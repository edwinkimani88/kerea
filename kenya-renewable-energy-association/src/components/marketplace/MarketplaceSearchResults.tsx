import React, { useState, useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  Search, 
  ArrowLeft, 
  Star, 
  Eye, 
  Compass, 
  Calendar,
  Grid,
  List,
  Heart
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

export default function MarketplaceSearchResults() {
  const { 
    products, 
    searchMarketQuery, 
    setSearchMarketQuery, 
    navigateTo, 
    setSelectedProductId,
    savedProductIds,
    toggleSaveProduct
  } = useAppState();

  const [localSearch, setLocalSearch] = useState(searchMarketQuery);
  const [isListView, setIsListView] = useState(false);

  // Apply matching
  const matchingProducts = useMemo(() => {
    if (!searchMarketQuery.trim()) return products;
    const q = searchMarketQuery.toLowerCase();
    return products.filter(p => 
      p.title.toLowerCase().includes(q) || 
      p.description.toLowerCase().includes(q) || 
      p.category.toLowerCase().includes(q)
    );
  }, [products, searchMarketQuery]);

  const handleSearchSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setSearchMarketQuery(localSearch);
  };

  const handleProductSelect = (id: string) => {
    setSelectedProductId(id);
    navigateTo('marketplace-product-details');
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
          <h1 className="text-2xl sm:text-3xl font-extrabold tracking-tight text-white leading-normal">Global Search Results</h1>
          <p className="text-xs text-slate-350 leading-relaxed max-w-lg">
            Catalog index matches for your customized query search. All listed devices hold valid KEBS standardization badges.
          </p>
        </div>
        <div className="bg-slate-800 px-4 py-2 border border-slate-700 rounded-2xl shrink-0 text-xs text-slate-300 font-mono">
          <span className="text-[#caa250] font-black">{matchingProducts.length}</span> Matches Found
        </div>
      </section>

      {/* Inline Search Bar */}
      <section className="bg-white p-5 border border-slate-150 rounded-2xl shadow-sm flex flex-col sm:flex-row gap-4 items-center">
        
        <form onSubmit={handleSearchSubmit} className="relative flex-1 w-full flex gap-3">
          <div className="relative flex-1">
            <Search className="absolute left-3.5 top-3.5 w-4.5 h-4.5 text-slate-400" />
            <input 
              type="text" 
              value={localSearch}
              onChange={e => setLocalSearch(e.target.value)}
              placeholder="Solar batteries, induction EPC, clean cookstoves..." 
              className="w-full text-xs text-[#112a1d] bg-slate-50 border border-slate-155 pl-11 pr-4 py-3.5 rounded-xl focus:outline-none focus:ring-1 focus:ring-emerald-700 font-sans"
            />
          </div>
          <button 
            type="submit" 
            className="px-6 py-3.5 bg-[#112a1d] hover:bg-slate-900 text-white font-black text-xs uppercase tracking-wider rounded-xl cursor-pointer shrink-0"
          >
            Update Query
          </button>
        </form>

        {/* List/Grid switcher */}
        <div className="flex border border-slate-200 rounded-xl overflow-hidden p-0.5 bg-slate-50 shrink-0">
          <button
            onClick={() => setIsListView(false)}
            className={`p-2.5 cursor-pointer rounded-lg ${!isListView ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400'}`}
          >
            <Grid className="w-4 h-4" />
          </button>
          <button
            onClick={() => setIsListView(true)}
            className={`p-2.5 cursor-pointer rounded-lg ${isListView ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400'}`}
          >
            <List className="w-4 h-4" />
          </button>
        </div>

      </section>

      {/* Result list columns */}
      {matchingProducts.length > 0 ? (
        <div className={isListView ? "space-y-4" : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"}>
          {matchingProducts.map((prod) => {
            const saved = savedProductIds.includes(prod.id);
            const discountPercent = prod.originalPriceKES 
              ? Math.round(((prod.originalPriceKES - prod.priceKES) / prod.originalPriceKES) * 100) 
              : null;

            if (isListView) {
              return (
                <div 
                  key={prod.id}
                  className="bg-white border border-slate-150 p-5 rounded-2xl flex flex-col sm:flex-row gap-5 items-center justify-between shadow-sm hover:shadow-md hover:border-emerald-700/20 transition"
                >
                  <div className="flex gap-4 items-center flex-1">
                    <img src={prod.imageUrl} alt={prod.title} className="w-24 h-16 object-cover rounded-xl shrink-0" referrerPolicy="no-referrer" />
                    <div className="space-y-1">
                      <span className="text-[8px] font-black uppercase text-[#caa250]">{prod.category}</span>
                      <h3 onClick={() => handleProductSelect(prod.id)} className="text-xs font-bold text-[#112a1d] hover:text-emerald-700 cursor-pointer">
                        {prod.title}
                      </h3>
                      <p className="text-[10px] text-gray-500 line-clamp-1 font-sans">{prod.description}</p>
                    </div>
                  </div>

                  <div className="flex sm:flex-col items-end gap-3 w-full sm:w-auto mt-3 sm:mt-0 font-mono">
                    <div className="text-right">
                      <span className="text-xs font-black text-[#112a1d] block">KES {prod.priceKES.toLocaleString()}</span>
                      <span className="text-[9px] text-gray-400">EPRA Verified Supplier</span>
                    </div>
                    <button 
                      onClick={() => handleProductSelect(prod.id)}
                      className="p-2 py-1.5 bg-[#112a1d] text-white text-[9px] font-bold rounded-lg flex items-center gap-1 cursor-pointer"
                    >
                      <Eye className="w-3.5 h-3.5" /> Details
                    </button>
                  </div>
                </div>
              );
            } else {
              return (
                <div 
                  key={prod.id} 
                  className="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:shadow-lg transition flex flex-col focus:ring-1"
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
                    <button 
                      onClick={() => toggleSaveProduct(prod.id)}
                      className="absolute top-3 right-3 p-2 bg-white/95 rounded-full hover:bg-amber-400 group-hover:scale-105 transition duration-150 text-slate-800 cursor-pointer shadow"
                    >
                      <Heart className={`w-3.5 h-3.5 ${saved ? 'fill-red-650 text-red-605 text-red-600' : 'text-slate-500'}`} />
                    </button>
                  </div>

                  <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                    <div>
                      <span className="text-[8px] font-black uppercase tracking-wider text-slate-400 block">{prod.category}</span>
                      <h3 className="font-bold text-xs text-[#112a1d] line-clamp-1 group-hover:text-emerald-700 mt-1">
                        {prod.title}
                      </h3>
                      <p className="text-[10px] text-slate-450 leading-normal line-clamp-2 mt-1 font-sans">{prod.description}</p>
                    </div>

                    <div className="pt-2 border-t border-slate-100 flex items-center justify-between text-xs">
                      <span className="font-black text-[#112a1d]">KES {prod.priceKES.toLocaleString()}</span>
                      <button 
                        onClick={() => handleProductSelect(prod.id)}
                        className="p-1.5 px-3 bg-slate-900 border border-slate-100 rounded-lg text-white text-[9px] font-bold flex items-center gap-1 cursor-pointer"
                      >
                        <Eye className="w-3.5 h-3.5" /> Specs
                      </button>
                    </div>
                  </div>
                </div>
              );
            }
          })}
        </div>
      ) : (
        <div className="text-center py-16 p-8 border border-dashed border-slate-205 rounded-xl bg-white space-y-3 shadow-sm max-w-sm mx-auto">
          <Search className="w-12 h-12 text-slate-350 mx-auto" />
          <h3 className="font-extrabold text-[#112a1d] text-sm">No matched results</h3>
          <p className="text-xs text-slate-450 font-sans leading-relaxed">
            We discovered zero listed clean devices for the term: <span className="font-bold text-[#caa250]">"{searchMarketQuery}"</span> in the database tree.
          </p>
        </div>
      )}

    </div>
  );
}
