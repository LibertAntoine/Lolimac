import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Observable } from 'rxjs';

import { ResponsiveService } from 'app/core/services/responsive.service';
import { AuthService } from 'app/core/services/auth.service';
import { UserService } from '../visitor/user.service';
import { EventService } from '../events/event.service';
import { User } from 'app/shared/models/user';
import { Event } from 'app/shared/models/event';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {
  bMobile = true;
  user$: Observable<User>;
  events$: Observable<Event[]>

  constructor(responsiveService: ResponsiveService,
    private m_authService: AuthService,
    private m_router: Router,
    private m_userService: UserService,
    private m_eventService: EventService) {
    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
          this.bMobile = false;
      } else {
          this.bMobile = true;
      }
    });

    this.user$ = this.m_userService.get(this.m_authService.getUserId());
    this.events$ = this.m_eventService.getEventList(0, 20);
  }

  ngOnInit() {}

  logout(): void {
    this.m_authService.logout();
    this.m_router.navigate(['/visiteur/login']);
  }

  goTo(url: string): void {
    this.m_router.navigate([url]);
  }
}
