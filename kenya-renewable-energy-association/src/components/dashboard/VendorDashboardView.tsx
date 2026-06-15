import React, { useState } from 'react';
import { useAppState } from '../../context/AppStateContext';
import { 
  ShoppingBag, 
  Coins, 
  Layers, 
  TrendingUp, 
  Check, 
  Truck, 
  RefreshCw, 
  CheckCircle,
  Clock,
  LogOut,
  AlertTriangle
} from 'lucide-react';

export default function VendorDashboardView() {
  const { 
    currentUser, 
    logoutCurrentUser, 
    products, 
    orders, 
    releaseOrderEscrowPayment, 
    updateProductStock,
    logUserAction
  } = useAppState();

  const [restockProductId, setRestockProductId] = useState('');
  const [restockAmount, setRestockAmount] = useState(10);

  if (!currentUser) return null;

  // Filter products owned by this vendor
  const vendorProducts = products.filter(p => p.vendorId === currentUser.id);

  // Filter orders containing this vendor's products
  const vendorOrders = orders.filter(o => o.vendorId === currentUser.id);

  // Math balances
  const pendingEscrowBalance = vendorOrders
    .filter(o => o.escrowStatus === 'Escrow_Held')
    .reduce((sum, o) => sum + o.totalKES, 0);

  const releasedPayouts = vendorOrders
    .filter(o => o.escrowStatus === 'Escrow_Released')
    .reduce((sum, o) => sum + o.totalKES, 0);

  const handleRestock = (e: React.FormEvent) => {
    e.preventDefault();
    if (!restockProductId) return;

    updateProductStock(restockProductId, restockAmount);
    alert('Stock restocked safely in catalog! Synced in client space.');
  };

  return (
    <div className="space-y-12 pb-16">
      
      {/* Vendor Top Header Bar */}
      <section className="bg-slate-50 border border-slate-150 p-6 sm:p-8 rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div className="space-y-1">
          <div className="flex items-center gap-2">
            <span className="text-[10px] uppercase font-black px-2.5 py-0.5 rounded bg-amber-500 text-white">
              VERIFIED KEREA VENDOR
            </span>
            <span className="text-xs text-gray-400 font-mono">ID: {currentUser.id}</span>
          </div>
          <h2 className="text-xl font-black text-[#112a1d]">Welcome, Partner: {currentUser.companyName || currentUser.name}</h2>
          <p className="text-xs text-slate-500 font-sans">Authorized catalog: Solar PV systems, chargers, and hybrid storage arrays.</p>
        </div>

        <button
          onClick={logoutCurrentUser}
          className="px-5 py-2 bg-slate-900 hover:bg-black text-white font-bold text-xs rounded-xl cursor-pointer select-none flex items-center gap-1.5"
        >
          <LogOut className="w-4 h-4" /> Log Out
        </button>
      </section>

      {/* Escrow Financial Balance Counters */}
      <section className="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <div className="p-6 bg-white border border-slate-100 rounded-2xl shadow-sm space-y-2">
          <div className="flex justify-between items-center text-gray-400">
            <span className="text-[10px] font-black uppercase tracking-wider">Locked Escrow</span>
            <Clock className="w-5 h-5 text-amber-500" />
          </div>
          <p className="text-2xl font-black text-[#112a1d]">KES {pendingEscrowBalance.toLocaleString()}</p>
          <p className="text-[10px] text-slate-400 leading-relaxed font-sans mt-1">Held securely by secretariat clearing account until customer delivers approval.</p>
        </div>

        <div className="p-6 bg-white border border-slate-150 rounded-2xl shadow-sm space-y-2">
          <div className="flex justify-between items-center text-gray-400">
            <span className="text-[10px] font-black uppercase tracking-wider">Released / Cleared</span>
            <Coins className="w-5 h-5 text-emerald-600" />
          </div>
          <p className="text-2xl font-black text-[#112a1d]">KES {releasedPayouts.toLocaleString()}</p>
          <p className="text-[10px] text-slate-400 leading-relaxed font-sans mt-1">Settled inside your cooperative bank accounts or registered M-Pesa till coordinates.</p>
        </div>

        <div className="p-6 bg-[#112a1d] text-white rounded-2xl shadow-sm space-y-2">
          <div className="flex justify-between items-center text-emerald-250">
            <span className="text-[10px] font-black uppercase tracking-wider">Sales count</span>
            <Layers className="w-5 h-5 text-amber-400" />
          </div>
          <p className="text-2xl font-black text-white">{vendorOrders.length} Transactions</p>
          <p className="text-[10px] text-slate-200 leading-relaxed font-sans mt-1">Total items sold using official KEREA guaranteed invoice matrices.</p>
        </div>
      </section>

      {/* Master details: Inventory restocks vs Escrow Sales list */}
      <section className="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {/* Left main: Cargo orders streams */}
        <div className="lg:col-span-7 bg-white p-6 border border-slate-100 rounded-2xl shadow-sm space-y-4">
          <h3 className="text-sm font-black text-[#112a1d]">Escrow Sales Stream Pipeline</h3>
          
          {vendorOrders.length > 0 ? (
            <div className="space-y-3">
              {vendorOrders.map(ord => {
                const matchedProd = products.find(p => p.id === ord.productId);
                return (
                  <div key={ord.id} className="p-4 border border-slate-150/80 rounded-xl space-y-2.5">
                    <div className="flex justify-between items-center">
                      <span className="text-[9px] font-mono text-gray-400">Transaction ID: {ord.id}</span>
                      <span className={`text-[9px] font-black uppercase tracking-wider px-2 py-0.5 rounded ${
                        ord.escrowStatus === 'Escrow_Held' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800'
                      }`}>
                        {ord.escrowStatus}
                      </span>
                    </div>

                    <div className="text-xs">
                      <p className="font-bold text-[#112a1d]">{matchedProd?.title || 'Unknown Product'}</p>
                      <p className="text-gray-400 mt-0.5">Buyer: {ord.userId}</p>
                    </div>

                    <div className="flex justify-between items-center pt-2.5 border-t border-slate-50 text-xs">
                      <span className="font-extrabold text-emerald-805">KES {ord.totalKES.toLocaleString()}</span>
                      {ord.escrowStatus === 'Escrow_Held' && (
                        <span className="text-[10px] text-[#112a1d] font-bold flex items-center gap-1">
                          <Truck className="w-4 h-4 text-[#112a1d] animate-bounce" /> Awaiting Buyer Release
                        </span>
                      )}
                    </div>
                  </div>
                );
              })}
            </div>
          ) : (
            <div className="text-center py-12 p-8 border border-dashed border-slate-205 rounded-xl">
              <ShoppingBag className="w-10 h-10 text-slate-350 mx-auto mb-1.5" />
              <p className="text-xs text-gray-450">No e-commerce sales logged yet in database.</p>
            </div>
          )}
        </div>

        {/* Right main: Restock form & Inventory item list */}
        <div className="lg:col-span-5 space-y-6">
          <form onSubmit={handleRestock} className="bg-slate-50 p-6 border border-slate-150 rounded-2xl space-y-4">
            <h3 className="text-xs font-black uppercase text-[#112a1d] tracking-widest flex items-center gap-1.5">
              <RefreshCw className="w-4 h-4 text-emerald-700" /> Catalog Stock Restocker
            </h3>

            <div>
              <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Select Hardware Item</label>
              <select
                required
                value={restockProductId}
                onChange={e => setRestockProductId(e.target.value)}
                className="w-full text-xs p-3 border border-slate-205 rounded-xl bg-white focus:outline-none"
              >
                <option value="">-- Choose Active Catalog Item --</option>
                {vendorProducts.map(p => (
                  <option key={p.id} value={p.id}>{p.title} (Stock: {p.stockAvailable})</option>
                ))}
              </select>
            </div>

            <div>
              <label className="block text-[10px] font-bold text-gray-450 uppercase mb-1">Stock Addition units (+)</label>
              <input 
                type="number" 
                required
                min={1}
                value={restockAmount}
                onChange={e => setRestockAmount(Number(e.target.value))}
                className="w-full text-xs p-3 border border-slate-205 rounded-xl focus:border-emerald-600 focus:outline-none"
              />
            </div>

            <button
              type="submit"
              className="w-full py-2.5 bg-[#112a1d] hover:bg-emerald-700 text-white font-bold text-xs rounded-xl cursor-pointer"
            >
              Push stock additions
            </button>
          </form>

          {/* Miniature List of owned hardware */}
          <div className="bg-white border border-slate-100 p-5 rounded-2xl space-y-3.5">
            <h4 className="text-xs font-black text-[#112a1d]">My Live Products ({vendorProducts.length})</h4>
            <div className="space-y-2 text-xs">
              {vendorProducts.map(vp => (
                <div key={vp.id} className="flex justify-between items-center text-slate-505 py-1.5 border-b border-slate-50 last:border-0">
                  <span className="truncate pr-4 leading-normal">{vp.title}</span>
                  <span className={`font-mono text-[10px] px-1.5 py-0.5 rounded font-black shrink-0 ${
                    vp.stockAvailable < 3 ? 'bg-red-50 text-red-800' : 'bg-green-50 text-green-800'
                  }`}>
                    {vp.stockAvailable} left
                  </span>
                </div>
              ))}
            </div>
          </div>
        </div>

      </section>

    </div>
  );
}
