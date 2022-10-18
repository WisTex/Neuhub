<!-- old nav bar -->


                            
                            <div class="navbar navbar-light navbar-expand-md bg-white" style="z-index:100;">
                                <div class="container-fluid">
                                    <a class="navbar-brand"  style="font-size: 24px;" href="{{$url}}"><img src="{{$channel_thumb}}" class="!menu-img-2" style="max-height:42px;">
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

                                    
                                    </a>
                                    
                                    <button data-bs-toggle="collapse" class="navbar-toggler text-end" data-bs-target="#navcol-2" s!tyle="font-size: 14px;"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon" style="font-size: 12px;"></span></button>
                                    <div class="collapse navbar-collapse d-xl-flex justify-content-xl-end" id="navcol-2">
                                        <ul class="navbar-nav">
                                            <!--
                                            <li class="nav-item"><a class="nav-link active" href="/channel/mockup">Channel</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/profile/mockup">Profile</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/cal/mockup">Calendar</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/cloud/mockup">Files</a></li>
                                            <li class="nav-item"><a class="nav-link" href="/photos/mockup">Photos</a></li>
                                            -->


            
            <!--
            <li class="nav-item">
                <a class="nav-link{{if $sel.name == "Channel"}} active{{/if}}" href="{{$url}}" title="Status Messages and Posts"><i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Posts</a>
            </li>
            -->
            <!--
            <li class="nav-item">
                <a class="nav-link{{if $sel.name == "Profile"}} active{{/if}}" href="{{$url}}" title="Profile Details"><i class="fa fa-fw fa-vcard-o generic-icons-nav"></i>About</a>
            </li>
            -->


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



<!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Channel Apps
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
            -->
            <!--
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
          -->

    <!--
{{if $channel_apps.0}}
		<div class="dropdown-header text-uppercase text-muted">
			{{$channelapps}}
		</div>
		{{foreach $channel_apps as $channel_app}}
		{{$channel_app}}
		{{/foreach}}
		{{/if}}
		{{if $navbar_apps.0}}
		<div class="d-lg-none dropdown-header text-uppercase text-muted">
			{{$pinned_apps}}
		</div>
		<div id="nav-app-bin-container" class="d-lg-none">
			{{foreach $navbar_apps as $navbar_app}}
				{{$navbar_app|replace:'navbar-app nav-link':'dropdown-item nav-app-sortable'|replace:'fa':'generic-icons-nav fa'}}
			{{/foreach}}
		</div>
		{{/if}}
		{{if $is_owner}}
		<div class="dropdown-header text-uppercase text-muted">
			{{$featured_apps}}
		</div>
		<div id="app-bin-container" data-token="{{$form_security_token}}">
			{{foreach $nav_apps as $nav_app}}
				{{$nav_app}}
			{{/foreach}}
		</div>
		<div class="dropdown-divider"></div>
		<a class="dropdown-item" href="/apps"><i class="generic-icons-nav fa fa-fw fa-plus"></i>{{$addapps}}</a>
		{{else}}
		<div class="dropdown-header text-uppercase text-muted">
			{{$sysapps}}
		</div>
		{{foreach $nav_apps as $nav_app}}
			{{$nav_app}}
		{{/foreach}}
		{{/if}}    

        </div>
      </li>    
    -->

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
                <a class="nav-link{{if $sel.name == "Channel"}} active{{/if}}" href="/channel" title="Status Messages and Posts"><i class="fa fa-fw fa-dot-circle-o generic-icons-nav"></i>Channel</a>
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
            <a class="nav-link" href="/notifications/system" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
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
<a class="nav-link" href="/notifications/system" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
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
<a class="nav-link active" href="/notifications/system" title="Settings"><i class="fa fa-fw fa-bell generic-icons-nav"></i>Notifications</a>
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


<!--
        <li class="nav-item">
            <a class="nav-link" href="/network">Network Stream</a>
        </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Channel Apps
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">

          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>

        </div>
    </li>
-->

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
        {{if $localuser}}
        <li class="nav-item">
            <a class="nav-link" href="/apps" title="Apps"><i class="fa fa-fw fa-cube generic-icons-nav"></i>Apps</a>	
            
        </li>
        {{/if}}


        <!-- </div> -->
    <!-- </li> -->
    
		{{/if}}

			{{if $settings_url}}
			<li class="nav-item">
			    <!-- <div id="nav-app-settings-link-wrapper" class="navbar-nav"> -->
				<a id="nav-app-settings-link" href="{{$settings_url}}/?f=&rpath={{$url}}" !class="dropdown-item" class="nav-link">
					<i class="fa fa-fw fa-cog generic-icons-nav"></i>
				</a>
			</li>
			<!-- </div> -->
			{{/if}}

                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>