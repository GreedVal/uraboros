export interface User {
  id: string;
  firstName?: string;
  lastName?: string;
  username?: string;
  status?: {
    type?: string;
  };
  bot?: boolean;
  verified?: boolean;
  premium?: boolean;
  scam?: boolean;
}

export interface Participant {
  userId: string;
  user?: User;
  type: string;
  date: string;
}

export interface BreadcrumbItem {
  title: string;
  href: string;
}

export interface PaginationProps {
  count: number;
  queryParams: Record<string, any>;
  currentPage: number;
  totalPages: number;
  perPage: number;
}