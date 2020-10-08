import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EventCardNotificationComponent } from './event-card-notification.component';

describe('EventCardNotificationComponent', () => {
  let component: EventCardNotificationComponent;
  let fixture: ComponentFixture<EventCardNotificationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EventCardNotificationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EventCardNotificationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
