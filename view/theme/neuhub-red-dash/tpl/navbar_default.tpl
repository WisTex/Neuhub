<!-- begin default navbar template -->



    {{if $localuserdisabled}}
        <style>
            #menu-toggle{
                color:black;
                position: absolute;
                top: 150px;
                right: -30px;
                // right: -45.75px;
                // right: -42px;
                transform: rotate(90deg);
                background: white;
                overflow: hidden;
            }    
        </style>
    
    	<button id="menu-toggle" class="btn btn-secondary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasLeft" aria-controls="offcanvasLeft"><i id="toggleIcon" class="fa fa-angle-double-down"></i> User Menu <!-- <i class="fa fa-filter"></i> --></button>
    {{/if}}

<!-- begin top navigation bar ---------------------------------------------- -->
<nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar !static-top">

    <div class="container-fluid">
        <!--
        <button class="btn btn-link rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-list"></i></button>
        -->
                    
        <h2 class="d-none d-sm-none d-md-none d-lg-block"><a href="/" style="color:#000000;">{{$banner}}</a></h2>
                    
        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search" method="get" action"/search" role="search">
            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" name="search" placeholder="{{$help}}"><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button></div>
        </form>
        <ul class="navbar-nav flex-nowrap ms-auto">
                            
            <li class="nav-item">
                <a class="nav-link text-primary" href="/"><i class="!generic-icons-nav fa fa-fw fa-home"></i></a>
            </li>                            

			{{if $localuser}}
            <li class="nav-item">
                <a class="nav-link text-primary" href="/channel"><i class="!generic-icons-nav fa fa-fw fa-dot-circle-o" alt="channel"></i></a>
            </li>                
			{{/if}}
                            
            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link text-primary" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="me-auto navbar-search w-100" method="get" action"/search" role="search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" name="search" placeholder="{{$help}}">
                            <div class="input-group-append"><button class="btn btn-primary py-0" type="submit"><i class="fas fa-search"></i></button></div>
                        </div>
                    </form>
                </div>
            </li>
            <!--
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 12, 2019</span>
                                <p>A new monthly report is ready to download!</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 7, 2019</span>
                                <p>$290.29 has been deposited into your account!</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="me-3">
                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 2, 2019</span>
                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                            </div>
                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown no-arrow mx-1">
                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="/view/theme/purplebasic/assets/img/avatars/avatar4.jpeg">
                                <div class="bg-success status-indicator"></div>
                            </div>
                            <div class="fw-bold">
                                <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="/view/theme/purplebasic/assets/img/avatars/avatar2.jpeg">
                                <div class="status-indicator"></div>
                            </div>
                            <div class="fw-bold">
                                <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="/view/theme/purplebasic/assets/img/avatars/avatar3.jpeg">
                                <div class="bg-warning status-indicator"></div>
                            </div>
                            <div class="fw-bold">
                                <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                            </div>
                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="/view/theme/purplebasic/assets/img/avatars/avatar5.jpeg">
                                <div class="bg-success status-indicator"></div>
                            </div>
                            <div class="fw-bold">
                                <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                <p class="small text-gray-500 mb-0">Chicken the Dog 路 2w</p>
                            </div>
                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </div>
                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
            </li>
            -->

            <!--
			{{if $localuser}}
    			<li class="nav-item text-primary">
    				<a id="nav-app-settings-link" href="/network" class="nav-link">
    					<i class="fa fa-fw fa-th"></i>
    				</a>
    			</li>
    			<li class="nav-item text-primary">
    				<a id="nav-app-settings-link" href="/messages" class="nav-link">
    					<i class="fa fa-fw fa-exclamation"></i>
    				</a>
    			</li>
    			-->
    			<!--
    			<li class="nav-item">
    				<a id="nav-app-settings-link" href="/notifications/system" class="nav-link">
    					<i class="fa fa-fw fa-comments-o"></i>
    				</a>
    			</li>			
			-->
			<!--
			{{/if}}
			-->


            <style>
                
            /* notifications */
            .notifications-btn {
            	// opacity: .5;
            	opacity: 1;
            	// color: #4e73df;
            	
            }
            .notifications-btn-icon {
            
                
                content: "\f024";
            }
            </style>

			{{if $localuser || $nav.pubs}}
    			<li id="notifications-btn" class="nav-item">
    				<a class="nav-link notifications-btn" href="/hq"><i id="notifications-btn-icon" class="fa fa-flag notifications-btn-icon"></i></a>
    			</li>
			{{/if}}


            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    
                    <a class="dropdown-toggle nav-link text-primary" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <span class="d-none d-sm-none d-md-block">Hub&nbsp; <!-- <i class="generic-icons-nav fa fa-fw fa-caret-down"></i> --></span>
                        <span class="d-xs-block d-sm-block d-md-none  d-lg-none d-xl-none"></span>
                        <!-- <i class="generic-icons-nav fa fa-fw fa-caret-square-down"></i> -->
                        
                         <!-- <span class="icon-hz-64"></span> -->
                         <span class="icon-hz"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        
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
                    		<div class="dropdown-divider"></div>
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


		<li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    
                    <a class="dropdown-toggle nav-link text-primary" aria-expanded="false" data-bs-toggle="dropdown" href="#">
					<!-- 
					<span class="d-none d-sm-none d-md-block">
						{{if $name}}{{$name}}{{/if}}   &nbsp; <i class="generic-icons-nav fa fa-fw fa-caret-down"></i> 
					</span>
					-->
                        <span class="d-xs-block d-sm-block d-md-none  d-lg-none d-xl-none"></span>
                        <!-- <i class="generic-icons-nav fa fa-fw fa-caret-square-down"></i> -->
                        
                         <!-- <span class="icon-hz-64"></span> -->
                         <span class="generic-icons-nav fa fa-bars"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                    </a>
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">


					<!-- show additional links based on page. -->
	          


                        <!-- channel apps drop down (when viewing someone else's channel) -->
                        {{if $channel_apps.0}}

                    		<div class="dropdown-header text-uppercase text-muted">
                    			Channel Apps
                    		</div>	          
	          
                        		    {{foreach $channel_apps as $channel_app}}
                        		        {{$channel_app}}
                        		    {{/foreach}}	          
	          
                            
                                <a class="dropdown-item" href="#" >
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>

                            
                		{{/if}}


					
                        {{if !$name && $sel.name == 'HQ' }}
                    		<div class="dropdown-header text-uppercase text-muted">
                    			Headquarters (HQ)
                    		</div>	          
                                <a class="dropdown-item active" href="/hq" title="HQ"><i class="fa fa-fw fa-flag generic-icons-nav"></i>HQ</a>            
                                <a class="dropdown-item" href="/network" title="Network"><i class="fa fa-fw fa-bullhorn generic-icons-nav"></i>Stream</a>
                                <a class="dropdown-item" href="/messages" title="Notifications"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
						<div class="dropdown-divider"></div>
                        {{/if}}					



					<!-- show pinned apps, if any -->
                		{{if $navbar_apps.0}}
                    		<div class="dropdown-header text-uppercase text-muted">
                    			{{$pinned_apps}}
                    		</div>
                    		<div id="nav-app-bin-container" class="">
                    			{{foreach $navbar_apps as $navbar_app}}
                    				{{$navbar_app|replace:'navbar-app nav-link':'dropdown-item nav-app-sortable'|replace:'fa':'generic-icons-nav fa'}}
                    			{{/foreach}}
                    		</div>
                		{{/if}}


	      
                	</div>
                                    
                </div>
            </li>	      

<!--
		<li class="nav-item">
            <a class="nav-link text-primary" >
            <span class="d-none d-sm-none d-md-block">

                
            
            &nbsp; <i class="generic-icons-nav fa fa-fw fa-caret-down"></i></span>
            <i class="generic-icons-nav fa fa-bars"></i>Sidebar <i class="generic-icons-nav fa fa-fw fa-caret-left"></i> fa fa-th-list</a>
            </li>

-->

            <li class="nav-item d-block d-md-none">
            <a class="nav-link text-primary" data-bs-toggle="offcanvas" href="#offcanvasRight" aria-controls="offcanvasRight"><i class="!generic-icons-nav fa fa-columns"></i><!-- Sidebar <i class="generic-icons-nav fa fa-fw fa-caret-left"></i> --></a>
            </li>

<!--
            {{if $localuser || $nav.pubs}}
                <li class="nav-item">
                    <a class="nav-link text-primary" data-bs-toggle="offcanvas" href="#offcanvasLeft" aria-controls="offcanvasLeft"><i class="generic-icons-nav fa fa-fw fa-paper-plane"></i></a>
                </li>
            {{/if}}
-->

			<ul class="navbar-nav">
				{{if $nav.login && !$userinfo}}
    				<li class="nav-item d-lg-flex">
    					{{if $nav.loginmenu.1.4}}
        					<a class="nav-link text-danger" href="#" title="{{$nav.loginmenu.1.3}}" id="{{$nav.loginmenu.1.4}}" data-bs-toggle="modal" data-bs-target="#nav-login">
        					    {{$nav.loginmenu.1.1}}
        					</a>
    					{{else}}
        					<a class="nav-link text-danger" href="login" title="{{$nav.loginmenu.1.3}}">
        						{{$nav.loginmenu.1.1}}
        					</a>
    					{{/if}}
    				</li>
				{{/if}}
				{{if $nav.register}}
    				<li class="nav-item {{$nav.register.2}} d-lg-flex">
    					<a class="nav-link" href="{{$nav.register.0}}" title="{{$nav.register.3}}" id="{{$nav.register.4}}">{{$nav.register.1}}</a>
    				</li>
				{{/if}}
				{{if $nav.alogout}}
    				<li class="nav-item {{$nav.alogout.2}} d-lg-flex">
    					<a class="nav-link" href="{{$nav.alogout.0}}" title="{{$nav.alogout.3}}" id="{{$nav.alogout.4}}">{{$nav.alogout.1}}</a>
    				</li>
				{{/if}}
			</ul>    


            <div class="d-none d-sm-block topbar-divider"></div>

            <li class="nav-item dropdown no-arrow">
                <div class="nav-item dropdown no-arrow">
                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                        <span class="d-none d-lg-inline me-2 text-gray-600 !small">
                            
                            {{if $nav.login && !$userinfo}}
                                Guest
                            {{else}}
                                {{$userinfo.name}}
                            {{/if}}
                                            
                               
                           <!--
                           {{$chan|@var_dump}}
                           {{$channel_id}}             
                           {{$chan.0}}
                           {{$chan.1}}
                           {{$chan.0.attribute}}
                           {{$chan.channel_id.attribute}}
                           {{$chan.channel_id}}
                           {{$chan[channel_id]}}
                           {{$chan[0]}}
                           {{$chan.channel_name}}
                                        {{if $chan[channel_name]}}
                                            {{$chan.channel_name}}
                                            {{$chan.channel_name}}
                                        {{/if}}
                            -->
                                
                                
                            
                        </span>
                        
                        <img class="border rounded-circle img-profile" onerror='this.src="/view/theme/neuhub-red-dash/img/blank-profile-picture-180x180.png"' 
                        disabledsrc="/view/theme/purplebasic/assets/img/avatars/avatar1.jpeg" src="{{$userinfo.icon}}" alt="{{$userinfo.name}}">
                    </a>
                    
                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                        <!--
                        <a class="dropdown-item" href="/profile"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                        <a class="dropdown-item" href="/manage"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Channels</a>
                        <a class="dropdown-item" href="/settings"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                        <a class="dropdown-item" href="/admin"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Admin</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                    
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Language</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                        -->

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
        					    <div class="dropdown-divider"></div>
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
        					    <div class="dropdown-divider"></div>
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
    				
    				
        				{{if ! $is_owner && $userinfo}}
        				
        					<a class="dropdown-item" href="{{$nav.rusermenu.0}}" role="menuitem">{{$nav.rusermenu.1}}</a>
        					<a class="dropdown-item" href="{{$nav.rusermenu.2}}" role="menuitem">{{$nav.rusermenu.3}}</a>
        				
        				{{/if}}		
        				
        				{{if $nav.login && !$userinfo}}
        
        					<a class="dropdown-item" href="login" title="{{$nav.loginmenu.1.3}}">
        						{{$nav.loginmenu.1.1}}
        					</a>
        				
        				{{/if}}
    					
    
                                           <!-- 
            			<div class="dropdown">
            				<div class="fakelink usermenu" data-bs-toggle="dropdown">
            					<img id="avatar" src="{{$userinfo.icon}}" alt="{{$userinfo.name}}">
            					<i class="fa fa-caret-down"></i>
            				</div>
            				{{if $is_owner}}
            				<div class="dropdown-menu">
            					{{foreach $nav.usermenu as $usermenu}}
            					<a class="dropdown-item{{if $usermenu.2}} active{{/if}}"  href="{{$usermenu.0}}" title="{{$usermenu.3}}" role="menuitem" id="{{$usermenu.4}}">{{$usermenu.1}}</a>
            					{{/foreach}}
            					{{if $nav.group}}
            					<a class="dropdown-item" href="{{$nav.group.0}}" title="{{$nav.group.3}}" role="menuitem" id="{{$nav.group.4}}">{{$nav.group.1}}</a>
            					{{/if}}
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
            					<div class="dropdown-divider"></div>
            					<a class="dropdown-item{{if $sel.name == Admin}} active{{/if}}" href="{{$nav.admin.0}}" title="{{$nav.admin.3}}" role="menuitem" id="{{$nav.admin.4}}">{{$nav.admin.1}}</a>
            					{{/if}}
            					{{if $nav.logout}}
            					<div class="dropdown-divider"></div>
            					<a class="dropdown-item" href="{{$nav.logout.0}}" title="{{$nav.logout.3}}" role="menuitem" id="{{$nav.logout.4}}">{{$nav.logout.1}}</a>
            					{{/if}}
            				</div>
            				{{/if}}
            				{{if ! $is_owner}}
            				<div class="dropdown-menu" role="menu" aria-labelledby="avatar">
            					<a class="dropdown-item" href="{{$nav.rusermenu.0}}" role="menuitem">{{$nav.rusermenu.1}}</a>
            					<a class="dropdown-item" href="{{$nav.rusermenu.2}}" role="menuitem">{{$nav.rusermenu.3}}</a>
            				</div>
            				{{/if}}
            			</div>                                        
                              -->              
                                        
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- end top navigation bar ------------------------------------------------ -->        


<!-- begin page layout ----------------------------------------------------- -->            
<div class="container" style="padding-right: 0px;padding-left: 0px;max-width: 1400px;">
    <div class="row" style="padding-bottom: 20px;">
                    
		<br>
		<div class="col-md-12">
		    
		    <div class="container-fluid">         
    			<!-- begin breadcrumb ------------------------------------------ --> 		    
                <div class="d-none d-sm-none d-md-none d-lg-block">					    

                    <!-- show channel id or user id -->
    			   <span class="pull-right text-muted" style="text-align: right;font-size: 14px;"><!-- {{$banner}} {{$sitelocation}} {{$chan.channel_id}} {{$chan.channel_name}} {{$sitename}} {{$channel_name}} {{$site_about}} -->
    					{{if $sitelocation && $channel_thumb}}
    					    {{$sitelocation}}
    					{{else}}
    					    {{$userinfo.addr}}
    					{{/if}}
    					<!-- mockup@completehostingguide.com -->
    				</span>
                </div>					
    
                <!-- example code -->
                {{* Set up URL we are looking for *}}
                {{assign var="lookingfor" value="$z_baseurl/settings/directory"}}
                {{* See if URL matches current URL *}}
                {{if $url == $lookingfor}}
                
                {{/if}}
                <!-- {{$url}} {{$lookingfor}} -->
    
                <!-- show breadcrumb -->

                <div class="d-none d-sm-none d-md-none d-lg-block">
                    <ol class="breadcrumb" style="font-size: 14px;">
                        <li class="breadcrumb-item"><a href="{{$baseurl}}" class="text-decoration-none"><span><i class="fa fa-home"></i> {{$sitename}}</span></a></li>
                        {{if $name}}
                            <li class="breadcrumb-item"><a href="/directory" class="text-decoration-none"><span>Channels</span></a></li>
                            <li class="breadcrumb-item"><a href="{{$url}}" class="text-decoration-none"><span><!-- <i class="fa5 fa5-house-user"></i> --><!-- Mockup Theme -->{{$name}}</span></a></li>
                        {{/if}}
                        
                        {{assign var="overrideselname" value='false'}}
                        
                        {{* Set up URL we are looking for *}}
                        {{assign var="lookingfor" value="$z_baseurl/settings/directory"}}
                        {{* If URL we are looking for matches the current URL then display *}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/directory" class="text-decoration-none"><span>Directory</span></a></li>
                        {{/if}}                                
    
                        {{* Set up URL we are looking for *}}
                        {{assign var="lookingfor" value="$z_baseurl/settings/channel_home"}}
                        {{* If URL we are looking for matches the current URL then display *}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/channel" class="text-decoration-none"><span>Channel</span></a></li>
                        {{/if}}                               
                        
                        
                        {{* Set up URL we are looking for *}}
                        {{assign var="lookingfor" value="$z_baseurl/settings/account"}}
                        {{* If URL we are looking for matches the current URL then display *}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/settings" class="text-decoration-none"><span>Settings</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/account" class="text-decoration-none"><span>Account</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}     
                        
                        {{* Set up URL we are looking for *}}
                        {{assign var="lookingfor" value="$z_baseurl/settings/channel"}}
                        {{* If URL we are looking for matches the current URL then display *}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/settings" class="text-decoration-none"><span>Settings</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/channel" class="text-decoration-none"><span>Channel</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}                                     
                        
                        {{assign var="lookingfor" value="$z_baseurl/settings/privacy"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/settings" class="text-decoration-none"><span>Settings</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/privacy" class="text-decoration-none"><span>Privacy</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}                                                


                        {{assign var="lookingfor" value="$z_baseurl/messages"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/hq" class="text-decoration-none"><span>HQ</span></a></li>
                            <li class="breadcrumb-item"><a href="/messages" class="text-decoration-none"><span>Notifications</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}       
                                 
                        {{assign var="lookingfor" value="$z_baseurl/settings/photos"}}
                        {{if $url == $lookingfor}}
                        <!--
                            <li class="breadcrumb-item"><a href="/photos" class="text-decoration-none"><span>Photos</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/photos" class="text-decoration-none"><span>Settings</span></a></li>
                            -->
                        {{/if}}             
    
                        
                        {{* Set up URL we are looking for *}}
                        {{assign var="lookingfor" value="$z_baseurl/settings/display"}}
                        {{* If URL we are looking for matches the current URL then display *}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/settings" class="text-decoration-none"><span>Settings</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/privacy" class="text-decoration-none"><span>Display</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}                                            
    
    
                        {{assign var="lookingfor" value="$z_baseurl/settings/calendar"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/cdav/calendar" class="text-decoration-none"><span>Calendar</span></a></li>
                            <li class="breadcrumb-item"><a href="/settings/calendar" class="text-decoration-none"><span>Settings</span></a></li>
                            {{assign var="overrideselname" value="true"}}
                        {{/if}}                   
    
                        {{assign var="lookingfor" value="$z_baseurl/profile_photo"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/profiles" class="text-decoration-none"><span>Profiles</span></a></li>
                            <li class="breadcrumb-item"><a href="/profile_photo" class="text-decoration-none"><span>Profile Photo</span></a></li>
                        {{/if}}                   
                        
                        {{math assign="localuserresult" equation="x - 1" x=$localuser}}
                        {{assign var="lookingfor" value="$z_baseurl/profile_photo/$localuserresult"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/profiles" class="text-decoration-none"><span>Profiles</span></a></li>
                            <li class="breadcrumb-item"><a href="/profile_photo" class="text-decoration-none"><span>Profile Photo</span></a></li>
                        {{/if}}                   
                        
                        {{assign var="lookingfor" value="$z_baseurl/cover_photo"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/profiles" class="text-decoration-none"><span>Profiles</span></a></li>
                            <li class="breadcrumb-item"><a href="/cover_photo" class="text-decoration-none"><span>Cover Photo</span></a></li>
                        {{/if}}                   
                        
                        {{assign var="lookingfor" value="$z_baseurl/thing"}}
                        {{if $url == $lookingfor}}
                            <li class="breadcrumb-item"><a href="/profiles" class="text-decoration-none"><span>Profiles</span></a></li>
                            <li class="breadcrumb-item"><a href="/things" class="text-decoration-none"><span>Things</span></a></li>
                        {{/if}}   
                        
                        
                        {{if !$name && ($sel.name == "Apps" || $sel.name == "HQ" || $sel.name == "Channel-disabled" || $sel.name == "Profile" || $sel.name == "Post" || $sel.name == "Stream" || $sel.name == "Notifications" || $sel.name == "Connections")}}
                            <li class="breadcrumb-item"><a href="/channel" class="text-decoration-none"><span>My Channel</span></a></li>
                        {{/if}}
                        
                        {{if !$name && ($sel.name == "Calendar" || $sel.name == "Contact Roles" || $sel.name == "Files" || $sel.name == "Photos" || $sel.name == "Wiki" || $sel.name == "Affinity Tool" || $sel.name == "Articles" || $sel.name == "Bookmarks" || $sel.name == "CardDAV" || $sel.name == "Cards")}}
                            <li class="breadcrumb-item"><a href="/channel" class="text-decoration-none"><span>My Channel</span></a></li>
                            <li class="breadcrumb-item"><a href="/apps" class="text-decoration-none"><span>Apps</span></a></li>
                        {{/if}}

                        {{if $sel.name && $name && $sel.name == 'Channel'}}
                            <li class="breadcrumb-item"><a href="{{$url}}" class="text-decoration-none"><span>Posts</span></a></li>
						{{assign var="overrideselname" value="true"}}
                        {{/if}}
                                    
                        {{if $sel.name && $overrideselname == 'false'}}
                            <li class="breadcrumb-item"><a href="{{$url}}" class="text-decoration-none"><span>{{$sel.name}}</span></a></li>
                        {{/if}}
                                    
    
                                    
                    </ol>
                                
                </div>                                                    
            </div>


            <!-- begin page navbar ----------------------------------------- -->
{{if $name == 'sdhflksadhfsadkhgsfdkjgfsdhkls'}}
            <div class="container-fluid">
                <div class="d-flex flex-wrap justify-content-center py-3 mb-0 border-bottom" style="z-index:100;">
                    <a href="{{$url}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                        <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="{{$url}}"/></svg> -->
                        <img src="{{$channel_thumb}}" class="!menu-img-2" style="max-height:42px;">&nbsp;&nbsp;
                        <span class="fs-4">
                            {{if $name}}
                                <b><!-- Mockup Theme -->{{$name}}</b>
                            {{/if}}
                            {{if $sel.name && !$name && $sel.name != "HQ"}}
                                <b><!-- Mockup Theme -->{{$sel.name}}</b>
                            {{/if}}                                    
                            {{if $sel.name && !$name && $sel.name == "HQ"}}
                                <span class="!text-primary notifications-btn"><i id="notifications-btn-icon" class="fa fa-flag notifications-btn-icon"></i></span> <b>Headquarters (HQ)</b>
                            {{/if}}      
            
                            {{assign var="lookingfor" value="$z_baseurl/profile_photo"}}
                            {{if $url == $lookingfor}}
                                <b>Profile Photo</b>
                            {{/if}}             
                            
                            {{math assign="localuserresult" equation="x - 1" x=$localuser}}
                            {{assign var="lookingfor" value="$z_baseurl/profile_photo/$localuserresult"}}
                            {{if $url == $lookingfor}}
                                <b>Profile Photo</b>
                            {{/if}}                   
                            
                            {{assign var="lookingfor" value="$z_baseurl/cover_photo"}}
                            {{if $url == $lookingfor}}
                                <b>Cover Photo</b>
                            {{/if}}                   
                            
                            {{assign var="lookingfor" value="$z_baseurl/thing"}}
                            {{if $url == $lookingfor}}
                                <b>Things</b>
                            {{/if}}                           

                            {{assign var="lookingfor" value="$z_baseurl/messages"}}
                            {{if $url == $lookingfor}}
                                <b>Notifications</b>
                            {{/if}}          
            
                        </span>
                    </a>

                    <ul class="nav nav-pills">
          
                        <!-- channel apps drop down-->
                        {{if $channel_apps.0}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    
                        		    {{foreach $channel_apps as $channel_app}}
                        		        {{$channel_app}}
                        		    {{/foreach}}
                    
                                    <!--
                                    <a class="dropdown-item" href="/channel">View Channel</a>
                                    <a class="dropdown-item" href="/profile/{{$localuserresult}}/view">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/connections">Connections</a>
                                    -->
                                </div>
                            </li>
                		{{/if}}



                        {{math assign="localuserresult" equation="x - 1" x=$localuser}}
                        {{if !$name && ($sel.name == 'Channel'
                         || $sel.name == "Calendar" 
                         || $sel.name == "Contact Roles" 
                         || $sel.name == "Post" 
                         || $sel.name == "Profile" 
                         || $sel.name == "Files" 
                         || $sel.name == "Help" 
                         || $sel.name == "Photos"
                         || $sel.name == "Search" 
                         || $sel.name == "Wiki")}}


                            <li class="nav-item">
                                <a class="nav-link{{if $sel.name == "Channel"}} active{{/if}}" href="/channel" title="Status Messages and Posts"><i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Posts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{if $sel.name == "Profile"}} active{{/if}}" href="/profile/{{$localuserresult}}/view" title="Profile Details"><i class="fa fa-fw fa-vcard-o generic-icons-nav"></i>About</a>
                            </li>
                
                            <!--            
                            <li class="nav-item">
                                <a class="nav-link" href="/photos" title="Photo Albums"><i class="fa fa-fw fa-photo generic-icons-nav"></i>Photos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cloud" title="Files and Storage"><i class="fa fa-fw fa-folder-open generic-icons-nav"></i>Files</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cal" title="Calendar"><i class="fa fa-fw fa-calendar generic-icons-nav"></i>Calendar</a>
                            </li>            
                            -->

                            <!--
                            <a class="dropdown-item" href="/photos" title="Photo Albums"><i class="fa fa-fw fa-photo generic-icons-nav"></i>Photos</a>
                            <a class="dropdown-item" href="/cloud" title="Files and Storage"><i class="fa fa-fw fa-folder-open generic-icons-nav"></i>Files</a>
                            <a class="dropdown-item" href="/cal" title="Calendar"><i class="fa fa-fw fa-calendar generic-icons-nav"></i>Calendar</a>
                            -->
                        {{/if}}

                        {{math assign="localuserresult" equation="x - 1" x=$localuser}}
                        {{if !$name && $sel.name == 'Profile-disabled'}}
                            <a class="dropdown-item" href="/channel" title="Status Messages and Posts"><i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel</a>
                            <a class="dropdown-item active" href="/profile/{{$localuserresult}}/view" title="Profile Details"><i class="fa fa-fw fa-user generic-icons-nav"></i>About</a>
                            <a class="dropdown-item" href="/apps" title="Photo Albums"><i class="fa fa-fw fa-photo generic-icons-nav"></i>Apps</a>
                            <!--
                            <a class="dropdown-item" href="/photos" title="Photo Albums"><i class="fa fa-fw fa-photo generic-icons-nav"></i>Photos</a>
                            <a class="dropdown-item" href="/cloud" title="Files and Storage"><i class="fa fa-fw fa-folder-open generic-icons-nav"></i>Files</a>
                            <a class="dropdown-item" href="/cal" title="Calendar"><i class="fa fa-fw fa-calendar generic-icons-nav"></i>Calendar</a>
                            -->
                        {{/if}}

                        {{if !$name && $sel.name == 'HQ' }}
                            <li class="nav-item">
                                <a class="nav-link active" href="/hq" title="HQ"><i class="fa fa-fw fa-flag generic-icons-nav"></i>HQ</a>            
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/network" title="Settings"><i class="fa fa-fw fa-bullhorn generic-icons-nav"></i>Stream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/messages" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        
                                    <a class="dropdown-item" href="/channel">View Channel</a>
                                    <a class="dropdown-item" href="/profile/{{$localuserresult}}/view">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/connections">Connections</a>
                        
                                </div>
                            </li>
                        {{/if}}

                        {{if !$name && $sel.name == 'Stream' }}
                            <li class="nav-item">
                                <a class="nav-link" href="/hq" title="Settings"><i class="fa fa-fw fa-flag generic-icons-nav"></i>HQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/network" title="Settings"><i class="fa fa-fw fa-bullhorn generic-icons-nav"></i>Stream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/messages" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        
                                    <a class="dropdown-item" href="/channel">View Channel</a>
                                    <a class="dropdown-item" href="/profile/{{$localuserresult}}/view">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/connections">Connections</a>
                        
                                </div>
                            </li>		
                        {{/if}}

                        {{if !$name && $sel.name == 'Notifications' }}
                            <li class="nav-item">
                                <a class="nav-link" href="/hq" title="Settings"><i class="fa fa-fw fa-flag generic-icons-nav"></i>HQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/network" title="Settings"><i class="fa fa-fw fa-bullhorn generic-icons-nav"></i>Stream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/messages" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        
                                    <a class="dropdown-item" href="/channel">View Channel</a>
                                    <a class="dropdown-item" href="/profile/{{$localuserresult}}/view">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/connections">Connections</a>
                        
                                </div>
                            </li>                            
                        {{/if}}

                     {{assign var="lookingfor" value="$z_baseurl/messages"}}
                        {{if $url == $lookingfor}}
                            <li class="nav-item">
                                <a class="nav-link" href="/hq" title="Settings"><i class="fa fa-fw fa-flag generic-icons-nav"></i>HQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/network" title="Settings"><i class="fa fa-fw fa-bullhorn generic-icons-nav"></i>Stream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/messages" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        
                                    <a class="dropdown-item" href="/channel">View Channel</a>
                                    <a class="dropdown-item" href="/profile/{{$localuserresult}}/view">View Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/connections">Connections</a>
                        
                                </div>
                            </li>		
                        {{/if}}   


                        {{if !$name && $sel.name == 'Settings'}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}

                        {{if !$name && $sel.name == 'Profiles'}}
                            <li class="nav-item">
                                <a class="nav-link active" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}

                        {{if !$name && $sel.name == 'Apps'}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}

                        {{if !$name && $sel.name == 'Directory'}}
                            <li class="nav-item">
                                <a class="nav-link" href="/directory?f=&pubforums=0&global=0" title="Settings"><i class="fa fa-fw fa-sitemap generic-icons-nav"></i>Channels</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/directory?f=&pubforums=1&global=0" title="Settings"><i class="fa fa-fw fa-comments-o generic-icons-nav"></i>Forums</a>
                            </li>
                            
                            {{if $localuser}}
                                <li class="nav-item">
                                    <a class="nav-link" href="/connections" title="Settings"><i class="fa fa-fw fa-users generic-icons-nav"></i>Connections</a>
                                </li>
                            {{/if}}
                        {{/if}}                    

                        {{if !$name && $sel.name == 'Connections'}}
                            <li class="nav-item">
                                <a class="nav-link" href="/directory?f=&pubforums=0&global=0" title="Settings"><i class="fa fa-fw fa-sitemap generic-icons-nav"></i>Channels</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/directory?f=&pubforums=1&global=0" title="Settings"><i class="fa fa-fw fa-comments-o generic-icons-nav"></i>Forums</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/connections" title="Settings"><i class="fa fa-fw fa-users generic-icons-nav"></i>Connections</a>
                            </li>
                        {{/if}}

                        {{assign var="lookingfor" value="$z_baseurl/profile_photo"}}
                        {{if $url == $lookingfor}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}           


                        {{math assign="localuserresult" equation="x - 1" x=$localuser}}
                        {{assign var="lookingfor" value="$z_baseurl/profile_photo/$localuserresult"}}
                        {{if $url == $lookingfor}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}                                                

                        {{assign var="lookingfor" value="$z_baseurl/cover_photo"}}
                        {{if $url == $lookingfor}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}                                  

                        {{assign var="lookingfor" value="$z_baseurl/thing"}}
                        {{if $url == $lookingfor}}
                            <li class="nav-item">
                                <a class="nav-link" href="/profiles" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Edit Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/settings" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/apps" title="Settings"><i class="fa fa-fw fa-home generic-icons-nav"></i>Apps</a>
                            </li>
                        {{/if}}            

                		{{if $navbar_apps.0}}
                		
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-fw fa-thumb-tack generic-icons-nav"></i>Pinned Apps
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                
                        			{{foreach $navbar_apps as $navbar_app}}
                        				{{$navbar_app|replace:'navbar-app nav-link':'dropdown-item'|replace:'fa':'generic-icons-nav fa'}}
                        			{{/foreach}}
                        			<div class="dropdown-divider"></div>
                        			<a class="dropdown-item" href="/apps" title="Apps"><i class="fa fa-fw fa-cube generic-icons-nav"></i>More Apps</a>	
                                </div>
                            </li>
    
                		{{else}}
                            <div class="dropdown-divider"></div>
                            
                            <!-- <a class="dropdown-item" href="/apps" title="Apps"><i class="fa fa-fw fa-cube generic-icons-nav"></i>Pin More Apps</a>	 -->
                            {{if $is_owner}}
                                <li class="nav-item">
                                    <a class="nav-link" href="/apps" title="Apps"><i class="fa fa-fw fa-cube generic-icons-nav"></i>Apps</a>	
                                </li>
                            {{/if}}
                            
                		{{/if}}

            			{{if $settings_url}}
                			<li class="nav-item">
                			    
                				<a id="nav-app-settings-link" href="{{$settings_url}}/?f=&rpath={{$url}}" !class="dropdown-item" class="nav-link">
                					<i class="fa fa-fw fa-cog generic-icons-nav"></i>
                				</a>
                			</li>
                			    
            			{{/if}}          
                        <!--
                        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        -->
                    </ul>
                </div>
            </div> <!-- container -->


{{/if}} <!-- // showextranav  -->



        </div> <!-- column -->
    </div> <!-- row -->

<!-- page layout continues -->

<!--
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>
-->



<script>
	var sse_bs_active = false;
	var sse_offset = 0;
	var sse_type;
	var sse_partial_result = false;
	var sse_rmids = [];
	var sse_fallback_interval;

	$(document).ready(function() {
		let notifications_parent;
		if ($('#notifications_wrapper').length) {
			notifications_parent = $('#notifications_wrapper')[0].parentElement.id;
		}

		$('.notifications-btn').click(function() {
			if($('#notifications_wrapper').hasClass('fs')) {
				$('#notifications_wrapper').prependTo('#' + notifications_parent);
			}
			else {
				$('#notifications_wrapper').prependTo('section');
			}

			$('#notifications_wrapper').toggleClass('fs');
			if($('#navbar-collapse-2').hasClass('show')){
				$('#navbar-collapse-2').removeClass('show');
			}
		});

		$(document).on('click', '.notification', function() {
			if($('#notifications_wrapper').hasClass('fs')) {
				$('#notifications_wrapper').prependTo('#' + notifications_parent).removeClass('fs');
			}
		});

		if(sse_enabled) {
			if(typeof(window.SharedWorker) === 'undefined') {
				// notifications with multiple tabs open will not work very well in this scenario
				var evtSource = new EventSource('/sse');

				evtSource.addEventListener('notifications', function(e) {
					var obj = JSON.parse(e.data);
					sse_handleNotifications(obj, false, false);
				}, false);

				document.addEventListener('visibilitychange', function() {
					if (!document.hidden) {
						sse_offset = 0;
						sse_bs_init();
					}
				}, false);

			}
			else {
				var myWorker = new SharedWorker('/view/js/sse_worker.js', localUser);

				myWorker.port.onmessage = function(e) {
					obj = e.data;
					console.log(obj);
					sse_handleNotifications(obj, false, false);
				}

				myWorker.onerror = function(e) {
					myWorker.port.close();
				}

				myWorker.port.start();
			}
		}
		else {
			if (!document.hidden)
				sse_fallback_interval = setInterval(sse_fallback, updateInterval);

			document.addEventListener('visibilitychange', function() {
				if (document.hidden) {
					clearInterval(sse_fallback_interval);
				}
				else {
					sse_offset = 0;
					sse_bs_init();
					sse_fallback_interval = setInterval(sse_fallback, updateInterval);
				}

			}, false);
		}

		$('.notification-link').on('click', { replace: true, followup: false }, sse_bs_notifications);

		$('.notification-filter').on('keypress', function(e) {
			if(e.which == 13) { // enter
				this.blur();
				sse_offset = 0;
				$("#nav-" + sse_type + "-menu").html('');
				$("#nav-" + sse_type + "-loading").show();

				var cn_val = $('#cn-' + sse_type + '-input').length ? $('#cn-' + sse_type + '-input').val().toString().toLowerCase() : '';

				$.get('/sse_bs/' + sse_type + '/' + sse_offset + '?nquery=' + encodeURIComponent(cn_val), function(obj) {
					console.log('sse: bootstraping ' + sse_type);
					console.log(obj);

					sse_bs_active = false;
					sse_partial_result = true;
					sse_offset = obj[sse_type].offset;
					if(sse_offset < 0)
						$("#nav-" + sse_type + "-loading").hide();

					sse_handleNotifications(obj, true, false);

				});
			}
		});

		$('.notifications-textinput-clear').on('click', function(e) {
			if(! sse_partial_result)
				return;

			$("#nav-" + sse_type + "-menu").html('');
			$("#nav-" + sse_type + "-loading").show();
			$.get('/sse_bs/' + sse_type, function(obj) {
				console.log('sse: bootstraping ' + sse_type);
				console.log(obj);

				sse_bs_active = false;
				sse_partial_result = false;
				sse_offset = obj[sse_type].offset;
				if(sse_offset < 0)
					$("#nav-" + sse_type + "-loading").hide();

				sse_handleNotifications(obj, true, false);

			});
		});

		$('.notification-content').on('scroll', function() {
			if(this.scrollTop > this.scrollHeight - this.clientHeight - (this.scrollHeight/7)) {
				sse_bs_notifications(sse_type, false, true);
			}
		});

	});

	$(document).on('hz:sse_setNotificationsStatus', function(e, data) {
		sse_setNotificationsStatus(data);
	});

	$(document).on('hz:sse_bs_init', function() {
		sse_bs_init();
	});

	$(document).on('hz:sse_bs_counts', function() {
		sse_bs_counts();
	});

	{{foreach $notifications as $notification}}
	{{if $notification.filter}}
	$(document).on('click', '#tt-{{$notification.type}}-only', function(e) {
		if($(this).hasClass('active sticky-top')) {
			$('#nav-{{$notification.type}}-menu .notification[data-thread_top=false]').removeClass('tt-filter-active');
			$(this).removeClass('active sticky-top');
		}
		else {
			$('#nav-{{$notification.type}}-menu .notification[data-thread_top=false]').addClass('tt-filter-active');
			$(this).addClass('active sticky-top');
			// load more notifications if visible notifications count is low
			if(sse_type  && sse_offset != -1 && $('#nav-' + sse_type + '-menu').children(':visible').length < 15) {
				sse_bs_notifications(sse_type, false, true);
			}
		}

	});

	$(document).on('click', '#cn-{{$notification.type}}-input-clear', function(e) {
		$('#cn-{{$notification.type}}-input').val('');
		$('#cn-{{$notification.type}}-only').removeClass('active sticky-top');
		$("#nav-{{$notification.type}}-menu .notification").removeClass('cn-filter-active');
		$('#cn-{{$notification.type}}-input-clear').addClass('d-none');
	});

	$(document).on('input', '#cn-{{$notification.type}}-input', function(e) {
		var val = $('#cn-{{$notification.type}}-input').val().toString().toLowerCase();
		if(val) {
			val = val.indexOf('%') == 0 ? val.substring(1) : val;
			$('#cn-{{$notification.type}}-only').addClass('active sticky-top');
			$('#cn-{{$notification.type}}-input-clear').removeClass('d-none');
		}
		else {
			$('#cn-{{$notification.type}}-only').removeClass('active sticky-top');
			$('#cn-{{$notification.type}}-input-clear').addClass('d-none');
		}

		$("#nav-{{$notification.type}}-menu .notification").each(function(i, el){
			var cn = $(el).data('contact_name').toString().toLowerCase();
			var ca = $(el).data('contact_addr').toString().toLowerCase();

			if(cn.indexOf(val) === -1 && ca.indexOf(val) === -1)
				$(this).addClass('cn-filter-active');
			else
				$(this).removeClass('cn-filter-active');
		});
	});
	{{/if}}
	{{/foreach}}

	function sse_bs_init() {
		if(sessionStorage.getItem('notification_open') !== null || typeof sse_type !== 'undefined' ) {
			if(typeof sse_type === 'undefined')
				sse_type = sessionStorage.getItem('notification_open');

			$("#nav-" + sse_type + "-sub").addClass('show');
			sse_bs_notifications(sse_type, true, false);
		}
		else {
			sse_bs_counts();
		}
	}

	function sse_bs_counts() {
		if(sse_bs_active)
			return;

		sse_bs_active = true;

		$.ajax({
			type: 'post',
			url: '/sse_bs',
			data: { sse_rmids }
		}).done( function(obj) {
			console.log(obj);
			sse_bs_active = false;
			sse_rmids = [];
			sse_handleNotifications(obj, true, false);
		});
	}

	function sse_bs_notifications(e, replace, followup) {

		if(sse_bs_active)
			return;

		var manual = false;

		if(typeof replace === 'undefined')
			replace = e.data.replace;

		if(typeof followup === 'undefined')
			followup = e.data.followup;

		if(typeof e === 'string') {
			sse_type = e;
		}
		else {
			manual = true;
			sse_offset = 0;
			sse_type = e.target.dataset.sse_type;
		}

		if(typeof sse_type === 'undefined')
			return;

		if(followup || !manual || !$('#notification-link-' + sse_type).hasClass('collapsed')) {

			if(sse_offset >= 0) {
				$("#nav-" + sse_type + "-loading").show();
			}

			sessionStorage.setItem('notification_open', sse_type);
			if(sse_offset !== -1 || replace) {

				var cn_val = (($('#cn-' + sse_type + '-input').length && sse_partial_result) ? $('#cn-' + sse_type + '-input').val().toString().toLowerCase() : '');

				$("#nav-" + sse_type + "-loading").show();

				sse_bs_active = true;

				$.ajax({
					type: 'post',
					url: '/sse_bs/' + sse_type + '/' + sse_offset,
					nquery: encodeURIComponent(cn_val),
					data: { sse_rmids }
				}).done(function(obj) {
					console.log('sse: bootstraping ' + sse_type);
					console.log(obj);
					sse_bs_active = false;
					sse_rmids = [];
					$("#nav-" + sse_type + "-loading").hide();
					sse_offset = obj[sse_type].offset;
					sse_handleNotifications(obj, replace, followup);
				});
			}
			else {
				$("#nav-" + sse_type + "-loading").hide();
			}
		}
		else {
			sessionStorage.removeItem('notification_open');
		}
	}

	function sse_handleNotifications(obj, replace, followup) {

		var primary_notifications = ['dm', 'home', 'intros', 'register', 'notify', 'files'];
		var secondary_notifications = ['network', 'forums', 'all_events', 'pubs'];
		var all_notifications = primary_notifications.concat(secondary_notifications);

		all_notifications.forEach(function(type, index) {
			if(typeof obj[type] === typeof undefined)
				return true;

			if(obj[type].count) {
				$('.' + type + '-button').fadeIn();
				if(replace || followup)
					$('.' + type + '-update').html(Number(obj[type].count));
				else
					$('.' + type + '-update').html(Number(obj[type].count) + Number($('.' + type + '-update').html()));
			}
			else {
				$('.' + type + '-update').html('0');
				$('#nav-' + type + '-sub').removeClass('show');
				$('.' + type + '-button').fadeOut(function() {
					sse_setNotificationsStatus();
				});
			}
			if(obj[type].notifications.length)
				sse_handleNotificationsItems(type, obj[type].notifications, replace, followup);
		});

		sse_setNotificationsStatus();

		// notice and info
		$.jGrowl.defaults.closerTemplate = '<div>[ ' + aStr.closeAll + ']</div>';

		if(obj.notice) {
			$(obj.notice.notifications).each(function() {
				$.jGrowl(this, { sticky: true, theme: 'notice' });
			});
		}

		if(obj.info) {
			$(obj.info.notifications).each(function(){
				$.jGrowl(this, { sticky: false, theme: 'info', life: 10000 });
			});
		}

		// load more notifications if visible notifications count becomes low
		if(sse_type  && sse_offset != -1 && $('#nav-' + sse_type + '-menu').children(':not(.tt-filter-active)').length < 15) {
			sse_bs_notifications(sse_type, false, true);
		}


	}

	function sse_handleNotificationsItems(notifyType, data, replace, followup) {

		var notifications_tpl = ((notifyType == 'forums') ? decodeURIComponent($("#nav-notifications-forums-template[rel=template]").html().replace('data-src', 'src')) : decodeURIComponent($("#nav-notifications-template[rel=template]").html().replace('data-src', 'src')));
		var notify_menu = $("#nav-" + notifyType + "-menu");
		var notify_loading = $("#nav-" + notifyType + "-loading");
		var notify_count = $("." + notifyType + "-update");

		if(replace && !followup) {
			notify_menu.html('');
			notify_loading.hide();
		}

		$(data).each(function() {

			// do not add a notification if it is already present
			if($('#nav-' + notifyType + '-menu .notification[data-b64mid=\'' + this.b64mid + '\']').length)
				return true;

			if(!replace && !followup && (this.thread_top && notifyType === 'network')) {
				$(document).trigger('hz:handleNetworkNotificationsItems', this);
			}

			html = notifications_tpl.format(this.notify_link,this.photo,this.name,this.addr,this.message,this.when,this.hclass,this.b64mid,this.notify_id,this.thread_top,this.unseen,this.private_forum, encodeURIComponent(this.mids), this.body);
			notify_menu.append(html);
		});

		if(!replace && !followup) {
			$("#nav-" + notifyType + "-menu .notification").sort(function(a,b) {
				a = new Date(a.dataset.when);
				b = new Date(b.dataset.when);
				return a > b ? -1 : a < b ? 1 : 0;
			}).appendTo('#nav-' + notifyType + '-menu');
		}

		$("#nav-" + notifyType + "-menu .notifications-autotime").timeago();

		if($('#tt-' + notifyType + '-only').hasClass('active'))
			$('#nav-' + notifyType + '-menu [data-thread_top=false]').addClass('tt-filter-active');

		if($('#cn-' + notifyType + '-input').length) {
			var filter = $('#cn-' + notifyType + '-input').val().toString().toLowerCase();
			if(filter) {
				filter = filter.indexOf('%') == 0 ? filter.substring(1) : filter;

				$('#nav-' + notifyType + '-menu .notification').each(function(i, el) {
					var cn = $(el).data('contact_name').toString().toLowerCase();
					var ca = $(el).data('contact_addr').toString().toLowerCase();
					if(cn.indexOf(filter) === -1 && ca.indexOf(filter) === -1)
						$(el).addClass('cn-filter-active');
					else
						$(el).removeClass('cn-filter-active');
				});
			}
		}
	}

	function sse_updateNotifications(type, mid) {

		if(type === 'pubs')
			return true;

		if(type === 'notify' && (mid !== bParam_mid || sse_type !== 'notify'))
			return true;
	/*
		var count = Number($('.' + type + '-update').html());

		count--;

		if(count < 1) {
			$('.' + type + '-update').html(count);
			$('.' + type + '-button').fadeOut(function() {
				sse_setNotificationsStatus();
			});
		}
		else {
			$('.' + type + '-update').html(count);
		}
	*/

		$('#nav-' + type + '-menu .notification[data-b64mid=\'' + mid + '\']').fadeOut(function() {
			this.remove();
		});

	}

	function sse_setNotificationsStatus(data) {
		var primary_notifications = ['dm', 'home', 'intros', 'register', 'notify', 'files'];
		var secondary_notifications = ['network', 'forums', 'all_events', 'pubs'];
		var all_notifications = primary_notifications.concat(secondary_notifications);

		var primary_available = false;
		var any_available = false;

		all_notifications.forEach(function(type, index) {
			if($('.' + type + '-button').css('display') == 'block') {
				any_available = true;
				if(primary_notifications.indexOf(type) > -1)
					primary_available = true;
			}
		});

		if(primary_available) {
			$('.notifications-btn-icon').removeClass('fa-flag');
			$('.notifications-btn-icon').addClass('fa-bell');
		}
		else {
			$('.notifications-btn-icon').removeClass('fa-bell');
			$('.notifications-btn-icon').addClass('fa-flag');
		}

		if(any_available) {
			$('.notifications-btn').css('color', 'red');
			$('#no_notifications').hide();
			$('#notifications').show();
		}
		else {
			$('.notifications-btn').css('color', '#43488A');
			$('#navbar-collapse-1').removeClass('show');
			$('#no_notifications').show();
			$('#notifications').hide();
		}

		if (typeof data !== typeof undefined) {
			data.forEach(function(nmid, index) {

				sse_rmids.push(nmid);

				if($('.notification[data-b64mid=\'' + nmid + '\']').length) {
					$('.notification[data-b64mid=\'' + nmid + '\']').each(function() {
						var n = this.parentElement.id.split('-');
						return sse_updateNotifications(n[1], nmid);
					});
				}

				// special handling for forum notifications
				$('.notification-forum').filter(function() {
					var fmids = decodeURIComponent($(this).data('b64mids'));
					var n = this.parentElement.id.split('-');
					if(fmids.indexOf(nmid) > -1) {
						var fcount = Number($('.' + n[1] + '-update').html());
						fcount--;
						$('.' + n[1] + '-update').html(fcount);
						if(fcount < 1) {
							$('.' + n[1] + '-button').fadeOut();
							$('#nav-' + n[1] + '-sub').removeClass('show');
						}
						var count = Number($(this).find('.bg-secondary').html());
						count--;
						$(this).find('.bg-secondary').html(count);
						if(count < 1)
							$(this).remove();
					}
				});
			});
		}

	}

	function sse_fallback() {
		$.get('/sse', function(obj) {
			if(! obj)
				return;

			console.log('sse fallback');
			console.log(obj);

			sse_handleNotifications(obj, false, false);
		});
	}
</script>

<!-- end default navbar template -->