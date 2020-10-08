import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Observable } from 'rxjs';

import { environment } from 'environments/environment';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private m_http: HttpClient) { }

  create(form: JSON): Observable<any> {
    const URL = `${environment.backend.serverUrl}users`;
    return this.m_http.post<any>(URL, JSON.stringify(form));
  }

  get(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}users/${id}`;
    return this.m_http.get<any>(URL);
  }

  update(id: number, form: JSON): Observable<any> {
    const URL = `${environment.backend.serverUrl}users/${id}`;
    return this.m_http.patch<any>(URL, JSON.stringify(form));
  }

  delete(id: number): Observable<any> {
    const URL = `${environment.backend.serverUrl}users/${id}`;
    return this.m_http.delete<any>(URL);
  }
}
