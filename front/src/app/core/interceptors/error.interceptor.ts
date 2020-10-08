import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Router } from '@angular/router';

// 3rd party
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';

// custom
import { AuthService } from '../services/auth.service';
import { SnackBarService } from '../services/snack-bar.service';

@Injectable({
    providedIn: 'root',
})
export class ErrorInterceptor implements HttpInterceptor {
    constructor(private m_authService: AuthService, private m_router: Router, private m_snackbar: SnackBarService) { }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        return next.handle(request).pipe(catchError(err => {
          console.error(err);
          switch(err.status) {
              case 0:
                this.m_snackbar.open('[Erreur] Le serveur est déconnecté !', 'Oh, zut alors', 10000);
                break;

              case 400:
                if (err.error.message) {
                  this.m_snackbar.open('[Erreur] ' + err.error.message, 'Oh, zut alors', 10000);
                } else {
                  this.m_snackbar.open('[Erreur] La requête envoyée au serveur est invalide !', 'Oh, zut alors', 10000);
                }
                break;

              case 401:
                  // logout if token expired
                  //this.m_authService.redirectUrl = location.origin; // FIXME wrong route ?
                  if (this.m_authService.isLoggedIn()) {
                    this.m_snackbar.open('Votre connexion a expirée', 'Très bien', 10000);
                    this.m_authService.logout();
                    this.m_router.navigate(['/visiteur/login']);
                  } else {
                    this.m_snackbar.open('Mot de passe ou pseudo incorrect !', 'Je retente', 10000);
                  }
                  break;

              case 500:
                this.m_snackbar.open('[Erreur] Problème interne coté serveur !', 'Oh, zut alors', 10000);
                break;

              case 504:
                this.m_snackbar.open('[Erreur] Le serveur a mit trop de temps à répondre, veuillez réessayer plus tard !', 'Oh, zut alors', 10000);
                break;
            
              default:
                if (err.message.search("Http failure during parsing") == 0) {
                  this.m_snackbar.open('[Erreur] La réponse formulée par le serveur est incorrecte !', 'Oh, zut alors', 10000);
                }
                break;
            }
          return throwError(err);
        }));
    }
}
