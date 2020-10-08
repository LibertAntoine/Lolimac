import { NgModule, Optional, SkipSelf } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { RouterModule } from '@angular/router';
import { MAT_DATE_LOCALE } from '@angular/material/core';
import { registerLocaleData } from '@angular/common';
import { LOCALE_ID } from '@angular/core';
import localeFr from '@angular/common/locales/fr';

import { BottomNavigationComponent } from './components/bottom-navigation/bottom-navigation.component';
import { TopNavigationComponent } from './components/top-navigation/top-navigation.component';
import { AuthService } from './services/auth.service';
import { AuthInterceptor } from './interceptors/auth.interceptor';
import { ErrorInterceptor } from './interceptors/error.interceptor';
import { CoreMaterialModule } from './modules/core-material.module';
import { ResponsiveService } from './services/responsive.service';

registerLocaleData(localeFr, 'fr');

@NgModule({
  declarations: [
    BottomNavigationComponent,
    TopNavigationComponent
  ],
  imports: [
    CommonModule,
    RouterModule,
    CoreMaterialModule
  ],
  providers: [
    HttpClientModule,

    // Custom
    AuthService,
    ResponsiveService,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: ErrorInterceptor,
      multi: true
    },
    {
      provide: MAT_DATE_LOCALE,
      useValue: 'fr-FR'
    },
    {
      provide: LOCALE_ID,
      useValue: 'fr-FR'
    }
  ],
  exports: [
    HttpClientModule,
    BottomNavigationComponent,
    TopNavigationComponent,
    CoreMaterialModule
  ]
})
export class CoreModule {
  constructor(@Optional() @SkipSelf() parentModule: CoreModule) {
    if (parentModule) {
      throw new Error('CoreModule is already loaded. Import only in AppModule');
    }
  }
}
