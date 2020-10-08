import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IsSignedInGuard } from './core/guards/is-signed-in.guard';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'tableau-de-bord',
    pathMatch: 'full'
  },
  {
    path: 'tableau-de-bord',
    loadChildren: './modules/dashboard/dashboard.module#DashboardModule',
    canActivate: [IsSignedInGuard]
  },
  {
    path: 'notifications',
    loadChildren: './modules/notifications/notifications.module#NotificationsModule',
    canActivate: [IsSignedInGuard]
  },
  {
    path: 'evenements',
    loadChildren: './modules/events/events.module#EventsModule',
    canActivate: [IsSignedInGuard]
  },
  {
    path: 'profil',
    loadChildren: './modules/profile/profile.module#ProfileModule',
    canActivate: [IsSignedInGuard]
  },
  {
    path: 'recherche',
    loadChildren: './modules/search/search.module#SearchModule',
    canActivate: [IsSignedInGuard]
  },
  {
    path: 'visiteur',
    loadChildren: './modules/visitor/visitor.module#VisitorModule'
  },
  {
    path: 'mentions-legales',
    loadChildren: './modules/legals/legals.module#LegalsModule'
  },
  {
    path: '404',
    loadChildren: './modules/page-not-found/page-not-found.module#PageNotFoundModule'
  },
  {
    path: '**',
    redirectTo: '404',
    pathMatch: 'full'
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
