import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    flash: {
        success: string | null;
        error: string | null;
        message?: string | null;
    };
};

export interface User {
  id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    profile_picture_path: string | null;

    user_code: string;
    mobile_number: string | null;
    
    account_type: number;
    plan_level: number;
    account_status: number;

    plan_label: string;
    account_type_label: string;

    nutritionist?: unknown;
    patient?: unknown;
}
