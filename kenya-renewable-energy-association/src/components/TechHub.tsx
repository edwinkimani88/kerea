import React, { useState } from 'react';
import { Sparkles, Calendar, Award, Star, Search, Filter, BookOpen, Key, Info, X, Zap } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';
import { technologiesData, trainingCoursesData } from '../data';
import { Technology, TrainingCourse } from '../types';

export default function TechHub() {
  const [activeTab, setActiveTab] = useState<'tech' | 'courses'>('tech');
  const [courseSearchQuery, setCourseSearchQuery] = useState('');
  const [courseLevelFilter, setCourseLevelFilter] = useState<'All' | 'Basic' | 'Intermediate' | 'Advanced'>('All');
  
  // Interactive Modal State
  const [selectedCourse, setSelectedCourse] = useState<TrainingCourse | null>(null);
  const [isRegisterSuccess, setIsRegisterSuccess] = useState(false);
  const [registerForm, setRegisterForm] = useState({ name: '', email: '', phone: '' });

  // Handle Course Register Submission
  const handleRegisterSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (registerForm.name && registerForm.email && registerForm.phone) {
      setIsRegisterSuccess(true);
      setTimeout(() => {
        setIsRegisterSuccess(false);
        setSelectedCourse(null);
        setRegisterForm({ name: '', email: '', phone: '' });
      }, 4000);
    }
  };

  const filteredCourses = trainingCoursesData.filter(course => {
    const matchesSearch = course.title.toLowerCase().includes(courseSearchQuery.toLowerCase()) || 
                          course.description.toLowerCase().includes(courseSearchQuery.toLowerCase());
    const matchesLevel = courseLevelFilter === 'All' || course.level === courseLevelFilter;
    return matchesSearch && matchesLevel;
  });

  return (
    <section id="tech-section" className="py-24 bg-slate-50/50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {/* Section Header */}
        <div className="text-center max-w-2xl mx-auto mb-16">
          <div className="inline-flex items-center gap-1.5 text-emerald-600 font-extrabold text-xs tracking-widest uppercase mb-3">
            <Sparkles className="w-3.5 h-3.5 text-amber-500" />
            TECHNOLOGY & ACADEMY HUB
          </div>
          <h2 className="text-3xl sm:text-4xl font-extrabold text-[#112a1d] tracking-tight leading-tight">
            Let’s Check Our <span className="text-emerald-600">Key Focus Fields</span>
          </h2>
          <p className="text-xs sm:text-sm text-gray-500 leading-relaxed mt-4">
            Transitioning the East African workforce by bridging advanced technological know-how with accredited, state-licensed vocational curricula.
          </p>

          {/* Tab Selector Links */}
          <div className="inline-flex p-1.5 rounded-xl bg-slate-100 border border-slate-200 mt-8 gap-1 shadow-inner">
            <button
              onClick={() => setActiveTab('tech')}
              className={`px-5 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer ${
                activeTab === 'tech'
                  ? 'bg-emerald-600 text-white shadow-md'
                  : 'text-gray-600 hover:text-emerald-950 hover:bg-white/50'
              }`}
            >
              Energy Sectors in Kenya
            </button>
            <button
              onClick={() => setActiveTab('courses')}
              className={`px-5 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer ${
                activeTab === 'courses'
                  ? 'bg-emerald-600 text-white shadow-md'
                  : 'text-gray-600 hover:text-emerald-950 hover:bg-white/50'
              }`}
            >
              Accredited Licensing Courses
            </button>
          </div>
        </div>

        {/* Tab Panel 1: Energy Technologies */}
        <AnimatePresence mode="wait">
          {activeTab === 'tech' && (
            <motion.div
              key="tech"
              initial={{ opacity: 0, y: 15 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -15 }}
              transition={{ duration: 0.3 }}
              className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6"
            >
              {technologiesData.map((tech) => (
                <div
                  key={tech.id}
                  className="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all group"
                >
                  {/* Tech Cover Image */}
                  <div className="h-44 w-full overflow-hidden relative">
                    <span className="absolute top-3 left-3 bg-emerald-600 text-[10px] text-white font-bold py-1 px-2.5 rounded-lg border border-emerald-400/20 shadow-md uppercase">
                      {tech.category}
                    </span>
                    <img
                      src={tech.imageUrl}
                      alt={tech.name}
                      className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                      referrerPolicy="no-referrer"
                    />
                    <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                    <div className="absolute bottom-3 left-3 right-3 text-white">
                      <p className="text-[10px] font-bold text-amber-300 tracking-wider">REGIONAL REPORT</p>
                      <p className="text-xs font-black tracking-tight truncate">{tech.name}</p>
                    </div>
                  </div>

                  {/* Card Content Description */}
                  <div className="p-5 flex flex-col justify-between h-[280px]">
                    <div>
                      <p className="text-xs font-bold text-emerald-700 italic mb-2.5">
                        "{tech.tagline}"
                      </p>
                      <p className="text-xs text-gray-500 leading-relaxed line-clamp-4 mb-3">
                        {tech.description}
                      </p>
                    </div>

                    <div className="border-t border-slate-50 pt-3 space-y-2">
                      <div className="flex gap-1.5 items-start text-[10px] font-medium text-gray-400">
                        <Key className="w-3.5 h-3.5 text-amber-500 shrink-0 mt-0.5" />
                        <span>
                          <strong className="text-gray-600">Licensing Grade:</strong> {tech.licensingBody}
                        </span>
                      </div>
                      <div className="flex gap-1.5 items-start text-[10px] font-medium text-gray-400">
                        <Info className="w-3.5 h-3.5 text-emerald-500 shrink-0 mt-0.5" />
                        <span>
                          <strong className="text-gray-600">Major Assets:</strong> {tech.keyProjects[0]}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              ))}
            </motion.div>
          )}

          {/* Tab Panel 2: Accredited Licensing Courses (matching the course list slider) */}
          {activeTab === 'courses' && (
            <motion.div
              key="courses"
              initial={{ opacity: 0, y: 15 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: -15 }}
              transition={{ duration: 0.3 }}
              id="training-section"
              className="space-y-6"
            >
              
              {/* Filter Search Header */}
              <div className="bg-white p-4.5 rounded-2xl border border-slate-100 flex flex-col sm:flex-row items-center gap-4 justify-between shadow-sm">
                <div className="relative w-full sm:max-w-sm">
                  <Search className="absolute left-3.5 top-3.5 w-4 h-4 text-gray-400" />
                  <input
                    type="text"
                    placeholder="Search course title (e.g. Solar PV, Biogas)..."
                    value={courseSearchQuery}
                    onChange={(e) => setCourseSearchQuery(e.target.value)}
                    className="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none focus:border-emerald-600"
                  />
                </div>

                <div className="flex items-center gap-2 shrink-0 self-stretch sm:self-auto justify-end">
                  <Filter className="w-4 h-4 text-emerald-600" />
                  <span className="text-xs font-bold text-gray-600">Level:</span>
                  <select
                    value={courseLevelFilter}
                    onChange={(e) => setCourseLevelFilter(e.target.value as any)}
                    className="bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-gray-700 outline-none focus:ring-1 focus:ring-emerald-500 cursor-pointer"
                  >
                    <option value="All">All Categories</option>
                    <option value="Basic">Basic (Entry Systems)</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced (C&I Commercial)</option>
                  </select>
                </div>
              </div>

              {/* Courses Matrix */}
              {filteredCourses.length > 0 ? (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                  {filteredCourses.map((course) => (
                    <div
                      key={course.id}
                      className="bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-md transition-all flex flex-col relative group"
                    >
                      {/* Course Header Banner */}
                      <div className="h-48 w-full overflow-hidden relative">
                        {/* Price Badge */}
                        <div className="absolute top-3 right-3 bg-amber-500 text-white font-black text-xs py-1.5 px-3.5 rounded-xl z-10 shadow-lg shadow-amber-500/20 border border-amber-400/20">
                          KES {course.feeKES.toLocaleString()}
                        </div>
                        <img
                          src={course.imageUrl}
                          alt={course.title}
                          className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-350"
                          referrerPolicy="no-referrer"
                        />
                        <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div className="absolute bottom-3 left-3 flex items-center gap-1">
                          <span className="bg-emerald-600 text-[10px] text-white font-bold py-0.5 px-2 rounded">
                            {course.level} ID
                          </span>
                          <span className="bg-white/10 text-[10px] text-white backdrop-blur-sm font-semibold py-0.5 px-2 rounded">
                            {course.duration}
                          </span>
                        </div>
                      </div>

                      {/* Course Mid Details */}
                      <div className="p-5 flex-1 flex flex-col justify-between">
                        <div>
                          {/* Rating Stars */}
                          <div className="flex items-center gap-1.5 mb-3">
                            <div className="flex gap-0.5 text-yellow-500">
                              {[...Array(5)].map((_, i) => (
                                <Star key={i} className="w-3.5 h-3.5 fill-current" />
                              ))}
                            </div>
                            <span className="text-[10px] font-extrabold text-[#112a1d]">{course.rating}</span>
                            <span className="text-[10px] text-gray-400">({course.reviewsCount} verified reviews)</span>
                          </div>

                          {/* Title */}
                          <h3 className="text-base font-extrabold text-[#112a1d] tracking-tight hover:text-emerald-600 transition-colors mb-2">
                            {course.title}
                          </h3>

                          {/* Description */}
                          <p className="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-4">
                            {course.description}
                          </p>
                        </div>

                        {/* Instructor/Co-instructor Box */}
                        <div className="border-t border-slate-100 pt-4 mt-auto">
                          <div className="flex items-center justify-between">
                            <div className="flex items-center gap-2">
                              <div className="w-8 h-8 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 font-bold font-mono text-xs">
                                {course.instructorName.charAt(0)}
                              </div>
                              <div>
                                <p className="text-[10px] font-black text-[#112a1d]">{course.instructorName}</p>
                                <p className="text-[9px] text-gray-400">{course.instructorRole}</p>
                              </div>
                            </div>

                            <button
                              onClick={() => setSelectedCourse(course)}
                              className="inline-flex items-center justify-center p-2 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white transition-colors cursor-pointer"
                              title="Enroll and scheduling information"
                            >
                              <BookOpen className="w-4 h-4" />
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              ) : (
                <div className="text-center py-16 bg-white rounded-2xl border border-slate-100 p-8 shadow-sm">
                  <BookOpen className="w-12 h-12 text-gray-300 mx-auto mb-3" />
                  <p className="text-sm font-bold text-[#112a1d]">No courses matched your search.</p>
                  <p className="text-xs text-gray-400 mt-1">Try another keyword or search term.</p>
                </div>
              )}
            </motion.div>
          )}
        </AnimatePresence>


      </div>

      {/* Interactive Modal Course detail & Enrollment */}
      {selectedCourse && (
        <div className="fixed inset-0 z-50 bg-[#112a1d]/65 backdrop-blur-sm flex items-center justify-center p-4">
          <div 
            className="bg-white rounded-2xl max-w-lg w-full overflow-hidden border border-slate-100 shadow-2xl animate-in fade-in zoom-in-95 duration-200"
            onClick={(e) => e.stopPropagation()}
          >
            {/* Banner block */}
            <div className="bg-[#112a1d] text-white p-6 relative">
              <button
                onClick={() => setSelectedCourse(null)}
                className="absolute top-4 right-4 text-emerald-300 hover:text-white p-1 rounded-lg hover:bg-white/10"
              >
                <X className="w-4 h-4" />
              </button>
              <span className="bg-amber-500 text-white text-[9px] uppercase font-black tracking-widest px-2 py-0.5 rounded shadow">
                CURRICULUM ACCREDITED
              </span>
              <h3 className="text-lg font-black tracking-tight mt-2">{selectedCourse.title}</h3>
              <p className="text-xs text-emerald-200/80 mt-1">Course duration: {selectedCourse.duration}</p>
            </div>

            {/* Modal fields info */}
            <div className="p-6">
              {isRegisterSuccess ? (
                <div className="text-center py-6">
                  <div className="w-12 h-12 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-500 flex items-center justify-center mx-auto mb-4 animate-bounce">
                    <Zap className="w-6 h-6 fill-current" />
                  </div>
                  <h4 className="text-base font-bold text-[#112a1d]">Syllabus Request Received!</h4>
                  <p className="text-xs text-gray-400 mt-2">
                    An email containing the T1-T3 syllabus and enrollment application form has been dispatched to your address.
                  </p>
                </div>
              ) : (
                <form onSubmit={handleRegisterSubmit} className="space-y-4">
                  <div>
                    <h4 className="text-xs font-bold text-[#112a1d] tracking-wide uppercase mb-1">Key Curriculum Includes:</h4>
                    <p className="text-xs text-gray-500 leading-relaxed pr-2 italic">
                      {selectedCourse.description}
                    </p>
                  </div>

                  <div className="grid grid-cols-2 gap-3 text-xs border-y border-slate-50 py-3 mt-2">
                    <div>
                      <span className="text-gray-400 font-medium">Standard Dues:</span>
                      <p className="font-bold text-[#112a1d]">KES {selectedCourse.feeKES.toLocaleString()}</p>
                    </div>
                    <div>
                      <span className="text-gray-400 font-medium">Certification Grade:</span>
                      <p className="font-bold text-[#112a1d] text-emerald-600 truncate">{selectedCourse.certification}</p>
                    </div>
                  </div>

                  {/* Syllabus / Register Form */}
                  <div className="pt-2">
                    <span className="text-xs font-heavy text-[#112a1d] block mb-2 font-bold uppercase">
                      Request Syllabus & Exam Dues Guide:
                    </span>
                    <div className="space-y-2.5">
                      <input
                        required
                        type="text"
                        placeholder="Your full name"
                        value={registerForm.name}
                        onChange={(e) => setRegisterForm({ ...registerForm, name: e.target.value })}
                        className="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none"
                      />
                      <div className="grid grid-cols-2 gap-2">
                        <input
                          required
                          type="email"
                          placeholder="Email address"
                          value={registerForm.email}
                          onChange={(e) => setRegisterForm({ ...registerForm, email: e.target.value })}
                          className="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none"
                        />
                        <input
                          required
                          type="tel"
                          placeholder="Phone number"
                          value={registerForm.phone}
                          onChange={(e) => setRegisterForm({ ...registerForm, phone: e.target.value })}
                          className="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs focus:ring-1 focus:ring-emerald-500 focus:outline-none"
                        />
                      </div>
                    </div>
                  </div>

                  {/* Buttons */}
                  <div className="flex gap-2.5 pt-4">
                    <button
                      type="button"
                      onClick={() => setSelectedCourse(null)}
                      className="w-1/3 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-600 font-bold rounded-lg text-xs border border-gray-100 transition-colors"
                    >
                      Cancel
                    </button>
                    <button
                      type="submit"
                      className="w-2/3 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-lg text-xs shadow-md shadow-orange-500/20 hover:opacity-95 transition-all"
                    >
                      REQUEST DETAILS & REGISTRATION
                    </button>
                  </div>
                </form>
              )}
            </div>
          </div>
        </div>
      )}

    </section>
  );
}
