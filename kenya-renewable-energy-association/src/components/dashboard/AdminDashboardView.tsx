import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  PlusCircle, 
  Trash2, 
  FileText, 
  Calendar, 
  Activity, 
  HelpCircle, 
  Search, 
  CheckCircle, 
  Clock, 
  User, 
  Wrench, 
  MessageSquare,
  AlertOctagon,
  LogOut,
  Sliders
} from 'lucide-react';

export default function AdminDashboardView() {
  const { 
    currentUser, 
    logoutCurrentUser, 
    blogs, 
    addNewBlog, 
    events, 
    addNewEvent, 
    supportTickets, 
    updateTicketStatus, 
    auditLogs,
    logUserAction
  } = useAppState();

  const [activeWorkspace, setActiveWorkspace] = useState<'cms' | 'tickets' | 'audits'>('cms');

  // CMS state form
  const [blogTitle, setBlogTitle] = useState('');
  const [blogContent, setBlogContent] = useState('');
  const [blogCategory, setBlogCategory] = useState<'News' | 'Article' | 'Impact Story'>('News');

  // Event state form
  const [eventTitle, setEventTitle] = useState('');
  const [eventType, setEventType] = useState<'Training' | 'Workshop' | 'Event'>('Training');
  const [eventFee, setEventFee] = useState(15000);
  const [eventLocation, setEventLocation] = useState('Strathmore SERC Labs, Nairobi');
  const [eventDesc, setEventDesc] = useState('');

  // Filtering Support ticketing
  const [ticketSearch, setTicketSearch] = useState('');
  const [ticketFilterStatus, setTicketFilterStatus] = useState<'All' | 'Open' | 'Pending' | 'Resolved'>('All');

  const filteredTickets = supportTickets.filter(t => {
    if (ticketFilterStatus !== 'All' && t.status !== ticketFilterStatus) return false;
    if (ticketSearch) {
      return t.subject.toLowerCase().includes(ticketSearch.toLowerCase()) || t.userId.toLowerCase().includes(ticketSearch.toLowerCase());
    }
    return true;
  });

  const handleCreateBlog = (e: React.FormEvent) => {
    e.preventDefault();
    if (!blogTitle || !blogContent) return;

    addNewBlog(blogTitle, blogContent, blogCategory);
    setBlogTitle('');
    setBlogContent('');
    alert('Dynamic CMS Blog successfully added to system memory!');
  };

  const handleCreateEvent = (e: React.FormEvent) => {
    e.preventDefault();
    if (!eventTitle || !eventDesc) return;

    addNewEvent(eventTitle, eventType, eventFee, eventLocation, eventDesc);
    setEventTitle('');
    setEventDesc('');
    alert('Interactive event added safely to standard technical streams!');
  };

  if (!currentUser) return null;

  return (
    <div className="space-y-12 pb-16">
      
      {/* Dashboard Top Header bar */}
      <section className="bg-slate-50 border border-slate-150 p-6 sm:p-8 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div className="space-y-1">
          <div className="flex items-center gap-2">
            <span className="text-[10px] uppercase font-black px-2.5 py-0.5 rounded bg-[#112a1d] text-white">
              ADMIN CONTROL PANEL
            </span>
            <span className="text-xs text-gray-400 font-mono">Session Live</span>
          </div>
          <h2 className="text-xl font-black text-[#112a1d]">Welcome, Administrator: {currentUser.name}</h2>
          <p className="text-xs text-slate-500 font-sans">Role privileges: Full CRUD, Content Moderation, and Ticket Audits.</p>
        </div>

        <button
          onClick={logoutCurrentUser}
          className="px-5 py-2 bg-red-600 hover:bg-red-700 text-white font-bold text-xs rounded-xl cursor-pointer select-none flex items-center gap-1.5"
        >
          <LogOut className="w-4 h-4" /> Sign Out from Admin
        </button>
      </section>

      {/* Internal Workspace Switch Tabs */}
      <section className="flex border-b border-gray-200 overflow-x-auto whitespace-nowrap justify-start lg:justify-center gap-1 sm:gap-4 scrollbar-none">
        <button
          onClick={() => setActiveWorkspace('cms')}
          className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
            activeWorkspace === 'cms'
              ? 'border-emerald-600 text-emerald-700'
              : 'border-transparent text-gray-500 hover:text-emerald-600'
          }`}
        >
          Content CMS (Blogs & Events)
        </button>
        <button
          onClick={() => setActiveWorkspace('tickets')}
          className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
            activeWorkspace === 'tickets'
              ? 'border-emerald-600 text-emerald-700'
              : 'border-transparent text-gray-500 hover:text-emerald-600'
          }`}
        >
          Ticketing Hub ({supportTickets.length})
        </button>
        <button
          onClick={() => setActiveWorkspace('audits')}
          className={`py-3 px-4 font-bold text-xs uppercase cursor-pointer border-b-2 transition-colors ${
            activeWorkspace === 'audits'
              ? 'border-emerald-600 text-emerald-700'
              : 'border-transparent text-gray-500 hover:text-emerald-600'
          }`}
        >
          Audit Logs Diagnostic
        </button>
      </section>

      {/* Workspace Area rendering */}
      <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {activeWorkspace === 'cms' && (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            
            {/* Form Column A: Create Blog Story */}
            <form onSubmit={handleCreateBlog} className="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
              <div className="flex items-center gap-2 mb-2">
                <FileText className="w-5 h-5 text-emerald-700" />
                <h3 className="text-sm font-black text-[#112a1d]">Publish CMS Blog Story</h3>
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Story Category</label>
                <select 
                  value={blogCategory}
                  onChange={e => setBlogCategory(e.target.value as any)}
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-white focus:outline-none"
                >
                  <option value="News">News Release</option>
                  <option value="Article">Technical Article</option>
                  <option value="Impact Story">Impact Story (Success Cases)</option>
                </select>
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Article Headline Title</label>
                <input 
                  type="text" 
                  required
                  value={blogTitle}
                  onChange={e => setBlogTitle(e.target.value)}
                  placeholder="e.g. EPC Tax exemptions on Lithium Battery units..." 
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
                />
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Article content body</label>
                <textarea 
                  required
                  rows={4}
                  value={blogContent}
                  onChange={e => setBlogContent(e.target.value)}
                  placeholder="Clearly spell out policy guidelines, EPRA regulatory references..." 
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
                ></textarea>
              </div>

              <button
                type="submit"
                className="w-full py-2.5 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl cursor-pointer"
              >
                Send to CMS Feed
              </button>
            </form>

            {/* Form Column B: Schedule Technical Training */}
            <form onSubmit={handleCreateEvent} className="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
              <div className="flex items-center gap-2 mb-2">
                <Calendar className="w-5 h-5 text-emerald-700" />
                <h3 className="text-sm font-black text-[#112a1d]">Publish Professional Training</h3>
              </div>

              <div className="grid grid-cols-2 gap-3">
                <div>
                  <label className="block text-[10px] font-bold text-gray-400 uppercase mb-1">Event Category</label>
                  <select
                    value={eventType}
                    onChange={e => setEventType(e.target.value as any)}
                    className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-white"
                  >
                    <option value="Training">Training (Certification)</option>
                    <option value="Workshop">Interactive Workshop</option>
                    <option value="Event">Summit / Webinar</option>
                  </select>
                </div>
                <div>
                  <label className="block text-[10px] font-bold text-gray-400 uppercase mb-1">Seat Fee (KES)</label>
                  <input 
                    type="number" 
                    required
                    value={eventFee}
                    onChange={e => setEventFee(Number(e.target.value))}
                    className="w-full text-xs p-3 border border-slate-205 rounded-xl"
                  />
                </div>
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase mb-1">Training Title (EPRA Syllabus code)</label>
                <input 
                  type="text" 
                  required
                  value={eventTitle}
                  onChange={e => setEventTitle(e.target.value)}
                  placeholder="e.g. Grid-connected Solar Systems Class T3 Prep" 
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
                />
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase mb-1">Secretariat Training Venue Address</label>
                <input 
                  type="text" 
                  required
                  value={eventLocation}
                  onChange={e => setEventLocation(e.target.value)}
                  placeholder="Strathmore SERC Research Center, Nairobi" 
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
                />
              </div>

              <div>
                <label className="block text-[10px] font-bold text-gray-400 uppercase mb-1">Syllabus Breakdown</label>
                <textarea 
                  required
                  rows={2}
                  value={eventDesc}
                  onChange={e => setEventDesc(e.target.value)}
                  placeholder="e.g. 5-day intensive syllabus covering active grid sync limits." 
                  className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
                ></textarea>
              </div>

              <button
                type="submit"
                className="w-full py-2.5 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl cursor-pointer"
              >
                Schedule & Invite Members
              </button>
            </form>

          </div>
        )}

        {activeWorkspace === 'tickets' && (
          <div className="max-w-5xl mx-auto space-y-6">
            
            {/* Tickets filtering */}
            <div className="flex flex-col sm:flex-row gap-4">
              <div className="flex-1 relative">
                <input 
                  type="text"
                  value={ticketSearch}
                  onChange={e => setTicketSearch(e.target.value)}
                  placeholder="Search tickets by subject, buyer..."
                  className="w-full text-xs p-3 pl-10 border border-slate-200 rounded-xl bg-white"
                />
                <Search className="absolute left-3.5 top-3.5 w-4 h-4 text-gray-300" />
              </div>
              <div className="sm:w-48">
                <select
                  value={ticketFilterStatus}
                  onChange={e => setTicketFilterStatus(e.target.value as any)}
                  className="w-full text-xs p-3 border border-slate-200 bg-white rounded-xl font-bold"
                >
                  <option value="All">All Statuses</option>
                  <option value="Open">Open (Action Needed)</option>
                  <option value="Pending">Pending (Escrow Locked)</option>
                  <option value="Resolved">Resolved</option>
                </select>
              </div>
            </div>

            {/* Ticket Cards */}
            {filteredTickets.length > 0 ? (
              <div className="space-y-4">
                {filteredTickets.map(ticket => (
                  <div key={ticket.id} className="bg-white rounded-2xl border border-slate-100 p-5 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div className="space-y-1">
                      <div className="flex items-center gap-3">
                        <span className={`text-[9px] uppercase font-black px-2 py-0.5 rounded ${
                          ticket.status === 'Open'
                            ? 'bg-red-50 text-red-800 border border-red-100'
                            : ticket.status === 'Pending'
                            ? 'bg-amber-50 text-amber-800 border border-amber-100'
                            : 'bg-emerald-50 text-emerald-800 border border-emerald-100'
                        }`}>
                          {ticket.status}
                        </span>
                        <span className="text-[10px] text-gray-400 font-mono">Reference Ticket ID: {ticket.id}</span>
                      </div>
                      <h4 className="text-xs sm:text-sm font-black text-[#112a1d]">{ticket.subject}</h4>
                      <div className="flex gap-4 text-[10px] text-gray-400 font-mono">
                        <span>Created: {ticket.dateCreated}</span>
                        <span>Filer: {ticket.userId}</span>
                      </div>
                      <p className="text-xs text-slate-500 font-sans max-w-xl">{ticket.description}</p>
                    </div>

                    <div className="flex gap-2 shrink-0">
                      {ticket.status !== 'Resolved' && (
                        <button
                          onClick={() => {
                            updateTicketStatus(ticket.id, 'Resolved');
                            alert('Ticket resolved successfully! Vendor notifications updated.');
                          }}
                          className="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs rounded-xl cursor-pointer"
                        >
                          Resolve Complaint
                        </button>
                      )}
                      {ticket.status === 'Open' && (
                        <button
                          onClick={() => {
                            updateTicketStatus(ticket.id, 'Pending');
                            alert('Ticket transitioned to Pending review state.');
                          }}
                          className="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs rounded-xl cursor-pointer"
                        >
                          Hold Escrow Refund
                        </button>
                      )}
                    </div>

                  </div>
                ))}
              </div>
            ) : (
              <div className="text-center py-16 bg-white border border-slate-150 rounded-2xl">
                <Wrench className="w-12 h-12 text-slate-300 mx-auto mb-2" />
                <h4 className="text-xs font-bold text-gray-500">No matching tickets found</h4>
                <p className="text-[11px] text-gray-400">Please relax search criteria parameters.</p>
              </div>
            )}

          </div>
        )}

        {activeWorkspace === 'audits' && (
          <div className="max-w-5xl mx-auto space-y-4">
            <div className="flex justify-between items-center bg-slate-100/60 p-4 rounded-xl">
              <span className="text-xs font-bold text-[#112a1d]">System Security Stream (Reactive Event Logs)</span>
              <span className="text-[10px] font-mono font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded">
                {auditLogs.length} Active events logged
              </span>
            </div>

            <div className="bg-[#112a1d] text-white p-5 rounded-2xl font-mono text-[10px] overflow-x-auto whitespace-nowrap h-96 overflow-y-auto space-y-2.5">
              {auditLogs.map(log => (
                <div key={log.id} className="flex gap-3 hover:bg-emerald-950 p-1.5 rounded transition-transform">
                  <span className="text-amber-400">[{log.timestamp}]</span>
                  <span className="text-teal-300">({log.action})</span>
                  <span className="text-slate-200">{log.details}</span>
                  <span className="text-gray-400">Logged IP: {log.ipAddress}</span>
                </div>
              ))}
            </div>
          </div>
        )}

      </section>

    </div>
  );
}
