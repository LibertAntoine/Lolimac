import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { EventsRoutingModule } from './events-routing.module';
import { EventService } from './event.service';
import { PostService } from './post.service';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,

    EventsRoutingModule
  ],
  providers: [
    EventService,
    PostService
  ]
})
export class EventsModule { }
