import React, { useState, useMemo } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  Grid, 
  List, 
  SlidersHorizontal, 
  Search, 
  ArrowUpDown, 
  Heart, 
  Eye, 
  Star, 
  ShieldCheck, 
  ArrowLeft,
  ChevronLeft,
  ChevronRight,
  Sparkles,
  ShoppingBag
} from 'lucide-react';
import { AppView, MarketplaceProduct } from '../../types';

interface MarketplaceCategoryProps {
  categoryName: 'Solar Technologies' | 'Electric Cooking' | 'Biogas Systems' | 'Biomass Technologies' | 'Improved Cookstoves' | 'Energy Storage' | 'Mini-grid Technologies';
}

export default function MarketplaceCategory({ categoryName }: MarketplaceCategoryProps) {
  const { 
    products, 
    savedProductIds, 
    toggleSaveProduct, 
    navigateTo,
    setSelectedProductId
  } = useAppState();

  const [searchQuery, setSearchQuery] = useState('');
  const [isListView, setIsListView] = useState(false);
  
  // Sidebar Filters
  const [priceRange, setPriceRange] = useState(200000); // 200k max
  const [epraOnly, setEpraOnly] = useState(false);
  const [inStockOnly, setInStockOnly] = useState(false);
  const [minRating, setMinRating] = useState(0);

  // Sorting
  const [sortBy, setSortBy] = useState<'price-asc' | 'price-desc' | 'rating' | 'newest'>('newest');

  // Pagination
  const [currentPage, setCurrentPage] = useState(1);
  const itemsPerPage = 6;

  // Filter products belonging to this category
  const categoryProducts = useMemo(() => {
    return products.filter(p => p.category === categoryName);
  }, [products, categoryName]);

  // Apply filters & query matching
  const filteredProducts = useMemo(() => {
    let result = [...categoryProducts];

    // Search query matching
    if (searchQuery.trim()) {
      const q = searchQuery.toLowerCase();
      result = result.filter(p => p.title.toLowerCase().includes(q) || p.description.toLowerCase().includes(q));
    }

    // Price query matching
    result = result.filter(p => p.priceKES <= priceRange);

    // EPRA filter
    if (epraOnly) {
      result = result.filter(p => p.certifiedByEPRA);
    }

    // In Stock filter
    if (inStockOnly) {
      result = result.filter(p => p.stockAvailable > 0);
    }

    // Rating filter
    if (minRating > 0) {
      result = result.filter(p => p.rating >= minRating);
    }

    // Sorting operations
    switch (sortBy) {
      case 'price-asc':
        result.sort((a, b) => a.priceKES - b.priceKES);
        break;
      case 'price-desc':
        result.sort((a, b) => b.priceKES - a.priceKES);
        break;
      case 'rating':
        result.sort((a, b) => b.rating - a.rating);
        break;
      case 'newest':
      default:
        // Keep order or reverse id as newest
        result.sort((a, b) => b.id.localeCompare(a.id));
        break;
    }

    return result;
  }, [categoryProducts, searchQuery, priceRange, epraOnly, inStockOnly, minRating, sortBy]);

  // Pagination logic
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage) || 1;
  const paginatedProducts = useMemo(() => {
    const startIndex = (currentPage - 1) * itemsPerPage;
    return filteredProducts.slice(startIndex, startIndex + itemsPerPage);
  }, [filteredProducts, currentPage]);

  const handleProductSelect = (id: string) => {
    setSelectedProductId(id);
    navigateTo('marketplace-product-details');
  };

  return (
    <div className="space-y-8 font-sans">
      
      {/* Category Header Banner */}
      <section className="bg-slate-900 text-white rounded-3xl p-6 sm:p-10 relative overflow-hidden flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div className="absolute right-0 top-0 bottom-0 w-1/3 bg-radial from-amber-500/10 to-transparent pointer-events-none"></div>
        <div className="space-y-2">
          <button 
            onClick={() => navigateTo('marketplace')}
            className="text-[10px] uppercase font-black tracking-widest text-[#caa250] hover:underline flex items-center gap-1.5 cursor-pointer"
          >
            <ArrowLeft className="w-3.5 h-3.5" /> Back to Marketplace Home
          </button>
          <h1 className="text-2xl sm:text-3xl font-extrabold tracking-tight text-white capitalize">{categoryName} Catalog</h1>
          <p className="text-xs text-slate-350 leading-relaxed font-sans max-w-lg">
            Procure high-compliance products listed by verified manufacturers. Complete tech records, certification audits, and escrow warranties apply.
          </p>
        </div>
        <div className="px-4 py-2 bg-slate-800 rounded-2xl border border-slate-700/80 text-xs shrink-0 font-mono">
          <span className="text-[#caa250] font-bold">{filteredProducts.length}</span> listed items
        </div>
      </section>

      {/* Main Filter & Catalog Grid area */}
      <section className="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        {/* Left column: Sidebar Filters */}
        <aside className="lg:col-span-3 bg-white border border-slate-150 p-6 rounded-2xl space-y-6 shadow-sm">
          <div className="flex justify-between items-center pb-4 border-b border-slate-100">
            <h3 className="text-xs font-black uppercase text-[#112a1d] tracking-widest flex items-center gap-1.5">
              <SlidersHorizontal className="w-4 h-4 text-emerald-700" /> Filter Options
            </h3>
            <button 
              onClick={() => {
                setPriceRange(200000);
                setEpraOnly(false);
                setInStockOnly(false);
                setMinRating(0);
                setSearchQuery('');
              }}
              className="text-[10px] font-bold text-emerald-700 hover:underline hover:text-emerald-800"
            >
              Reset All
            </button>
          </div>

          {/* Search Input */}
          <div className="space-y-2">
            <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">Search Catalog</label>
            <div className="relative">
              <Search className="absolute left-3 top-2.5 w-4 h-4 text-slate-400" />
              <input 
                type="text" 
                value={searchQuery}
                onChange={e => setSearchQuery(e.target.value)}
                placeholder="Product keywords..."
                className="w-full text-xs p-2.5 pl-9 border border-slate-205 rounded-xl bg-slate-50/50 focus:outline-none focus:ring-1 focus:ring-emerald-700"
              />
            </div>
          </div>

          {/* Price Range Slider */}
          <div className="space-y-2">
            <div className="flex justify-between items-baseline text-[10px] font-bold text-gray-400 uppercase tracking-wider">
              <span>Max Price</span>
              <span className="text-[#112a1d] font-mono text-xs">KES {priceRange.toLocaleString()}</span>
            </div>
            <input 
              type="range" 
              min={1000} 
              max={200000} 
              step={2000}
              value={priceRange}
              onChange={e => setPriceRange(Number(e.target.value))}
              className="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-emerald-700"
            />
            <div className="flex justify-between text-[9px] font-mono text-slate-400">
              <span>KES 1,000</span>
              <span>KES 200,000</span>
            </div>
          </div>

          {/* Certification Filters (EPRA) */}
          <div className="space-y-3">
            <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">Regulatory Compliance</label>
            <div className="space-y-2 text-xs">
              <label className="flex items-center gap-2 cursor-pointer select-none">
                <input 
                  type="checkbox" 
                  checked={epraOnly}
                  onChange={e => setEpraOnly(e.target.checked)}
                  className="rounded text-emerald-700 focus:ring-emerald-700 hover:border-emerald-750"
                />
                <span className="text-slate-600 font-medium">EPRA Verified & Certified</span>
              </label>

              <label className="flex items-center gap-2 cursor-pointer select-none">
                <input 
                  type="checkbox" 
                  checked={inStockOnly}
                  onChange={e => setInStockOnly(e.target.checked)}
                  className="rounded text-emerald-700 focus:ring-emerald-700 hover:border-emerald-750"
                />
                <span className="text-slate-600 font-medium">Available in Local Stock</span>
              </label>
            </div>
          </div>

          {/* Sourcing Rating Filters */}
          <div className="space-y-3">
            <label className="block text-[10px] font-bold text-gray-500 uppercase tracking-wider">Minimum Rating</label>
            <div className="space-y-1.5 text-xs">
              {[4, 3, 0].map((rate) => (
                <label key={rate} className="flex items-center gap-2 cursor-pointer select-none">
                  <input 
                    type="radio" 
                    name="minRating"
                    checked={minRating === rate}
                    onChange={() => setMinRating(rate)}
                    className="text-emerald-700 focus:ring-emerald-700"
                  />
                  <span className="text-slate-600 font-medium flex items-center gap-1">
                    {rate === 0 ? 'All Ratings' : `${rate}.0 Stars & Up`}
                    {rate > 0 && <Star className="w-3.5 h-3.5 fill-amber-400 text-amber-400" />}
                  </span>
                </label>
              ))}
            </div>
          </div>
        </aside>

        {/* Right column: Results Grid */}
        <main className="lg:col-span-9 space-y-6">
          
          {/* Controls Bar */}
          <div className="bg-white border border-slate-150 p-4 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 shadow-sm">
            <div className="text-xs text-slate-500">
              Showing <span className="font-extrabold text-[#112a1d]">{filteredProducts.length}</span> results for <span className="font-extrabold italic text-[#caa250]">{categoryName}</span>
            </div>

            <div className="flex flex-wrap items-center gap-4 w-full sm:w-auto justify-between sm:justify-end">
              
              {/* Sorting Switch */}
              <div className="flex items-center gap-2">
                <ArrowUpDown className="w-4 h-4 text-slate-400 shrink-0" />
                <select
                  value={sortBy}
                  onChange={e => setSortBy(e.target.value as any)}
                  className="text-xs p-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none"
                >
                  <option value="newest">Sort: Newly Certified</option>
                  <option value="price-asc">Price: Low to High</option>
                  <option value="price-desc">Price: High to Low</option>
                  <option value="rating">Rating: Highest Rated</option>
                </select>
              </div>

              {/* Grid / List Switcher */}
              <div className="flex border border-slate-200 rounded-xl overflow-hidden p-0.5 bg-slate-50">
                <button
                  onClick={() => setIsListView(false)}
                  className={`p-2 cursor-pointer rounded-lg ${!isListView ? 'bg-white text-[#112a1d] shadow-sm' : 'text-slate-400'}`}
                  title="Grid view"
                >
                  <Grid className="w-4 h-4" />
                </button>
                <button
                  onClick={() => setIsListView(true)}
                  className={`p-2 cursor-pointer rounded-lg ${isListView ? 'bg-white text-[#112a1d] shadow-sm' : 'text-slate-400'}`}
                  title="List view"
                >
                  <List className="w-4 h-4" />
                </button>
              </div>

            </div>
          </div>

          {/* Products Grid / List display */}
          {paginatedProducts.length > 0 ? (
            <div className={isListView ? "space-y-4" : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"}>
              {paginatedProducts.map((prod) => {
                const saved = savedProductIds.includes(prod.id);
                const discountPercent = prod.originalPriceKES 
                  ? Math.round(((prod.originalPriceKES - prod.priceKES) / prod.originalPriceKES) * 100) 
                  : null;

                if (isListView) {
                  // LIST VIEW
                  return (
                    <div 
                      key={prod.id}
                      className="bg-white border border-slate-150 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-emerald-700/25 transition p-5 flex flex-col sm:flex-row gap-5 items-start sm:items-center"
                    >
                      <div className="relative w-full sm:w-40 aspect-video bg-slate-100 rounded-xl overflow-hidden shrink-0">
                        <img 
                          src={prod.imageUrl} 
                          alt={prod.title} 
                          className="w-full h-full object-cover"
                          referrerPolicy="no-referrer"
                        />
                        {discountPercent && (
                          <span className="absolute top-2 left-2 bg-[#112a1d] text-white text-[8px] font-extrabold px-1.5 py-0.5 rounded">
                            -{discountPercent}%
                          </span>
                        )}
                      </div>

                      <div className="flex-1 space-y-3">
                        <div className="space-y-1">
                          <div className="flex flex-wrap items-center gap-2">
                            <span className="text-[8px] font-black uppercase text-[#caa250]">{prod.category}</span>
                            {prod.certifiedByEPRA && (
                              <span className="text-[8px] font-black text-white bg-emerald-700 px-1 py-0.5 rounded flex items-center gap-0.5">
                                <ShieldCheck className="w-3 h-3 text-white" /> EPRA CERTIFIED
                              </span>
                            )}
                          </div>
                          <h3 className="text-sm font-bold text-[#112a1d] hover:text-emerald-700 cursor-pointer" onClick={() => handleProductSelect(prod.id)}>
                            {prod.title}
                          </h3>
                          <p className="text-[11px] text-gray-500 font-sans leading-normal line-clamp-2">{prod.description}</p>
                        </div>

                        <div className="flex items-center gap-1.5">
                          <div className="flex text-amber-400">
                            {Array.from({ length: 5 }).map((_, i) => (
                              <Star key={i} className={`w-3 h-3 ${i < Math.floor(prod.rating) ? 'fill-amber-400 text-amber-400' : 'text-slate-200'}`} />
                            ))}
                          </div>
                          <span className="text-[10px] text-slate-400">({prod.reviewsCount} supplier audits)</span>
                        </div>
                      </div>

                      <div className="w-full sm:w-auto flex sm:flex-col justify-between sm:justify-end items-center sm:items-end gap-3 pt-3 sm:pt-0 sm:pl-4 sm:border-l border-slate-100 shrink-0">
                        <div className="flex flex-col items-start sm:items-end">
                          {prod.originalPriceKES && (
                            <span className="text-[10px] text-slate-400 line-through">KES {prod.originalPriceKES.toLocaleString()}</span>
                          )}
                          <span className="text-sm font-black text-[#112a1d]">KES {prod.priceKES.toLocaleString()}</span>
                          <span className={`text-[9px] font-mono mt-0.5 ${prod.stockAvailable < 5 ? 'text-red-700 font-extrabold' : 'text-slate-400'}`}>
                            {prod.stockAvailable} units in stock
                          </span>
                        </div>

                        <div className="flex gap-2">
                          <button 
                            onClick={() => toggleSaveProduct(prod.id)}
                            className="p-2 border border-slate-200 rounded-xl hover:bg-slate-50 cursor-pointer"
                          >
                            <Heart className={`w-3.5 h-3.5 ${saved ? 'fill-red-600 text-red-600' : 'text-slate-500'}`} />
                          </button>
                          <button 
                            onClick={() => handleProductSelect(prod.id)}
                            className="p-2.5 px-4 bg-slate-900 hover:bg-black text-white text-[10px] font-black rounded-xl flex items-center gap-1 cursor-pointer"
                          >
                            <Eye className="w-3.5 h-3.5" /> Specs
                          </button>
                        </div>
                      </div>
                    </div>
                  );
                } else {
                  // GRID VIEW
                  return (
                    <div 
                      key={prod.id}
                      className="group bg-white border border-slate-150 rounded-2xl overflow-hidden hover:shadow-md hover:border-emerald-700/25 transition flex flex-col"
                    >
                      <div className="relative aspect-video bg-slate-100 overflow-hidden">
                        <img 
                          src={prod.imageUrl} 
                          alt={prod.title} 
                          className="w-full h-full object-cover group-hover:scale-103 transition duration-300"
                          referrerPolicy="no-referrer"
                        />
                        {discountPercent && (
                          <span className="absolute top-3 left-3 bg-red-600 text-white text-[9px] font-black px-2 py-0.5 rounded-md">
                            -{discountPercent}% OFF
                          </span>
                        )}
                        {prod.certifiedByEPRA && (
                          <span className="absolute bottom-3 left-3 bg-emerald-750 text-white bg-emerald-700 text-[8px] font-bold px-1.5 py-0.5 rounded tracking-wide">
                            EPRA Certified
                          </span>
                        )}
                        <button 
                          onClick={() => toggleSaveProduct(prod.id)}
                          className="absolute top-3 right-3 p-2 bg-white/95 rounded-full hover:bg-amber-400 group-hover:scale-105 transition duration-150 text-[#112a1d] shadow cursor-pointer"
                        >
                          <Heart className={`w-3.5 h-3.5 ${saved ? 'fill-red-600 text-red-600' : 'text-slate-500'}`} />
                        </button>
                      </div>

                      <div className="p-4 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                          <span className="text-[8px] font-black uppercase text-gray-400 block">{prod.category}</span>
                          <h3 
                            onClick={() => handleProductSelect(prod.id)}
                            className="font-bold text-xs text-[#112a1d] line-clamp-2 hover:text-[#caa250] hover:underline cursor-pointer tracking-tight mt-1"
                          >
                            {prod.title}
                          </h3>
                          
                          <div className="flex items-center gap-1 mt-1">
                            <div className="flex text-amber-400">
                              {Array.from({ length: 5 }).map((_, i) => (
                                <Star key={i} className={`w-3 h-3 ${i < Math.floor(prod.rating) ? 'fill-amber-400 text-amber-400' : 'text-slate-200'}`} />
                              ))}
                            </div>
                            <span className="text-[9px] text-gray-400 font-mono">({prod.reviewsCount})</span>
                          </div>
                        </div>

                        <div className="pt-3 border-t border-slate-50 flex items-center justify-between">
                          <div className="flex flex-col">
                            {prod.originalPriceKES && (
                              <span className="text-[10px] text-slate-450 line-through">KES {prod.originalPriceKES.toLocaleString()}</span>
                            )}
                            <span className="text-xs font-black text-emerald-805 text-emerald-800">
                              KES {prod.priceKES.toLocaleString()}
                            </span>
                          </div>

                          <button 
                            onClick={() => handleProductSelect(prod.id)}
                            className="p-2 bg-slate-900 text-white rounded-lg hover:bg-black text-[9px] font-black flex items-center gap-1 cursor-pointer"
                          >
                            <Eye className="w-3.5 h-3.5" /> Details
                          </button>
                        </div>
                      </div>
                    </div>
                  );
                }
              })}
            </div>
          ) : (
            <div className="text-center py-16 p-8 border border-dashed border-slate-205 rounded-2xl bg-white space-y-3 shadow-sm">
              <ShoppingBag className="w-12 h-12 text-slate-350 mx-auto" />
              <h3 className="font-bold text-[#112a1d] text-sm">No items match your criteria</h3>
              <p className="text-xs text-slate-450 max-w-sm mx-auto font-sans">
                Try loosening your filters, reducing your product name keyword constraints, or checking back later as members list new equipment.
              </p>
            </div>
          )}

          {/* Pagination bar */}
          {totalPages > 1 && (
            <div className="flex justify-between items-center bg-white border border-slate-150 p-4 rounded-2xl shadow-sm">
              <button
                disabled={currentPage === 1}
                onClick={() => setCurrentPage(c => Math.max(1, c - 1))}
                className="px-4 py-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 disabled:opacity-50 text-xs font-bold rounded-xl cursor-pointer disabled:cursor-not-allowed flex items-center gap-1"
              >
                <ChevronLeft className="w-4 h-4" /> Previous
              </button>
              
              <div className="text-xs font-mono text-slate-500">
                Page <span className="font-extrabold text-[#112a1d]">{currentPage}</span> of {totalPages}
              </div>

              <button
                disabled={currentPage === totalPages}
                onClick={() => setCurrentPage(c => Math.min(totalPages, c + 1))}
                className="px-4 py-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 disabled:opacity-50 text-xs font-bold rounded-xl cursor-pointer disabled:cursor-not-allowed flex items-center gap-1"
              >
                Next <ChevronRight className="w-4 h-4" />
              </button>
            </div>
          )}

        </main>
      </section>

    </div>
  );
}
