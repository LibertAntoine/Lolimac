'use strict';


customElements.define('compodoc-menu', class extends HTMLElement {
    constructor() {
        super();
        this.isNormalMode = this.getAttribute('mode') === 'normal';
    }

    connectedCallback() {
        this.render(this.isNormalMode);
    }

    render(isNormalMode) {
        let tp = lithtml.html(`
        <nav>
            <ul class="list">
                <li class="title">
                    <a href="index.html" data-type="index-link">imac-resoi-front documentation</a>
                </li>

                <li class="divider"></li>
                ${ isNormalMode ? `<div id="book-search-input" role="search"><input type="text" placeholder="Type to search"></div>` : '' }
                <li class="chapter">
                    <a data-type="chapter-link" href="index.html"><span class="icon ion-ios-home"></span>Getting started</a>
                    <ul class="links">
                        <li class="link">
                            <a href="overview.html" data-type="chapter-link">
                                <span class="icon ion-ios-keypad"></span>Overview
                            </a>
                        </li>
                        <li class="link">
                            <a href="index.html" data-type="chapter-link">
                                <span class="icon ion-ios-paper"></span>README
                            </a>
                        </li>
                        <li class="link">
                            <a href="license.html"  data-type="chapter-link">
                                <span class="icon ion-ios-paper"></span>LICENSE
                            </a>
                        </li>
                        <li class="link">
                            <a href="dependencies.html" data-type="chapter-link">
                                <span class="icon ion-ios-list"></span>Dependencies
                            </a>
                        </li>
                    </ul>
                </li>
                    <li class="chapter modules">
                        <a data-type="chapter-link" href="modules.html">
                            <div class="menu-toggler linked" data-toggle="collapse" ${ isNormalMode ?
                                'data-target="#modules-links"' : 'data-target="#xs-modules-links"' }>
                                <span class="icon ion-ios-archive"></span>
                                <span class="link-name">Modules</span>
                                <span class="icon ion-ios-arrow-down"></span>
                            </div>
                        </a>
                        <ul class="links collapse" ${ isNormalMode ? 'id="modules-links"' : 'id="xs-modules-links"' }>
                            <li class="link">
                                <a href="modules/AppModule.html" data-type="entity-link">AppModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-AppModule-1baba09bc7b7a38c6798e3b55ffefd74"' : 'data-target="#xs-components-links-module-AppModule-1baba09bc7b7a38c6798e3b55ffefd74"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-AppModule-1baba09bc7b7a38c6798e3b55ffefd74"' :
                                            'id="xs-components-links-module-AppModule-1baba09bc7b7a38c6798e3b55ffefd74"' }>
                                            <li class="link">
                                                <a href="components/AppComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">AppComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/AppRoutingModule.html" data-type="entity-link">AppRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/AppServerModule.html" data-type="entity-link">AppServerModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-AppServerModule-6f845fdce6d80526e11ce4cddb70e623"' : 'data-target="#xs-components-links-module-AppServerModule-6f845fdce6d80526e11ce4cddb70e623"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-AppServerModule-6f845fdce6d80526e11ce4cddb70e623"' :
                                            'id="xs-components-links-module-AppServerModule-6f845fdce6d80526e11ce4cddb70e623"' }>
                                            <li class="link">
                                                <a href="components/AppComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">AppComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/CoreMaterialModule.html" data-type="entity-link">CoreMaterialModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/CoreModule.html" data-type="entity-link">CoreModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' : 'data-target="#xs-components-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' :
                                            'id="xs-components-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' }>
                                            <li class="link">
                                                <a href="components/BottomNavigationComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">BottomNavigationComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/TopNavigationComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">TopNavigationComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                                <li class="chapter inner">
                                    <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                        'data-target="#injectables-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' : 'data-target="#xs-injectables-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' }>
                                        <span class="icon ion-md-arrow-round-down"></span>
                                        <span>Injectables</span>
                                        <span class="icon ion-ios-arrow-down"></span>
                                    </div>
                                    <ul class="links collapse" ${ isNormalMode ? 'id="injectables-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' :
                                        'id="xs-injectables-links-module-CoreModule-019fda25406c3d315c97aa9cf0a552fe"' }>
                                        <li class="link">
                                            <a href="injectables/AuthService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>AuthService</a>
                                        </li>
                                        <li class="link">
                                            <a href="injectables/ResponsiveService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>ResponsiveService</a>
                                        </li>
                                    </ul>
                                </li>
                            </li>
                            <li class="link">
                                <a href="modules/CreateEventModule.html" data-type="entity-link">CreateEventModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-CreateEventModule-1dc31bbf58b03dbe752879b28960acc3"' : 'data-target="#xs-components-links-module-CreateEventModule-1dc31bbf58b03dbe752879b28960acc3"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-CreateEventModule-1dc31bbf58b03dbe752879b28960acc3"' :
                                            'id="xs-components-links-module-CreateEventModule-1dc31bbf58b03dbe752879b28960acc3"' }>
                                            <li class="link">
                                                <a href="components/CreateEventComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">CreateEventComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/CreateEventRoutingModule.html" data-type="entity-link">CreateEventRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/DashboardModule.html" data-type="entity-link">DashboardModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-DashboardModule-eee20dbd623b64326757842e12126d70"' : 'data-target="#xs-components-links-module-DashboardModule-eee20dbd623b64326757842e12126d70"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-DashboardModule-eee20dbd623b64326757842e12126d70"' :
                                            'id="xs-components-links-module-DashboardModule-eee20dbd623b64326757842e12126d70"' }>
                                            <li class="link">
                                                <a href="components/DashboardComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">DashboardComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/DashboardRoutingModule.html" data-type="entity-link">DashboardRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/EditEventModule.html" data-type="entity-link">EditEventModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-EditEventModule-6b834132e3de09ab0c237f559d6bb3db"' : 'data-target="#xs-components-links-module-EditEventModule-6b834132e3de09ab0c237f559d6bb3db"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-EditEventModule-6b834132e3de09ab0c237f559d6bb3db"' :
                                            'id="xs-components-links-module-EditEventModule-6b834132e3de09ab0c237f559d6bb3db"' }>
                                            <li class="link">
                                                <a href="components/EditEventComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">EditEventComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/EditEventRoutingModule.html" data-type="entity-link">EditEventRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/EventDetailModule.html" data-type="entity-link">EventDetailModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-EventDetailModule-494bd5a76125960439a258868cb76a69"' : 'data-target="#xs-components-links-module-EventDetailModule-494bd5a76125960439a258868cb76a69"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-EventDetailModule-494bd5a76125960439a258868cb76a69"' :
                                            'id="xs-components-links-module-EventDetailModule-494bd5a76125960439a258868cb76a69"' }>
                                            <li class="link">
                                                <a href="components/EventDetailComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">EventDetailComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/EventDetailRoutingModule.html" data-type="entity-link">EventDetailRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/EventsModule.html" data-type="entity-link">EventsModule</a>
                                <li class="chapter inner">
                                    <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                        'data-target="#injectables-links-module-EventsModule-b1488a9ad3d6042e16afdec85bc68306"' : 'data-target="#xs-injectables-links-module-EventsModule-b1488a9ad3d6042e16afdec85bc68306"' }>
                                        <span class="icon ion-md-arrow-round-down"></span>
                                        <span>Injectables</span>
                                        <span class="icon ion-ios-arrow-down"></span>
                                    </div>
                                    <ul class="links collapse" ${ isNormalMode ? 'id="injectables-links-module-EventsModule-b1488a9ad3d6042e16afdec85bc68306"' :
                                        'id="xs-injectables-links-module-EventsModule-b1488a9ad3d6042e16afdec85bc68306"' }>
                                        <li class="link">
                                            <a href="injectables/EventService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>EventService</a>
                                        </li>
                                        <li class="link">
                                            <a href="injectables/PostService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>PostService</a>
                                        </li>
                                    </ul>
                                </li>
                            </li>
                            <li class="link">
                                <a href="modules/EventsRoutingModule.html" data-type="entity-link">EventsRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/LegalsModule.html" data-type="entity-link">LegalsModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-LegalsModule-3a7232d3d4fd893148edc73ce1c0b8ac"' : 'data-target="#xs-components-links-module-LegalsModule-3a7232d3d4fd893148edc73ce1c0b8ac"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-LegalsModule-3a7232d3d4fd893148edc73ce1c0b8ac"' :
                                            'id="xs-components-links-module-LegalsModule-3a7232d3d4fd893148edc73ce1c0b8ac"' }>
                                            <li class="link">
                                                <a href="components/LegalsComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">LegalsComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/LegalsRoutingModule.html" data-type="entity-link">LegalsRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/NotificationsModule.html" data-type="entity-link">NotificationsModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' : 'data-target="#xs-components-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' :
                                            'id="xs-components-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' }>
                                            <li class="link">
                                                <a href="components/NotificationsComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">NotificationsComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                                <li class="chapter inner">
                                    <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                        'data-target="#injectables-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' : 'data-target="#xs-injectables-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' }>
                                        <span class="icon ion-md-arrow-round-down"></span>
                                        <span>Injectables</span>
                                        <span class="icon ion-ios-arrow-down"></span>
                                    </div>
                                    <ul class="links collapse" ${ isNormalMode ? 'id="injectables-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' :
                                        'id="xs-injectables-links-module-NotificationsModule-080eb549465e4180c88c86e652079db6"' }>
                                        <li class="link">
                                            <a href="injectables/NotificationsService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>NotificationsService</a>
                                        </li>
                                    </ul>
                                </li>
                            </li>
                            <li class="link">
                                <a href="modules/NotificationsRoutingModule.html" data-type="entity-link">NotificationsRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/PageNotFoundModule.html" data-type="entity-link">PageNotFoundModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-PageNotFoundModule-0bc830147d4044f6d50a71f02bb3e477"' : 'data-target="#xs-components-links-module-PageNotFoundModule-0bc830147d4044f6d50a71f02bb3e477"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-PageNotFoundModule-0bc830147d4044f6d50a71f02bb3e477"' :
                                            'id="xs-components-links-module-PageNotFoundModule-0bc830147d4044f6d50a71f02bb3e477"' }>
                                            <li class="link">
                                                <a href="components/PageNotFoundComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">PageNotFoundComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/PageNotFoundRoutingModule.html" data-type="entity-link">PageNotFoundRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/ProfileModule.html" data-type="entity-link">ProfileModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-ProfileModule-3a43e8cd5888c0a8cc903ffad7e09556"' : 'data-target="#xs-components-links-module-ProfileModule-3a43e8cd5888c0a8cc903ffad7e09556"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-ProfileModule-3a43e8cd5888c0a8cc903ffad7e09556"' :
                                            'id="xs-components-links-module-ProfileModule-3a43e8cd5888c0a8cc903ffad7e09556"' }>
                                            <li class="link">
                                                <a href="components/ChangePasswordComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">ChangePasswordComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/EditProfileComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">EditProfileComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/ProfileComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">ProfileComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/ProfileRoutingModule.html" data-type="entity-link">ProfileRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/SearchModule.html" data-type="entity-link">SearchModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-SearchModule-f91f897b9a44ee7da0d12eae88e59247"' : 'data-target="#xs-components-links-module-SearchModule-f91f897b9a44ee7da0d12eae88e59247"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-SearchModule-f91f897b9a44ee7da0d12eae88e59247"' :
                                            'id="xs-components-links-module-SearchModule-f91f897b9a44ee7da0d12eae88e59247"' }>
                                            <li class="link">
                                                <a href="components/SearchComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">SearchComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/SearchRoutingModule.html" data-type="entity-link">SearchRoutingModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/SharedMaterialModule.html" data-type="entity-link">SharedMaterialModule</a>
                            </li>
                            <li class="link">
                                <a href="modules/SharedModule.html" data-type="entity-link">SharedModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-SharedModule-d4a7898cfced2451f209e2a9c9529e5b"' : 'data-target="#xs-components-links-module-SharedModule-d4a7898cfced2451f209e2a9c9529e5b"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-SharedModule-d4a7898cfced2451f209e2a9c9529e5b"' :
                                            'id="xs-components-links-module-SharedModule-d4a7898cfced2451f209e2a9c9529e5b"' }>
                                            <li class="link">
                                                <a href="components/CommentListComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">CommentListComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/EventCardComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">EventCardComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/PostListComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">PostListComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/TopAppBarComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">TopAppBarComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                            </li>
                            <li class="link">
                                <a href="modules/VisitorModule.html" data-type="entity-link">VisitorModule</a>
                                    <li class="chapter inner">
                                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                            'data-target="#components-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' : 'data-target="#xs-components-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' }>
                                            <span class="icon ion-md-cog"></span>
                                            <span>Components</span>
                                            <span class="icon ion-ios-arrow-down"></span>
                                        </div>
                                        <ul class="links collapse" ${ isNormalMode ? 'id="components-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' :
                                            'id="xs-components-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' }>
                                            <li class="link">
                                                <a href="components/ForgotComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">ForgotComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/InscriptionComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">InscriptionComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/InvitationComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">InvitationComponent</a>
                                            </li>
                                            <li class="link">
                                                <a href="components/LoginComponent.html"
                                                    data-type="entity-link" data-context="sub-entity" data-context-id="modules">LoginComponent</a>
                                            </li>
                                        </ul>
                                    </li>
                                <li class="chapter inner">
                                    <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ?
                                        'data-target="#injectables-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' : 'data-target="#xs-injectables-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' }>
                                        <span class="icon ion-md-arrow-round-down"></span>
                                        <span>Injectables</span>
                                        <span class="icon ion-ios-arrow-down"></span>
                                    </div>
                                    <ul class="links collapse" ${ isNormalMode ? 'id="injectables-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' :
                                        'id="xs-injectables-links-module-VisitorModule-44b744e02433e4a304802c512af792b7"' }>
                                        <li class="link">
                                            <a href="injectables/UserService.html"
                                                data-type="entity-link" data-context="sub-entity" data-context-id="modules" }>UserService</a>
                                        </li>
                                    </ul>
                                </li>
                            </li>
                            <li class="link">
                                <a href="modules/VisitorRoutingModule.html" data-type="entity-link">VisitorRoutingModule</a>
                            </li>
                </ul>
                </li>
                        <li class="chapter">
                            <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ? 'data-target="#injectables-links"' :
                                'data-target="#xs-injectables-links"' }>
                                <span class="icon ion-md-arrow-round-down"></span>
                                <span>Injectables</span>
                                <span class="icon ion-ios-arrow-down"></span>
                            </div>
                            <ul class="links collapse" ${ isNormalMode ? 'id="injectables-links"' : 'id="xs-injectables-links"' }>
                                <li class="link">
                                    <a href="injectables/AuthService.html" data-type="entity-link">AuthService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/EventService.html" data-type="entity-link">EventService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/NotificationsService.html" data-type="entity-link">NotificationsService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/NotificationsService-1.html" data-type="entity-link">NotificationsService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/PostService.html" data-type="entity-link">PostService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/ResponsiveService.html" data-type="entity-link">ResponsiveService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/SnackBarService.html" data-type="entity-link">SnackBarService</a>
                                </li>
                                <li class="link">
                                    <a href="injectables/UserService.html" data-type="entity-link">UserService</a>
                                </li>
                            </ul>
                        </li>
                    <li class="chapter">
                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ? 'data-target="#interceptors-links"' :
                            'data-target="#xs-interceptors-links"' }>
                            <span class="icon ion-ios-swap"></span>
                            <span>Interceptors</span>
                            <span class="icon ion-ios-arrow-down"></span>
                        </div>
                        <ul class="links collapse" ${ isNormalMode ? 'id="interceptors-links"' : 'id="xs-interceptors-links"' }>
                            <li class="link">
                                <a href="interceptors/AuthInterceptor.html" data-type="entity-link">AuthInterceptor</a>
                            </li>
                            <li class="link">
                                <a href="interceptors/ErrorInterceptor.html" data-type="entity-link">ErrorInterceptor</a>
                            </li>
                        </ul>
                    </li>
                    <li class="chapter">
                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ? 'data-target="#guards-links"' :
                            'data-target="#xs-guards-links"' }>
                            <span class="icon ion-ios-lock"></span>
                            <span>Guards</span>
                            <span class="icon ion-ios-arrow-down"></span>
                        </div>
                        <ul class="links collapse" ${ isNormalMode ? 'id="guards-links"' : 'id="xs-guards-links"' }>
                            <li class="link">
                                <a href="guards/IsSignedInGuard.html" data-type="entity-link">IsSignedInGuard</a>
                            </li>
                        </ul>
                    </li>
                    <li class="chapter">
                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ? 'data-target="#interfaces-links"' :
                            'data-target="#xs-interfaces-links"' }>
                            <span class="icon ion-md-information-circle-outline"></span>
                            <span>Interfaces</span>
                            <span class="icon ion-ios-arrow-down"></span>
                        </div>
                        <ul class="links collapse" ${ isNormalMode ? ' id="interfaces-links"' : 'id="xs-interfaces-links"' }>
                            <li class="link">
                                <a href="interfaces/Comment.html" data-type="entity-link">Comment</a>
                            </li>
                            <li class="link">
                                <a href="interfaces/Event.html" data-type="entity-link">Event</a>
                            </li>
                            <li class="link">
                                <a href="interfaces/Notification.html" data-type="entity-link">Notification</a>
                            </li>
                            <li class="link">
                                <a href="interfaces/Place.html" data-type="entity-link">Place</a>
                            </li>
                            <li class="link">
                                <a href="interfaces/Post.html" data-type="entity-link">Post</a>
                            </li>
                            <li class="link">
                                <a href="interfaces/User.html" data-type="entity-link">User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="chapter">
                        <div class="simple menu-toggler" data-toggle="collapse" ${ isNormalMode ? 'data-target="#miscellaneous-links"'
                            : 'data-target="#xs-miscellaneous-links"' }>
                            <span class="icon ion-ios-cube"></span>
                            <span>Miscellaneous</span>
                            <span class="icon ion-ios-arrow-down"></span>
                        </div>
                        <ul class="links collapse" ${ isNormalMode ? 'id="miscellaneous-links"' : 'id="xs-miscellaneous-links"' }>
                            <li class="link">
                                <a href="miscellaneous/enumerations.html" data-type="entity-link">Enums</a>
                            </li>
                            <li class="link">
                                <a href="miscellaneous/functions.html" data-type="entity-link">Functions</a>
                            </li>
                            <li class="link">
                                <a href="miscellaneous/variables.html" data-type="entity-link">Variables</a>
                            </li>
                        </ul>
                    </li>
                    <li class="chapter">
                        <a data-type="chapter-link" href="coverage.html"><span class="icon ion-ios-stats"></span>Documentation coverage</a>
                    </li>
                    <li class="divider"></li>
                    <li class="copyright">
                        Documentation generated using <a href="https://compodoc.app/" target="_blank">
                            <img data-src="images/compodoc-vectorise.png" class="img-responsive" data-type="compodoc-logo">
                        </a>
                    </li>
            </ul>
        </nav>
        `);
        this.innerHTML = tp.strings;
    }
});