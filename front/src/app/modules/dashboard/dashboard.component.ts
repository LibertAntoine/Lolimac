import { Component, OnInit } from '@angular/core';
import { ResponsiveService } from 'app/core/services/responsive.service';

import { Event } from 'app/shared/models/event';
import { EventService } from '../events/event.service';
import { AuthService } from 'app/core/services/auth.service';
import { isEmpty } from 'app/shared/utility/change-objects';

enum DashBoardState {
  Error,
  Empty,
  Done,
  Loading,
  NoMore
}

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  events: Event[] = [];
  bMobile = true;
  dashBoardState = DashBoardState;
  currentState = DashBoardState.Loading;
  private m_offset = 0;
  private m_sizeToGet = 5;

  constructor(responsiveService: ResponsiveService, private m_eventService: EventService, private m_authService: AuthService) {
    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
        this.bMobile = false;
      } else {
        this.bMobile = true;
      }
    });

    if (!this.bMobile) {
      this.m_sizeToGet = 15;
    }
  }

  ngOnInit() {
    this.m_eventService.getEventList(this.m_offset, this.m_sizeToGet).subscribe(result => {
      this.currentState = DashBoardState.Done;
      this.events = result;
      this.m_offset += this.m_sizeToGet;
    }, error => {
      this.currentState = DashBoardState.Error;
    });

  }

  increaseEventList() {
    this.currentState = DashBoardState.Loading;
    this.m_eventService.getEventList(this.m_offset, this.m_sizeToGet).subscribe(result => {
      if (isEmpty(result)) {
        this.currentState = DashBoardState.NoMore;
      } else {
        this.events = this.events.concat(result);
        this.m_offset += this.m_sizeToGet;
        this.currentState = DashBoardState.Done;
      }
    }, error => {
      this.currentState = DashBoardState.Error;
    });
  }

}
