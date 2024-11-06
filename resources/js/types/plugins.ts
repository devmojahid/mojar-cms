export interface Plugin {
    name: string
    extra: {
        mojar?: {
            name?: string
        }
    };
}
