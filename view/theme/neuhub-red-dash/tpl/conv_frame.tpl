<div id="threads-begin"></div>
<div id="threads-end"></div>
<div id="conversation-end"></div>
<div id="page-spinner" class="spinner-wrapper">
	<div  class="spinner m"></div>
	<div id="image_counter" class="text-muted text-center small"></div>
</div>
<div class="modal" id="conversation_settings" tabindex="-1" role="dialog" aria-labelledby="conversation_settings_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="conversation_settings_label">{{$conversation_tools}}</h3>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body" id="conversation_settings_body">
				{{$wait}}
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{include file="contact_edit_modal.tpl"}}
