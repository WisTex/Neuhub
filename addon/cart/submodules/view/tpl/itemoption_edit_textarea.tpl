<li id="ItemOptions_{{$option.uuid}}" class="form-group">
<div id="cart-itemoptions-{{$option.uuid}}-wrapper"><div class="panel panel-default">
    <div class="panel-heading"><div class="panel-title"><div class="row">
        <div class="col-sm-12 col-md-2">
        <input type=hidden name="itemoption_type[{{$option.uuid}}]" value="{{$option.type}}">
        <a data-toggle="collapse" data-bs-parent="#cart-itemoptions-{{$option.uuid}}-wrapper" href="#itemoptdetails_{{$option.uuid}}" style="display:inline;">
        <span style="font-size:medium;"><label for="id_itemopt_default_{{$option.uuid}}" id="label_{{$option.uuid}}" style="display:inline;">Textarea: </label></span></a>
        </div>
        <div class="col-sm-12 col-md-10">
        <span style="font-size:medium;"><input class="form-control" name="itemoption_label[{{$option.uuid}}]" id="id_itemopt_label_{{$option.uuid}}" type="text" value="{{$option.label}}" style="display:inline;"/></span>
        </div>
    </div><div class="row">
	<div class="col-12">
		<div id="itemopt_required_{{$option.uuid}}_container" class="clearfix form-group checkbox">
			<label for="id_itemopt_required_{{$option.uuid}}">{{$textstrings.required}}</label>
			<div class="float-right"><input type="checkbox" name="itemoption_required[{{$option.uuid}}]" id="id_itemopt_required_{{$option.uuid}}" value="1" {{if $option.required}}checked="checked"{{/if}} /><label class="switchlabel" for="id_itemopt_required_{{$option.uuid}}"> <span class="onoffswitch-inner" data-on="{{$textstrings.yes}}" data-off="{{$textstrings.no}}"></span><span class="onoffswitch-switch"></span></label></div>
		</div>
        </div>
        <div class="col-sm-12 col-md-10">
        <span style="font-size:medium;"><input class="form-control" name="itemoption_label[{{$option.uuid}}]" id="id_itemopt_label_{{$option.uuid}}" type="text" value="{{$option.label}}" style="display:inline;"/></span>
        </div>
    </div></div></div>
    <div id="itemoptdetails_{{$option.uuid}}" class="panel-collapse collapse">

		<div class="row">
			<div class="col-12">
				<label for="id_itemopt_default_{{$option.uuid}}" id="label_{{$option.uuid}}">{{$textstrings.default}}:</label>
				<textarea class="form-control" name="itemoption_default[{{$option.uuid}}]" id="id_itemopt_default_{{$option.uuid}}">{{$option.default}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<label for="id_itemopt_instructions_{{$option.uuid}}" id="label_{{$option.uuid}}">{{$textstrings.instructions}}:</label>
				<textarea class="form-control" name="itemoption_instructions[{{$option.uuid}}]" id="id_itemopt_instructions_{{$option.uuid}}">{{$option.instructions}}</textarea>
			</div>
		</div>
	</li>
