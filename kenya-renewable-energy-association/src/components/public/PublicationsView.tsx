import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { Publication } from '../../types';
import { FileText, Download, Check, Clock, HardDrive, Search, Filter } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

type SubView = 'all' | 'reports' | 'briefs' | 'papers';

export default function PublicationsView() {
  const { publications, logUserAction } = useAppState();
  const [activeTab, setActiveTab] = useState<SubView>('all');
  const [searchQuery, setSearchQuery] = useState('');
  const [downloadStates, setDownloadStates] = useState<Record<string, string>>({});

  const handleDownload = (pubId: string) => {
    setDownloadStates(prev => ({ ...prev, [pubId]: 'downloading' }));
    logUserAction('Publication Downloaded', `User fetched public report ID: ${pubId}`);
    
    setTimeout(() => {
      setDownloadStates(prev => ({ ...prev, [pubId]: 'completed' }));
      // Increment download counter
      const pub = publications.find(p => p.id === pubId);
      if (pub) pub.downloads += 1;
    }, 1500);
  };

  const getFilteredPublications = () => {
    let result = publications;
    if (activeTab === 'reports') result = publications.filter(p => p.category === 'Market Report');
    if (activeTab === 'briefs') result = publications.filter(p => p.category === 'Policy Brief' || p.category === 'Regulation');
    if (activeTab === 'papers') result = publications.filter(p => p.category === 'Research Paper' || p.category === 'Technical Standard');

    if (searchQuery) {
      result = result.filter(p => 
        p.title.toLowerCase().includes(searchQuery.toLowerCase()) || 
        p.author.toLowerCase().includes(searchQuery.toLowerCase())
      );
    }
    return result;
  };

  const currentPubs = getFilteredPublications();

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-amber-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          DOCUMENT LIBRARY & DOWNLOAD MATRIX
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Publications & Reports Download Center
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Search, browse, and download authorized publications compiled by our policy lobbying secretariat and global research partners.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveTab('all')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'all'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-400 hover:text-emerald-600'
            }`}
          >
            All Documents ({publications.length})
          </button>
          <button
            onClick={() => setActiveTab('reports')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'reports'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-400 hover:text-emerald-600'
            }`}
          >
            Market Reports
          </button>
          <button
            onClick={() => setActiveTab('briefs')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'briefs'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-400 hover:text-emerald-600'
            }`}
          >
            Policy Briefs & Bills
          </button>
          <button
            onClick={() => setActiveTab('papers')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'papers'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-400 hover:text-emerald-600'
            }`}
          >
            Research Papers & Standards
          </button>
        </div>
      </section>

      {/* Search and Filters toolbar */}
      <section className="max-w-4xl mx-auto px-4">
        <div className="relative">
          <Search className="absolute left-4 top-3.5 w-5 h-5 text-gray-300 pointer-events-none" />
          <input
            type="text"
            value={searchQuery}
            onChange={e => setSearchQuery(e.target.value)}
            placeholder="Search documents by title keyword or publisher names..."
            className="w-full text-xs pl-12 pr-6 py-4 border border-slate-200 rounded-2xl focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-60/40 bg-white shadow-sm"
          />
        </div>
      </section>

      {/* Publications Grid List */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {currentPubs.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            {currentPubs.map(pub => (
              <div 
                key={pub.id}
                className="bg-white rounded-2xl p-5 border border-slate-100 hover:border-emerald-500/20 shadow-sm transition-all flex flex-col justify-between"
              >
                <div>
                  <div className="flex items-center justify-between gap-4 mb-3.5">
                    <span className="text-[9px] uppercase font-black px-2 py-0.5 rounded border border-emerald-100/50 text-emerald-800 bg-emerald-50 bg-opacity-70">
                      {pub.category}
                    </span>
                    <span className="text-[10px] text-gray-400 font-mono">
                      {pub.downloads.toLocaleString()} downloads
                    </span>
                  </div>

                  <h3 className="text-xs sm:text-sm font-extrabold text-[#112a1d] mb-2 leading-snug">
                    {pub.title}
                  </h3>
                  
                  <p className="text-[10px] text-gray-400 font-sans">
                    Published by: <strong className="text-gray-500">{pub.author}</strong>
                  </p>
                </div>

                <div className="border-t border-slate-50 pt-3.5 mt-4 flex items-center justify-between">
                  <div className="flex items-center gap-4 text-[10px] text-gray-400 font-mono">
                    <span className="flex items-center gap-1">
                      <Clock className="w-3.5 h-3.5 text-gray-300" />
                      Y: {pub.publishedYear}
                    </span>
                    <span className="flex items-center gap-1">
                      <HardDrive className="w-3.5 h-3.5 text-gray-300" />
                      Size: {pub.fileSize}
                    </span>
                  </div>

                  <button
                    onClick={() => handleDownload(pub.id)}
                    className={`inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-black tracking-wide uppercase transition-all cursor-pointer border ${
                      downloadStates[pub.id] === 'completed'
                        ? 'bg-emerald-100 text-emerald-800 border-emerald-200'
                        : downloadStates[pub.id] === 'downloading'
                        ? 'bg-slate-100 text-gray-505 border-slate-200 animate-pulse'
                        : 'bg-emerald-50 text-emerald-700 border-emerald-100 hover:bg-emerald-700 hover:text-white'
                    }`}
                  >
                    {downloadStates[pub.id] === 'completed' ? (
                      <>
                        <Check className="w-3 h-3" /> Get PDF (Done)
                      </>
                    ) : downloadStates[pub.id] === 'downloading' ? (
                      <>
                        <Clock className="w-3 h-3 animate-spin" /> Fetching...
                      </>
                    ) : (
                      <>
                        <Download className="w-3 h-3" /> Get PDF Document
                      </>
                    )}
                  </button>

                </div>

              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-16 bg-white border border-slate-100 rounded-2xl max-w-sm mx-auto">
            <FileText className="w-12 h-12 text-gray-300 mx-auto mb-2" />
            <h4 className="text-xs font-bold text-gray-500">No documents found</h4>
            <p className="text-[11px] text-gray-400">Try re-filtering search criteria keywords.</p>
          </div>
        )}
      </section>

    </div>
  );
}
