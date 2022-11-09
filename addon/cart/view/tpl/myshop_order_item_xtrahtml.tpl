<div style="margin-left:5em;">
{{if $item.meta.data.html}}
<div>
<div style="font-weight:bold;color:#fff;background-color:#0d0d0d;width:100%;">Item details and customizations</div>

<div style="color:#000;background-color:#e0e0e0;width:100%;padding:10px;">
	{{$item.meta.data.html}}
</div>
</div>
{{/if}}{{if !$item.item_fulfilled}}
<div style="background-color:#ff0;"><span style="font-weight:bold;">Item Not Fulfilled</span></div>
{{else}}
<div><span style="font-weight:bold;">Item Fulfilled</span></div>
{{/if}}
<div style="width:100%;">
<div class="cart-myshop-itemfulfill-form" style="float:left;">
<form method="post">
<input type=hidden name="form_security_token" value="{{$security_token}}">
<input type="hidden" name="cart_posthook" value="myshop_item_fulfill">
<input type="hidden" name="itemid" value="{{$item.id}}">
<button class="btn btn-primary" type="submit" name="cart-myshop-fullfill-item" id="item-{{$item.id}}-fulfill-button" value="{{$item.item_sku}}">Fulfill</button>
</form>
</div>
<div class="cart-myshop-itemcancel-form" style="float:left;">
<form method="post">
<input type=hidden name="form_security_token" value="{{$security_token}}">
<input type="hidden" name="cart_posthook" value="myshop_item_cancel">
<input type="hidden" name="itemid" value="{{$item.id}}">
<button class="btn btn-primary" type="submit" name="cart-myshop-cancel-item" id="item-{{$item.id}}-cancel-button" value="{{$item.item_sku}}">Cancel</button>
</form>
</div>
<div style="clear:both;"></div>
</div>
{{if $item.item_fulfilled}}<div style="background-color:#fe0;color:#00;">Warning: May result in duplicate product being sent.</div>{{/if}}
{{if $item.item_exception}}<div class="background-color:#f33;color:#fff;">Item Exception: Please review notes.</div>
<div class="cart-myshop-itemexception-form">
<form method="post">
<input type=hidden name="form_security_token" value="{{$security_token}}">
<input type="hidden" name="cart_posthook" value="myshop_clear_item_exception">
<input type="hidden" name="itemid" value="{{$item.id}}">
<input type="hidden" name="exception" value="false">
<button class="btn btn-primary" type="submit" name="cart-myshop-clear-item-exception" value="{{$item.id}}">Clear Exception</button>
</form>
</div>
{{/if}}
<div class="cart-myshop-itemnotes">
{{foreach $item.item_meta.notes as $note}}
<li>{{$note}}</li>
{{/foreach}}
</div>
<div class="cart-myshop-itemnotes-form">
<form method="post">
<input type=hidden name="form_security_token" value="{{$security_token}}">
<input type="hidden" name="cart_posthook" value="myshop_add_itemnote">
<input type="hidden" name="itemid" value="{{$item.id}}">
<textarea name="notetext" rows=3 cols=80></textarea>
<br><input type="checkbox" name="exception">EXCEPTION<br>
<button class="btn btn-primary" type="submit" name="add" id="cart-myshop-add-item-note" value="add">Add Note</button>
</form>
</div>
{{if $item.meta.notes}}
<ul>
{{foreach $item.meta.notes as $note}}
<li>{{$note}}
{{/foreach}}
</ul>
{{/if}}
</div>
