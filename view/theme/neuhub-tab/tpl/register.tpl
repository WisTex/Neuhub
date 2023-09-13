    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item"><a class="nav-link" href="/rmagic">Magic Sign-On</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Local Login</a></li>
                <li class="nav-item"><a class="nav-link active" href="/register">Register</a></li>
            </ul>
        </div>
        <div class="card-body">

			<div class="!generic-content-wrapper">
				<div class="!section-title-wrapper">
					<h2>{{$title}}</h2>
				</div>
				<div class="section-content-wrapper">
					<form action="register" method="post" id="register-form">
						<input type='hidden' name='form_security_token' value='{{$form_security_token}}'>
						{{if $now}}
						<div class="section-content-danger-wrapper">
							<div class="h3">{{$now}}</div>
						</div>
						{{/if}}
						{{if $reg_is || $other_sites || $msg}}
						<div class="section-content-warning-wrapper">
							<div id="register-desc" class="descriptive-paragraph">{{$msg}}</div>
							<div id="register-desc" class="descriptive-paragraph">{{$reg_is}}</div>
							<div id="register-sites" class="descriptive-paragraph">{{$other_sites}}</div>
						</div>
						{{/if}}
						{{if $registertext}}
						<div class="section-content-info-wrapper">
							<div id="register-text" class="descriptive-paragraph">{{$registertext}}</div>
						</div>
						{{/if}}

						{{if $invitations}}
						<a id="zar014" href="javascript:;" style="display: inline-block;">{{$haveivc}}</a>
						<div id="zar015" style="display: none;">
							<div class="position-relative">
								<div id="invite-spinner" class="spinner-wrapper position-absolute" style="top: 2.5rem; right: 0.5rem;"><div class="spinner s"></div></div>
								{{include file="field_input.tpl" field=[$invite_code.0,$invite_code.1,"","",""]}}
							</div>
						</div>
						{{/if}}

						{{if $auto_create}}
						<div class="position-relative">
							<div id="name-spinner" class="spinner-wrapper position-absolute" style="top: 2.5rem; right: 0.75rem;"><div class="spinner s"></div></div>
							{{include file="field_input.tpl" field=$name}}
						</div>
						<div class="position-relative">
							<div id="nick-hub" class="position-absolute" style="top: 2.3rem; right: 0.75rem;"><span class="text-muted">{{$nickhub}}</span></div>
							<div id="nick-spinner" class="spinner-wrapper position-absolute" style="top: 2.5rem; right: 0.75rem;"><div class="spinner s"></div></div>
							{{include file="field_input.tpl" field=$nickname}}
						</div>
						{{/if}}
						{{include file="field_input.tpl" field=$email}}
						{{include file="field_password.tpl" field=$pass1}}
						{{include file="field_password.tpl" field=$pass2}}
						{{if $reg_is}}
						{{include file="field_textarea.tpl" field=$register_msg}}
						{{/if}}
						{{if $enable_tos}}
						{{include file="field_checkbox.tpl" field=$tos}}
						{{else}}
						<input type="hidden" name="tos" value="1" />
						{{/if}}
						<button class="btn btn-primary" type="submit" name="submit" id="newchannel-submit-button" value="{{$submit}}" {{$atform}}>{{$submit}}</button>
						<div id="register-submit-end" class="register-field-end"></div>
					</form>
				</div>
			</div>


    	</div>
	<!--
    	<div class="card-footer">
            <h3 style="text-align: center;">Magic Sign-On</h3>
            <p class="card-text" style="text-align: left;margin-top: 16px;">This website is part of a decentralized social network, with remote authentication powered by <a href="https://magicsignon.org" target="_blank">OpenWebAuth&nbsp;<i class="fa fa-external-link"></i></a>.</p>
            <p style="text-align: left;">Accounts created on this website are compatible with OpenWebAuth, which allows you to remotely authenticate on other websites.</p>
            <p style="text-align: left;">If you already have an account on a website that supports OpenWebAuth, you do not need to create a local account here. You can <a href="/rmagic">remotely authenticate</a> with your existing social identity.</p>
        </div>
		-->
    </div>




