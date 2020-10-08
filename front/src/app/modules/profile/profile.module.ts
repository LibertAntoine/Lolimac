import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProfileComponent } from './profile.component';
import { ProfileRoutingModule } from './profile-routing.module';
import { SharedModule } from 'app/shared/shared.module';
import { EditProfileComponent } from './edit-profile/edit-profile.component';
import { ChangePasswordComponent } from './change-password/change-password.component';

@NgModule({
  declarations: [ProfileComponent, EditProfileComponent, ChangePasswordComponent],
  imports: [
    CommonModule,

    ProfileRoutingModule,
    SharedModule
  ]
})
export class ProfileModule { }
