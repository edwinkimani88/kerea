import React, { createContext, useContext, useState, useEffect } from 'react';
import { 
  AppView, 
  UserAccount, 
  MarketplaceProduct, 
  SupportTicket, 
  BlogArticle, 
  EventBooking, 
  OrderRecord, 
  AuditLog, 
  DynamicPage,
  Publication,
  FAQ
} from '../types';

interface AppStateContextType {
  // Navigation
  currentView: AppView;
  setCurrentView: (view: AppView) => void;
  navigationHistory: AppView[];
  navigateTo: (view: AppView) => void;
  goBack: () => void;
  breadcrumbs: { label: string; view?: AppView }[];
  
  selectedProductId: string | null;
  setSelectedProductId: (id: string | null) => void;
  selectedVendorId: string | null;
  setSelectedVendorId: (id: string | null) => void;
  searchMarketQuery: string;
  setSearchMarketQuery: (query: string) => void;

  // Authentication
  currentUser: UserAccount | null;
  loginAsUser: (email: string, role: 'administrator' | 'vendor' | 'customer') => boolean;
  logoutCurrentUser: () => void;
  registerUser: (name: string, email: string, role: 'vendor' | 'customer', companyName?: string, phone?: string) => UserAccount;
  allUsers: UserAccount[];
  updateUserStatus: (userId: string, status: 'active' | 'pending_verification' | 'disabled') => void;

  // Marketplace
  products: MarketplaceProduct[];
  savedProductIds: string[];
  toggleSaveProduct: (productId: string) => void;
  addNewProduct: (product: Omit<MarketplaceProduct, 'id' | 'rating' | 'reviewsCount'>) => void;
  updateProductStock: (productId: string, stock: number) => void;
  deleteProduct: (productId: string) => void;
  compareProductIds: string[];
  toggleCompareProduct: (productId: string) => void;

  // CMS Content
  blogs: BlogArticle[];
  publications: Publication[];
  events: EventBooking[];
  dynamicPages: DynamicPage[];
  faqItems: FAQ[];

  addNewBlog: (article: Omit<BlogArticle, 'id' | 'dateCreated'>) => void;
  addNewPublication: (pub: Omit<Publication, 'id' | 'downloads'>) => void;
  addNewEvent: (evt: Omit<EventBooking, 'id' | 'registeredAttendees'>) => void;
  addNewPage: (page: Omit<DynamicPage, 'id' | 'createdAt'>) => void;
  updateFAQ: (faqs: FAQ[]) => void;

  // Ticketing System
  tickets: SupportTicket[];
  submitNewTicket: (title: string, category: SupportTicket['category'], description: string) => SupportTicket;
  replyToTicket: (ticketId: string, message: string) => void;
  updateTicketStatus: (ticketId: string, status: SupportTicket['status']) => void;

  // Orders & Escrow Transactions
  orders: OrderRecord[];
  placeNewOrder: (productId: string) => OrderRecord | null;
  updateOrderStatus: (orderId: string, status: OrderRecord['status']) => void;
  escrowPayout: (orderId: string) => void;

  // Logs & Analytics
  auditLogs: AuditLog[];
  logUserAction: (action: string, details: string) => void;
}

const AppStateContext = createContext<AppStateContextType | undefined>(undefined);

