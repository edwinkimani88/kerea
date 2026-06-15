export interface Technology {
  id: string;
  name: string;
  category: 'Solar' | 'Wind' | 'Biomass' | 'Hydro' | 'Geothermal';
  tagline: string;
  description: string;
  statusInKenya: string;
  keyProjects: string[];
  imageUrl: string;
  licensingBody: string;
}

export interface TrainingCourse {
  id: string;
  title: string;
  duration: string;
  level: 'Basic' | 'Intermediate' | 'Advanced' | 'Professional';
  certification: string;
  feeKES: number;
  description: string;
  instructorName: string;
  instructorRole: string;
  rating: number;
  reviewsCount: number;
  imageUrl: string;
}

export interface Metric {
  value: string;
  label: string;
  description: string;
  icon: string;
}

export interface MembershipCategory {
  id: string;
  name: string;
  subType: string;
  annualFeeKES: number;
  annualFeeUSD: number;
  registrationFeeKES: number;
  benefits: string[];
  requirements: string[];
}

export interface Publication {
  id: string;
  title: string;
  category: 'Regulation' | 'Guide' | 'Market Report' | 'Technical Standard' | 'Policy Brief' | 'Research Paper';
  fileSize: string;
  publishedYear: number;
  author: string;
  downloads: number;
}

export interface FAQ {
  question: string;
  answer: string;
  category: string;
}

// ==========================================
// NEW SYSTEM ARCHITECTURE TYPES
// ==========================================

export type AppView =
  | 'home'
  | 'about'
  | 'leadership'
  | 'policy-advocacy'
  | 'standards'
  | 'access-to-finance'
  | 'market-dev'
  | 'partnerships'
  | 'events'
  | 'blog'
  | 'publications'
  | 'knowledge-hub'
  | 'member-directory'
  | 'contact'
  | 'marketplace'
  | 'marketplace-category-solar'
  | 'marketplace-category-cooking'
  | 'marketplace-category-biogas'
  | 'marketplace-category-biomass'
  | 'marketplace-category-cookstoves'
  | 'marketplace-category-storage'
  | 'marketplace-category-minigrid'
  | 'marketplace-product-details'
  | 'marketplace-compare'
  | 'marketplace-vendors'
  | 'marketplace-vendor-profile'
  | 'marketplace-search-results'
  | 'auth'
  | 'dashboard-admin'
  | 'dashboard-vendor'
  | 'dashboard-customer';

export type UserRole = 'administrator' | 'vendor' | 'customer';

export interface UserAccount {
  id: string;
  name: string;
  email: string;
  role: UserRole;
  status: 'active' | 'pending_verification' | 'disabled';
  companyName?: string;
  phone?: string;
  location?: string;
  joinedDate: string;
}

export interface MarketplaceProduct {
  id: string;
  title: string;
  category: 'Solar Technologies' | 'Electric Cooking' | 'Biogas Systems' | 'Biomass Technologies' | 'Improved Cookstoves' | 'Energy Storage' | 'Mini-grid Technologies';
  description: string;
  priceKES: number;
  originalPriceKES?: number; // to show discounts like in the design template
  imageUrl: string;
  vendorName: string;
  vendorId: string;
  rating: number;
  reviewsCount: number;
  specKW?: number;
  stockAvailable: number;
  certifiedByEPRA: boolean;
  specifications?: Record<string, string>;
  features?: string[];
  warranty?: string;
  downloads?: { label: string; url: string }[];
}

export interface SupportTicket {
  id: string;
  title: string;
  userId: string;
  userName: string;
  userRole: UserRole;
  category: 'Billing' | 'Technical' | 'License Issue' | 'Order Issue' | 'CMS Update';
  status: 'open' | 'pending' | 'resolved';
  description: string;
  replies: TicketReply[];
  createdAt: string;
}

export interface TicketReply {
  id: string;
  authorName: string;
  authorRole: UserRole;
  content: string;
  createdAt: string;
}

export interface BlogArticle {
  id: string;
  title: string;
  category: 'News' | 'Article' | 'Impact Story';
  content: string;
  imageUrl: string;
  dateCreated: string;
  author: string;
  readTime: string;
}

export interface EventBooking {
  id: string;
  title: string;
  type: 'Event' | 'Training' | 'Workshop' | 'Seminar';
  date: string;
  location: string;
  feeKES: number;
  description: string;
  registeredAttendees: number;
}

export interface OrderRecord {
  id: string;
  vendorId: string;
  vendorName: string;
  customerId: string;
  customerName: string;
  productTitle: string;
  productCategory: string;
  amountKES: number;
  orderDate: string;
  status: 'Processing' | 'Shipped' | 'Completed' | 'Escrow_Held';
}

export interface AuditLog {
  id: string;
  action: string;
  userId: string;
  userName: string;
  details: string;
  timestamp: string;
}

export interface DynamicPage {
  id: string;
  title: string;
  permalink: string;
  content: string;
  published: boolean;
  createdAt: string;
}
