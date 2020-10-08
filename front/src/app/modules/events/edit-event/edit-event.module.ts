import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { EditEventComponent } from './edit-event.component';
import { SharedModule } from 'app/shared/shared.module';
import { EditEventRoutingModule } from './edit-event-routing.module';

@NgModule({
  declarations: [EditEventComponent],
  imports: [
    CommonModule,
    SharedModule,
    EditEventRoutingModule
  ]
})
export class EditEventModule { }
