	{{include "./basic_cart.tpl"}}
	<div class="section-subtitle-wrapper">
		<h3>Payment Options</h3>
	</div>
	<div class="section-content-wrapper">
		{{if $readytopay}}
		<form method="post">
			<input type="hidden" name="cart_posthook" value="checkout_choosepayment">
			<div class="mb-3">
				<select name="paymenttypeslug" class="form-control">
					{{foreach from=$paymentopts key=payslug item=payopt}}
					<option value="{{$payslug}}">{{$payopt.html}}</option>
					{{/foreach}}
				</select>
			</div>
			<div class="mb-3">
				<button class="btn btn-primary" type="submit" name="add" id="pay" value="pay">Proceed with Payment</button>
				<a href="{{$links.cataloglink}}" class="btn btn-outline-secondary">Continue Shopping</a>
			</div>
		</form>
		{{else}}
		<div class="mb-3">
			{{$text.readytopayrequirementsnotmet}}<br>
			<a href="{{$links.checkoutlink}}" class="btn btn-outline-secondary">Continue to payment</a>
		</div>
		{{/if}}
	</div>
</div>
