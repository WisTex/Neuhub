<div class="generic-content-wrapper">
	<div class="section-title-wrapper">
		<h2>{{$title}}</h2>
	</div>
	<div class="section-content-wrapper">
		{{if $action_url}}
		<form action="{{$action_url}}" method="post" autocomplete="off">
		{{/if}}
			{{if $form_security_token}}
			<input type='hidden' name='form_security_token' value='{{$form_security_token}}'>
			{{/if}}
			{{$content}}
			{{if $submit}}
			<div class="settings-submit-wrapper" >
				<button type="submit" name="submit" class="btn btn-primary">{{$submit}}</button>
			</div>
			{{/if}}
		{{if $action_url}}
		</form>
		{{/if}}
	</div>
</div>
