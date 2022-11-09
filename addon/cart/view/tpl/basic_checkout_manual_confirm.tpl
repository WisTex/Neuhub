{{include file="./basic_cart.tpl"}}
	<div class="section-content-wrapper">
		<div class="center">
			<p>Print and send a copy of this invoice along with your check or money order to:</p>
			<p>{{$payopts.mailing_address}}</p>
		</div>
		{{if !$order.checkedout}}
		<form method="post">
			<input type=hidden name="cart_posthook" value="manual_checkout_confirm">
			<input type=hidden name="orderhash" value="{{$order_hash}}">
			<button class="btn btn-primary" type="submit" name="Confirm" id="cart-submit-button" value="Confirm">Confirm Order</button>
			<a href="{{$links.checkoutlink}}" class="btn btn-outline-secondary">Back to Payment Options</a>
		</form>
		{{else}}
		<h3>This order has been confirmed and is awaiting payment.</h3>
		<h4><a href="{{$finishedurl}}">{{$finishedtext}}</a></h4>
		{{/if}}
	</div>
</div>
