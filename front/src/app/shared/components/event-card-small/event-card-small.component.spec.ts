import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EventCardSmallComponent } from './event-card-small.component';

describe('EventCardSmallComponent', () => {
  let component: EventCardSmallComponent;
  let fixture: ComponentFixture<EventCardSmallComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EventCardSmallComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EventCardSmallComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
