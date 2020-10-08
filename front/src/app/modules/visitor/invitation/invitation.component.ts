import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ResponsiveService } from 'app/core/services/responsive.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-invitation',
  templateUrl: './invitation.component.html',
  styleUrls: ['./invitation.component.scss']
})
export class InvitationComponent implements OnInit {
  invitationForm: FormGroup;
  bMobile: boolean;

  constructor(private m_formBuilder: FormBuilder,
    private m_router: Router,
    responsiveService: ResponsiveService) {
    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
          this.bMobile = false;
      } else {
          this.bMobile = true;
      }
    });

    this.invitationForm = this.m_formBuilder.group({
      email: ['', Validators.compose([
        Validators.required,
        Validators.email
      ])],
      name: ['', Validators.compose([
        Validators.required,
        Validators.minLength(4)
      ])],
      promotion: ['', Validators.required],
      message: ['']
    });
  }

  ngOnInit() {
  }

  goTo(url: string): void {
    this.m_router.navigate([url]);
  }
}
