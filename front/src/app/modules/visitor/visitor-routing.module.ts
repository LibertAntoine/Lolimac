import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LoginComponent } from './login/login.component';
import { InvitationComponent } from './invitation/invitation.component';
import { InscriptionComponent } from './inscription/inscription.component';
import { ForgotComponent } from './forgot/forgot.component';

const routes: Routes = [
    {
        path: 'login',
        component: LoginComponent
    },
    {
        path: 'invitation',
        component: InvitationComponent
    },
    {
        path: 'inscription',
        component: InscriptionComponent
    },
    {
        path: 'oubli',
        component: ForgotComponent
    },
    {
        path: '**',
        redirectTo: 'login',
        pathMatch: 'full'
    },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class VisitorRoutingModule { }