<script src="https://www.paypal.com/sdk/js?client-id={{$paypal_clientid}}&currency={{$currency}}"></script>
{{include file="../../../view/tpl/basic_cart.tpl"}}
	<div class="section-content-wrapper">
		{{if !$order.checkedout}}
		<div class="clearfix">
			<div id="paypal-button-container"></div>
			<a href="{{$links.checkoutlink}}">Back to Payment Options</a>
		</div>
		<script>
		  paypal.Buttons({
		    createOrder: function(data, actions) {
			return fetch('{{$buttonhook}}_create', {
				method: 'post'
			}).then(function(res){
				return res.json();
			}).then(function(data) {
				return data.id;
			});
		    },
		    onApprove: function(data, actions) {
			//console.log(data);
			postdata = new FormData();
			postdata.append('paymentID' , data.orderID);
			return fetch('{{$buttonhook}}_execute', {
			method: 'POST',
			body: postdata
		      }).then(function () {window.location = '{{$finishedurl}}';});
		    }
		  }).render('#paypal-button-container');
		</script>
		{{else}}
		<h3>This order has been confirmed and is awaiting payment.</h3>
		<h4><a href="{{$finishedurl}}">{{$finishedtext}}</a></h4>
		{{/if}}
	</div>
</div>

