import { Technology, TrainingCourse, Metric, MembershipCategory, Publication, FAQ } from './types';

export const technologiesData: Technology[] = [
  {
    id: 'solar-pv',
    name: 'Solar PV & Thermal',
    category: 'Solar',
    tagline: 'Kenya’s fastest-growing energy source',
    description: 'Solar power is the core driver of off-grid electrification in Kenya, powering millions of homes via Solar Home Systems (SHS) and powering industries through Commercial & Industrial (C&I) solar plant installations.',
    statusInKenya: 'Over 300MW installed capacity with rapid residential and microgrid expansion across off-grid counties.',
    keyProjects: ['Garissa Solar Power Station (55MW)', 'Malindi Solar (52MW)', 'Numerous rural microgrids in Turkana & Marsabit'],
    imageUrl: 'https://images.unsplash.com/photo-1509391366360-2e959784a276?auto=format&fit=crop&w=800&q=80',
    licensingBody: 'EPRA (Energy and Petroleum Regulatory Authority) Class T1/T2/T3'
  },
  {
    id: 'wind-power',
    name: 'Utility & Off-Grid Wind',
    category: 'Wind',
    tagline: 'Harnessing the strong East African winds',
    description: 'Kenya boasts one of Africa’s largest wind energy farms. Wind energy contributes massively to the national grid during peak hours, complemented by small-scale mechanical wind pumps for rural agricultural water supply.',
    statusInKenya: 'Generating over 15% of national grid power during high wind seasons, with world-class wind speeds in the Rift Valley.',
    keyProjects: ['Lake Turkana Wind Power Project (310MW - Largest in Africa)', 'Ngong Hills Wind Farm (25MW)', 'Kipeto Wind Power Project (100MW)'],
    imageUrl: 'https://images.unsplash.com/photo-1466611653911-95081537e5b7?auto=format&fit=crop&w=800&q=80',
    licensingBody: 'EPRA Project Authorisation & County Permits'
  },
  {
    id: 'biomass-biogas',
    name: 'Sustainably Managed Biomass & Biogas',
    category: 'Biomass',
    tagline: 'Modernizing clean cooking & decentralized thermal energy',
    description: 'Transitioning from traditional fuels to modern, highly efficient biomass systems, gasification, and domestic/industrial biogas. This reduces deforestation while providing reliable heat and electricity.',
    statusInKenya: 'Widely used in the tea and flower industry for thermal processing, and rapidly growing in household biodigesters.',
    keyProjects: ['Kilifi sisal biogas plant', 'Keekorok Lodge biogas system', 'Tea factory biomass briquette boiler conversions'],
    imageUrl: 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?auto=format&fit=crop&w=800&q=80',
    licensingBody: 'KEREA Biomass Certification & National Environmental Management Authority (NEMA)'
  },
  {
    id: 'geothermal-hydro',
    name: 'Geothermal & Hydro Power',
    category: 'Geothermal',
    tagline: 'The base load backbone of Kenyan grid greening',
    description: 'Geothermal energy from the Great Rift Valley is the ultimate reliable baseload source, positioning Kenya as a global leader. Coupled with mini-hydro power, it forms the bedrock of the 100% renewable grid goal.',
    statusInKenya: 'Kenya is the 7th largest geothermal producer globally. Geothermal accounts for over 40% of standard grid power.',
    keyProjects: ['Olkaria Geothermal Complex (800MW+)', 'Seven Forks Hydro Scheme', 'Gura River Small Hydro Project (5MW)'],
    imageUrl: 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=800&q=80',
    licensingBody: 'Ministry of Energy & KenGen'
  }
];

