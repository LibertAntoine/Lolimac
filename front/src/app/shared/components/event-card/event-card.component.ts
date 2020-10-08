import { Component, OnInit, Input } from '@angular/core';
import { Router } from '@angular/router';

import { Event } from 'app/shared/models/event';
import { EventService } from 'app/modules/events/event.service';

@Component({
  selector: 'app-event-card',
  templateUrl: './event-card.component.html',
  styleUrls: ['./event-card.component.scss']
})
export class EventCardComponent implements OnInit {
  @Input() event: Event;

  constructor(private m_router: Router,
    private m_eventService: EventService) { }

  ngOnInit() {
  }

  goTo(url: string) {
    this.m_router.navigateByUrl(url);
  }

  joinEvent(id: number) {
    this.m_eventService.join(id).subscribe(result => {
    }, error => {
    })
  }

  leaveEvent(id: number) {
    this.m_eventService.leave(id).subscribe(result => {
    }, error => {
    })
  }
}
