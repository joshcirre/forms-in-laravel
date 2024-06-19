export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string | null;
    password: string;
    remember_token: string;
}

export interface Journal {
    id: number;
    summary: string;
    notes: string;
    rating: number;
    created_at: string;
}


export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    journals: Journal[];
};