export const trainingCoursesData: TrainingCourse[] = [
  {
    id: 'solar-t1-t2',
    title: 'Solar PV Installer Licensing Prep (T1 & T2)',
    duration: '2 Weeks (80 Hours)',
    level: 'Basic',
    certification: 'EPRA T1 & T2 Certification-Ready Certificate',
    feeKES: 35000,
    description: 'Comprehensive practical training on small-scale off-grid solar systems (DC) and medium residential solar systems with batteries and simple inverters. Includes electrical basics, installation standards, and safety.',
    instructorName: 'Eng. Caleb Wafula',
    instructorRole: 'Lead Technical Trainer & EPRA Assessor',
    rating: 4.8,
    reviewsCount: 142,
    imageUrl: 'https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'solar-t3',
    title: 'Advanced Grid-Tie & Hybrid Solar PV (T3)',
    duration: '3 Weeks (120 Hours)',
    level: 'Advanced',
    certification: 'EPRA T3 Specialist Certification',
    feeKES: 48000,
    description: 'Designed for experienced technicians and engineers to master Commercial & Industrial (C&I) grid-connected, net-metered, and hybrid systems. Covers solar design software, grid synchronization, and protective relays.',
    instructorName: 'Dr. Jane Kamau',
    instructorRole: 'Renown Microgrid Researcher & System Designer',
    rating: 4.9,
    reviewsCount: 88,
    imageUrl: 'https://images.unsplash.com/photo-1548543604-a87a9989fd0f?auto=format&fit=crop&w=800&q=80'
  },
  {
    id: 'biogas-design',
    title: 'Biogas Plant Design, Construction & Maintenance',
    duration: '1 Week (40 Hours)',
    level: 'Intermediate',
    certification: 'KEREA Certified Biogas Engineer',
    feeKES: 25000,
    description: 'Hands-on instruction on building domestic and institutional scale biodigesters using masonry and prefabricated models. Focused on agricultural waste recycling and clean thermal gas routing.',
    instructorName: 'Charles Langat',
    instructorRole: 'Bioenergy Specialist & Consultant',
    rating: 4.6,
    reviewsCount: 54,
    imageUrl: 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=800&q=80'
  }
];

export const metricsData: Metric[] = [
  {
    value: '450+',
    label: 'Corporate Members',
    description: 'Solar suppliers, green financing firms, and non-profits registered under our umbrella.',
    icon: 'Users'
  },
  {
    value: '1,200+',
    label: 'Certified Installers',
    description: 'Highly skilled technical experts verified according to strict EPRA and KEREA quality mandates.',
    icon: 'Award'
  },
  {
    value: '85%',
    label: 'Off-Grid Access',
    description: 'Attributed to our advocacy supporting decentralized solar solutions across remote counties.',
    icon: 'TrendingUp'
  },
  {
    value: '22+',
    label: 'Years of Service',
    description: 'Formed in 2004, KEREA is the premier, trusted driver of Kenya’s clean energy transition.',
    icon: 'ShieldCheck'
  }
];

export const membershipCategoriesData: MembershipCategory[] = [
  {
    id: 'individual',
    name: 'Individual Members',
    subType: 'Practitioner, Consultant, Associate, Student',
    annualFeeKES: 5000,
    annualFeeUSD: 40,
    registrationFeeKES: 2000,
    benefits: [
      'Official listing in KEREA Online Verified Directory.',
      'Discounts on accredited technical training (T1, T2, T3 prep courses).',
      'Exclusive access to our local job boards and consultant RFPs.',
      'Invitations to annual general meetings and industry networking workshops.'
    ],
    requirements: [
      'Copy of national ID or passport.',
      'Relevant degrees, certificates, or EPRA technical licenses (if applying as practitioner).',
      'Brief summary CV detailing solar, wind, or bioenergy exposure.'
    ]
  },
  {
    id: 'corporate-sme',
    name: 'Corporate SME Member',
    subType: 'Annual Turn-over under KES 10 Million',
    annualFeeKES: 25000,
    annualFeeUSD: 190,
    registrationFeeKES: 5000,
    benefits: [
      'Verified corporate listing with company profile link on KEREA homepage.',
      'Direct representation in national lobbying efforts regarding tax & tariffs.',
      'Participation in standard-setting workgroups with EPRA and KEBS.',
      'Two complimentary passes to the annual Eastern Africa Renewable Energy Conference.'
    ],
    requirements: [
      'Certificate of business incorporation.',
      'KRA PIN Certificate and valid Tax Compliance Certificate.',
      'Declaration of renewable product line or technician licenses.'
    ]
  },
  {
    id: 'corporate-large',
    name: 'Corporate Premium / Large Member',
    subType: 'Annual Turn-over over KES 10 Million, Dev Partners, Multinationals',
    annualFeeKES: 75000,
    annualFeeUSD: 580,
    registrationFeeKES: 10000,
    benefits: [
      'Premium brand display at all KEREA major symposiums, workshops, and exhibitions.',
      'Voting rights in KEREA board selections and direct influence on strategic policies.',
      'Direct matchmaking with foreign investors and development capital funds.',
      'Unlimited job posting listings and priority feature in monthly newsletters.'
    ],
    requirements: [
      'Certificate of incorporation & Business CR12.',
      'KRA Pin with valid compliance evidence.',
      'Brief profile of operations and reference projects statement.'
    ]
  }
];

