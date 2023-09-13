    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" href="/rmagic">Magic Sign On</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Local Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

<h2>{{$title}}</h2>

<div class="generic-content-wrapper-styled">

<p id="lostpass-desc">
{{$desc}}
</p>

<form action="lostpass" method="post" class="form-inline">
<div id="login-name-wrapper">
    <div class="mb-3">
        <div class = "form-group">
            <label for="login-name" id="label-login-name">{{$name}}</label>
            <input class="form-control mb-3" type="text" maxlength="60" name="login-name" id="login-name" value="" />
		    <input  class="btn btn-primary" type="submit" name="submit" id="lostpass-submit-button" value="{{$submit}}" />
		</div>
	</div>
</div>
<div id="login-extra-end"></div>
<div id="login-submit-end"></div>
</form>
</div>

    </div>
<!--
        <div class="card-footer">
            <h3 style="text-align: left;">Magic Sign-On</h3>
            <p class="card-text" style="text-align: left;margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="text-align: left;">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can <a href="/rmagic">remotely authenticate</a> with your existing social identity.</p>
        </div>
-->
    </div>



