import { Injectable } from '@angular/core';
import { MatSnackBar } from '@angular/material';

@Injectable({
  providedIn: 'root'
})
export class SnackBarService {
  constructor(private m_snackBar: MatSnackBar) { }

  open(message: string, action = "ok", timeout = 5000): void {
    this.m_snackBar.open(message, action, {
      duration: timeout
    });
  }
}
