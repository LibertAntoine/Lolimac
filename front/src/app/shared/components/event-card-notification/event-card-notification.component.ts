import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';

import { Event } from 'app/shared/models/event';

@Component({
  selector: 'app-event-card-notification',
  templateUrl: './event-card-notification.component.html',
  styleUrls: ['./event-card-notification.component.scss']
})
export class EventCardNotificationComponent implements OnInit {
  @Input() event: Event;

  constructor(private m_router: Router) { }

  ngOnInit() {
  }

  goTo(url: string) {
    this.m_router.navigateByUrl(url);
  }
}
