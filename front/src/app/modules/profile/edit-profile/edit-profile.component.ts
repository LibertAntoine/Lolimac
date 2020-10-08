import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { ResponsiveService } from 'app/core/services/responsive.service';
import { UserService } from 'app/modules/visitor/user.service';
import { ImageUrl } from 'app/shared/validators/image-url';
import { AuthService } from 'app/core/services/auth.service';
import { fillUndefinedProperties } from 'app/shared/utility/change-objects';
import { MatDialog } from '@angular/material';
import { DialogComponent } from 'app/shared/components/dialog/dialog.component';

@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.component.html',
  styleUrls: ['./edit-profile.component.scss']
})
export class EditProfileComponent implements OnInit {
  bMobile: boolean;
  userForm: FormGroup;
  bUserDeleted = false;

  constructor(responsiveService: ResponsiveService,
    private m_router: Router,
    private m_formBuilder: FormBuilder,
    private m_userService: UserService,
    private m_authService: AuthService,
    private m_dialog: MatDialog) {
      responsiveService.isMobile().subscribe(result => {
        if (result.matches) {
          this.bMobile = false;
        } else {
          this.bMobile = true;
        }
      });

      this.userForm = this.m_formBuilder.group({
        pseudo: ['', Validators.required],
        mail: ['', Validators.compose([
          Validators.required,
          Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)
        ])],
        year_promotion: ['', Validators.required],
        phone: '',
        firstname: ['', Validators.required],
        lastname: ['', Validators.required],
        photo_url: ['', Validators.required]
      }, {
        validators: ImageUrl('photo_url')
      });
    }

  ngOnInit() {
    this.m_userService.get(this.m_authService.getUserId()).subscribe(result => {
      result = fillUndefinedProperties(result);
      this.userForm.patchValue({
        pseudo: result.pseudo,
        mail: result.mail,
        year_promotion: result.year_promotion.toString(),
        phone: result.phone,
        firstname: result.firstname,
        lastname: result.lastname,
        photo_url: result.photo_url
      });
    }, error => {

    });
  }

  submitForm(): void {
    let form = this.userForm.value;
    form.id = this.m_authService.getUserId();
    this.m_userService.update(this.m_authService.getUserId(), form).subscribe(result => {
      this.m_router.navigate(['/profil']);
    }, error => {

    });
  }

  deleteUser(): void {
    const dialogRef = this.m_dialog.open(DialogComponent, {
      width: "500px",
      data: {title: `Suppression de votre compte`, text: `On est triste de vous voir partir ! En êtes-vous sûr de sûr ?`, bValBtn: true}
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result.validated) {
        this.m_userService.delete(this.m_authService.getUserId()).subscribe(result => {
          this.bUserDeleted = true;
          this.m_authService.logout();
          this.m_router.navigate(['/visiteur/login]']);
        }, error => {

        });
      }
    });
  }

  goTo(url: string): void {
    this.m_router.navigate([url]);
  }

}
