<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid flex-nowrap">
		{{if $userinfo}}
		<div class="d-flex" style="max-width: 50%">
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
			{{if $sel.name}}
			<div id="nav-app-link-wrapper" class="navbar-nav{{if $sitelocation}} has_location{{/if}}">
				<a id="nav-app-link" href="{{$url}}" class="nav-link text-truncate" style="width: 100%">
					{{$sel.name}}
					{{if $sitelocation}}
					<br><small>{{$sitelocation}}</small>
					{{/if}}
				</a>
			</div>
			{{if $settings_url}}
			<div id="nav-app-settings-link-wrapper" class="navbar-nav">
				<a id="nav-app-settings-link" href="{{$settings_url}}/?f=&rpath={{$url}}" class="nav-link">
					<i class="fa fa-fw fa-cog"></i>
				</a>
			</div>
			{{/if}}
			{{/if}}
		</div>
		{{else}}
		<div id="banner" class="navbar-text d-lg-none">{{$banner}}</div>
		{{/if}}
		<div class="navbar-toggler-right">
			{{if $nav.help.6}}
			<button id="context-help-btn" class="navbar-toggler border-0" type="button" onclick="contextualHelp(); return false;">
				<i class="fa fa-question-circle"></i>
			</button>
			{{/if}}
			<button id="expand-aside" type="button" class="d-lg-none navbar-toggler border-0">
				<i class="fa fa-arrow-circle-right" id="expand-aside-icon"></i>
			</button>
			{{if $localuser || $nav.pubs}}
			<button id="notifications-btn-1" type="button" class="navbar-toggler border-0 notifications-btn">
				<i id="notifications-btn-icon-1" class="fa fa-exclamation-circle notifications-btn-icon"></i>
			</button>
			{{/if}}
			<button id="menu-btn" class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#app-bin">
				<i class="fa fa-bars"></i>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-between" id="navbar-collapse-1">
			<ul class="navbar-nav">
				{{if $nav.login && !$userinfo}}
				<li class="nav-item d-lg-flex">
					{{if $nav.loginmenu.1.4}}
					<a class="nav-link" href="#" title="{{$nav.loginmenu.1.3}}" id="{{$nav.loginmenu.1.4}}" data-bs-toggle="modal" data-bs-target="#nav-login">
					{{$nav.loginmenu.1.1}}
					</a>
					{{else}}
					<a class="nav-link" href="login" title="{{$nav.loginmenu.1.3}}">
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

			<div id="banner" class="navbar-text">{{$banner}}</div>

			<ul id="nav-right" class="navbar-nav">
				<li class="nav-item collapse clearfix" id="nav-search">
					<form class="form-inline" method="get" action="{{$nav.search.4}}" role="search">
						<input class="form-control form-control-sm mt-1 me-2" id="nav-search-text" type="text" value="" placeholder="{{$help}}" name="search" title="{{$nav.search.3}}" onclick="this.submit();" onblur="closeMenu('nav-search'); openMenu('nav-search-btn');"/>
					</form>
					<div id="nav-search-spinner" class="spinner-wrapper">
						<div class="spinner s"></div>
					</div>
				</li>
				<li class="nav-item" id="nav-search-btn">
					<a class="nav-link" href="#nav-search" title="{{$nav.search.3}}" onclick="openMenu('nav-search'); closeMenu('nav-search-btn'); $('#nav-search-text').focus(); return false;"><i class="fa fa-fw fa-search"></i></a>
				</li>
				{{if $nav.help.6}}
				<li class="nav-item dropdown {{$sel.help}}">
					<a class="nav-link {{$nav.help.2}}" target="hubzilla-help" href="{{$nav.help.0}}" title="{{$nav.help.3}}" id="{{$nav.help.4}}" onclick="contextualHelp(); return false;"><i class="fa fa-fw fa-question-circle"></i></a>
				</li>
				{{/if}}
				{{if $localuser || $nav.pubs}}
				<li id="notifications-btn" class="nav-item d-xl-none">
					<a class="nav-link text-white notifications-btn" href="#"><i id="notifications-btn-icon" class="fa fa-exclamation-circle  notifications-btn-icon"></i></a>
				</li>
				{{/if}}
				{{if $navbar_apps}}
				{{foreach $navbar_apps as $navbar_app}}
				<li class="nav-app-sortable">
					{{$navbar_app}}
				</li>
				{{/foreach}}
				{{/if}}
				<li class="nav-item dropdown" id="app-menu">
					<a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#app-bin" aria-controls="app-bin"><i class="fa fa-fw fa-bars"></i></a>
				</li>
			</ul>
		</div>
		{{if $nav.help.6}}
		<div id="contextual-help-content" class="contextual-help-content">
			{{$nav.help.5}}
			<div class="float-end">
				<a class="btn btn-primary btn-sm" target="hubzilla-help" href="{{$nav.help.0}}" title="{{$nav.help.3}}"><i class="fa fa-question"></i>&nbsp;{{$fulldocs}}</a>
				<a class="contextual-help-tool" href="#" onclick="contextualHelp(); return false;"><i class="fa fa-times"></i></a>
			</div>
		</div>
		{{/if}}
	</div>
