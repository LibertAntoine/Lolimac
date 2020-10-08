import { User } from './user';

export interface Comment {
    id?: number;
    content?: string;
    date_created?: Date;
    date_edited?: Date;
    id_user?: number;
    id_post?: number;
    user?: User;
}