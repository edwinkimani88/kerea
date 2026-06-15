import React, { useState } from 'react';
import { FileText, Download, Check, Search, Filter, BookOpen, Clock, HardDrive, Sparkles } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';
import { publicationsData } from '../data';
import { Publication } from '../types';

export default function ResourcesDirectory() {
  const [searchQuery, setSearchQuery] = useState('');
  const [categoryFilter, setCategoryFilter] = useState<'All' | 'Regulation' | 'Guide' | 'Market Report' | 'Technical Standard'>('All');
  const [downloadStates, setDownloadStates] = useState<{ [key: string]: 'idle' | 'downloading' | 'completed' }>({});

  const filteredPublications = publicationsData.filter((pub) => {
    const matchesSearch = pub.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
                          pub.author.toLowerCase().includes(searchQuery.toLowerCase());
    const matchesCategory = categoryFilter === 'All' || pub.category === categoryFilter;
    return matchesSearch && matchesCategory;
  });

  const handleDownload = (pubId: string) => {
    if (downloadStates[pubId] === 'downloading' || downloadStates[pubId] === 'completed') return;

    // Set state to downloading
    setDownloadStates((prev) => ({ ...prev, [pubId]: 'downloading' }));

    // Simulate downloading progression
    setTimeout(() => {
      setDownloadStates((prev) => ({ ...prev, [pubId]: 'completed' }));
      
      // Revert back to idle after 3 seconds
      setTimeout(() => {
        setDownloadStates((prev) => ({ ...prev, [pubId]: 'idle' }));
      }, 3000);
    }, 2000);
  };

  const getCategoryBadgeClass = (category: string) => {
    switch (category) {
      case 'Regulation':
        return 'bg-rose-50 border-rose-100 text-rose-700';
      case 'Guide':
        return 'bg-blue-50 border-blue-100 text-blue-700';
      case 'Market Report':
        return 'bg-purple-50 border-purple-100 text-purple-700';
      case 'Technical Standard':
        return 'bg-emerald-50 border-emerald-100 text-emerald-700';
      default:
        return 'bg-gray-50 border-gray-100 text-gray-700';
    }
  };

  return (
    <section id="publications-section" className="py-24 bg-slate-50/50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
          <div>
            <div className="inline-flex items-center gap-1.5 text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3">
              <FileText className="w-3.5 h-3.5 text-amber-500" />
              PUBLICATIONS & RESOURCE CENTER
            </div>
            <h2 className="text-3xl sm:text-4xl font-extrabold text-[#112a1d] tracking-tight leading-tight">
              Regulatory Codes <span className="text-emerald-600">& Guides</span>
            </h2>
            <p className="text-xs sm:text-sm text-gray-500 leading-relaxed mt-2 max-w-xl">
              Equipping practitioners and corporate developers with official solar codes, net metering handbooks, and update notes regarding tax VAT exemption lobbying.
            </p>
          </div>

          {/* Quick Stats Badge */}
          <div className="inline-flex items-center gap-2 p-1 px-3 bg-white border border-slate-100 rounded-xl shadow-sm text-xs font-bold text-gray-600">
            <Sparkles className="w-4 h-4 text-amber-500 animate-pulse" />
            <span>Over 6.5k Downloads this Quarter</span>
          </div>
        </div>

        {/* Resources Search and filtration row */}
        <div className="bg-white p-4.5 rounded-2xl border border-slate-100 flex flex-col md:flex-row items-center gap-4 justify-between shadow-sm mb-8">
          
          {/* Search bar input */}
          <div className="relative w-full md:max-w-md">
            <Search className="absolute left-3.5 top-3.5 w-4 h-4 text-gray-400" />
            <input
              type="text"
              placeholder="Search code titles, guidelines, KEREA acts, authors..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none focus:border-emerald-600"
            />
          </div>

          {/* Inline filters */}
          <div className="flex flex-wrap items-center gap-2 w-full md:w-auto justify-start md:justify-end">
            <Filter className="w-4 h-4 text-emerald-600 shrink-0" />
            <button
              onClick={() => setCategoryFilter('All')}
              className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer ${categoryFilter === 'All' ? 'bg-[#112a1d] text-white shadow' : 'bg-slate-50 border border-slate-100 text-gray-500 hover:text-emerald-950 hover:bg-slate-100'}`}
            >
              All Items
            </button>
            <button
              onClick={() => setCategoryFilter('Technical Standard')}
              className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer ${categoryFilter === 'Technical Standard' ? 'bg-[#112a1d] text-white shadow' : 'bg-slate-50 border border-slate-100 text-gray-500 hover:text-emerald-950 hover:bg-slate-100'}`}
            >
              Standards
            </button>
            <button
              onClick={() => setCategoryFilter('Guide')}
              className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer ${categoryFilter === 'Guide' ? 'bg-[#112a1d] text-white shadow' : 'bg-slate-50 border border-slate-100 text-gray-500 hover:text-emerald-950 hover:bg-slate-100'}`}
            >
              Guides
            </button>
            <button
              onClick={() => setCategoryFilter('Regulation')}
              className={`px-3.5 py-1.5 rounded-lg text-xs font-bold transition-all cursor-pointer ${categoryFilter === 'Regulation' ? 'bg-[#112a1d] text-white shadow' : 'bg-slate-50 border border-slate-100 text-gray-500 hover:text-emerald-950 hover:bg-slate-100'}`}
            >
              Tax Reliefs
            </button>
          </div>

        </div>

        {/* Publications Grid List */}
        {filteredPublications.length > 0 ? (
          <motion.div layout className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <AnimatePresence mode="popLayout">
              {filteredPublications.map((pub) => (
                <motion.div 
                  layout
                  initial={{ opacity: 0, y: 15 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: -15 }}
                  transition={{ duration: 0.3 }}
                  key={pub.id}
                  className="bg-white rounded-2xl p-5 border border-slate-100 hover:border-emerald-500/20 shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                >
                  <div>
                    <div className="flex items-center justify-between gap-4 mb-3.5">
                      {/* Category Tag */}
                      <span className={`text-[9px] uppercase font-black px-2 py-0.5 rounded border ${getCategoryBadgeClass(pub.category)}`}>
                        {pub.category}
                      </span>
                      
                      {/* Downloads count */}
                      <span className="text-[10px] text-gray-400 font-mono">
                        {pub.downloads.toLocaleString()} reads
                      </span>
                    </div>

                    <h3 className="text-sm font-extrabold text-[#112a1d] mb-2 leading-snug hover:text-emerald-600 transition-colors">
                      {pub.title}
                    </h3>
                    
                    {/* Author */}
                    <p className="text-[11px] text-gray-400 mb-4 font-sans flex items-center gap-1">
                      <BookOpen className="w-3 h-3" /> Published by: <strong className="text-gray-500 font-bold">{pub.author}</strong>
                    </p>
                  </div>

                  <div className="border-t border-slate-50 pt-3.5 mt-2 flex items-center justify-between">
                    <div className="flex items-center gap-4 text-[10px] text-gray-400 font-mono">
                      <span className="flex items-center gap-1.5">
                        <Clock className="w-3.5 h-3.5 text-gray-400" />
                        Y: {pub.publishedYear}
                      </span>
                      <span className="flex items-center gap-1.5">
                        <HardDrive className="w-3.5 h-3.5 text-gray-400" />
                        Size: {pub.fileSize}
                      </span>
                    </div>

                    {/* Interactive Download Trigger */}
                    <button
                      onClick={() => handleDownload(pub.id)}
                      className={`inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold transition-all cursor-pointer ${
                        downloadStates[pub.id] === 'completed'
                          ? 'bg-emerald-100 text-emerald-800 border border-emerald-200'
                          : downloadStates[pub.id] === 'downloading'
                          ? 'bg-slate-100 text-gray-500 border border-slate-200 animate-pulse'
                          : 'bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white border border-emerald-100'
                      }`}
                    >
                      {downloadStates[pub.id] === 'completed' ? (
                        <>
                          <Check className="w-3.5 h-3.5" /> Checked!
                        </>
                      ) : downloadStates[pub.id] === 'downloading' ? (
                        <>
                          <Clock className="w-3.5 h-3.5 animate-spin" /> Fetching...
                        </>
                      ) : (
                        <>
                          <Download className="w-3.5 h-3.5" /> Get Code (PDF)
                        </>
                      )}
                    </button>

                  </div>

                </motion.div>
              ))}
            </AnimatePresence>
          </motion.div>
        ) : (
          <div className="text-center py-16 bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
            <FileText className="w-12 h-12 text-gray-300 mx-auto mb-3" />
            <p className="text-sm font-bold text-[#112a1d]">No regulatory papers matched your filters.</p>
            <p className="text-xs text-gray-400 mt-1">Try toggling of alternative categories or query keywords.</p>
          </div>
        )}

      </div>
    </section>
  );
}
