import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { CreateEventComponent } from './create-event.component';
import { SharedModule } from 'app/shared/shared.module';
import { CreateEventRoutingModule } from './create-event-routing.module';

@NgModule({
  declarations: [CreateEventComponent],
  imports: [
    CommonModule,
    SharedModule,
    CreateEventRoutingModule
  ]
})
export class CreateEventModule { }