export const AppStateProvider: React.FC<{ children: React.ReactNode }> = ({ children }) => {
  // Navigation State
  const [currentView, setCurrentView] = useState<AppView>('home');
  const [navigationHistory, setNavigationHistory] = useState<AppView[]>(['home']);

  const [selectedProductId, setSelectedProductId] = useState<string | null>(null);
  const [selectedVendorId, setSelectedVendorId] = useState<string | null>(null);
  const [searchMarketQuery, setSearchMarketQuery] = useState<string>('');

  // Authentication State
  const [allUsers, setAllUsers] = useState<UserAccount[]>([
    { id: 'usr-1', name: 'Eng. Caleb Wafula', email: 'caleb@kerea.org', role: 'administrator', status: 'active', joinedDate: '2024-03-12' },
    { id: 'usr-2', name: 'Safi Solar Kenya', email: 'sales@safisolar.co.ke', role: 'vendor', status: 'active', companyName: 'Safi Solar Solutions Ltd', phone: '+254 711 002233', location: 'Nairobi', joinedDate: '2025-01-20' },
    { id: 'usr-3', name: 'EcoPower Biomass', email: 'info@ecopower.or.ke', role: 'vendor', status: 'pending_verification', companyName: 'EcoPower Bioenergy Systems', phone: '+254 722 334455', location: 'Kisumu', joinedDate: '2026-05-10' },
    { id: 'usr-4', name: 'George Mwangi', email: 'george@gmail.com', role: 'customer', status: 'active', phone: '+254 700 889922', location: 'Nakuru', joinedDate: '2025-09-14' },
    { id: 'usr-5', name: 'Grace Mutua', email: 'grace.mutua@outlook.com', role: 'customer', status: 'active', phone: '+254 733 112233', location: 'Mombasa', joinedDate: '2026-02-18' }
  ]);
  const [currentUser, setCurrentUser] = useState<UserAccount | null>(null);

  // Marketplace Products State
  const [products, setProducts] = useState<MarketplaceProduct[]>([
    {
      id: 'prod-1',
      title: 'KEREA Certified 450W Monocrystalline PV Solar Panel',
      category: 'Solar Technologies',
      description: 'Ultra-high efficiency PERC technology monocrystalline solar module, optimal for off-grid Solar Home Systems and industrial grid-connection. Heavy-duty aluminum frame and anti-reflection tempered glass.',
      priceKES: 18500,
      originalPriceKES: 22000,
      imageUrl: 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=600&q=80',
      vendorName: 'Safi Solar Solutions Ltd',
      vendorId: 'usr-2',
      rating: 4.8,
      reviewsCount: 34,
      specKW: 0.45,
      stockAvailable: 150,
      certifiedByEPRA: true,
      specifications: {
        'Cell Type': 'Monocrystalline PERC',
        'Max Power (Pmax)': '450W',
        'Open Circuit Voltage (Voc)': '49.6V',
        'Short Circuit Current (Isc)': '11.4A',
        'Module Efficiency': '20.7%',
        'Dimensions': '2094 x 1038 x 35 mm',
        'Weight': '23.5 kg'
      },
      features: [
        'Anti-reflective, highly transparent low-iron tempered glass',
        'Anodized aluminum alloy frame for high wind/snow loads',
        'IP68 rated junction box with bypass diodes',
        '10-year product quality warranty & 25-year linear power warranty'
      ],
      warranty: '10 years limited product warranty, 25 years performance output warranty',
      downloads: [
        { label: 'Technical Datasheet PDF', url: '#' },
        { label: 'User Installation Manual', url: '#' }
      ]
    },
    {
      id: 'prod-2',
      title: 'Commercial Multi-Plate Induction Electric Cooker (3.5kW)',
      category: 'Electric Cooking',
      description: 'High-power energy-efficient electric cooking plate designed for catering companies and institutions. Robust stainless steel housing, precise digital touch selectors, and multi-stage heating.',
      priceKES: 28000,
      originalPriceKES: 32500,
      imageUrl: 'https://images.unsplash.com/photo-1574269603917-389f5a6550bf?auto=format&fit=crop&w=600&q=80',
      vendorName: 'Safi Solar Solutions Ltd',
      vendorId: 'usr-2',
      rating: 4.7,
      reviewsCount: 15,
      stockAvailable: 12,
      certifiedByEPRA: true,
      specifications: {
        'Power Rating': '3.5 kW',
        'Voltage Input': '220-240V AC',
        'Controls': 'Touch Interface with LED Display',
        'Temperature Range': '60°C to 240°C',
        'Housing Material': 'SUS304 Stainless Steel',
        'Safety Sensors': 'Auto pan-detection and overheat protection'
      },
      features: [
        'Up to 85% energy efficiency compared to standard gas burners',
        'Water-resistant housing with heavy-duty black ceramic plate',
        'Saves up to KES 3,000 monthly in clean cooking expenses',
        'EPRA Accredited and certified by Kenya Bureau of Standards (KEBS)'
      ],
      warranty: '2 Years Manufacturer Warranty',
      downloads: [
        { label: 'Safety Guidelines Sheet', url: '#' },
        { label: 'Induction Cooking Guide', url: '#' }
      ]
    },
    {
      id: 'prod-3',
      title: 'High-Density 48V 100Ah Lithium Iron Phosphate Battery (LiFePO4)',
      category: 'Energy Storage',
      description: 'Premium grade lithium power backup with integrated smart Battery Management System (BMS). Offers over 6,000 active cycles, excellent for residential backup solar designs and solar mini-grids.',
      priceKES: 135000,
      originalPriceKES: 150000,
      imageUrl: 'https://images.unsplash.com/photo-1620712943543-bcc4688e7485?auto=format&fit=crop&w=600&q=80',
      vendorName: 'EcoPower Bioenergy Systems',
      vendorId: 'usr-3',
      rating: 4.9,
      reviewsCount: 8,
      stockAvailable: 25,
      certifiedByEPRA: true,
      specifications: {
        'Nominal Voltage': '48.0V',
        'Capacity': '100Ah (4.8 kWh)',
        'Battery Chemistry': 'Lithium Iron Phosphate (LiFePO4)',
        'Standard Discharge Rate': '50A',
        'Lifecycles': '6,000+ cycles at 80% DOD',
        'Weight': '43.0 kg'
      },
      features: [
        'Advanced built-in BMS protects against over-charging & temperature anomalies',
        'Scalable up to 15 packs in parallel for large storage demands',
        'Completely maintenance-free dry design, zero gas emissions',
        'High thermal safety limits under warm East African ambient climates'
      ],
      warranty: '5 Years Full Product Replacement Gaurantee',
      downloads: [
        { label: 'BMS Programming Manual', url: '#' },
        { label: 'SDS Safety Sheet', url: '#' }
      ]
    },
    {
      id: 'prod-4',
      title: 'High-Velocity Prefabricated 3m³ Domestic Biogas Digester Kit',
      category: 'Biogas Systems',
      description: 'Easy-to-assemble premium reinforced PVC composite biogas digester. Package includes gas storage bladder, pipeline desulfurizer booster, organic fertilizer outlet, and a modern single-burner gas stove.',
      priceKES: 42000,
      originalPriceKES: 45000,
      imageUrl: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=600&q=80',
      vendorName: 'EcoPower Bioenergy Systems',
      vendorId: 'usr-3',
      rating: 4.5,
      reviewsCount: 12,
      stockAvailable: 20,
      certifiedByEPRA: false,
      specifications: {
        'Digester Volume': '3.0 cubic meters',
        'Gas Output Rate': '1.2 to 2.0 m³/day',
        'Daily Feed Material': '15-20 kg animal manure or agricultural waste',
        'Installation Requirements': 'Flat sunny surface 4x2 meters',
        'Gas Pipe Length': '15 meters premium rubber pipe included'
      },
      features: [
        'Includes manual booster compressor pump to stabilize cooktop gas pressure',
        'Converts farm waste into premium organic digestate bio-fertilizer',
        'Durable structure designed to survive over 15 years in direct equatorial sun',
        'Requires no brick masonry – can be fully commissioned in 4 hours'
      ],
      warranty: '3 Years Structural Warranty',
      downloads: [
        { label: 'Installation Video Reference Sheet', url: '#' },
        { label: 'Biogas Feeding Protocols', url: '#' }
      ]
    },
    {
      id: 'prod-5',
      title: 'High-Calorific Carbonized Biomass Briquettes (50kg Bag)',
      category: 'Biomass Technologies',
      description: 'Sustainably sourced agricultural waste briquettes. Highly carbonized to produce zero smoke, zero odors, and high heat output, outlasting ordinary hardwood charcoal by up to 2.5 times.',
      priceKES: 2400,
      originalPriceKES: 2800,
      imageUrl: 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=600&q=80',
      vendorName: 'EcoPower Bioenergy Systems',
      vendorId: 'usr-3',
      rating: 4.6,
      reviewsCount: 42,
      stockAvailable: 500,
      certifiedByEPRA: true,
      specifications: {
        'Calorific Value': '4,500 - 4,800 kcal/kg',
        'Moisture Content': 'Less than 6.5%',
        'Ash Content': '3.2% max',
        'Burning Duration': '3.5 to 5 hours',
        'Sourcing material': 'Sugar bagasse, coffee husks, and coconut shells'
      },
      features: [
        '100% smokeless and spark-free output, safe for indoor household setups',
        'Protects local forests by displacing normal tree logging operations',
        'Extradense structures packed tightly for long cross-county transport safety'
      ],
      warranty: 'Shelf-stable indefinitely if kept dry in a shaded warehouse',
      downloads: [
        { label: 'KEBS Standard Assessment Certificate', url: '#' }
      ]
    },
    {
      id: 'prod-6',
      title: 'SuperSaver Premium Rocket-Stove Improved Cookstove (Jiko)',
      category: 'Improved Cookstoves',
      description: 'Premium stainless steel household cookstove optimizing fuel utilization by up to 60%. Insulated thermal combustion chamber minimizes heat loss and redirects air for secondary combustion.',
      priceKES: 4500,
      originalPriceKES: 5500,
      imageUrl: 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=600&q=80',
      vendorName: 'EcoPower Bioenergy Systems',
      vendorId: 'usr-3',
      rating: 4.8,
      reviewsCount: 94,
      stockAvailable: 85,
      certifiedByEPRA: true,
      specifications: {
        'Fuel Compatibility': 'Small wood sticks, twigs, carbonized briquettes',
        'Thermal Efficiency': '42%',
        'Materials Used': 'Refractory ceramic lining with SS304 exterior casing',
        'Weight': '3.8 kg',
        'Smoke Emission Reduction': '80% compared to three-stone fire'
      },
      features: [
        'Ergonomic cool-touch wooden handles prevent burns during cooking',
        'Heavy cast iron pot support accepts round or flat cooking pots',
        'Drastically reduces firewood collection times for rural households'
      ],
      warranty: '1 Year Full Replacement Warranty',
      downloads: [
        { label: 'Improved Stove Health Benefits', url: '#' }
      ]
    },
    {
      id: 'prod-7',
      title: 'Smart Decentralized Pre-paid Mini-Grid Electricity Meter',
      category: 'Mini-grid Technologies',
      description: 'Advanced pre-paid electric utility meter equipped with GSM module and STS token input. Perfect to monitor and bill rural microgrids, supporting automated mobile money integration.',
      priceKES: 12500,
      originalPriceKES: 14500,
      imageUrl: 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=600&q=80',
      vendorName: 'Safi Solar Solutions Ltd',
      vendorId: 'usr-2',
      rating: 4.4,
      reviewsCount: 6,
      stockAvailable: 40,
      certifiedByEPRA: true,
      specifications: {
        'STS Standard Compliant': 'Yes, supports standard numeric tokens',
        'Communication channels': 'GSM Quad-Band / RS485 / RF Mesh network',
        'Base Load Rating': '5(60)A Class 1.0',
        'Tamper Proofing': 'Automatic magnetic anomaly lockouts',
        'Water Ingress Rating': 'IP54 weather protection'
      },
      features: [
        'Supports automated API query triggers for M-Pesa instant payment vending',
        'Keeps precise telemetry records for multi-family distribution grids',
        'Equipped with anti-tamper latch switches and non-volatile clock state'
      ],
      warranty: '2 Years Regulatory Warranty',
      downloads: [
        { label: 'STS Microgrid Metering Reference API Manual', url: '#' },
        { label: 'Installation Wiring Scheme', url: '#' }
      ]
    },
    {
      id: 'prod-8',
      title: 'EPC Premium Digital Electric Pressure Cooker (6L, 1000W)',
      category: 'Electric Cooking',
      description: 'Saves up to 80% on fuel electricity compared to normal pots! Optimized for cooking traditional heavy foods like Githeri and beans. Fully sealed with heavy locking safety lid.',
      priceKES: 9500,
      originalPriceKES: 12000,
      imageUrl: 'https://images.unsplash.com/photo-1544233726-9f1d2b27be8b?auto=format&fit=crop&w=600&q=80',
      vendorName: 'Safi Solar Solutions Ltd',
      vendorId: 'usr-2',
      rating: 4.9,
      reviewsCount: 55,
      stockAvailable: 60,
      certifiedByEPRA: true,
      specifications: {
        'Volumetric Volume': '6.0 Litres',
        'Wattage': '1000 Watts',
        'Preset Programs': '12 Custom clean cooking presets',
        'Lining pot Material': 'Non-stick double-layer food certified ceramic core',
        'Operating Pressure': '70 kPa'
      },
      features: [
        'Automatic temperature regulation turns off current during heat peaks',
        'Under KES 15 of electricity used to boil a full pot of beans',
        'Endorsed by the Kenya Clean Cooking Association and EPRA efficiency teams'
      ],
      warranty: '2 Years Manufacturer Warranty',
      downloads: [
        { label: 'Electric Cooker Recipe Book PDF', url: '#' },
        { label: 'Pre-paid Metering Load Guide', url: '#' }
      ]
    }
  ]);

  const [savedProductIds, setSavedProductIds] = useState<string[]>(['prod-1', 'prod-3']);
  const [compareProductIds, setCompareProductIds] = useState<string[]>([]);

  // Blogs CMS State
  const [blogs, setBlogs] = useState<BlogArticle[]>([
    {
      id: 'blog-1',
      title: 'Kenya Passes New Landmark Renewable Net-Metering Regulations for 2026',
      category: 'News',
      content: 'Under the new gazetted Net-Metering guidelines, commercial power consumers in Kenya can now export up to 1MW of excess solar power to Kenya Power (KPLC) in exchange for billing credits. This milestone dramatically reduces the payback period for corporate and industrial solar arrays, incentivizing substantial green energy investments across Nairobi, Mombasa, and Nakuru counties. KEREA works continuously with EPRA to ensure fair interconnection rates.',
      imageUrl: 'https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=600&q=80',
      dateCreated: '2026-06-10',
      author: 'Ecosystem Advocacy Team',
      readTime: '4 min read'
    },
    {
      id: 'blog-2',
      title: 'Empowering Off-Grid Agri-Businesses: The Impact Story of PURE Solar Cooling',
      category: 'Impact Story',
      content: 'In Marsabit and Samburu, the Productive Use of Renewable Energy (PURE) is transforming nomadic farming preservation. With solar-powered cooling lockers sponsored by international funding partners, post-harvest milk and fish losses have plunged by 75%. Smallholder women cooperatives can now secure fair pricing without rush-selling. KEREA has spearheaded quality standards for these PURE devices to ensure durable, water-resistant field deployment.',
      imageUrl: 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=600&q=80',
      dateCreated: '2026-05-24',
      author: 'Clara Lagat, PURE Initiatives Coordinator',
      readTime: '6 min read'
    },
    {
      id: 'blog-3',
      title: 'Top 5 Design Standards Every Certified Technical Installer Must Observe',
      category: 'Article',
      content: 'Building safe and resilient solar arrays requires adhering to the latest Kenya Bureau of Standards (KEBS) and KEREA structural requirements. High wind loads in the Rift Valley and extreme UV exposure near the equator mean common plastic cable ties and substandard mounting brackets will degrade in less than three years. This article unpacks critical standards on DC isolation, electrical bonding, and battery ventilation.',
      imageUrl: 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=600&q=80',
      dateCreated: '2026-04-12',
      author: 'Technical Training Unit',
      readTime: '5 min read'
    }
  ]);

  // Publications State
  const [publications, setPublications] = useState<Publication[]>([
    {
      id: 'pub-1',
      title: 'Kenya Code of Practice for Grid-Tier Solar PV System Installations',
      category: 'Technical Standard',
      fileSize: '4.2 MB',
      publishedYear: 2025,
      author: 'KEREA Standards Sub-Committee & KEBS',
      downloads: 1420
    },
    {
      id: 'pub-2',
      title: 'National Net-Metering Implementation Guide for Commercial Consumers',
      category: 'Guide',
      fileSize: '2.8 MB',
      publishedYear: 2026,
      author: 'EPRA & KEREA Policy Advocacy Team',
      downloads: 981
    },
    {
      id: 'pub-3',
      title: 'Kenya Decentralized Renewable Energy (DRE) Sector Report 2025',
      category: 'Market Report',
      fileSize: '5.6 MB',
      publishedYear: 2025,
      author: 'KEREA Market Intelligence & GOGLA',
      downloads: 2450
    },
    {
      id: 'pub-4',
      title: 'Updated VAT & Import Duty Exemptions for Solar Components in Kenya',
      category: 'Regulation',
      fileSize: '1.4 MB',
      publishedYear: 2026,
      author: 'KEREA Tax Lobbying Secretariat',
      downloads: 1850
    },
    {
      id: 'pub-5',
      title: 'Policy Brief: Unblocking Off-Grid Finance and De-risking Capital for Agri-Solar',
      category: 'Policy Brief',
      fileSize: '1.1 MB',
      publishedYear: 2026,
      author: 'KEREA Advocacy Team',
      downloads: 412
    },
    {
      id: 'pub-6',
      title: 'Research Paper: Assessing Biomass Gasification Potential in Kenya’s Tea Sector',
      category: 'Research Paper',
      fileSize: '3.1 MB',
      publishedYear: 2025,
      author: 'Strathmore University Energy Research Centre & KEREA',
      downloads: 284
    }
  ]);

  // Events State
  const [events, setEvents] = useState<EventBooking[]>([
    {
      id: 'evt-1',
      title: 'Solar PV Installer Licensing Prep Course (T1 & T2)',
      type: 'Training',
      date: '2026-07-06',
      location: 'KEREA Training Centre, Westlands, Nairobi',
      feeKES: 35000,
      description: 'Intense practical cohort designed to ready solar technicians for EPRA licensing class T1 & T2 examinations. Topics cover electrical calculations, sizing, and safety.',
      registeredAttendees: 28
    },
    {
      id: 'evt-2',
      title: 'Productive Use of Energy (PURE) Stakeholder Summit 2026',
      type: 'Event',
      date: '2026-06-25',
      location: 'Nairobi Serena Hotel / Hybrid Mode',
      feeKES: 5000,
      description: 'Uniting agricultural innovators, development financiers, and solar equipment distributors to build scalable supply chains for smart solar irrigation, mills, and cold chain structures.',
      registeredAttendees: 145
    },
    {
      id: 'evt-3',
      title: 'Advanced Hybrid Solar Engineering & Storage Masterclass (T3 Prep)',
      type: 'Training',
      date: '2026-08-10',
      location: 'Strathmore University Laboratories, Nairobi',
      feeKES: 48000,
      description: 'Hands-on laboratory training on commercial grid-tied systems, custom grid-synchronizing inverters, and utility lithium thermal battery storage design constraints.',
      registeredAttendees: 16
    },
    {
      id: 'evt-4',
      title: 'Bioenergy Technical Standards & Safety Workshop',
      type: 'Workshop',
      date: '2026-07-22',
      location: 'Kisumu Sunset Hotel',
      feeKES: 2500,
      description: 'Designed for biomass briquetting manufacturers and waste biodigester engineers to establish KEBS regulatory safety compliance frameworks.',
      registeredAttendees: 42
    }
  ]);

  // Dynamic CMS Pages list
  const [dynamicPages, setDynamicPages] = useState<DynamicPage[]>([
    {
      id: 'ch-1',
      title: 'Become an EPRA Licensed Electrician: Complete Walkthrough',
      permalink: 'epra-licensing',
      content: 'Here you will find full instructions, prerequisites, and syllabi regarding Solar Class T1, T2, and T3 licensing categories...',
      published: true,
      createdAt: '2025-05-12'
    }
  ]);

  // FAQs State
  const [faqItems, setFaqItems] = useState<FAQ[]>([
    {
      question: 'How do I obtain an EPRA Solar PV Installer License in Kenya?',
      answer: 'To apply for EPRA license Class T1, T2, or T3, you must finish a recognized solar training course (such as KEREAs Licensing Prep), have an engineering or technical background, and submit your application with certifications through the online EPRA portal. Passing the technical interview/exam is mandatory.',
      category: 'Licensing'
    },
    {
      question: 'Can individual installers join KEREA, or is it only for corporate companies?',
      answer: 'KEREA is open to both! Individual membership is tailored for students, technicians, freelance consultants, and researchers. Corporate membership tiers are structured by company size and annual turnover to keep it fair and encouraging.',
      category: 'Membership'
    },
    {
      question: 'Does Kenya offer Net-Metering for commercial rooftop solar?',
      answer: 'Yes, Kenyas net-metering regulations allow industrial and commercial consumers with grid-tied solar systems to feed excess power back into the national grid in exchange for credits on their monthly bills. Small systems up to 1MW are covered under standard rules.',
      category: 'Regulations'
    },
    {
      question: 'Which renewable energy technologies are tax-exempt in Kenya?',
      answer: 'Solar modules, solar batteries, solar lamps, inverter controllers, and specialized wind generation equipment are largely exempt from Value Added Tax (VAT) and Import Duties, provided they adhere to KEBS standards. KEREA works tirelessly to preserve and expand these incentives for the association’s members.',
      category: 'Regulations'
    }
  ]);

  // Ticketing State
  const [tickets, setTickets] = useState<SupportTicket[]>([
    {
      id: 'tkt-1',
      title: 'Pending Vendor Verification Review',
      userId: 'usr-3',
      userName: 'EcoPower Biomass',
      userRole: 'vendor',
      category: 'License Issue',
      status: 'pending',
      description: 'Hello Admin. We uploaded our company CR12 certificate and valid Tax Compliance document last week, but our profile still shows pending. Please help us review so we can access our product marketplace dashboard. Thank you.',
      createdAt: '2026-06-12',
      replies: [
        {
          id: 'rep-1',
          authorName: 'Eng. Caleb Wafula',
          authorRole: 'administrator',
          content: 'Hello EcoPower Team. We have received your uploaded credentials. We are waiting on a quick confirmation of alignment from the registrar. We should finalize this within 24 hours.',
          createdAt: '2026-06-13'
        }
      ]
    },
    {
      id: 'tkt-2',
      title: 'Payment stuck in Escrow Holder',
      userId: 'usr-4',
      userName: 'George Mwangi',
      userRole: 'customer',
      category: 'Billing',
      status: 'open',
      description: 'Purchased solar panel (ID: prod-1) on escrow agreement, but the status is showing locked. I need to get the order dispatch status from Safi Solar Kenya.',
      createdAt: '2026-06-13',
      replies: []
    },
    {
      id: 'tkt-3',
      title: 'Inquiry on Solar PV class T3 requirements',
      userId: 'usr-5',
      userName: 'Grace Mutua',
      userRole: 'customer',
      category: 'Technical',
      status: 'resolved',
      description: 'Does KEREA course issue official certificates that EPRA accepts as proof of technical competency?',
      createdAt: '2026-06-02',
      replies: [
        {
          id: 'rep-2',
          authorName: 'Ecosystem Advocacy Team',
          authorRole: 'administrator',
          content: 'Yes, Grace. KEREA is an accredited training provider. Our syllabus is endorsed by EPRA and built strictly to KEBS syllabus guidelines.',
          createdAt: '2026-06-03'
        }
      ]
    }
  ]);

  // Marketplace Orders tracking state
  const [orders, setOrders] = useState<OrderRecord[]>([
    {
      id: 'ord-1001',
      vendorId: 'usr-2',
      vendorName: 'Safi Solar Solutions Ltd',
      customerId: 'usr-4',
      customerName: 'George Mwangi',
      productTitle: 'KEREA Certified 450W Monocrystalline Solar Panel',
      productCategory: 'Solar PV',
      amountKES: 18500,
      orderDate: '2026-06-11',
      status: 'Completed'
    },
    {
      id: 'ord-1002',
      vendorId: 'usr-3',
      vendorName: 'EcoPower Bioenergy Systems',
      customerId: 'usr-5',
      customerName: 'Grace Mutua',
      productTitle: 'High-Velocity Prefabricated 3m³ Domestic Biogas Digester Kit',
      productCategory: 'Biogas Equipment',
      amountKES: 42000,
      orderDate: '2026-06-13',
      status: 'Escrow_Held'
    }
  ]);

  // System Audit Logging
  const [auditLogs, setAuditLogs] = useState<AuditLog[]>([
    { id: 'log-1', action: 'System Initialization', userId: 'system', userName: 'Server Kernel', details: 'KEREA digital portal core booted successfully on host port 3000.', timestamp: '2026-06-14 00:00:01' },
    { id: 'log-2', action: 'User Sign-Up', userId: 'usr-3', userName: 'EcoPower Biomass', details: 'New vendor registry processed. Waiting admin validation approval.', timestamp: '2026-06-14 00:10:45' }
  ]);

  // Navigation Logic
  const navigateTo = (view: AppView) => {
    setCurrentView(view);
    setNavigationHistory(prev => [...prev, view]);
    window.scrollTo({ top: 0, behavior: 'instant' });
    logUserAction('Navigate View', `User navigated directly to: [${view}]`);
  };

  const goBack = () => {
    if (navigationHistory.length > 1) {
      const historyCopy = [...navigationHistory];
      historyCopy.pop(); // Remove current
      const lastView = historyCopy[historyCopy.length - 1];
      setCurrentView(lastView);
      setNavigationHistory(historyCopy);
      window.scrollTo({ top: 0, behavior: 'instant' });
    }
  };

  // Generate dynamic breadcrumbs base on the current view
  const getBreadcrumbs = () => {
    const list = [{ label: 'Home', view: 'home' as AppView }];
    if (currentView === 'home') return list;

    // Mapping view to label
    const labels: Record<string, string> = {
      about: 'About Us',
      leadership: 'Board Leadership',
      'policy-advocacy': 'Policy & Advocacy Lobbying',
      standards: 'Standards & Technical Resources',
      'access-to-finance': 'Access to Finance',
      'market-dev': 'Market Development & PURE',
      partnerships: 'Africa-Global Partnerships',
      events: 'Upcoming Events & Calendar',
      blog: 'Ecosystem News & Blog',
      publications: 'Technical Publications',
      'knowledge-hub': 'Knowledge Hub & FAQ',
      'member-directory': 'KEREA Member Directory',
      contact: 'Contact Us',
      marketplace: 'Renewable Tech Marketplace',
      'marketplace-category-solar': 'Solar Technologies Catalog',
      'marketplace-category-cooking': 'Electric Cooking Catalog',
      'marketplace-category-biogas': 'Biogas Systems Catalog',
      'marketplace-category-biomass': 'Biomass Technologies Catalog',
      'marketplace-category-cookstoves': 'Improved Cookstoves Catalog',
      'marketplace-category-storage': 'Energy Storage Catalog',
      'marketplace-category-minigrid': 'Mini-Grid Technologies Catalog',
      'marketplace-product-details': 'Clean Energy Product Specifications',
      'marketplace-compare': 'Clean Energy Product Comparator Grid',
      'marketplace-vendors': 'Verified Renewable Vendors Directory',
      'marketplace-vendor-profile': 'Vendor Certified Profile',
      'marketplace-search-results': 'Marketplace Catalog Search Results',
      auth: 'Security Sign In',
      'dashboard-admin': 'Administrator Control Hub',
      'dashboard-vendor': 'Vendor Commerce Centre',
      'dashboard-customer': 'Customer Account Dashboard'
    };

    list.push({ label: labels[currentView] || currentView, view: currentView });
    return list;
  };

  // Action Logging Helper
  const logUserAction = (action: string, details: string) => {
    const newLog: AuditLog = {
      id: `log-${Date.now()}-${Math.floor(Math.random() * 1000)}`,
      action,
      userId: currentUser?.id || 'guest',
      userName: currentUser?.name || 'Anonymous Guest',
      details,
      timestamp: new Date().toISOString().replace('T', ' ').substring(0, 19)
    };
    setAuditLogs(prev => [newLog, ...prev]);
  };

  // Login System
  const loginAsUser = (email: string, role: 'administrator' | 'vendor' | 'customer'): boolean => {
    const match = allUsers.find(u => u.email.toLowerCase() === email.toLowerCase() && u.role === role);
    if (match) {
      if (match.status === 'disabled') {
        logUserAction('Auth Rejected', `Attempted blocked account loading: ${email}`);
        return false;
      }
      setCurrentUser(match);
      logUserAction('User Login', `Successfully signed in as KEREA [${role}]`);
      
      // Auto-route to respective portals on login
      if (role === 'administrator') navigateTo('dashboard-admin');
      else if (role === 'vendor') navigateTo('dashboard-vendor');
      else navigateTo('dashboard-customer');
      return true;
    }
    return false;
  };

  const logoutCurrentUser = () => {
    if (currentUser) {
      logUserAction('User Logout', `User signed out from system.`);
      setCurrentUser(null);
      navigateTo('home');
    }
  };

  const registerUser = (
    name: string, 
    email: string, 
    role: 'vendor' | 'customer', 
    companyName?: string, 
    phone?: string
  ): UserAccount => {
    const newUser: UserAccount = {
      id: `usr-${Date.now()}`,
      name,
      email,
      role,
      status: role === 'vendor' ? 'pending_verification' : 'active',
      companyName: companyName || '',
      phone: phone || '',
      location: 'Nairobi',
      joinedDate: new Date().toISOString().split('T')[0]
    };

    setAllUsers(prev => [...prev, newUser]);
    setCurrentUser(newUser);

    logUserAction('User Registry', `Newly registered account: ${email} [${role}]`);
    if (role === 'vendor') {
      navigateTo('dashboard-vendor');
    } else {
      navigateTo('dashboard-customer');
    }
    return newUser;
  };

  const updateUserStatus = (userId: string, status: 'active' | 'pending_verification' | 'disabled') => {
    setAllUsers(prev => prev.map(u => u.id === userId ? { ...u, status } : u));
    logUserAction('Account Status Mutated', `User UID: ${userId} status updated to [${status}]`);
  };

  // Save/Wishlist Products
  const toggleSaveProduct = (productId: string) => {
    setSavedProductIds(prev => 
      prev.includes(productId) 
        ? prev.filter(id => id !== productId) 
        : [...prev, productId]
    );
    logUserAction('Wishlist Updated', `Saved status toggled for item: ${productId}`);
  };

  // Product Comparisons Picker
  const toggleCompareProduct = (productId: string) => {
    setCompareProductIds(prev => {
      if (prev.includes(productId)) {
        return prev.filter(id => id !== productId);
      }
      if (prev.length >= 3) {
        // limit comparator to 3 items
        return [prev[1], prev[2], productId];
      }
      return [...prev, productId];
    });
  };

  // Marketplace Products
  const addNewProduct = (product: Omit<MarketplaceProduct, 'id' | 'rating' | 'reviewsCount'>) => {
    const newProd: MarketplaceProduct = {
      ...product,
      id: `prod-${Date.now()}`,
      rating: 5.0,
      reviewsCount: 0
    };
    setProducts(prev => [newProd, ...prev]);
    logUserAction('Catalog Addition', `Registered new seller listing: "${product.title}"`);
  };

  const updateProductStock = (productId: string, stock: number) => {
    setProducts(prev => prev.map(p => p.id === productId ? { ...p, stockAvailable: stock } : p));
  };

  const deleteProduct = (productId: string) => {
    setProducts(prev => prev.filter(p => p.id !== productId));
    logUserAction('Catalog Deletion', `Removed seller listing reference: ${productId}`);
  };

  // CMS Content Helpers
  const addNewBlog = (article: Omit<BlogArticle, 'id' | 'dateCreated'>) => {
    const newArt: BlogArticle = {
      ...article,
      id: `blog-${Date.now()}`,
      dateCreated: new Date().toISOString().split('T')[0]
    };
    setBlogs(prev => [newArt, ...prev]);
    logUserAction('CMS Publication', `Posted new ecosystem article: "${article.title}"`);
  };

  const addNewPublication = (pub: Omit<Publication, 'id' | 'downloads'>) => {
    const newPub: Publication = {
      ...pub,
      id: `pub-${Date.now()}`,
      downloads: 0
    };
    setPublications(prev => [newPub, ...prev]);
    logUserAction('CMS Publication', `Uploaded technical report: "${pub.title}"`);
  };

  const addNewEvent = (evt: Omit<EventBooking, 'id' | 'registeredAttendees'>) => {
    const newEvt: EventBooking = {
      ...evt,
      id: `evt-${Date.now()}`,
      registeredAttendees: 0
    };
    setEvents(prev => [newEvt, ...prev]);
    logUserAction('CMS Schedule', `Scheduled new training / seminar: "${evt.title}"`);
  };

  const addNewPage = (page: Omit<DynamicPage, 'id' | 'createdAt'>) => {
    const newPage: DynamicPage = {
      ...page,
      id: `page-${Date.now()}`,
      createdAt: new Date().toISOString().split('T')[0]
    };
    setDynamicPages(prev => [...prev, newPage]);
    logUserAction('CMS Structure', `Custom portal page injected: "${page.title}"`);
  };

  const updateFAQ = (faqs: FAQ[]) => {
    setFaqItems(faqs);
    logUserAction('CMS Structure', `FAQs repository index modified.`);
  };

  // Ticketing Logic
  const submitNewTicket = (title: string, category: SupportTicket['category'], description: string): SupportTicket => {
    const newTkt: SupportTicket = {
      id: `tkt-${Date.now()}`,
      title,
      userId: currentUser?.id || 'guest',
      userName: currentUser?.name || 'Guest User',
      userRole: currentUser?.role || 'customer',
      category,
      status: 'open',
      description,
      createdAt: new Date().toISOString().split('T')[0],
      replies: []
    };
    setTickets(prev => [newTkt, ...prev]);
    logUserAction('Support Ticket Opened', `Generated ticket listing: "${title}"`);
    return newTkt;
  };

  const replyToTicket = (ticketId: string, message: string) => {
    const newReply = {
      id: `rep-${Date.now()}`,
      authorName: currentUser?.name || 'Support Desk Agent',
      authorRole: currentUser?.role || 'administrator',
      content: message,
      createdAt: new Date().toISOString().replace('T', ' ').substring(0, 10)
    };

    setTickets(prev => prev.map(t => {
      if (t.id === ticketId) {
        return {
          ...t,
          status: currentUser?.role === 'administrator' ? 'pending' : t.status,
          replies: [...t.replies, newReply]
        };
      }
      return t;
    }));
    logUserAction('Support Ticket Replied', `Added update thread reply to ticket ID: ${ticketId}`);
  };

  const updateTicketStatus = (ticketId: string, status: SupportTicket['status']) => {
    setTickets(prev => prev.map(t => t.id === ticketId ? { ...t, status } : t));
    logUserAction('Support Ticket Resolved', `Ticket ID: ${ticketId} resolved status set to [${status}]`);
  };

  // Order & Payout Flow
  const placeNewOrder = (productId: string): OrderRecord | null => {
    const prod = products.find(p => p.id === productId);
    if (!prod) return null;

    if (prod.stockAvailable <= 0) {
      logUserAction('Purchase Aborted', `Product out of stock context: ${prod.title}`);
      return null;
    }

    const newOrd: OrderRecord = {
      id: `ord-${Math.floor(Math.random() * 9000) + 1000}`,
      vendorId: prod.vendorId,
      vendorName: prod.vendorName,
      customerId: currentUser?.id || 'usr-4', // Fallback guest
      customerName: currentUser?.name || 'George Mwangi',
      productTitle: prod.title,
      productCategory: prod.category,
      amountKES: prod.priceKES,
      orderDate: new Date().toISOString().split('T')[0],
      status: 'Escrow_Held'
    };

    setOrders(prev => [newOrd, ...prev]);
    // update stocks
    setProducts(prev => prev.map(p => p.id === productId ? { ...p, stockAvailable: p.stockAvailable - 1 } : p));

    logUserAction('E-Commerce Order Locked', `Locked payment KES ${prod.priceKES.toLocaleString()} in KEREA Escrow for: "${prod.title}"`);
    return newOrd;
  };

  const updateOrderStatus = (orderId: string, status: OrderRecord['status']) => {
    setOrders(prev => prev.map(o => o.id === orderId ? { ...o, status } : o));
    logUserAction('Order Shipping Sync', `Order ID: ${orderId} dispatch marked as: [${status}]`);
  };

  const escrowPayout = (orderId: string) => {
    setOrders(prev => prev.map(o => o.id === orderId ? { ...o, status: 'Completed' } : o));
    logUserAction('Escrow Released', `Released payments to vendor for order reference ${orderId}`);
  };

  return (
    <AppStateContext.Provider
      value={{
        currentView,
        setCurrentView,
        navigationHistory,
        navigateTo,
        goBack,
        breadcrumbs: getBreadcrumbs(),

        selectedProductId,
        setSelectedProductId,
        selectedVendorId,
        setSelectedVendorId,
        searchMarketQuery,
        setSearchMarketQuery,

        currentUser,
        loginAsUser,
        logoutCurrentUser,
        registerUser,
        allUsers,
        updateUserStatus,

        products,
        savedProductIds,
        toggleSaveProduct,
        addNewProduct,
        updateProductStock,
        deleteProduct,
        compareProductIds,
        toggleCompareProduct,

        blogs,
        publications,
        events,
        dynamicPages,
        faqItems,

        addNewBlog,
        addNewPublication,
        addNewEvent,
        addNewPage,
        updateFAQ,

        tickets,
        submitNewTicket,
        replyToTicket,
        updateTicketStatus,

        orders,
        placeNewOrder,
        updateOrderStatus,
        escrowPayout,

        auditLogs,
        logUserAction
      }}
    >
      {children}
    </AppStateContext.Provider>
  );
};

export const useAppState = () => {
  const context = useContext(AppStateContext);
  if (context === undefined) {
    throw new Error('useAppState must be used within an AppStateProvider');
  }
  return context;
};