export const publicationsData: Publication[] = [
  {
    id: 'standards-code',
    title: 'Kenya Code of Practice for Grid-Tier Solar PV System Installations',
    category: 'Technical Standard',
    fileSize: '4.2 MB',
    publishedYear: 2025,
    author: 'KEREA Standards Sub-Committee & KEBS',
    downloads: 1420
  },
  {
    id: 'net-metering-guide',
    title: 'National Net-Metering Implementation Guide for Commercial Consumers',
    category: 'Guide',
    fileSize: '2.8 MB',
    publishedYear: 2026,
    author: 'EPRA & KEREA Policy Advocacy Team',
    downloads: 980
  },
  {
    id: 'market-trends-2025',
    title: 'Kenya Decentralized Renewable Energy (DRE) Sector Report 2025',
    category: 'Market Report',
    fileSize: '5.6 MB',
    publishedYear: 2025,
    author: 'KEREA Market Intelligence & GOGLA',
    downloads: 2450
  },
  {
    id: 'tax-guidelines',
    title: 'Updated VAT & Import Duty Exemptions for Solar Components in Kenya',
    category: 'Regulation',
    fileSize: '1.4 MB',
    publishedYear: 2026,
    author: 'KEREA Tax Lobbying Secretariat',
    downloads: 1850
  }
];

export const faqsData: FAQ[] = [
  {
    question: 'How do I obtain an EPRA Solar PV Installer License in Kenya?',
    answer: 'To apply for EPRA license Class T1, T2, or T3, you must finish a recognized solar training course (such as KEREA’s Licensing Prep), have an engineering or technical background, and submit your application with certifications through the online EPRA portal. Passing the technical interview/exam is mandatory.',
    category: 'Licensing'
  },
  {
    question: 'Can individual installers join KEREA, or is it only for corporate companies?',
    answer: 'KEREA is open to both! Individual membership is tailored for students, technicians, freelance consultants, and researchers. Corporate membership tiers are structured by company size and annual turnover to keep it fair and encouraging.',
    category: 'Membership'
  },
  {
    question: 'Does Kenya offer Net-Metering for commercial rooftop solar?',
    answer: 'Yes, Kenya’s net-metering regulations allow industrial and commercial consumers with grid-tied solar systems to feed excess power back into the national grid in exchange for credits on their monthly bills. Small systems up to 1MW are covered under standard rules.',
    category: 'Regulations'
  },
  {
    question: 'Which renewable energy technologies are tax-exempt in Kenya?',
    answer: 'Solar modules, solar batteries, solar lamps, inverter controllers, and specialized wind generation equipment are largely exempt from Value Added Tax (VAT) and Import Duties, provided they adhere to KEBS standards. KEREA works tirelessly to preserve and expand these incentives for the association’s members.',
    category: 'Regulations'
  }
];
