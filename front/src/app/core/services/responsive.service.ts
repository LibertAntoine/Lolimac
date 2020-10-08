import { Injectable } from '@angular/core';
import { BreakpointObserver, BreakpointState } from '@angular/cdk/layout';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ResponsiveService {
  constructor(private m_breakpointObserver: BreakpointObserver) {}

  isMobile(): Observable<BreakpointState> {
    return this.m_breakpointObserver.observe(['(min-width: 800px)']);
  }
}
