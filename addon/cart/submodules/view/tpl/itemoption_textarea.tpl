<div class="row">
	<div class="col-12">
		<span style="font-size:small;"><label for="id_itemopt_{{$itemid}}_{{$uuid}}" id="label_{{$itemid}}_{{$uuid}}" style="display:inline;">{{$label}}</label></span>{{if $required}}<span class="required">*</span>{{/if}}
	</div>
</div>
<div class="row">
	<div class="col-12">
		{{if $confirmed}}
			{{$value}}
		{{else}}
		<input type=hidden name="itemoption_label[{{$itemid}}][{{$uuid}}]" value="{{$label}}" />
		<input type=hidden name="itemoption[{{$itemid}}][]" value="{{$uuid}}">
		<textarea style="font-size:small;" class="form-control" name="itemoption_value[{{$itemid}}][{{$uuid}}]" id="itemopt_value_{{$itemid}}_{{$uuid}}">{{$value}}</textarea>
		{{/if}}
	</div>
</div>
{{if !$confirmed}}
<div class="row">
	<div class="col-12">
		{{if $instructions}}<small id="help_{{$itemid}}_{{$uuid}}" class="form-text text-muted">{{$instructions}}</small>{{/if}}<BR />
	</div>
{{/if}}
</div>
