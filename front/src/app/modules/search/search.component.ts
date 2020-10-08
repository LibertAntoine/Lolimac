import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';

import { Observable, Subject } from 'rxjs';
import { debounceTime, distinctUntilChanged, switchMap } from 'rxjs/operators';

import { Event } from 'app/shared/models/event';
import { EventService } from '../events/event.service';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {
  searchResults$: Observable<Event[]>;
  searchForm: FormGroup;

  private m_searchTerms = new Subject<string>();

  constructor(private m_eventService: EventService,
    private m_formBuilder: FormBuilder) {
    this.searchForm = this.m_formBuilder.group({
      terms: ['']
    });
  }

  ngOnInit() {
    this.searchResults$ = this.m_searchTerms.pipe(
      // wait 300ms after each keystroke before considering the term
      debounceTime(300),
      // ignore new term if same as previous term
      distinctUntilChanged(),
      // switch to new search observable each time the term changes
      switchMap((term: string) => this.m_eventService.search(term))
    );
  }

  // Push a search term into the observable stream.
  search(terms: string): void {
    this.m_searchTerms.next(terms);
  }

}