</nav>
<div class="offcanvas offcanvas-end" tabindex="-1" id="app-bin" aria-labelledby="app-bin-label">
	<div class="offcanvas-header">
		{{if $nav.login && !$userinfo}}
		<div class="d-lg-none pt-1 pb-1">
			{{if $nav.loginmenu.1.4}}
			<a class="btn btn-primary btn-sm text-white" href="#" title="{{$nav.loginmenu.1.3}}" id="{{$nav.loginmenu.1.4}}_collapse" data-bs-toggle="modal" data-bs-target="#nav-login">
				{{$nav.loginmenu.1.1}}
			</a>
			{{else}}
			<a class="btn btn-primary btn-sm text-white" href="login" title="{{$nav.loginmenu.1.3}}">
				{{$nav.loginmenu.1.1}}
			</a>
			{{/if}}
			{{if $nav.register}}
			<a class="btn btn-warning btn-sm text-dark" href="{{$nav.register.0}}" title="{{$nav.register.3}}" id="{{$nav.register.4}}" >
				{{$nav.register.1}}
			</a>
			{{/if}}
		</div>
		<div class="nav d-lg-flex"></div>
		{{else}}
		<div class="lh-1" id="app-bin-label">
			{{if $name}}
			<img src="{{$thumb}}" class="menu-img-2">
			<div class="float-start pe-2">
				<div class="fw-bold">{{$name}}</div>
				<div class="text-muted">{{$sitelocation}}</div>
			</div>
			{{/if}}
		</div>
		<i id="app-bin-trash" class="fa fa-2x fa-fw fa-trash-o d-none"></i>
		{{/if}}

		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>

	</div>
	<div class="offcanvas-body">
		{{if $channel_apps.0}}
		<div class="text-uppercase text-muted">
			{{$channelapps}}
		</div>
		<div class="nav nav-pills flex-column">
			{{foreach $channel_apps as $channel_app}}
			{{$channel_app}}
			{{/foreach}}
		</div>
		{{/if}}
		{{if $navbar_apps.0}}
		<div class="d-lg-none dropdown-header text-uppercase text-muted">
			{{$pinned_apps}}
		</div>
		<div id="nav-app-bin-container" class="d-lg-none nav nav-pills flex-column">
			{{foreach $navbar_apps as $navbar_app}}
				{{$navbar_app|replace:'fa':'generic-icons-nav fa'}}
			{{/foreach}}
		</div>
		{{/if}}
		{{if $is_owner}}
		<div class="text-uppercase text-muted nav-link">
			{{$featured_apps}}
		</div>
		<div id="app-bin-container" data-token="{{$form_security_token}}" class="nav nav-pills flex-column">
			{{foreach $nav_apps as $nav_app}}
				{{$nav_app}}
			{{/foreach}}
		</div>
		<hr>
		<div class="nav nav-pills flex-column">
			<a class="nav-link" href="/apps"><i class="generic-icons-nav fa fa-fw fa-plus"></i>{{$addapps}}</a>
		</div>
		{{else}}
		<div class="text-uppercase text-muted nav-link">
			{{$sysapps}}
		</div>
		<div class="nav nav-pills flex-column">
			{{foreach $nav_apps as $nav_app}}
				{{$nav_app}}
			{{/foreach}}
		</div>
		{{/if}}
	</div>
