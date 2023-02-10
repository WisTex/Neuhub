    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" href="/rmagic">Remote Authentication</a></li>
                <li class="nav-item"><a class="nav-link active" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

<h2>Local Login</h2>

<form action="{{$dest_url}}" id="{{$form_id}}" method="post" >
	<input type="hidden" name="auth-params" value="login" />
	<div class="login-wrapper d-grid gap-2">
		{{include file="field_input.tpl" field=$lname}}
		{{include file="field_password.tpl" field=$lpassword}}
		{{include file="field_checkbox.tpl" field=$remember_me}}
		<button type="submit" name="submit" class="btn btn-primary">{{$login}}</button>
		{{if $register}}<a href="{{$register.link}}" title="{{$register.title}}" class="register-link float-end">{{$register.desc}}</a>{{/if}}
		{{if $lostlink}}<a href="lostpass" title="{{$lostpass}}" class="lost-pass-link">{{$lostlink}}</a>{{/if}}
		<hr>
		<a href="rmagic" class="btn btn-outline-success">{{$remote_login}}</a>
	</div>
	{{foreach $hiddens as $k=>$v}}
		<input type="hidden" name="{{$k}}" value="{{$v}}" />
	{{/foreach}}
</form>
{{if $login_page}}
<script type="text/javascript"> $(document).ready(function() { $("#id_{{$lname.0}}").focus();} );</script>
{{/if}}

    </div>
    <div class="card-footer">
            <h3 style="text-align: center;">Federated Hub Social Identity</h3>
            <p class="card-text" style="text-align: center;margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://federatedhub.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="text-align: center;">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can <a href="/rmagic">remotely authenticate</a> with your existing social identity.</p>
            
        </div>
    </div>