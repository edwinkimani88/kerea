import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { Calendar, MapPin, GraduationCap, Users, Clock, ArrowRight, UserCheck, X } from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';
import { EventBooking } from '../../types';

type SubView = 'all' | 'training' | 'workshop' | 'past';

export default function EventsView() {
  const { events, addNewEvent, logUserAction } = useAppState();
  const [activeTab, setActiveTab] = useState<SubView>('all');
  const [selectedEvent, setSelectedEvent] = useState<EventBooking | null>(null);
  const [bookingFormData, setBookingFormData] = useState({ name: '', email: '', phone: '', org: '' });
  const [bookingSuccess, setBookingSuccess] = useState(false);

  // Filter events by tab
  const getFilteredEvents = () => {
    if (activeTab === 'training') return events.filter(e => e.type === 'Training');
    if (activeTab === 'workshop') return events.filter(e => e.type === 'Workshop');
    if (activeTab === 'past') {
      // simulate past events based on year
      return [
        { id: 'past-1', title: 'National Biomas Gasification Summit 24', type: 'Event' as const, date: '2024-11-12', location: 'Nairobi', feeKES: 0, description: 'Closed event reviewing regional sugarcane residue generation grids.', registeredAttendees: 110 }
      ];
    }
    return events;
  };

  const currentEvents = getFilteredEvents();

  const handleBookingSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!bookingFormData.name || !bookingFormData.email) return;

    // Simulate database registration
    if (selectedEvent) {
      selectedEvent.registeredAttendees = (selectedEvent.registeredAttendees || 0) + 1;
      logUserAction('Event Booked', `Seat reserved for ${bookingFormData.name} on event: ${selectedEvent.title}`);
    }

    setBookingSuccess(true);
    setTimeout(() => {
      setBookingSuccess(false);
      setSelectedEvent(null);
      setBookingFormData({ name: '', email: '', phone: '', org: '' });
    }, 2500);
  };

  return (
    <div className="space-y-12 pb-16">
      {/* Editorial Header */}
      <section className="text-center max-w-3xl mx-auto px-4 pt-4">
        <span className="text-amber-600 font-extrabold text-xs tracking-widest uppercase mb-3 block">
          CAPACITY BUILDING & ECOSYSTEM SUMMITS
        </span>
        <h1 className="text-3xl sm:text-4xl font-black text-[#112a1d] tracking-tight">
          Events Calendar & Technical Trainings
        </h1>
        <p className="text-xs sm:text-sm text-gray-500 mt-2">
          Upskill your technicians under the country’s leading energy researchers, prepare for EPRA licensing assessments, or purchase delegates passes to continental energy expos.
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
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Upcoming Events & Seminars
          </button>
          <button
            onClick={() => setActiveTab('training')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'training'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Trainings (EPRA Prep)
          </button>
          <button
            onClick={() => setActiveTab('workshop')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'workshop'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Workshops
          </button>
          <button
            onClick={() => setActiveTab('past')}
            className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
              activeTab === 'past'
                ? 'border-emerald-600 text-emerald-700'
                : 'border-transparent text-gray-500 hover:text-emerald-600'
            }`}
          >
            Past Events
          </button>
        </div>
      </section>

      {/* Events Grid List */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {currentEvents.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            {currentEvents.map(evt => (
              <div 
                key={evt.id}
                className="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
              >
                <div>
                  <div className="flex justify-between items-start mb-4">
                    <span className="text-[10px] uppercase font-black px-2.5 py-1 rounded bg-emerald-50 text-emerald-900 border border-emerald-100">
                      {evt.type}
                    </span>
                    <span className="text-xs font-mono font-bold text-slate-500">
                      KES {evt.feeKES > 0 ? evt.feeKES.toLocaleString() : 'FREE'}
                    </span>
                  </div>

                  <h3 className="text-base font-extrabold text-[#112a1d] leading-snug group-hover:text-emerald-700 transition-colors">
                    {evt.title}
                  </h3>
                  
                  <p className="text-xs text-gray-500 mt-2.5 leading-relaxed font-sans line-clamp-3">
                    {evt.description}
                  </p>

                  <div className="pt-4 mt-4 border-t border-slate-50 space-y-2 text-xs text-gray-400">
                    <p className="flex items-center gap-2">
                      <Calendar className="w-4 h-4 text-slate-400" />
                      <span>Date: <strong className="text-gray-500">{evt.date}</strong></span>
                    </p>
                    <p className="flex items-center gap-2">
                      <MapPin className="w-4 h-4 text-slate-400" />
                      <span>Location: <strong className="text-gray-500">{evt.location}</strong></span>
                    </p>
                    <p className="flex items-center gap-2">
                      <Clock className="w-4 h-4 text-slate-400" />
                      <span>Registered: <strong className="text-emerald-700">{evt.registeredAttendees} delegates</strong></span>
                    </p>
                  </div>
                </div>

                <div className="pt-6">
                  {activeTab === 'past' ? (
                    <button disabled className="w-full py-2.5 bg-slate-100 text-gray-400 text-xs font-bold rounded-xl cursor-not-allowed">
                      Archive Completed
                    </button>
                  ) : (
                    <button
                      onClick={() => setSelectedEvent(evt)}
                      className="w-full py-2.5 bg-[#112a1d] hover:bg-emerald-600 hover:scale-[1.01] text-white text-xs font-bold rounded-xl transition-all cursor-pointer block text-center"
                    >
                      Book Seat / Apply Cohort
                    </button>
                  )}
                </div>

              </div>
            ))}
          </div>
        ) : (
          <div className="text-center py-12 max-w-sm mx-auto bg-white border border-slate-100 p-8 rounded-2xl">
            <Calendar className="w-12 h-12 text-slate-300 mx-auto mb-2" />
            <h3 className="text-sm font-bold text-[#112a1d]">No active schedules found</h3>
            <p className="text-xs text-slate-400 mt-1">Please selection other subtabs or check back on bulletins.</p>
          </div>
        )}
      </section>

      {/* Booking Dialog Form Overlay */}
      <AnimatePresence>
        {selectedEvent && (
          <motion.div 
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="fixed inset-0 z-55 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 shadow-2xl"
          >
            <motion.div 
              initial={{ scale: 0.95 }}
              animate={{ scale: 1 }}
              exit={{ scale: 0.95 }}
              className="bg-white rounded-2xl max-w-md w-full overflow-hidden p-6 sm:p-8 relative border border-slate-100"
            >
              <button
                onClick={() => setSelectedEvent(null)}
                className="absolute top-4 right-4 p-1 rounded hover:bg-slate-150 cursor-pointer text-gray-500"
              >
                <X className="w-5 h-5" />
              </button>

              {bookingSuccess ? (
                <div className="text-center py-8 space-y-4">
                  <div className="w-12 h-12 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center mx-auto">
                    <UserCheck className="w-6 h-6 animate-bounce" />
                  </div>
                  <h3 className="text-base font-black text-[#112a1d]">Seat Reserved Successfully!</h3>
                  <p className="text-xs text-gray-400">An official KEREA confirmation invoice and curriculum calendar has safety-sent to your mailbox.</p>
                </div>
              ) : (
                <form onSubmit={handleBookingSubmit} className="space-y-4">
                  <div>
                    <span className="text-[10px] uppercase tracking-widest font-bold text-amber-600">{selectedEvent.type} REGISTRATION</span>
                    <h3 className="text-base font-black text-[#112a1d] leading-snug mt-1">{selectedEvent.title}</h3>
                    <p className="text-xs text-gray-500 mt-0.5">Seat Fee: KES {selectedEvent.feeKES.toLocaleString()}</p>
                  </div>

                  <div className="space-y-3 pt-4">
                    <div>
                      <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Full Applicant Name</label>
                      <input 
                        type="text" 
                        required
                        value={bookingFormData.name}
                        onChange={e => setBookingFormData({...bookingFormData, name: e.target.value})}
                        placeholder="e.g. Eng. George Kipkirui" 
                        className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                      />
                    </div>
                    <div>
                      <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Delegate Email Address</label>
                      <input 
                        type="email" 
                        required
                        value={bookingFormData.email}
                        onChange={e => setBookingFormData({...bookingFormData, email: e.target.value})}
                        placeholder="e.g. corporate@company.co.ke" 
                        className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                      />
                    </div>
                    <div className="grid grid-cols-2 gap-3">
                      <div>
                        <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Phone Number</label>
                        <input 
                          type="tel"
                          value={bookingFormData.phone}
                          onChange={e => setBookingFormData({...bookingFormData, phone: e.target.value})}
                          placeholder="+254" 
                          className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                        />
                      </div>
                      <div>
                        <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Organization</label>
                        <input 
                          type="text"
                          value={bookingFormData.org}
                          onChange={e => setBookingFormData({...bookingFormData, org: e.target.value})}
                          placeholder="e.g. Safi Ltd" 
                          className="w-full text-xs p-3 border border-slate-200 rounded-xl focus:border-emerald-600 focus:outline-none"
                        />
                      </div>
                    </div>
                  </div>

                  <button
                    type="submit"
                    className="w-full py-3 bg-[#112a1d] hover:bg-emerald-700 text-white text-xs font-bold rounded-xl transition-all cursor-pointer select-none"
                  >
                    Confirm Delegate Booking KES {selectedEvent.feeKES.toLocaleString()}
                  </button>
                </form>
              )}

            </motion.div>
          </motion.div>
        )}
      </AnimatePresence>
    </div>
  );
}
