<script src="https://www.paypalobjects.com/api/checkout.js"></script>
{{include file="../../../view/tpl/basic_cart.tpl"}}
	<div class="section-content-wrapper">
		{{if !$order.checkedout}}
		<div class="clearfix">
			<div id="paypal-button" class="float-left mr-2"></div>
			<a href="{{$links.checkoutlink}}" class="float-left p-1">Back to Payment Options</a>
		</div>
		<script>
		  paypal.Button.render({
		    env: '{{$paypalenv}}',
		    payment: function(data, actions) {
		      return actions.request.post('{{$buttonhook}}_create')
			.then(function(res) {
			  return res.id;
			});
		    },
		    onAuthorize: function(data, actions) {
		      return actions.request.post('{{$buttonhook}}_execute', {
			paymentID: data.paymentID,
			payerID:   data.payerID
		      }).then(function () {window.location = '{{$finishedurl}}';});
		    }
		  }, '#paypal-button');
		</script>
		{{else}}
		<h3>This order has been confirmed and is awaiting payment.</h3>
		<h4><a href="{{$finishedurl}}">{{$finishedtext}}</a></h4>
		{{/if}}
	</div>
</div>

