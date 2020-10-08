import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { LoginComponent } from './login/login.component';
import { VisitorRoutingModule } from './visitor-routing.module';
import { SharedModule } from 'app/shared/shared.module';
import { InvitationComponent } from './invitation/invitation.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ForgotComponent } from './forgot/forgot.component';
import { UserService } from './user.service';

@NgModule({
  declarations: [
    LoginComponent,
    InvitationComponent,
    InscriptionComponent,
    ForgotComponent
  ],
  imports: [
    CommonModule,

    VisitorRoutingModule,
    SharedModule
  ],
  providers: [
    UserService
  ]
})
export class VisitorModule { }
