import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
 
import { Observable } from 'rxjs';

import { environment } from 'environments/environment';

@Injectable({
  providedIn: 'root'
})
export class NotificationsService {

  constructor(private m_http: HttpClient) {}

  getAll(): Observable<any> {
    const URL = `${environment.backend.serverUrl}me/notifications`;
    return this.m_http.get<any>(URL);
  }

  getCount(): Observable<any> {
    const URL = `${environment.backend.serverUrl}me/notifications/count`;
    return this.m_http.get<any>(URL);
  }
}
