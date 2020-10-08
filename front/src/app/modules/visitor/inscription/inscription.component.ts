import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { PasswordMatch } from 'app/shared/validators/password-match';
import { UserService } from '../user.service';
import { HttpErrorResponse } from '@angular/common/http';
import { ImageUrl } from 'app/shared/validators/image-url';
import { ResponsiveService } from 'app/core/services/responsive.service';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.scss']
})
export class InscriptionComponent implements OnInit {
  inscriptionForm: FormGroup;
  bInscriptionDone = false;
  bMobile = true;

  constructor(private m_formBuilder: FormBuilder,
    private m_userService: UserService,
    private m_router: Router,
    responsiveService: ResponsiveService) {
    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
          this.bMobile = false;
      } else {
          this.bMobile = true;
      }
    });

    this.inscriptionForm = this.m_formBuilder.group({
      page1: this.m_formBuilder.group({
        pseudo: ['', Validators.required],
        mail: ['', Validators.compose([
          Validators.required,
          Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)
        ])],
        year_promotion: ['', Validators.required]
      }),
      page2: this.m_formBuilder.group({
        phone: '',
        firstname: ['', Validators.required],
        lastname: ['', Validators.required],
        photo_url: ['https://i2.wp.com/rouelibrenmaine.fr/wp-content/uploads/2018/10/empty-avatar.png', Validators.required]
      }, {
        validators: ImageUrl('photo_url')
      }),
      page3: this.m_formBuilder.group({
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
      })
    });
  }

  ngOnInit() {}

  submitForm(): void {
    // Prepare form
    const form = Object.assign({}, this.inscriptionForm.value.page1, this.inscriptionForm.value.page2, this.inscriptionForm.value.page3);
    delete form.confirm_pwd;

    // Send form
    this.m_userService.create(form).subscribe(response => {
      this.bInscriptionDone = true;

      setTimeout(() => {
        this.m_router.navigate(['/visiteur/login]']);
      }, 2500);
    }, (error: HttpErrorResponse) => {
      // TODO handles error
    });
  }

  goTo(url: string): void {
    this.m_router.navigate([url]);
  }
}
