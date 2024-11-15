<style>
{{if $size == 'hz_large'}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
}
.hz_cover_photo {
	max-width: 100%;
}
.hz_profile_photo {
	position: relative;
	top: -300px;
	left: 30px;
	background-color: white;
	border: 1px solid #ddd;
	border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 10px;
	width: 320px;
	height: 320px;
}

.hz_name {
	position: relative;
	top: -100px;
	left: 400px;
	color: #fff;
	font-size: 48px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -110px;
	left: 400px;
	color: #fff;
	font-size: 24px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	
{{elseif $size == 'hz_medium'}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
	width: 100%;
	overflow: hidden; 
	height: 390px; 
}
.hz_cover_photo img {
	width: {{$maxwidth}}px;
/*	max-width: 100%; */
}
.hz_profile_photo {
	position: relative;
	top: -165px;
	left: 30px;

	width: 150px;
	height: 150px;
}
.hz_profile_photo img {
	background-color: white;
	border: 1px solid #ddd;
	border-radius: 5px;
	-moz-border-radius: 5px;
	padding: 5px;
	width: 150px;
	height: 150px;
}

.hz_name {
	position: relative;
	top: -100px;
	left: 210px;
	color: #fff;
	font-size: 32px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -100px;
	left: 210px;
	color: #fff;
	font-size: 18px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	


{{else}}
.hz_card {
/*	-moz-transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); 
	transform: translate(-{{$translate}}%, -{{$translate}}%) scale({{$scale}}, {{$scale}}); */
	font-family: sans-serif, arial, freesans;
}
.hz_cover_photo {
	max-width: 100%;
}
.hz_profile_photo {
	position: relative;
	top: -75px;
	left: 20px;
	background-color: white;
	border: 1px solid #ddd;
/*	border-radius: 5px;
	-moz-border-radius: 5px; */
	padding: 3px;
	width: 80px;
	height: 80px;
}

.hz_name {
	position: relative;
	top: -40px;
	left: 120px;
	color: #fff;
	font-size: 18px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}
.hz_addr {
	position: relative;
	top: -40px;
	left: 120px;
	color: #fff;
	font-size: 10px;
    text-rendering: optimizelegibility;
    text-shadow: 0 0 3px rgba(0, 0, 0, 0.8);
}	
{{/if}}

</style>


<div class="d-none d-sm-none d-md-none d-lg-none d-xl-inline">



<div class="hz_card {{$size}}">
	<div class="hz_cover_photo"><img src="{{$cover.href}}" alt="{{$zcard.chan.xchan_name}}" />
		<div class="hz_name">{{$zcard.chan.xchan_name}}</div>
		<div class="hz_addr">{{$zcard.chan.channel_addr}}</div>
        <!--
        <div style="margin-top:-150px;" class="pull-right">
            <a href="/channel/{{$zcard.chan.channel_address}}" class="btn btn-sm btn-ghost-primary pull-right ms-2">Posts</a>
            <a href="/profile/{{$zcard.chan.channel_address}}" class="btn btn-sm btn-ghost-primary pull-right ms-2">Profile</a>
        </div>
        -->
	</div>
	<div class="hz_profile_photo"><img src="{{$pphoto.href}}" alt="{{$zcard.chan.xchan_name}}" /></div>
</div>
<div style="margin-top:-70px; z-index: 9999;" class="pull-right z-3">
    <a href="/channel/{{$zcard.chan.channel_address}}" class="btn btn-sm btn-ghost-primary pull-right ms-2 z-3">Posts</a>
    <a href="/profile/{{$zcard.chan.channel_address}}" class="btn btn-sm btn-ghost-primary pull-right ms-2 z-3">Profile</a>
</div>

</div>
<div class="d-sm-inline d-md-inline d-lg-inline d-xl-none">

<!--

<div class="rounded mb-3 vcard-card h-card">
	<div class="card mb-2">
		<div class="position-relative">
			<div id="cover-photo-wrapper" class="overflow-hidden w-100 rounded-top">
				<img class="img-fluid rounded-top" src="{{$cover.href}}" alt="" style="">
			</div>
			{{if $connect}}
			<a href="{{$connect_url}}" class="btn btn-success btn-sm m-2 position-absolute top-0 end-0" rel="nofollow">
				<i class="fa fa-plus"></i> {{$connect}}
			</a>
			{{/if}}
			<div id="profile-cover-text" class="p-2 position-absolute bottom-0 w-100">
				<div class="text-truncate h3 mb-0 lh-sm">
					<strong class="text-white fn p-name">{{$profile.fullname}}{{if $profile.online}}<i class="fa fa-fw fa-circle text-success ps-2" title="{{$profile.online}}"></i>{{/if}}</strong>
				</div>
				<div class="text-truncate">
					<span class="text-white p-adr">{{$profile.reddress}}</span>
				</div>
			</div>
			{{if $editmenu.multi}}
			<div class="dropdown position-absolute bottom-0 end-0 m-2">
				<a class="profile-edit-side-link text-white" data-bs-toggle="dropdown" href="#" ><i class="fa fa-pencil" title="{{$editmenu.edit.1}}"></i></a>
				<div class="dropdown-menu dropdown-menu-end" role="menu">
					{{foreach $editmenu.menu.entries as $e}}
					<a href="profiles/{{$e.id}}" class="dropdown-item"><img class="menu-img-1" src='{{$e.photo}}'> {{$e.profile_name}}</a>
					{{/foreach}}
					{{if $editmenu.menu.cr_new}}
					<a href="profiles/new" id="profile-listing-new-link" class="dropdown-item">{{$editmenu.menu.cr_new}}</a>
					{{/if}}
				</div>
			</div>
			{{elseif $editmenu}}
			<div class="position-absolute bottom-0 end-0 m-2">
				<a class="profile-edit-side-link text-white" href="{{$editmenu.edit.0}}" ><i class="fa fa-pencil" title="{{$editmenu.edit.1}}"></i></a>
			</div>
			{{/if}}
		</div>
		<div class="d-flex">
			<div id="profile-photo-wrapper" class="bg-body-secondary rounded rounded-end-0 rounded-top-0 overflow-hidden" style="min-width: 5rem; min-height: 5rem;">
				<img class="u-photo" src="{{$profile.thumb}}?rev={{$profile.picdate}}" alt="{{$profile.fullname}}" style="width: 5rem; height: 5rem;">
			</div>
			{{if $profile.pdesc}}
			<div class="m-2 small text-break">{{$profile.pdesc}}</div>
			{{else}}
			<div class="m-2 small">
				<span class="opacity-50">{{$no_pdesc}}</span>
			</div>
			{{/if}}
		</div>
	</div>
</div>

-->

</div>


