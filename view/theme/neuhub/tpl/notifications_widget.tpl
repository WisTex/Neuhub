

<div id="notifications_wrapper" class="mb-4">
	<div id="no_notifications" class="d-xl-none">
		{{$no_notifications}}<span class="jumping-dots"><span class="dot-1">.</span><span class="dot-2">.</span><span class="dot-3">.</span></span>
	</div>
	<div id="nav-notifications-template" rel="template">
		<a class="list-group-item text-decoration-none text-dark clearfix notification {6}" href="{0}" title="{13}" data-b64mid="{7}" data-notify_id="{8}" data-thread_top="{9}" data-contact_name="{2}" data-contact_addr="{3}" data-when="{5}">
			<img class="menu-img-3" data-src="{1}" loading="lazy">
			<div class="contactname"><span class="text-dark fw-bold">{2}</span> <span class="text-muted">{3}</span></div>
			<span class="text-muted">{4}</span><br>
			<span class="text-muted notifications-autotime" title="{5}">{5}</span>
		</a>
	</div>
	<div id="nav-notifications-forums-template" rel="template">
		<a class="list-group-item text-decoration-none clearfix notification notification-forum" href="{0}" title="{4} - {3}" data-b64mid="{7}" data-notify_id="{8}" data-thread_top="{9}" data-contact_name="{2}" data-contact_addr="{3}" data-b64mids='{12}'>
			<span class="float-end badge bg-secondary">{10}</span>
			<img class="menu-img-1" data-src="{1}" loading="lazy">
			<span class="">{2}</span>
			<i class="fa fa-{11} text-muted"></i>
		</a>
	</div>
	<div id="notifications" class="border border-top-0 rounded navbar-nav collapse">
		{{foreach $notifications as $notification}}
		<div class="border border-start-0 border-end-0 border-bottom-0 list-group list-group-flush collapse {{$notification.type}}-button">
			<a id="notification-link-{{$notification.type}}" class="collapsed list-group-item fakelink notification-link" href="#" title="{{$notification.title}}" data-bs-target="#nav-{{$notification.type}}-sub" data-bs-toggle="collapse" data-sse_type="{{$notification.type}}">
				<i class="fa fa-fw fa-{{$notification.icon}}"></i> {{$notification.label}}
				<span class="float-end badge bg-{{$notification.severity}} {{$notification.type}}-update"></span>
			</a>
		</div>
		<div id="nav-{{$notification.type}}-sub" class="border border-start-0 border-end-0 border-bottom-0 list-group list-group-flush collapse notification-content" data-bs-parent="#notifications" data-sse_type="{{$notification.type}}">
			{{if $notification.viewall}}
			<a class="list-group-item text-decoration-none text-dark" id="nav-{{$notification.type}}-see-all" href="{{$notification.viewall.url}}">
				<i class="fa fa-fw fa-external-link"></i> {{$notification.viewall.label}}
			</a>
			{{/if}}
			{{if $notification.markall}}
			<div class="list-group-item cursor-pointer" id="nav-{{$notification.type}}-mark-all" onclick="markRead('{{$notification.type}}'); return false;">
				<i class="fa fa-fw fa-check"></i> {{$notification.markall.label}}
			</div>
			{{/if}}
			{{if $notification.filter}}
			{{if $notification.filter.posts_label}}
			<div class="list-group-item cursor-pointer" id="tt-{{$notification.type}}-only">
				<i class="fa fa-fw fa-filter"></i> {{$notification.filter.posts_label}}
			</div>
			{{/if}}
			{{if $notification.filter.name_label}}
			<div class="list-group-item clearfix notifications-textinput" id="cn-{{$notification.type}}-only">
				<div class="text-muted notifications-textinput-filter"><i class="fa fa-fw fa-filter"></i></div>
				<input id="cn-{{$notification.type}}-input" type="text" class="notification-filter form-control form-control-sm" placeholder="{{$notification.filter.name_label}}">
				<div id="cn-{{$notification.type}}-input-clear" class="text-muted notifications-textinput-clear d-none"><i class="fa fa-times"></i></div>
			</div>
			{{/if}}
			{{/if}}
			<div id="nav-{{$notification.type}}-menu" class="list-group list-group-flush"></div>
			<div id="nav-{{$notification.type}}-loading" class="list-group-item" style="display: none;">
				{{$loading}}<span class="jumping-dots"><span class="dot-1">.</span><span class="dot-2">.</span><span class="dot-3">.</span></span>
			</div>
		</div>
		{{/foreach}}
	</div>
</div>
