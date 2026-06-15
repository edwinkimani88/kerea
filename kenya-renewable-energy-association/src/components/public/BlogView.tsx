import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { BlogArticle } from '../../types';
import { BookOpen, Calendar, Clock, ArrowRight, X, User } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

type SelectorTab = 'all' | 'news' | 'article' | 'impact';

export default function BlogView() {
  const { blogs } = useAppState();
  const [activeSubTab, setActiveSubTab] = useState<SelectorTab>('all');
  const [readingArticle, setReadingArticle] = useState<BlogArticle | null>(null);

  const filteredBlogs = blogs.filter(b => {
    if (activeSubTab === 'news') return b.category === 'News';
    if (activeSubTab === 'article') return b.category === 'Article';
    if (activeSubTab === 'impact') return b.category === 'Impact Story';
    return true;
  });

  return (
    <div className="space-y-12 pb-16">
      {/* Page Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          RENEWABLE BULLETIN & TECHNICAL INSIGHTS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          News, Articles & Impact Stories
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Read the latest press statements on energy policies, technical articles by certified engineers, and stories on rural solar installations in off-grid counties.
        </p>
      </section>

      {/* Internal Navigation Subtabs */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start sm:justify-center gap-1 sm:gap-4 scrollbar-none">
          <button
            onClick={() => setActiveSubTab('all')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'all'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            All Bulletins ({blogs.length})
          </button>
          <button
            onClick={() => setActiveSubTab('news')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'news'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            News Releases
          </button>
          <button
            onClick={() => setActiveSubTab('article')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'article'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Technical Articles
          </button>
          <button
            onClick={() => setActiveSubTab('impact')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeSubTab === 'impact'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Impact Stories
          </button>
        </div>
      </section>

      {/* Grid of Articles */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {filteredBlogs.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {filteredBlogs.map(post => (
              <div 
                key={post.id} 
                className="bg-white rounded-2xl overflow-hidden border border-slate-100 flex flex-col justify-between hover:shadow-lg transition-shadow group cursor-pointer"
                onClick={() => setReadingArticle(post)}
              >
                <div>
                  {/* Photo Head */}
                  <div className="h-48 overflow-hidden relative bg-slate-100">
                    <img 
                      src={post.imageUrl} 
                      alt={post.title} 
                      className="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-300"
                      referrerPolicy="no-referrer"
                    />
                    <div className="absolute top-3 left-3">
                      <span className="text-[9px] uppercase font-black px-2 py-0.5 rounded bg-amber-500 text-white shadow-sm">
                        {post.category}
                      </span>
                    </div>
                  </div>

                  {/* Context */}
                  <div className="p-6 space-y-3">
                    <div className="flex gap-4 text-[10px] text-gray-400 font-mono">
                      <span className="flex items-center gap-1"><Calendar className="w-3.5 h-3.5" /> {post.dateCreated}</span>
                      <span className="flex items-center gap-1"><Clock className="w-3.5 h-3.5" /> {post.readTime}</span>
                    </div>
                    <h3 className="text-sm font-black text-[#112a1d] leading-snug group-hover:text-emerald-700 transition-colors line-clamp-2">
                      {post.title}
                    </h3>
                    <p className="text-xs text-slate-400 line-clamp-3 leading-relaxed">
                      {post.content}
                    </p>
                  </div>
                </div>

                <div className="p-6 pt-0 border-t border-slate-50 mt-4">
                  <span className="text-xs font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1 select-none">
                    Read Breakdown Article <ArrowRight className="w-3.5 h-3.5" />
                  </span>
                </div>

              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-16 bg-white border border-slate-100 rounded-2xl max-w-sm mx-auto">
            <BookOpen className="w-12 h-12 text-slate-300 mx-auto mb-2" />
            <h4 className="text-xs font-bold text-gray-500">No matching bulletins found</h4>
            <p className="text-[11px] text-gray-400">Try choosing a different category subtab.</p>
          </div>
        )}
      </section>

      {/* Reader Dialog Overlay */}
      <AnimatePresence>
        {readingArticle && (
          <motion.div 
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-55 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4"
          >
            <motion.div 
              initial={{ scale: 0.95 }}
              animate={{ scale: 1 }}
              exit={{ scale: 0.95 }}
              className="bg-white rounded-2xl max-w-2xl w-full overflow-hidden shadow-2xl relative border border-slate-100"
            >
              {/* Photo top */}
              <div className="h-64 relative bg-slate-100">
                <img 
                  src={readingArticle.imageUrl} 
                  alt={readingArticle.title} 
                  className="w-full h-full object-cover"
                  referrerPolicy="no-referrer"
                />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <button
                  onClick={() => setReadingArticle(null)}
                  className="absolute top-4 right-4 p-1 rounded-lg bg-black/40 hover:bg-black/60 text-white cursor-pointer"
                >
                  <X className="w-5 h-5" />
                </button>

                <div className="absolute bottom-5 left-6 right-6 text-white space-y-2">
                  <span className="text-[9px] uppercase font-black bg-amber-550 text-white px-2.5 py-1 rounded">
                    {readingArticle.category}
                  </span>
                  <h2 className="text-lg sm:text-xl font-bold leading-tight">{readingArticle.title}</h2>
                </div>
              </div>

              {/* Text Body */}
              <div className="p-6 sm:p-8 space-y-6 max-h-[400px] overflow-y-auto">
                <div className="flex justify-between items-center text-xs text-gray-400 font-mono pb-4 border-b border-slate-100">
                  <span className="flex items-center gap-1.5"><User className="w-4 h-4 text-emerald-600" /> By: <strong className="text-gray-500">{readingArticle.author}</strong></span>
                  <span className="flex items-center gap-1.5"><Calendar className="w-4 h-4" /> Published: {readingArticle.dateCreated}</span>
                  <span className="flex items-center gap-1.5"><Clock className="w-4 h-4" /> {readingArticle.readTime}</span>
                </div>

                <div className="text-xs sm:text-sm text-slate-500 leading-relaxed font-sans space-y-4">
                  {readingArticle.content.split('\n\n').map((para, i) => (
                    <p key={i}>{para}</p>
                  ))}
                </div>
              </div>

              {/* Close controls */}
              <div className="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <button
                  onClick={() => setReadingArticle(null)}
                  className="px-5 py-2 bg-[#112a1d] text-white font-bold text-xs rounded-lg cursor-pointer hover:bg-emerald-700"
                >
                  Close Article
                </button>
              </div>

            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
}
