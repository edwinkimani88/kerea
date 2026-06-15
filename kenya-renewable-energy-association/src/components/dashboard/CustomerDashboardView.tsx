import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ShoppingBag, 
  Trash2, 
  Coins, 
  HelpCircle, 
  CheckCircle, 
  LifeBuoy, 
  Clock, 
  Sparkles, 
  ArrowRight,
  UserCheck,
  FileText,
  MessageSquarePlus,
  LogOut
} from 'lucide-react';

export default function CustomerDashboardView() {
  const { 
    currentUser, 
    logoutCurrentUser, 
    orders, 
    products, 
    releaseOrderEscrowPayment, 
    supportTickets, 
    openNewSupportTicket,
    logUserAction
  } = useAppState();

  const [ticketSubject, setTicketSubject] = useState('');
  const [ticketDesc, setTicketDesc] = useState('');
  const [ticketSuccess, setTicketSuccess] = useState(false);

  if (!currentUser) return null;

  // Filter orders placed by this customer
  const customerOrders = orders.filter(o => o.userId === currentUser.email);

  // Filter support tickets filed by this customer
  const customerTickets = supportTickets.filter(t => t.userId === currentUser.email);

  const handleCreateTicketSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (!ticketSubject || !ticketDesc) return;

    openNewSupportTicket(ticketSubject, ticketDesc);
    setTicketSubject('');
    setTicketDesc('');
    setTicketSuccess(true);
    
    setTimeout(() => {
      setTicketSuccess(false);
    }, 2800);
  };

  const handleReleasePayment = (orderId: string) => {
    const doubleCheck = window.confirm('Are you absolutely certain you want to release held escrow funds directly to this vendor? This action is legally irreversible.');
    if (doubleCheck) {
      releaseOrderEscrowPayment(orderId);
      alert('Escrow balance released safely! Payments settled inside vendor registries.');
    }
  };

  return (
    <div className="space-y-12 pb-16">
      
      {/* Customer Header Row */}
      <section className="bg-slate-50 border border-slate-150 p-6 sm:p-8 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div className="space-y-1">
          <div className="flex items-center gap-2">
            <span className="text-[10px] uppercase font-black px-2.5 py-0.5 rounded bg-emerald-650 text-white">
              VERIFIED CLIENT PROFILE
            </span>
            <span className="text-xs text-gray-400 font-mono">Sync active</span>
          </div>
          <h2 className="text-xl font-black text-[#112a1d]">Welcome, Member: {currentUser.name}</h2>
          <p className="text-xs text-slate-500 font-sans">Official registration: {currentUser.email} • Standard Escrow Privileges</p>
        </div>

        <button
          onClick={logoutCurrentUser}
          className="px-5 py-2 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl cursor-pointer select-none flex items-center gap-1.5"
        >
          <LogOut className="w-4 h-4" /> Sign Out
        </button>
      </section>

      {/* Main Grid: Escrow purchases vs Helpdesk Ticket submission */}
      <section className="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {/* Left Column: Escrow Transactions */}
        <div className="lg:col-span-7 bg-white p-6 border border-slate-100 rounded-2xl shadow-sm space-y-5">
          <div className="flex justify-between items-center">
            <h3 className="text-sm font-black text-[#112a1d]">My Escrow Transactions</h3>
            <span className="text-[10px] uppercase font-bold text-gray-400 font-mono">
              {customerOrders.length} Transactions logged
            </span>
          </div>

          {customerOrders.length > 0 ? (
            <div className="space-y-4">
              {customerOrders.map(ord => {
                const matchedProd = products.find(p => p.id === ord.productId);
                return (
                  <div key={ord.id} className="p-4 border border-slate-150 rounded-xl space-y-3">
                    <div className="flex justify-between items-center">
                      <span className="text-[9px] font-mono text-gray-400">Order ID: {ord.id}</span>
                      <span className={`text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded ${
                        ord.escrowStatus === 'Escrow_Held' ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-green-100 text-emerald-800'
                      }`}>
                        {ord.escrowStatus === 'Escrow_Held' ? 'Escrow Held' : 'Released (Settled)'}
                      </span>
                    </div>

                    <div className="text-xs">
                      <p className="font-bold text-[#112a1d]">{matchedProd?.title || 'Unknown Components'}</p>
                      <p className="text-slate-400 mt-0.5">Seller Account: {ord.vendorName}</p>
                    </div>

                    <div className="flex justify-between items-center pt-3 border-t border-slate-50 text-xs">
                      <span className="font-black text-emerald-805">KES {ord.totalKES.toLocaleString()}</span>
                      
                      {ord.escrowStatus === 'Escrow_Held' ? (
                        <button
                          onClick={() => handleReleasePayment(ord.id)}
                          className="px-4 py-1.5 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-[10px] rounded-lg cursor-pointer transition-colors"
                        >
                          Release Funds
                        </button>
                      ) : (
                        <span className="text-[10px] text-emerald-700 font-bold flex items-center gap-1">
                          <CheckCircle className="w-3.5 h-3.5" /> Settled completely
                        </span>
                      )}
                    </div>
                  </div>
                );
              })}
            </div>
          ) : (
            <div className="text-center py-12 p-8 border border-dashed border-slate-205 rounded-xl">
              <ShoppingBag className="w-10 h-10 text-slate-350 mx-auto mb-2" />
              <p className="text-xs text-gray-450 leading-relaxed max-w-xs mx-auto">
                No purchases yet. Go to the <span className="text-emerald-700 underline font-semibold cursor-pointer">Escrow Marketplace</span> to purchase verified off-grid hardware.
              </p>
            </div>
          )}
        </div>

        {/* Right Column: File Support Tickets & View filed tickets list */}
        <div className="lg:col-span-5 space-y-6">
          
          <form onSubmit={handleCreateTicketSubmit} className="bg-slate-50 p-6 border border-slate-150 rounded-2xl space-y-4">
            <h3 className="text-xs font-black uppercase text-[#112a1d] tracking-widest flex items-center gap-1.5">
              <MessageSquarePlus className="w-4 h-4 text-emerald-700 font-black" /> File Dispute or Technical Help
            </h3>

            {ticketSuccess && (
              <div className="p-3 bg-emerald-50 text-emerald-800 text-[11px] font-bold rounded-xl border border-emerald-100">
                Ticket logged! Admins are reviewing details.
              </div>
            )}

            <div>
              <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Inquiry/Dispute Topic</label>
              <input 
                type="text" 
                required
                value={ticketSubject}
                onChange={e => setTicketSubject(e.target.value)}
                placeholder="e.g. Escrow Refund Request on Solar PV Array" 
                className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
              />
            </div>

            <div>
              <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Details & EPRA references</label>
              <textarea 
                required
                rows={3}
                value={ticketDesc}
                onChange={e => setTicketDesc(e.target.value)}
                placeholder="Describe shipping transit problems or defective hardware performance..." 
                className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
              ></textarea>
            </div>

            <button
              type="submit"
              className="w-full py-2.5 bg-[#112a1d] hover:bg-emerald-750 text-white font-bold text-xs rounded-xl cursor-pointer select-none"
            >
              Raise Helpdesk Ticket
            </button>
          </form>

          {/* Miniature view of logged dispute files */}
          <div className="bg-white border border-slate-100 p-5 rounded-2xl space-y-3.5">
            <h4 className="text-xs font-black text-[#112a1d]">My Active Tickets ({customerTickets.length})</h4>
            <div className="space-y-3.5 text-xs text-slate-505">
              {customerTickets.map(t => (
                <div key={t.id} className="py-2 border-b border-slate-50 last:border-0 space-y-1">
                  <div className="flex justify-between items-center">
                    <span className="font-bold truncate pr-3">{t.subject}</span>
                    <span className={`text-[9px] uppercase font-black px-1.5 py-0.5 rounded ${
                      t.status === 'Open' ? 'bg-red-50 text-red-800' : 'bg-emerald-50 text-emerald-800'
                    }`}>
                      {t.status}
                    </span>
                  </div>
                  <p className="text-[10px] text-gray-400 font-sans line-clamp-2">{t.description}</p>
                </div>
              ))}
            </div>
          </div>

        </div>

      </section>

    </div>
  );
}
