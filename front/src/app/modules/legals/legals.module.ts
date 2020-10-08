import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { LegalsComponent } from './legals.component';
import { LegalsRoutingModule } from './legals-routing.module';
import { SharedModule } from 'app/shared/shared.module';

@NgModule({
  declarations: [ LegalsComponent ],
  imports: [
    CommonModule,

    LegalsRoutingModule,
    SharedModule
  ]
})
export class LegalsModule { }
