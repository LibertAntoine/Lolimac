import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { Event } from 'app/shared/models/event';
import { EventService } from '../event.service';
import { ResponsiveService } from 'app/core/services/responsive.service';
import { MatDialog } from '@angular/material';
import { DialogComponent } from 'app/shared/components/dialog/dialog.component';

@Component({
  selector: 'app-event-detail',
  templateUrl: './event-detail.component.html',
  styleUrls: ['./event-detail.component.scss']
})
export class EventDetailComponent implements OnInit {
  @ViewChild('place') place: ElementRef;
  event: Event;
  bMobile = true;
  bNoHour = true;
  eventId: number;

  constructor(private m_eventService: EventService,
    route: ActivatedRoute,
    private m_router: Router,
    responsiveService: ResponsiveService,
    private m_dialog: MatDialog) {
    this.eventId = Number(route.snapshot.paramMap.get('id'));

    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
        this.bMobile = false;
      } else {
        this.bMobile = true;
      }
    });
  }

  ngOnInit() {
    this.m_eventService.getEventById(this.eventId).subscribe(result => {
      this.event = result;
      if (result.date_start != '') {
        const date = new Date(result.date_start);
        if (date.getHours() != 0) {
          this.bNoHour = false;
        };
      }
    }, error => {

    });
  }

  goTo(url: string) {
    this.m_router.navigateByUrl(url);
  }

  joinEvent() {
    this.m_eventService.join(this.eventId).subscribe(result => {
    }, error => {
    })
  }

  leaveEvent() {
    this.m_eventService.leave(this.eventId).subscribe(result => {
    }, error => {
    })
  }

  reloadPosts(): void {
    this.m_eventService.getEventById(this.eventId).subscribe(result => {
      this.event.posts = result.posts;
    }, error => {

    });
  }

  getIcsLink(): void {
    this.m_eventService.getIcsLink(this.eventId).subscribe(result => {
      const dialogRef = this.m_dialog.open(DialogComponent, {
        width: "500px",
        data: {title: `Export de l'évènement`, text: `Copiez ce lien dans votre application de calendrier: ${result.url} `}
      });
    }, error => {

    });
  }

  scrollToPlace(): void {
    const target = this.place.nativeElement;
    target.scrollIntoView({behavior: 'smooth'});
  }

  log(text: string): void {
    console.log(text);
  }
}
