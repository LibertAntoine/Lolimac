import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SearchComponent } from './search.component';
import { SearchRoutingModule } from './search-routing.module';
import { SharedModule } from 'app/shared/shared.module';

@NgModule({
  declarations: [SearchComponent],
  imports: [
    CommonModule,

    SearchRoutingModule,
    SharedModule
  ]
})
export class SearchModule { }
