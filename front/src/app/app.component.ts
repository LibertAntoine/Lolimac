import { Component } from '@angular/core';
import { SwUpdate, SwPush } from '@angular/service-worker';
import { Router, RouterEvent, NavigationEnd } from '@angular/router';

import { AuthService } from './core/services/auth.service';
import { ResponsiveService } from './core/services/responsive.service';
import { NotificationsService } from './modules/notifications/notifications.service';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss'],
})
export class AppComponent {
    bMobile = true;
    bVisitor = true;
    notificationCount = 0;

    constructor(updates: SwUpdate, push: SwPush,
        authService: AuthService,
        responsiveService: ResponsiveService,
        router: Router,
        notificationsService: NotificationsService) 
    {
        push.messages.subscribe(message => {
            console.info("New push message recieved !");
            console.log(message);
        });

        responsiveService.isMobile().subscribe(result => {
            if (result.matches) {
                this.bMobile = false;
            } else {
                this.bMobile = true;
            }
        });

        router.events.subscribe((event: RouterEvent) => {
            if (event instanceof NavigationEnd) {
                if (event.url.search("visiteur") != -1 || event.url.search("404") != -1) {
                    this.bVisitor = true;
                } else {
                    this.bVisitor = false;
                    notificationsService.getCount().subscribe(result => {
                        this.notificationCount = Number(result.notifications);
                    });
                }

                if (event.url.search("notifications") != -1) {
                    this.notificationCount = 0;
                }
            }
        });
    }
}
