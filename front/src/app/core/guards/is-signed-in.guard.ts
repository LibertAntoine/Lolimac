import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router, CanActivate } from '@angular/router';
import { Observable } from 'rxjs';

import { AuthService } from '../services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class IsSignedInGuard implements CanActivate {
  constructor(private m_authService: AuthService, private m_router: Router) {}

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
    const url: string = state.url;
    return this.checkLogin(url);
  }

  private checkLogin(url: string): boolean {
    if (this.m_authService.isLoggedIn()) {
      return true;
    } else {
      // Store the attempted URL for redirecting after a successfull login
      this.m_authService.redirectUrl = url;
      this.m_router.navigate(['/visiteur/login']);
      return false;
    }
  }
}
