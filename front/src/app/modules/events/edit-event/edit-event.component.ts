import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';

import { ResponsiveService } from 'app/core/services/responsive.service';
import { EventService } from '../event.service';
import { fillUndefinedProperties, removeEmptyProperties, removeUnchangedProperties, isEmpty } from 'app/shared/utility/change-objects';
import { MatDialog } from '@angular/material';
import { DialogComponent } from 'app/shared/components/dialog/dialog.component';

@Component({
  selector: 'app-edit-event',
  templateUrl: './edit-event.component.html',
  styleUrls: ['./edit-event.component.scss']
})
export class EditEventComponent implements OnInit {
  bMobile: boolean;
  eventId: number;
  eventForm: FormGroup;
  oldEventData: Object;
  minDate = new Date();
  bEndDetail = false;
  bEndDetailControl = true;

  constructor(responsiveService: ResponsiveService,
    private m_router: Router,
    private m_formBuilder: FormBuilder,
    route: ActivatedRoute,
    private m_eventService: EventService,
    private m_dialog: MatDialog) {
    this.eventId = Number(route.snapshot.paramMap.get('id'));

    responsiveService.isMobile().subscribe(result => {
      if (result.matches) {
        this.bMobile = false;
      } else {
        this.bMobile = true;
      }
    });

    this.eventForm = this.m_formBuilder.group({
      title: ['', Validators.required],
      photo_url: ['https://images.unsplash.com/photo-1541532713592-79a0317b6b77?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80', Validators.required],
      description: '',
      date_start: '',
      date_start_hour: '0',
      date_start_minute: '0',
      date_end: '',
      date_end_offset: '0',
      date_end_hour: '0',
      place: this.m_formBuilder.group({
        name: '',
        street: '',
        number: '',
        city: ''
      })
    });
  }

  ngOnInit() {
    this.m_eventService.getEventById(this.eventId).subscribe((result) => {
      // TODO store result as oldform, and remove matching terms

      result = fillUndefinedProperties(result);
      this.oldEventData = result;
      if (result.date_start != '') {
        const dateStart = new Date(result.date_start);
        this.eventForm.patchValue({
          date_start: dateStart,
          date_start_hour: dateStart.getHours().toString(),
          date_start_minute: dateStart.getMinutes().toString(),
        });
      }

      if (result.date_end != '') {
        this.bEndDetail = true;
        this.bEndDetailControl = false;
        const dateEnd = new Date(result.date_end);
        this.eventForm.patchValue({
          date_end: dateEnd,
          date_end_hour: dateEnd.getHours().toString(),
        });
      }
      
      this.eventForm.patchValue({
        title: result.title,
        photo_url: result.photo_url,
        description: result.description,
        place: result.place
      });
    }, error => {

    });
  }

  goTo(url: string) {
    this.m_router.navigateByUrl(url);
  }

  submitForm(): void {
    let form = this.eventForm.value;
    if (form.date_start_hour && form.date_start_minute) {
      if (form.date_start instanceof Date) {
        form.date_start.setHours(form.date_start_hour, form.date_start_minute); 
      }
    }
    if (!this.bEndDetail) {
      form.date_end = new Date(form.date_start);
      if (form.date_end_offset === 24) {
        form.date_end.setHours(23);
      } else {
        form.date_end.setHours(form.date_end.getHours() + Number(form.date_end_offset), 0);
      }
    } else {
      if (form.date_end instanceof Date && form.date_end_hour instanceof Date) {
        form.date_end.setHours(form.date_end_hour);
      }
    }

    delete form.date_start_hour;
    delete form.date_start_minute;
    delete form.date_end_hour;
    delete form.date_end_offset;

    form = removeEmptyProperties(form);
    form = removeUnchangedProperties(this.oldEventData, form);

    if (!isEmpty(form)) {
      this.m_eventService.update(this.eventId, form).subscribe(result => {
        this.m_router.navigate(['/evenements/detail/' + this.eventId]);
      }, error => {
  
      });
    } else {
      this.m_router.navigate(['/evenements/detail/' + this.eventId]);
    }
  }

  deleteEvent(): void {
    const dialogRef = this.m_dialog.open(DialogComponent, {
      width: "500px",
      data: {title: `Suppression d'un évènement`, text: `En êtes-vous bien sûr ?`, bValBtn: true}
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result.validated) {
        this.m_eventService.delete(this.eventId).subscribe(result => {
          this.m_router.navigate(['/tableau-de-bord']);
        }, error => {
    
        });
      }
    });
  }

  onDateEndDropChange(event: any): void {
    if (event === 'more') {
      this.bEndDetail = true;
      this.eventForm.patchValue({
        date_end: this.eventForm.value.date_start,
        date_end_hour: (this.eventForm.value.date_start.getHours() + 2 ).toString()
      });
    } else {
      this.bEndDetail = false;
    }
  }
}
