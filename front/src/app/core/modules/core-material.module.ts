import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatSnackBarModule, MatIconModule, MatButtonModule, MatRippleModule, MatNativeDateModule } from '@angular/material';

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    MatButtonModule,
    MatSnackBarModule,
    MatIconModule,
    MatRippleModule,
    MatNativeDateModule
  ],
  exports: [
    MatButtonModule,
    MatSnackBarModule,
    MatIconModule,
    MatRippleModule,
    MatNativeDateModule
  ]
})
export class CoreMaterialModule { }
