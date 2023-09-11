    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link active" href="/rmagic">Magic Sign-On</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Local Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

<h2>{{$title}}</h2>

<p>Use your existing Magic Sign-On or Hubzilla social identity to interact with this website.</p>

<div class="generic-content-wrapper-styled">
	
	<form action="rmagic" method="post" >
		<div class="mb-3">
			{{include file="field_input.tpl" field=$address}}
			<input class="btn btn-primary" type="submit" name="submit" id="rmagic-submit-button" value="{{$submit}}" />
		</div>
	</form>
</div>

<p>If you created an account on this website, please enter your username and password on the <a href="/login">local login</a> page instead.

    </div>
    <div class="card-footer">
            <h3 style="text-align: left;">Magic Sign-On</h3>
            <p class="card-text" style="text-align: left;margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="text-align: left;">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can remotely authenticate with your existing social identity.</p>
    </div>
    <div class="card-footer">

            <h3 style="text-align: left;">How to Remotely Authenticate</h3>
            <p style="text-align: left;">To remotely authenticate with your existing social identity, you must be logged into your home hub or instance, and then enter your channel address on this website (channel@example.com). This website will check and see if you are logged into your home hub or instance, and if you are, it will remotely authenticate you.</p>
        </div>
    </div>
