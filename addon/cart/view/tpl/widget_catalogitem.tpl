<div class="widget">
	<div class="catalog-item-details dm42cart">
		{{if $item.item_photo_url}}
		<img src="{{$item.item_photo_url}}" class="w-100 rounded pb-2">
		{{/if}}
		<div class="catalog-item-desc pb-2">
			{{$item.item_desc}}
		</div>
		<div class="catalog-item-price pb-2">
			<span class="font-weight-bold">{{$item.item_price_label}}:</span> {{$item.item_price}}
		</div>
		{{if $item.info}}
		<div class="catalog-item-info pb-2">
			<i class="fa fa-info-circle"></i> {{$item.info}}
		</div>
		{{/if}}
	</div>
	<div class="catalog-item-cart-button dm42cart">
		{{if $item.order_qty}}
		{{if $item.maxcount != 1}}
		<form method="post" action="{{$posturl}}?returnurl={{$returnurl}}">
			<input type="hidden" name="cart_posthook" value="update_item">
			<div class="input-group">
				<input class="form-control form-control-sm" type="text" name="qty-{{$item.id}}" value="{{$item.order_qty}}" style="width: 4em;float:left;">
				<button class="btn btn-sm btn-primary" type="submit" name="Submit" value="{{$item.item_sku}}">Update Quantity</button>
				<button class="btn btn-sm btn-outline-danger btn-outline" type="submit" name="delsku" value="{{$item.item_sku}}" title="Remove from cart"><i class="fa fa-remove"></i></button>
			</div>
		</form>
		{{else}}
		<form method="post" action="{{$posturl}}?returnurl={{$returnurl}}">
			<input type="hidden" name="cart_posthook" value="update_item">
			<input type="hidden" name="delsku" value="{{$item.item_sku}}">
			<b>Item Already in your cart!</b>
			<button class="btn btn-sm btn-outline-danger btn-outline" type="submit" name="remove" title="Remove from cart"><i class="fa fa-remove"></i></button>
			</form>
		{{/if}}
		{{else}}
		<form method="post" action="{{$posturl}}{{if $returnurl}}?returnurl={{$returnurl}}{{/if}}">
			<input type="hidden" name="cart_posthook" value="add_item">
			<div class="input-group">
				<input class="form-control form-control-sm" type="text" name="qty" value="1">
				<button class="btn btn-sm btn-primary" type="submit" name="add" value="{{$item.item_sku}}">Add to Cart</button>
			</div>
		</form>
		{{/if}}
	</div>
	<div class="clearfix"></div>
</div>
