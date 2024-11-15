<!-- begin default navbar template -->

{{* debug *}}

{{* import variables from neuhub-config.php so they are available in this template *}}
{{include file="neuhub-config.tpl"}}

      <!-- Sidebar -->
      <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            
              <!-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> -->
              <!-- <img src="https://wistex.com/images/wt_4.gif" width="115" height="51" alt="Tabler" class="!navbar-brand-image"> -->
              <!-- <img src="https://neuhub.org/custom/images/neuhub-horizontal-51.png" height="51" alt="Neuhub"></a> -->
              {{$banner}}
            
          </h1>
          <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-lg-flex me-3">
              <div class="btn-list">
                <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/brand-github -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                  Source code
                </a>
                <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
                  <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                  Sponsor
                </a>
              </div>
            </div>
            <div class="d-none d-lg-flex">
              <a href="{{$url}}?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="{{$url}}?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
              <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                  <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                  <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Last updates</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 1</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Change deprecated html tags to text decoration classes (#29604)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 2</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              justify-content:between ⇒ justify-content:space-between (#29734)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions show">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 3</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Update change-version.js (#29736)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="#" class="text-body d-block">Example 4</a>
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Regenerate package-lock.json (#29730)
                            </div>
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {{* check for not null. *}}
          {{if isset($userinfo.icon) }}

            {{* If there is an user icon display it *}}
            {{$redtab.icon=$userinfo.icon}}

          {{else}}

            {{* If there is not user icon display a default icon instead *}}
            {{$redtab.icon="/view/theme/neuhub-tab/img/blank-profile-picture-180x180.png"}}
            
          {{/if}}

            <!-- Top Navbar User Menu MOBILE -->
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{$redtab.icon}})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{if $nav.login && !$userinfo.addr}}
                    Guest
                {{else}}
                    {{$userinfo.name}}
                {{/if}}</div>
                  <div class="mt-1 small text-secondary">Channel</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

              {{if $is_owner}}
                <a class="dropdown-item" href="/channel"><!-- <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp; -->View Channel</a>

                {{foreach $nav.usermenu as $usermenu}}
                    <a class="dropdown-item{{if $usermenu.2}} active{{/if}}"  href="{{$usermenu.0}}" title="{{$usermenu.3}}" role="menuitem" id="{{$usermenu.4}}">{{$usermenu.1}}</a>
                {{/foreach}}
                {{if $nav.group}}
                    <a class="dropdown-item" href="{{$nav.group.0}}" title="{{$nav.group.3}}" role="menuitem" id="{{$nav.group.4}}">{{$nav.group.1}}</a>
                {{/if}}
                
                
                <a class="dropdown-item" href="/connections"><!-- <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp; -->Connections</a>
                
                <div class="dropdown-divider"></div>
                
                {{if $nav.manage}}
                    <a class="dropdown-item{{if $sel.name == Manage}} active{{/if}}" href="{{$nav.manage.0}}" title="{{$nav.manage.3}}" role="menuitem" id="{{$nav.manage.4}}">{{$nav.manage.1}}</a>
                {{/if}}
                {{if $nav.channels}}
                    {{foreach $nav.channels as $chan}}
                        <a class="dropdown-item" href="manage/{{$chan.channel_id}}" title="{{$chan.channel_name}}" role="menuitem"><i class="fa fa-circle{{if $localuser == $chan.channel_id}} text-success{{else}} invisible{{/if}}"></i> {{$chan.channel_name}}</a>
                    {{/foreach}}
                {{/if}}
                {{if $nav.profiles}}
                    <a class="dropdown-item" href="{{$nav.profiles.0}}" title="{{$nav.profiles.3}}" role="menuitem" id="{{$nav.profiles.4}}">{{$nav.profiles.1}}</a>
                {{/if}}
                {{if $nav.settings}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item{{if $sel.name == Settings}} active{{/if}}" href="{{$nav.settings.0}}" title="{{$nav.settings.3}}" role="menuitem" id="{{$nav.settings.4}}">{{$nav.settings.1}}</a>
                {{/if}}
                {{if $nav.admin}}
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item{{if $sel.name == Admin}} active{{/if}}" href="{{$nav.admin.0}}" title="{{$nav.admin.3}}" role="menuitem" id="{{$nav.admin.4}}">{{$nav.admin.1}}</a>
                {{/if}}
                {{if $nav.logout}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{$nav.logout.0}}" title="{{$nav.logout.3}}" role="menuitem" id="{{$nav.logout.4}}">{{$nav.logout.1}}</a>
                {{/if}}
            {{/if}}
        
        
            {{if $localuser && !$is_owner}}
            
                {{if $nav.manage}}
                    <a class="dropdown-item{{if $sel.name == Manage}} active{{/if}}" href="{{$nav.manage.0}}" title="{{$nav.manage.3}}" role="menuitem" id="{{$nav.manage.4}}">{{$nav.manage.1}}</a>
                {{/if}}
                {{if $nav.channels}}
                    {{foreach $nav.channels as $chan}}
                        <a class="dropdown-item" href="manage/{{$chan.channel_id}}" title="{{$chan.channel_name}}" role="menuitem"><i class="fa fa-circle{{if $localuser == $chan.channel_id}} text-success{{else}} invisible{{/if}}"></i> {{$chan.channel_name}}</a>
                    {{/foreach}}
                {{/if}}
            

                {{if $nav.settings}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item{{if $sel.name == Settings}} active{{/if}}" href="{{$nav.settings.0}}" title="{{$nav.settings.3}}" role="menuitem" id="{{$nav.settings.4}}">{{$nav.settings.1}}</a>
                {{/if}}
                {{if $nav.admin}}
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item{{if $sel.name == Admin}} active{{/if}}" href="{{$nav.admin.0}}" title="{{$nav.admin.3}}" role="menuitem" id="{{$nav.admin.4}}">{{$nav.admin.1}}</a>
                {{/if}}
            <!--
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/settings"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Admin</a>
            -->
            <div class="dropdown-divider"></div>
            {{/if}}
        
        
            {{if ! $is_owner && $userinfo.addr}}
            
                <a class="dropdown-item" href="{{$nav.rusermenu.0}}" role="menuitem">{{$nav.rusermenu.1}}</a>
                <a class="dropdown-item" href="{{$nav.rusermenu.2}}" role="menuitem">{{$nav.rusermenu.3}}</a>
            
            {{/if}}		
            
            {{if $nav.login && !$userinfo.addr}}

              
              
                <a class="dropdown-item" href="login" title="{{$nav.loginmenu.1.3}}">
                    {{$nav.loginmenu.1.1}}
                </a>
                
                <a class="dropdown-item" href="rmagic" title="{{$nav.loginmenu.1.3}}">
                    Magic Sign-On
                </a>							
                <a class="dropdown-item" href="rmagic" title="{{$nav.loginmenu.1.3}}">
                    Remote Authentication
                </a>        				
            {{/if}}

              <!--
                <a href="/channel" class="dropdown-item">View Channel</a>
                <a href="/profile/wistex" class="dropdown-item">View Profile</a>
                <a href="/profiles/3" class="dropdown-item">Edit Profile</a>
                <a href="/connections" class="dropdown-item">Connections</a>
                <div class="dropdown-divider"></div>
                <a href="/settings" class="dropdown-item">Settings</a>
                <a href="/admin" class="dropdown-item">Admin</a>
                <div class="dropdown-divider"></div>
                <a href="/logout" class="dropdown-item">Logout</a>
                -->
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="sidebar-menu">


          {{$userinfo.testplugin.sidebar_before}}


          {{if $localuser}} 

            {{else}}

            {{* If this has a Channel Thumbnail, show details about the channel *}}
            {{if $channel_thumb_disabled}}


                <div class="card border-0">
                    <div class="card-body p-4 text-center">
                    <span class="avatar avatar-xl mb-3 rounded" style="background-image: url({{$channel_thumb}})"></span>

                    <h3 class="m-0 mb-1"><a href="{{$url}}">
                        {{if $name}}
                            {{$name}} {{* Name of the Channel *}}
                        {{else}}
                            {{$userinfo.name}} {{* If no name of the Channel, then we must be viewing our own channel *}}
                        {{/if}}
                    </a></h3>
                    
                    <!-- 
                        Says whether this is a channel or a forum.
                    -->
                    <div class="text-secondary">{{$sel.name}}</div>
                    <div class="!mt-3">
                    </div>
                    </div>
                    <!--
                    Says connect if the user must approve the connection.
                    Says follow if the user accepts any connection.
                    Says join if it is a forum.
                    -->
                    {{*
                    <div class="d-flex">
                    <!-- <span class="icon icon-hz-64"></span> -->
                    <a href="#" class="card-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275" />
                        <path d="M11.683 12.317l5.759 -5.759" />
                        <path d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                        <path d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                        <path d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                        <path d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0" />
                        </svg>&nbsp;Connect</a>
                    </div>
                    *}}
              </div>

            {{/if}}


          {{/if}}
              <!--
                APP TRAY
                User can change which links show up here by changing the app settings.
              -->

              {{if $localuser}} 

              {{else}}


                {{if $userinfo.testplugin.showlocalmenu}}

                                    <!-- channel apps -->
                                    <ul class="navbar-nav pt-lg-3">
                                    {{if $channel_apps.0}}
                                        
                                            <li class="nav-item">
                                                {{foreach $channel_apps as $channel_app}}
                                                    {{$channel_app}}
                                                {{/foreach}}
                                            </li>
                                            <!-- <li><hr></li> -->
                                    {{/if}}


                                        {{if $navbar_apps.0}}
                                        
                                                <!--
                                                <li class="nav-item">
                                                {{$pinned_apps}}xxx
                                            </li>

                                                <li class="nav-item">
                                                {{foreach $navbar_apps as $navbar_app}}
                                                    {{$navbar_app|replace:'fa fa-fw fa-home':'fa5 fa-fw fa5-house-user text-muted'|replace:'fa-user-circle-o':'fa-user-circle-o text-muted'}}
                                                {{/foreach}}
                                                </li>
                                            -->

                                            <!--
                                            <li class="nav-item">
                                                {{$pinned_apps}}xxx
                                            </li>
                                            
                                            
                                                <li class="nav-item">
                                                {{foreach $navbar_apps as $navbar_app}}
                                                    {{$navbar_app}}
                                                {{/foreach}}
                                                </li>
                                            -->

                                        {{/if}}
                                        {{if $is_owner}}
                                            <!--
                                            <li class="nav-item">                                      
                                            {{$featured_apps}}
                                        
                                        </li>
                                        -->
                                        <div id="app-bin-container" data-token="{{$form_security_token}}">
                                            {{foreach $nav_apps as $nav_app}}
                                                {{$nav_app|replace:'fa fa-fw fa-home':'fa5 fa-fw fa5-house-user'|replace:'fa fa-fw fa-users':'fa5 fa-fw fa5-user-friends'|replace:'fa fa-fw fa-sitemap':'fa5 fa-fw fa5-address-book'}}
                                            {{/foreach}}
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <li class="nav-item">
                                        <a class="nav-link" href="/apps"><i class="generic-icons-nav fa fa-fw fa-plus"></i>{{$addapps}}</a></li>
                                        {{else}}
                                            <!--
                                        <div class="dropdown-header text-uppercase text-muted">
                                            {{$sysapps}}
                                        </div>
                                        {{foreach $nav_apps as $nav_app}}
                                            {{$nav_app}}
                                        {{/foreach}}
                                        -->
                                        {{/if}}

                    {{/if}}

              {{/if}}                                      

              

            <ul class="navbar-nav pt-lg-3">


            

            {{if $localuser}}

              {{if $smarty.server.SCRIPT_URL == "/" or $smarty.server.SCRIPT_URL == "/home"}}
                {{assign var="ClassMenuHome" value=" active"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/hq" or $smarty.server.SCRIPT_URL == "/hq/"}}
                {{assign var="ClassMenuHQ" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/notifications" or $smarty.server.SCRIPT_URL == "/notifications/"}}
                {{assign var="ClassMenuNotifications" value=" active"}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/channel" or $smarty.server.SCRIPT_URL == "/channel/"}}
                {{assign var="ClassMenuViewChannel" value=" active"}}
                {{assign var="ClassMenuChannel" value=" active"}}
                {{assign var="ClassDropdownChannel" value=" show"}}
                {{assign var="ClassAriaExpandedChannel" value="true"}}
              {{/if}}

              {{assign var="ClassMenuViewProfileURL" value="/`$nav.usermenu.0.0`" }}
              {{if $smarty.server.SCRIPT_URL == $ClassMenuViewProfileURL or $smarty.server.SCRIPT_URL == "/profile"}}
                {{assign var="ClassMenuViewProfile" value=" active"}}
                {{assign var="ClassMenuChannel" value=" active"}}
                {{assign var="ClassDropdownChannel" value=" show"}}
                {{assign var="ClassAriaExpandedChannel" value="true"}}
              {{/if}}

              {{assign var="ClassMenuEditProfileURL" value="/`$nav.usermenu.1.0`" }}
              {{if $smarty.server.SCRIPT_URL == $ClassMenuEditProfileURL or $smarty.server.SCRIPT_URL == "/profile"}}
                {{assign var="ClassMenuEditProfile" value=" active"}}
                {{assign var="ClassMenuChannel" value=" active"}}
                {{assign var="ClassDropdownChannel" value=" show"}}
                {{assign var="ClassAriaExpandedChannel" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/cloud" or $smarty.server.SCRIPT_URL == "/cloud/"}}
                {{assign var="ClassMenuFiles" value=" active"}}
                {{assign var="ClassMenuChannel" value=" active"}}
                {{assign var="ClassDropdownChannel" value=" show"}}
                {{assign var="ClassAriaExpandedChannel" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/network" or $smarty.server.SCRIPT_URL == "/network/"}}
                {{assign var="ClassMenuInbox" value=" active"}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/network/" and $smarty.get.conv  == "1"}}
                {{assign var="ClassMenuParticipating" value=" active"}}
                {{assign var="ClassMenuInbox" value=""}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/network/" and $smarty.get.star  == "1"}}
                {{assign var="ClassMenuStarred" value=" active"}}
                {{assign var="ClassMenuInbox" value=""}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}              

              {{if $smarty.server.SCRIPT_URL == "/network/" and $smarty.get.verb  == ".Event"}}
                {{assign var="ClassMenuEvents" value=" active"}}
                {{assign var="ClassMenuInbox" value=""}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}              

              {{if $smarty.server.SCRIPT_URL == "/network/" and $smarty.get.verb  == ".Question"}}
                {{assign var="ClassMenuPolls" value=" active"}}
                {{assign var="ClassMenuInbox" value=""}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/network/" and $smarty.get.dm  == "1"}}
                {{assign var="ClassMenuDMs" value=" active"}}
                {{assign var="ClassMenuInbox" value=""}}
                {{assign var="ClassMenuConversations" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}              

              {{if $smarty.server.SCRIPT_URL == "/connections" or $smarty.server.SCRIPT_URL == "/connections/"}}
                {{assign var="ClassMenuConn" value=" active"}}
                {{assign var="ClassMenuContacts" value=" active"}}
                {{assign var="ClassDropdownContacts" value=" show"}}
                {{assign var="ClassAriaExpandedContacts" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/connections/active" or $smarty.server.SCRIPT_URL == "/connections/active/"}}
                {{assign var="ClassMenuConnActive" value=" active"}}
                {{assign var="ClassMenuContacts" value=" active"}}
                {{assign var="ClassDropdownContacts" value=" show"}}
                {{assign var="ClassAriaExpandedContacts" value="true"}}
              {{/if}}

              {{if $smarty.server.SCRIPT_URL == "/connections/pending" or $smarty.server.SCRIPT_URL == "/connections/pending/"}}
                {{assign var="ClassMenuConnPending" value=" active"}}
                {{assign var="ClassMenuContacts" value=" active"}}
                {{assign var="ClassDropdownContacts" value=" show"}}
                {{assign var="ClassAriaExpandedContacts" value="true"}}
              {{/if}}              

              {{if $smarty.server.SCRIPT_URL == "/directory" or $smarty.server.SCRIPT_URL == "/directory/"}}
                {{assign var="ClassMenuDirectory" value=" active"}}
                {{assign var="ClassMenuContacts" value=" active"}}
                {{assign var="ClassDropdownContacts" value=" show"}}
                {{assign var="ClassAriaExpandedContacts" value="true"}}
              {{/if}}        

              {{if $smarty.server.SCRIPT_URL == "/apps" or $smarty.server.SCRIPT_URL == "/apps/"}}
                {{assign var="ClassMenuMoreApps" value=" active"}}
                {{assign var="ClassMenuApps" value=" active"}}
                {{assign var="ClassDropdownApps" value=" show"}}
                {{assign var="ClassAriaExpandedApps" value="true"}}
              {{/if}}        

              {{if $smarty.server.SCRIPT_URL == "/apps/available" or $smarty.server.SCRIPT_URL == "/apps/available/"}}
                {{assign var="ClassMenuMoreApps" value=" active"}}
                {{assign var="ClassMenuApps" value=" active"}}
                {{assign var="ClassDropdownApps" value=" show"}}
                {{assign var="ClassAriaExpandedApps" value="true"}}
              {{/if}}     

              {{if $smarty.server.SCRIPT_URL == "/apps/edit" or $smarty.server.SCRIPT_URL == "/apps/edit/"}}
                {{assign var="ClassMenuMoreApps" value=" active"}}
                {{assign var="ClassMenuApps" value=" active"}}
                {{assign var="ClassDropdownApps" value=" show"}}
                {{assign var="ClassAriaExpandedApps" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/settings" or $smarty.server.SCRIPT_URL == "/settings/"}}
                {{assign var="ClassMenuSettingsChannel" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/settings/channel" or $smarty.server.SCRIPT_URL == "/settings/channel/"}}
                {{assign var="ClassMenuSettingsChannel" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/settings/account" or $smarty.server.SCRIPT_URL == "/settings/account/"}}
                {{assign var="ClassMenuSettingsAccount" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/settings/privacy" or $smarty.server.SCRIPT_URL == "/settings/privacy/"}}
                {{assign var="ClassMenuSettingsPrivacy" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/settings/display" or $smarty.server.SCRIPT_URL == "/settings/display/"}}
                {{assign var="ClassMenuSettingsDisplay" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                   

              {{if $smarty.server.SCRIPT_URL == "/locs" or $smarty.server.SCRIPT_URL == "/locs/"}}
                {{assign var="ClassMenuSettingsLocs" value=" active"}}
                {{assign var="ClassMenuSettings" value=" active"}}
                {{assign var="ClassDropdownSettings" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}                                 

              {{if $smarty.server.SCRIPT_URL == "/settings/channel_home" or $smarty.server.SCRIPT_URL == "/settings/channel_home/"}}
                {{assign var="ClassMenuSettingsChannelHome" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/settings/connections" or $smarty.server.SCRIPT_URL == "/settings/connections/"}}
                {{assign var="ClassMenuSettingsConn" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/settings/network" or $smarty.server.SCRIPT_URL == "/settings/network/"}}
                {{assign var="ClassMenuSettingsNetwork" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/settings/directory" or $smarty.server.SCRIPT_URL == "/settings/directory/"}}
                {{assign var="ClassMenuSettingsDirectory" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/settings/calendar" or $smarty.server.SCRIPT_URL == "/settings/calendar/"}}
                {{assign var="ClassMenuSettingsCalendar" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/settings/photos" or $smarty.server.SCRIPT_URL == "/settings/photos/"}}
                {{assign var="ClassMenuSettingsPhotos" value=" active"}}
                {{assign var="ClassMenuPrefs" value=" active"}}
                {{assign var="ClassDropdownPrefs" value=" show"}}
                {{assign var="ClassAriaExpandedSettings" value="true"}}
              {{/if}}      

              {{if $smarty.server.SCRIPT_URL == "/search" or $smarty.server.SCRIPT_URL == "/search/"}}
                {{assign var="ClassMenuSearch" value=" active"}}
                {{assign var="ClassDropdownConversations" value=" show"}}
                {{assign var="ClassAriaExpandedConversations" value="true"}}
              {{/if}}

              <li class="nav-item{{$ClassMenuHome}}">
              <a class="nav-link" href="/" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Home
                </span>
              </a>
            </li>              
              
            <li class="nav-item{{$ClassMenuHQ}}">
              <a class="nav-link" href="/hq" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-castle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15 19v-2a3 3 0 0 0 -6 0v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-14h4v3h3v-3h4v3h3v-3h4v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M3 11l18 0" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Headquarters (HQ)
                </span>
              </a>
            </li>
  


            <li class="nav-item{{$ClassMenuNotifications}}">
              <a class="nav-link" href="/notifications" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notification" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 6h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M17 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg>
                </span>
                <span class="nav-link-title">
                  Notifications
                </span>
              </a>
            </li>  

              <li class="nav-item dropdown{{$ClassMenuChannel}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedChannel}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-broadcast" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.364 19.364a9 9 0 1 0 -12.728 0" /><path d="M15.536 16.536a5 5 0 1 0 -7.072 0" /><path d="M12 13m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Channel
                    </span>
                  </a>
                  <div class="dropdown-menu{{$ClassDropdownChannel}}">

                    <a class="dropdown-item{{$ClassMenuViewChannel}}" href="/channel" rel="noopener">
                      View Channel
                    </a>
                    <a class="dropdown-item{{$ClassMenuViewProfile}}" href="/{{$nav.usermenu.0.0}}">
                      View Profile
                    </a>
                    <a class="dropdown-item{{$ClassMenuEditProfile}}" href="/{{$nav.usermenu.1.0}}" rel="noopener">
                      Edit Profile
                    </a>
                    <!--
                    <a class="dropdown-item" href="/photos" rel="noopener">
                      Photos
                    </a> 
                    -->
                    <a class="dropdown-item{{$ClassMenuFiles}}" href="/cloud" rel="noopener">
                      Files
                    </a> 
                    <!--
                    <a class="dropdown-item" href="/calendar" rel="noopener">
                      Calendar
                    </a>
                    -->                  
                  </div>
                </li>

                <li class="nav-item dropdown{{$ClassMenuConversations}}">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedConversations}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-messages" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" /><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Conversations
                  </span>
                </a>
                <div class="dropdown-menu{{$ClassDropdownConversations}}">
                  <a class="dropdown-item{{$ClassMenuInbox}}" href="/network" rel="noopener">
                    Inbox / Stream
                  </a>
                  <a class="dropdown-item{{$ClassMenuDMs}}" href="/network/?f=&dm=1" rel="noopener">
                    Direct Messages
                  </a>  
                  <a class="dropdown-item{{$ClassMenuStarred}}" href="/network/?f=&star=1">
                    Starred Posts
                  </a>
                  <a class="dropdown-item{{$ClassMenuParticipating}}" href="/network/?f=&conv=1" rel="noopener">
                    Personal Posts
                  </a>
                  <a class="dropdown-item{{$ClassMenuEvents}}" href="/network/?verb=%2EEvent" rel="noopener">
                    Events
                  </a>
                  <a class="dropdown-item{{$ClassMenuPolls}}" href="/network/?verb=%2EQuestion" rel="noopener">
                    Polls
                  </a>

                  <!--
                  <a class="dropdown-item" href="https://github.com/tabler/tabler" rel="noopener">
                    Announcements
                  </a>
                  -->                                                    
                </div>
              </li>        

              <li class="nav-item dropdown{{$ClassMenuContacts}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedContacts}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                      <path d="M10 16h6" />
                      <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                      <path d="M4 8h3" />
                      <path d="M4 12h3" />
                      <path d="M4 16h3" />
                    </svg>
                    </span>
                    <span class="nav-link-title">
                      Contacts
                    </span>
                  </a>
                  <div class="dropdown-menu{{$ClassDropdownContacts}}">
                    <a class="dropdown-item{{$ClassMenuConnActive}}" href="/connections/active" rel="noopener">
                      Active Connections
                    </a>
                    <a class="dropdown-item{{$ClassMenuConn}}" href="/connections" rel="noopener">
                      All Connections
                    </a>                    
                    <a class="dropdown-item{{$ClassMenuConnPending}}" href="/connections/pending">
                      Connection Requests
                    </a>
                    <a class="dropdown-item{{$ClassMenuDirectory}}" href="/directory" rel="noopener">
                      Directory
                    </a>
                  </div>
                </li>

                <!-- Need to build interface first.
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles-relation" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M9.183 6.117a6 6 0 1 0 4.511 3.986" />
                  <path d="M14.813 17.883a6 6 0 1 0 -4.496 -3.954" />
                </svg>
                  </span>
                  <span class="nav-link-title">
                    Affinity
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="https://tabler.io/docs" rel="noopener">
                    Me
                  </a>
                  <a class="dropdown-item" href="./changelog.html">
                    Family
                  </a>
                  <a class="dropdown-item" href="https://github.com/tabler/tabler" rel="noopener">
                    Friends
                  </a>
                  <a class="dropdown-item" href="https://github.com/tabler/tabler" rel="noopener">
                    Acquantances
                  </a>                  
                </div>
              </li>
              -->

              <li class="nav-item dropdown{{$ClassMenuApps}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedApps}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12v.01" /><path d="M19.071 4.929c-1.562 -1.562 -6 .337 -9.9 4.243c-3.905 3.905 -5.804 8.337 -4.242 9.9c1.562 1.561 6 -.338 9.9 -4.244c3.905 -3.905 5.804 -8.337 4.242 -9.9" /><path d="M4.929 4.929c-1.562 1.562 .337 6 4.243 9.9c3.905 3.905 8.337 5.804 9.9 4.242c1.561 -1.562 -.338 -6 -4.244 -9.9c-3.905 -3.905 -8.337 -5.804 -9.9 -4.242" /></svg>
                    </span>
                    <span class="nav-link-title">
                      {{$featured_apps}} <!-- Apps -->
                    </span>
                  </a>
                  <div class="dropdown-menu{{$ClassDropdownApps}}">
                  
                    {{foreach $nav_apps as $nav_app}}
                      {{$nav_app|replace:'nav-link':'dropdown-item'|replace:'generic-icons-nav fa':'generic-icons-nav fa d-none'}}
                    {{/foreach}}

                    <a class="dropdown-item{{$ClassMenuMoreApps}}" href="/apps"><i class="generic-icons-nav fa fa-fw fa-plus d-none"></i>{{$addapps}}</a>


                  </div>
                </li>

                <li class="nav-item dropdown{{$ClassMenuSettings}}">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedSettings}}" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                  <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                </svg>
                  </span>
                  <span class="nav-link-title">
                    Settings
                  </span>
                </a>
                <div class="dropdown-menu{{$ClassDropdownSettings}}">
                  <a class="dropdown-item{{$ClassMenuSettingsChannel}}" href="/settings/channel">
                    Channel Settings
                  </a>
                  <a class="dropdown-item{{$ClassMenuSettingsAccount}}" href="/settings/account" rel="noopener">
                    Account Settings
                  </a>

                  <a class="dropdown-item{{$ClassMenuSettingsPrivacy}}" href="/settings/privacy" rel="noopener">
                    Privacy Settings
                  </a>
                  <a class="dropdown-item{{$ClassMenuSettingsDisplay}}" href="/settings/display" rel="noopener">
                    Display Settings
                  </a>
                  <a class="dropdown-item{{$ClassMenuSettingsLocs}}" href="/locs" rel="noopener">
                    Manage Locations
                  </a>
                </div>
              </li>

              <li class="nav-item dropdown{{$ClassMenuPrefs}}">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{$ClassAriaExpandedPrefs}}" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M6 4v4" /><path d="M6 12v8" /><path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M12 4v10" /><path d="M12 18v2" /><path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M18 4v1" /><path d="M18 9v11" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Personalization
                    </span>
                  </a>
                  <div class="dropdown-menu{{$ClassDropdownPrefs}}">
                    <a class="dropdown-item{{$ClassMenuSettingsChannelHome}}" href="/settings/channel_home" rel="noopener">
                      Channel Home
                    </a>
                    <a class="dropdown-item{{$ClassMenuSettingsConn}}" href="/settings/connections">
                      Connections
                    </a>
                    <a class="dropdown-item{{$ClassMenuSettingsNetwork}}" href="/settings/network" rel="noopener">
                      Stream
                    </a>
                    <a class="dropdown-item{{$ClassMenuSettingsDirectory}}" href="/settings/directory" rel="noopener">
                      Directory
                    </a>
                    <a class="dropdown-item{{$ClassMenuSettingsCalendar}}" href="/settings/calendar">
                      Calendar
                    </a>
                    <a class="dropdown-item{{$ClassMenuSettingsPhotos}}" href="/settings/photos" rel="noopener">
                      Photo
                    </a>
                  </div>
                </li>

                <li class="nav-item{{$ClassMenuSearch}}">
                <a class="nav-link" href="/search" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M21 21l-6 -6" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Search
                  </span>
                </a>
              </li>  

              <!--
<li><hr></li>

              <li class="nav-item">
                <a class="nav-link" href="/connections" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles-relation" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M9.183 6.117a6 6 0 1 0 4.511 3.986" />
                      <path d="M14.813 17.883a6 6 0 1 0 -4.496 -3.954" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Connections
                  </span>
                </a>
              </li>  

              <li class="nav-item">
                <a class="nav-link" href="/network" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ripple" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 7c3 -2 6 -2 9 0s6 2 9 0" />
                      <path d="M3 17c3 -2 6 -2 9 0s6 2 9 0" />
                      <path d="M3 12c3 -2 6 -2 9 0s6 2 9 0" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Stream
                  </span>
                </a>
              </li>  

              <li class="nav-item">
                <a class="nav-link" href="/directory" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                      <path d="M10 16h6" />
                      <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                      <path d="M4 8h3" />
                      <path d="M4 12h3" />
                      <path d="M4 16h3" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Directory
                  </span>
                </a>
              </li>      

              <li class="nav-item">
                <a class="nav-link" href="/search" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M21 21l-6 -6" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Search
                  </span>
                </a>
              </li>                

              <li class="nav-item">
                <a class="nav-link" href="/settings" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                      <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Settings
                  </span>
                </a>
              </li>
              -->

            {{/if}}



<!--

<li><hr></li>

            <li class="nav-item">
            <a class="nav-link" href="/hq" >
              <span class="nav-link-icon d-md-none d-lg-inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-castle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M15 19v-2a3 3 0 0 0 -6 0v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-14h4v3h3v-3h4v3h3v-3h4v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                  <path d="M3 11l18 0" />
                </svg>
              </span>
              <span class="nav-link-title">
                Headquarters (HQ)
              </span>
            </a>
          </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                  </span>
                  <span class="nav-link-title">
                    Help
                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="https://tabler.io/docs" rel="noopener">
                    Documentation
                  </a>
                  <a class="dropdown-item" href="./changelog.html">
                    Changelog
                  </a>
                  <a class="dropdown-item" href="https://github.com/tabler/tabler" rel="noopener">
                    Source code
                  </a>
                  <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" rel="noopener">
                    
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                    Sponsor project!
                  </a>
                </div>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="/channel/wistex" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-note" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M13 20l7 -7" />
                      <path d="M13 20v-6a1 1 0 0 1 1 -1h6v-7a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Posts
                  </span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/profile/wistex" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                      <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                      <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Profile
                  </span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/photos/wistex" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M15 8h.01" />
                      <path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" />
                      <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" />
                      <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Photos
                  </span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="/cloud/wistex" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-files" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                      <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                      <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Files
                  </span>
                </a>
              </li>              

              <li class="nav-item">
                <a class="nav-link" href="/calendar" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                      <path d="M16 3l0 4" />
                      <path d="M8 3l0 4" />
                      <path d="M4 11l16 0" />
                      <path d="M8 15h2v2h-2z" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Calendar
                  </span>
                </a>
              </li>
            -->


            {{$userinfo.testplugin.sidebar_after}}

              <!-- 
                PIN TO NAVBAR
                Logged In Users can select apps to show here. 
                <li><hr></li>
              -->              
              

            {{if $localuser}}

              <!--
              <li><hr></li>



              <li class="nav-item">
              <a class="nav-link" href="/hq" >
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-castle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M15 19v-2a3 3 0 0 0 -6 0v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-14h4v3h3v-3h4v3h3v-3h4v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M3 11l18 0" />
                  </svg>
                </span>
                <span class="nav-link-title">
                  Headquarters (HQ)
                </span>
              </a>
            </li>
  
  
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Help
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="https://tabler.io/docs" rel="noopener">
                      Documentation
                    </a>
                    <a class="dropdown-item" href="./changelog.html">
                      Changelog
                    </a>
                    <a class="dropdown-item" href="https://github.com/tabler/tabler" rel="noopener">
                      Source code
                    </a>
                    <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" rel="noopener">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor project!
                    </a>
                  </div>
                </li>

        

              <li class="nav-item">
                <a class="nav-link" href="/connections" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles-relation" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M9.183 6.117a6 6 0 1 0 4.511 3.986" />
                      <path d="M14.813 17.883a6 6 0 1 0 -4.496 -3.954" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Connections
                  </span>
                </a>
              </li>  

              <li class="nav-item">
                <a class="nav-link" href="/network" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ripple" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 7c3 -2 6 -2 9 0s6 2 9 0" />
                      <path d="M3 17c3 -2 6 -2 9 0s6 2 9 0" />
                      <path d="M3 12c3 -2 6 -2 9 0s6 2 9 0" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Stream
                  </span>
                </a>
              </li>  

              <li class="nav-item">
                <a class="nav-link" href="/directory" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                      <path d="M10 16h6" />
                      <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                      <path d="M4 8h3" />
                      <path d="M4 12h3" />
                      <path d="M4 16h3" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Directory
                  </span>
                </a>
              </li>      

              <li class="nav-item">
                <a class="nav-link" href="/search" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                      <path d="M21 21l-6 -6" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Search
                  </span>
                </a>
              </li>                

              <li class="nav-item">
                <a class="nav-link" href="/settings" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                      <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                    </svg>
                  </span>
                  <span class="nav-link-title">
                    Settings
                  </span>
                </a>
              </li>
               -->

            {{/if}}

            </ul>
          </div>
        </div>
      </aside>


      <!-- Navbar -->
      <header class="navbar navbar-expand-md d-none d-lg-flex d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
              <a href="{{$url}}?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a href="{{$url}}?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>



              {{if $localuser}}

              <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                  <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                  <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Last Updates</h3>
                    </div>
                    <div class="list-group list-group-flush list-group-hoverable">
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="/hq" class="text-body d-block">Headquarters (HQ)</a>
                            <!--
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Private Messages
                            </div>
                            -->
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="/network/?f=&dm=1" class="text-body d-block">Direct Messages (DMs)</a>
                            <!--
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Private Messages
                            </div>
                            -->
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="/network/?f=&star=1" class="text-body d-block">Starred Posts</a>
                            <!--
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Update change-version.js (#29736)
                            </div>
                            -->
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions show">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-yellow" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
                          <div class="col text-truncate">
                            <a href="/notifications" class="text-body d-block">Notifications</a>
                            <!--
                            <div class="d-block text-secondary text-truncate mt-n1">
                              Regenerate package-lock.json (#29730)
                            </div>
                            -->
                          </div>
                          <div class="col-auto">
                            <a href="#" class="list-group-item-actions">
                              <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{/if}}

            </div>
            <!-- Top Navbar User Menu FULL SCREEN -->
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url({{$redtab.icon}})"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>{{if $nav.login && !$userinfo.addr}}
                    Welcome Guest
                {{else}}
                    {{$userinfo.name}}
                {{/if}}</div>
                  <div class="mt-1 small text-secondary">{{$userinfo.addr}}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">




              {{if $is_owner}}
                <a class="dropdown-item" href="/channel"><!-- <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp; -->View Channel</a>

                {{foreach $nav.usermenu as $usermenu}}
                    <a class="dropdown-item{{if $usermenu.2}} active{{/if}}"  href="{{$usermenu.0}}" title="{{$usermenu.3}}" role="menuitem" id="{{$usermenu.4}}">{{$usermenu.1}}</a>
                {{/foreach}}
                {{if $nav.group}}
                    <a class="dropdown-item" href="{{$nav.group.0}}" title="{{$nav.group.3}}" role="menuitem" id="{{$nav.group.4}}">{{$nav.group.1}}</a>
                {{/if}}
                
                
                <a class="dropdown-item" href="/connections"><!-- <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp; -->Connections</a>
                
                <div class="dropdown-divider"></div>
                
                {{if $nav.manage}}
                    <a class="dropdown-item{{if $sel.name == Manage}} active{{/if}}" href="{{$nav.manage.0}}" title="{{$nav.manage.3}}" role="menuitem" id="{{$nav.manage.4}}">{{$nav.manage.1}}</a>
                {{/if}}
                {{if $nav.channels}}
                    {{foreach $nav.channels as $chan}}
                        <a class="dropdown-item" href="manage/{{$chan.channel_id}}" title="{{$chan.channel_name}}" role="menuitem"><i class="fa fa-circle{{if $localuser == $chan.channel_id}} text-success{{else}} invisible{{/if}}"></i> {{$chan.channel_name}}</a>
                    {{/foreach}}
                {{/if}}
                {{if $nav.profiles}}
                    <a class="dropdown-item" href="{{$nav.profiles.0}}" title="{{$nav.profiles.3}}" role="menuitem" id="{{$nav.profiles.4}}">{{$nav.profiles.1}}</a>
                {{/if}}
                {{if $nav.settings}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item{{if $sel.name == Settings}} active{{/if}}" href="{{$nav.settings.0}}" title="{{$nav.settings.3}}" role="menuitem" id="{{$nav.settings.4}}">{{$nav.settings.1}}</a>
                {{/if}}
                {{if $nav.admin}}
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item{{if $sel.name == Admin}} active{{/if}}" href="{{$nav.admin.0}}" title="{{$nav.admin.3}}" role="menuitem" id="{{$nav.admin.4}}">{{$nav.admin.1}}</a>
                {{/if}}
                {{if $nav.logout}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{$nav.logout.0}}" title="{{$nav.logout.3}}" role="menuitem" id="{{$nav.logout.4}}">{{$nav.logout.1}}</a>
                {{/if}}
            {{/if}}
        
        
            {{if $localuser && !$is_owner}}
            
                {{if $nav.manage}}
                    <a class="dropdown-item{{if $sel.name == Manage}} active{{/if}}" href="{{$nav.manage.0}}" title="{{$nav.manage.3}}" role="menuitem" id="{{$nav.manage.4}}">{{$nav.manage.1}}</a>
                {{/if}}
                {{if $nav.channels}}
                    {{foreach $nav.channels as $chan}}
                        <a class="dropdown-item" href="manage/{{$chan.channel_id}}" title="{{$chan.channel_name}}" role="menuitem"><i class="fa fa-circle{{if $localuser == $chan.channel_id}} text-success{{else}} invisible{{/if}}"></i> {{$chan.channel_name}}</a>
                    {{/foreach}}
                {{/if}}
            

                {{if $nav.settings}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item{{if $sel.name == Settings}} active{{/if}}" href="{{$nav.settings.0}}" title="{{$nav.settings.3}}" role="menuitem" id="{{$nav.settings.4}}">{{$nav.settings.1}}</a>
                {{/if}}
                {{if $nav.admin}}
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item{{if $sel.name == Admin}} active{{/if}}" href="{{$nav.admin.0}}" title="{{$nav.admin.3}}" role="menuitem" id="{{$nav.admin.4}}">{{$nav.admin.1}}</a>
                {{/if}}
            <!--
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/settings"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Admin</a>
            -->
            <div class="dropdown-divider"></div>
            {{/if}}
        
        
            {{if ! $is_owner && $userinfo.addr}}
            
                <a class="dropdown-item" href="{{$nav.rusermenu.0}}" role="menuitem">{{$nav.rusermenu.1}}</a>
                <a class="dropdown-item" href="{{$nav.rusermenu.2}}" role="menuitem">{{$nav.rusermenu.3}}</a>
            
            {{/if}}		
            
            {{if $nav.login && !$userinfo.addr}}

                <a class="dropdown-item" href="login" title="{{$nav.loginmenu.1.3}}">
                    {{$nav.loginmenu.1.1}}
                </a>
                <a class="dropdown-item" href="rmagic" title="{{$nav.loginmenu.1.3}}">
                    Magic Sign-On
                </a>							
                <a class="dropdown-item" href="rmagic" title="{{$nav.loginmenu.1.3}}">
                    Remote Authentication
                </a>        				
            {{/if}}

            {{if $nav.register}}
                <a class="dropdown-item" href="{{$nav.register.0}}" title="{{$nav.register.3}}" id="{{$nav.register.4}}">
                    {{$nav.register.1}}
                </a>
            {{/if}}






            <!--
            <a href="/channel" class="dropdown-item">View Channel</a>
            <a href="/profile/wistex" class="dropdown-item">View Profile</a>
            <a href="/profiles/3" class="dropdown-item">Edit Profile</a>
            <a href="/connections" class="dropdown-item">Connections</a>
            <div class="dropdown-divider"></div>
            <a href="{{$settings_url}}" class="dropdown-item">Settings</a>
            <a href="/admin" class="dropdown-item">Admin</a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item">Logout</a>
            -->



          </div>


            </div>
          </div>
          <div class="collapse navbar-collapse" id="navbar-menu">

            {{* ! Note: This menu does not appear on mobile. Make sure that users can get to these pages some other way. 
                For example, you may want to make sure that there are links to these pages on the home page and/or in other navbars. *}}
            
            {{*
              Example for Website: Home, Articles, Channels, Forums, Help
              Example for Public Hub: Home, Channels, Forums, Membership, Help
              Example for Single User Hub: Profile, Posts, Photos, Calendar, Help

              Default Setup:
                Not Logged In: Home, Login, Register
                Viewing Own Profile: Home, HQ
                Viewing Someone Else's Profile: Home, HQ
                Viewing Other Pages: Home, HQ
            *}}

            

            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
              <ul class="navbar-nav">

              
              {{if $nav.login && !$userinfo.addr}}
                {{* If Not Logged In *}}

                <li class="nav-item">
                  <a class="nav-link" href="/" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>

                <!-- The login link is better hidden on private hubs. You can still get to it in the dropdown or other ways. -->
                <!-- uncomment if you want this to appear in the top menu bar. -->
                <!-- 
                <li class="nav-item">
                <a class="nav-link" href="login" title="{{$nav.loginmenu.1.3}}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">{{* <!-- Download SVG icon from http://tabler-icons.io/i/home --> *}}
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                  <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                </svg>
                  </span>
                  <span class="nav-link-title">
                  {{$nav.loginmenu.1.1}}
                  </span>
                </a>
              </li>
              -->
   
              <li class="nav-item">
              <a class="nav-link" href="rmagic" title="{{$nav.loginmenu.1.3}}">
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate-filled" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18.5 3a2.5 2.5 0 1 1 -.912 4.828l-4.556 4.555a5.475 5.475 0 0 1 .936 3.714l2.624 .787a2.5 2.5 0 1 1 -.575 1.916l-2.623 -.788a5.5 5.5 0 0 1 -10.39 -2.29l-.004 -.222l.004 -.221a5.5 5.5 0 0 1 2.984 -4.673l-.788 -2.624a2.498 2.498 0 0 1 -2.194 -2.304l-.006 -.178l.005 -.164a2.5 2.5 0 1 1 4.111 2.071l.787 2.625a5.475 5.475 0 0 1 3.714 .936l4.555 -4.556a2.487 2.487 0 0 1 -.167 -.748l-.005 -.164l.005 -.164a2.5 2.5 0 0 1 2.495 -2.336z" stroke-width="0" fill="currentColor" />
                </svg>
                </span>
                <span class="nav-link-title">
                Magic Sign On
                </span>
              </a>
            </li>
		
                {{if $nav.register}}
                    <li class="nav-item {{$nav.register.2}} d-lg-flex">
                        <a class="nav-link" href="{{$nav.register.0}}" title="{{$nav.register.3}}" id="{{$nav.register.4}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                                    <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{$nav.register.1}}
                            </span>

                        </a>
                    </li>
                {{/if}}

            {{else}}		
                {{* Else If Logged In *}}

                

                
                <li class="nav-item">
                  <a class="nav-link" href="/" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <!--
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                      -->
                      <i class="fa5 fa-fw fa5-home text-muted"></i>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>
                
              
                {{if $userinfo.addr}}
                

                  <!--
                <li class="nav-item">
                  <a class="nav-link" href="/hq" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-castle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15 19v-2a3 3 0 0 0 -6 0v2a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1v-14h4v3h3v-3h4v3h3v-3h4v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        <path d="M3 11l18 0" />
                        </svg>
                    </span>
                    <span class="nav-link-title">
                      Headquarters (HQ)
                    </span>
                  </a>
                </li> 
                -->               

                {{/if}}

            {{/if}}


            <!-- navapps -------------------------------------------------------------------- -->

            {{* Shows pinned apps in top navigation bar on user's own channel. *}}    
            {{foreach $navbar_apps as $navbar_app}}
              <li class="nav-item">
              {{$navbar_app|replace:'d-lg-none':'nav-link-title ms-2'|replace:'Channel':'Channel'|replace:'fa fa-fw fa-home':'fa5 fa-fw fa5-house-user text-muted'|replace:'fa-user-circle-o':'fa-user-circle-o text-muted'}}
              </li>
          {{/foreach}}
          
        {{*
          {{foreach $channel_apps as $channel_app}}
            <li class="nav-item">
            {{$channel_app|replace:'d-lg-none':'nav-link-title ms-2'|replace:'Channel':'My Channel'}}
            </li>
        {{/foreach}}
        *}}

              <!--
              <li class="nav-item">
              {{foreach $navbar_apps as $navbar_app}}
                  {{$navbar_app|replace:'nav-link':'dropdown-item'}}
              {{/foreach}}
              </li>
              -->
              
            <!-- end navapps ---------------------------------------------------------------- -->

            <!--  Featured Apps ----------------------------------------------------------------- -->
            
            {{* if $featured_apps *}}

            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow" style="left: 0;">
                <!-- <div class="nav-item dropdown-menu dropdown-menu-end dropdown-menu-arrow"> -->
                
                    
                    <a class="dropdown-toggle nav-link !text-primary" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12v.01" />
                        <path d="M19.071 4.929c-1.562 -1.562 -6 .337 -9.9 4.243c-3.905 3.905 -5.804 8.337 -4.242 9.9c1.562 1.561 6 -.338 9.9 -4.244c3.905 -3.905 5.804 -8.337 4.242 -9.9" />
                        <path d="M4.929 4.929c-1.562 1.562 .337 6 4.243 9.9c3.905 3.905 8.337 5.804 9.9 4.242c1.561 -1.562 -.338 -6 -4.244 -9.9c-3.905 -3.905 -8.337 -5.804 -9.9 -4.242" />
                      </svg>
                    </span>

                    <span class="nav-link-title">Apps<!-- <i class="generic-icons-nav fa fa-fw fa-caret-down"></i> --></span>
                        <span class="d-xs-block d-sm-block d-md-none  d-lg-none d-xl-none"></span>
                        <!-- <i class="generic-icons-nav fa fa-fw fa-caret-square-down"></i> -->
                        
                         <!-- <span class="icon-hz-64"></span> -->
                         <!--
                         <span class="icon-hz"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                         -->
                    </a>
                    <div class="dropdown-menu shadow !dropdown-menu-end animated--grow-in">
                                        
                        <!--                                        
                        <a class="dropdown-item" href="/"><i class="generic-icons-nav fa fa-fw fa-home"></i>Home</a>
                        <div class="dropdown-divider"></div>
                        -->

                        {{if $is_owner}}    
                          
					              <!-- featured apps -->
                    		<div class="dropdown-header text-uppercase text-muted">
						              {{$featured_apps|replace:'featured-apps nav-link':'dropdown-item'}}
                    			<!-- {{$featured_apps}} -->
				

                          
				
                    		</div>
					<!-- nav apps -->

                    
                    		<div id="app-bin-container" data-token="{{$form_security_token}}">
                    			{{foreach $nav_apps as $nav_app}}
                    				{{$nav_app|replace:'nav-link':'dropdown-item'}}
                    			{{/foreach}}
                    		</div>
                    		<!-- <div class="dropdown-divider"></div> -->
                    		<a class="dropdown-item" href="/apps"><i class="generic-icons-nav fa fa-fw fa-plus"></i>{{$addapps}}</a>
                		{{else}}
					<!-- system apps -->
                    		<div class="dropdown-header text-uppercase text-muted">
                    			{{$sysapps|replace:'nav-link':'dropdown-item'}}
                    		</div>
                    		{{foreach $nav_apps as $nav_app}}
                    			{{$nav_app|replace:'nav-link':'dropdown-item'}}
                    		{{/foreach}}
                            
                		{{/if}}    
                	</div>
                                    
                </div>
            </li>            

             

            

                      {{* /if *}}

            <!-- end featured apps ---------------------------------------------------------- -->

 


{{*
                <li class="nav-item">
                  <a class="nav-link" href="/article/main" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Home
                    </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/articles" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notebook" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" />
                        <path d="M13 8l2 0" />
                        <path d="M13 12l2 0" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Articles
                    </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/courses" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-certificate" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
                        <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
                        <path d="M6 9l12 0" />
                        <path d="M6 12l3 0" />
                        <path d="M6 15l2 0" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Courses
                    </span>
                  </a>
                </li>

                <!--
                <li class="nav-item">
                  <a class="nav-link" href="/directory?f=&pubforums=0&global=0" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                        <path d="M10 16h6" />
                        <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M4 8h3" />
                        <path d="M4 12h3" />
                        <path d="M4 16h3" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Channels
                    </span>
                  </a>
                </li>
                -->

                <li class="nav-item">
                  <a class="nav-link" href="/directory?f=&pubforums=1&global=0" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-messages" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" />
                        <path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" />
                      </svg>
                    </span>
                    <span class="nav-link-title">
                      Forums
                    </span>
                  </a>
                </li>


                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M15 15l3.35 3.35" /><path d="M9 15l-3.35 3.35" /><path d="M5.65 5.65l3.35 3.35" /><path d="M18.35 5.65l-3.35 3.35" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Help
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="https://tabler.io/docs" target="_blank" rel="noopener">
                      Documentation
                    </a>
                    <a class="dropdown-item" href="./changelog.html">
                      Changelog
                    </a>
                    <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank" rel="noopener">
                      Source code
                    </a>
                    <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" target="_blank" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor project!
                    </a>
                  </div>
                </li>

                *}}

              </ul>
            </div>
<!--
            <div>
              <form action="./" method="get" autocomplete="off" novalidate>
                <div class="input-icon">
                  <span class="input-icon-addon">
                    {{* <!-- Download SVG icon from http://tabler-icons.io/i/search --> *}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                  </span>
                  <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search in website">
                </div>
              </form>
            </div>
-->
            <div style="margin: right 10px;">&nbsp;</div> 

          </div>
        </div>
      </header>

<!-- end default navbar template -->