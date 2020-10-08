import { Injectable, PLATFORM_ID, Inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';

// 3rd party
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';

// Custom
import { environment } from 'environments/environment';
import { isPlatformBrowser } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  redirectUrl = '/tableau-de-bord';
  private m_bLoggedIn = false;

  constructor(private m_http: HttpClient, @Inject(PLATFORM_ID) private m_platformId: Object) {
    if (isPlatformBrowser(this.m_platformId)) {
      if (localStorage.getItem('jwt')) {
        this.m_bLoggedIn = true;
        // TODO test token and renew it
      }
    }
  }

  login(username: string, password: string): Observable<any> {
    const URL = `${environment.backend.serverUrl}login`;
    return this.m_http.post<any>(URL, {"pseudo": username, "pwd": password})
      .pipe(
        tap(
          data => { // logged-in
            if ((data.jwt) && (data.id_user)) {
              if (isPlatformBrowser(this.m_platformId)) {
                localStorage.setItem('jwt', data.jwt);
                localStorage.setItem('userId', data.id_user);
                this.m_bLoggedIn = true;
              } else {
                console.error('[Login] Impossible de stocker token coté serveur');
              }
            } else {
              console.error('[Login] Mauvaise structure de la réponse');
            }
          },
          error => { // bad credentials or internal error
            console.error(error);
          }
        )
      );
  }

  logout(): void {
    localStorage.removeItem('jwt');
    localStorage.removeItem('userId');
    this.m_bLoggedIn = false;
  }

  isLoggedIn(): boolean {
    return this.m_bLoggedIn;
  }

  getToken(): string {
    return localStorage.getItem('jwt');
  }

  getUserId(): number {
    return Number(localStorage.getItem('userId'));
  }
}
