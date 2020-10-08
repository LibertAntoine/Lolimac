import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
    {
      path: 'creation',
      loadChildren: './create-event/create-event.module#CreateEventModule'
    },
    {
      path: 'detail/:id',
      loadChildren: './event-detail/event-detail.module#EventDetailModule'
    },
    {
      path: 'edition/:id',
      loadChildren: './edit-event/edit-event.module#EditEventModule'
    },
    {
      path: '404',
      loadChildren: '../page-not-found/page-not-found.module#PageNotFoundModule'
    },
    {
      path: '**',
      redirectTo: '404',
      pathMatch: 'full'
    }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class EventsRoutingModule { }