import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { AuthService } from 'app/core/services/auth.service';
import { UserService } from 'app/modules/visitor/user.service';
import { PasswordMatch } from 'app/shared/validators/password-match';
import { ResponsiveService } from 'app/core/services/responsive.service';

@Component({
  selector: 'app-change-password',
  templateUrl: './change-password.component.html',
  styleUrls: ['./change-password.component.scss']
})
export class ChangePasswordComponent implements OnInit {
  userForm: FormGroup;
  bUpdated = false;
  bMobile: boolean;

  constructor(private m_router: Router,
    private m_formBuilder: FormBuilder,
    private m_userService: UserService,
    private m_authService: AuthService,
    responsiveService: ResponsiveService) {
    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
          this.bMobile = false;
      } else {
          this.bMobile = true;
      }
    });

    this.userForm = this.m_formBuilder.group({
      pwd: ['', Validators.compose([
        Validators.required,
        Validators.minLength(4)
      ])],
      confirm_pwd: ['', Validators.compose([
        Validators.required,
        Validators.minLength(4)
      ])]
    }, {
      validators: PasswordMatch('pwd','confirm_pwd')
    });
  }

  ngOnInit() {

  }

  submitForm(): void {
    let form = this.userForm.value;
    form.id = this.m_authService.getUserId();
    delete form.confirm_pwd;
    this.m_userService.update(this.m_authService.getUserId(), form).subscribe(result => {
      this.m_router.navigate(['/profil']);
    }, error => {

    });
  }

  goTo(url: string): void {
    this.m_router.navigate([url]);
  }

}
