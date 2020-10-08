import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { NotificationsComponent } from './notifications.component';
import { NotificationsRoutingModule } from './notifications-routing.module';
import { SharedModule } from 'app/shared/shared.module';
import { NotificationsService } from './notifications.service';

@NgModule({
  declarations: [NotificationsComponent],
  imports: [
    CommonModule,

    NotificationsRoutingModule,
    SharedModule
  ],
  providers: [
    NotificationsService
  ]
})
export class NotificationsModule { }
