import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Observable } from 'rxjs';
import { environment } from 'environments/environment';
import { removeEmptyProperties } from 'app/shared/utility/change-objects';

@Injectable({
  providedIn: 'root'
})
export class EventService {

  constructor(private m_http: HttpClient) {}

  createEvent(form: Object): Observable<any> {
    form = removeEmptyProperties(form);
    const URL = `${environment.backend.serverUrl}events`;
    return this.m_http.post<any>(URL, JSON.stringify(form));
  }

  getEventById(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${id}`;
    return this.m_http.get<any>(URL);
  }

  getEventList(from: number, limit: number): Observable<any[]> {
    const URL = `${environment.backend.serverUrl}events?from=${from}&limit=${limit}`;
    return this.m_http.get<any>(URL);
  }

  getIcsLink(id: number) {
    const URL = `${environment.backend.serverUrl}events/export/${id}`;
    return this.m_http.get<any>(URL);
  }

  search(terms: string): Observable<any[]> {
    const URL = `${environment.backend.serverUrl}events/search/?q=${terms}`;
    return this.m_http.get<any>(URL);
  }

  update(id: number, form: Object): Observable<any> {
    form = removeEmptyProperties(form);
    const URL = `${environment.backend.serverUrl}events/${id}`;
    return this.m_http.patch<any>(URL, JSON.stringify(form));
  }

  join(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${id}/join`;
    return this.m_http.post<any>(URL, undefined);
  }

  leave(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${id}/leave`;
    return this.m_http.delete<any>(URL, undefined);
  }

  delete(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}events/${id}`;
    return this.m_http.delete<any>(URL);
  }
}