</div>
{{if $is_owner}}
<script>
	var app_bin = document.getElementById('app-bin-container');
	new Sortable(app_bin, {
		animation: 150,
		delay: 200,
		delayOnTouchOnly: true,
		onStart: function (e) {
			$('#app-bin-trash').removeClass('d-none');
		},
		onEnd: function (e) {
			$('#app-bin-trash').addClass('d-none');

			let app_str = '';
			$('#app-bin-container a:visible').each(function () {
				if(app_str.length) {
					app_str = app_str.concat(',', this.text);
				}
				else {
					app_str = app_str.concat(this.text);
				}
			});
			$.post(
				'pconfig',
				{
					'aj' : 1,
					'cat' : 'system',
					'k' : 'app_order',
					'v' : app_str,
					'form_security_token' : $('#app-bin-container').data('token')
				}
			);

		}
	});

	var nav_app_bin = document.getElementById('nav-right');
	new Sortable(nav_app_bin, {
		animation: 150,
		delay: 200,
		delayOnTouchOnly: true,
		draggable: '.nav-app-sortable',
		onEnd: function (e) {
			let nav_app_str = '';
			$('#nav-right .nav-app-sortable').each(function () {
				if(nav_app_str.length) {
					nav_app_str = nav_app_str.concat(',', $(this).text());
				}
				else {
					nav_app_str = nav_app_str.concat($(this).text());
				}
			});
			$.post(
				'pconfig',
				{
					'aj' : 1,
					'cat' : 'system',
					'k' : 'app_pin_order',
					'v' : nav_app_str,
					'form_security_token' : $('#app-bin-container').data('token')
				}
			);

		}
	});

	var nav_app_bin_container = document.getElementById('nav-app-bin-container');
	new Sortable(nav_app_bin_container, {
		animation: 150,
		delay: 200,
		delayOnTouchOnly: true,
		onEnd: function (e) {
			let nav_app_str = '';
			$('#nav-app-bin-container a').each(function () {
				if(nav_app_str.length) {
					nav_app_str = nav_app_str.concat(',', $(this).text());
				}
				else {
					nav_app_str = nav_app_str.concat($(this).text());
				}
			});
			$.post(
				'pconfig',
				{
					'aj' : 1,
					'cat' : 'system',
					'k' : 'app_pin_order',
					'v' : nav_app_str,
					'form_security_token' : $('#app-bin-container').data('token')
				}
			);

		}
	});

	$('#nav-right').on('dragover', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '0px 0px 3px red inset');
	});
	$('#nav-right').on('dragleave', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '');

	});
	$('#nav-right').on('drop', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '');

		if (papp === null)
			return;

		$.ajax({
			type: 'post',
			url: 'appman',
			data: {
				'aj' : 1,
				'feature' : 'nav_pinned_app',
				'papp' : papp
			}
		})
		.done( function() {
			$('<li><a class="navbar-app nav-link" href="' + app_url + '"><i class="fa fa-fw fa-' + app_icon + '"></i></li>').insertBefore('#app-menu');
		});

	});

	$('#app-menu').on('dragover', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '0px 0px 1px red inset');
	});
	$('#app-menu').on('dragleave', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '');

	});
	$('#app-menu').on('drop', function (e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).css('box-shadow', '');

		if (papp === null)
			return;

		$.ajax({
			type: 'post',
			url: 'appman',
			data: {
				'aj' : 1,
				'feature' : 'nav_featured_app',
				'papp' : papp
			}
		})
		.done( function() {
			$('<a class="dropdown-item" href="' + app_url + '"><i class="generic-icons-nav fa fa-fw fa-' + app_icon + '"></i>' + app_name + '</a>').appendTo('#app-bin-container');
		});

	});


	$('#app-bin-trash').on('dragover', function (e) {
		e.preventDefault();
		e.stopPropagation();

		$('#app-bin-container a[href=\'' + app_url + '\']').fadeOut();
	});
	$('#app-bin-trash').on('dragleave', function (e) {
		e.preventDefault();
		e.stopPropagation();

		$('#app-bin-container a[href=\'' + app_url + '\']').fadeIn();

	});
	$('#app-bin-trash').on('drop', function (e) {
		e.preventDefault();
		e.stopPropagation();

		if (papp === null)
			return;

		$.ajax({
			type: 'post',
			url: 'appman',
			data: {
				'aj' : 1,
				'feature' : 'nav_featured_app',
				'papp' : papp
			}
		});

	});

	var papp, app_icon, app_url;
	$(document).on('dragstart', function (e) {
		papp = e.target.dataset.papp || null;
		app_icon = e.target.dataset.icon || null;
		app_url = e.target.dataset.url || null;
		app_name = e.target.dataset.name || null;
	});
</script>
{{/if}}
