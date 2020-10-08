import { Place } from './place';
import { Post } from './post';
import { User } from './user';

export interface Event {
    id_event?: number;
    title?: string;
    description?: string;
    date_start?: Date;
    date_end?: Date;
    date_created?: Date;
    photo_url?: string;
    participation: number;
    place?: Place;
    posts?: Post[];
    participants?: User[];
    type_edit?: string;
}