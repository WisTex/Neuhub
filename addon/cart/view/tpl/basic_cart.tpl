<div class="generic-content-wrapper">
	<div class="section-title-wrapper">
		<h2>CART CONTENTS</h2>
	</div>
	<div class="section-subtitle-wrapper">
		<h3>{{if $title}}{{$title}}{{else}}Order{{/if}}</h3>
	</div>
	<div class="section-content-wrapper">
		<form id="cart_form" method="post">
			<input type="hidden" name="cart_posthook" value="update_item">
			<table class="w-100">
				<tr>
					<th width=10%>Qty</th>
					<th width=50%>Description</th>
					<th width=20% style="text-align:right;">Price each {{if $currencysymbol}}({{$currencysymbol}}){{/if}}</th>
					<th width=20% style="text-align:right;">Extended</th>
				</tr>
				{{foreach $items as $item}}
				<tr>
					<td>
					{{if $order_checkedout}}
					{{$item.item_qty}}
					{{else}}
					<input class="form-control form-control-sm" type="text" name="qty-{{$item.id}}" value="{{$item.item_qty}}" style="min-width: 4em;">
					{{/if}}
					</td>
					<td>{{$item.item_desc}}</td>
					<td style="text-align:right;">{{$item.item_price}}</td>
					<td style="text-align:right;">{{$item.extended}}</td>
				</tr>
				<tr>
				{{if $item.itemextras}}
					<td></td>
					<td colspan=3>
					{{$item.itemextras}}
					</td>
				</tr>
				{{/if}}
				{{/foreach}}
				<tr>
					<td colspan=4>
						{{$orderextras}}
						{{if !$order_checkedout && $orderextras}}
						<button id="cart_update" class="btn btn-success btn-sm invisible" type="submit" name="Submit" title="Update Cart"><i class="fa fa-check"></i> Save Changes</button>
						{{/if}}
					</td>
				</tr>
				<tr>
					<td colspan=4>
						{{if !$order_checkedout}}
						<button id="cart_update" class="btn btn-success btn-sm invisible" type="submit" name="Submit" title="Update Cart"><i class="fa fa-check"></i> Save Changes</button>
						{{/if}}
					</td>
				</tr>

				<tr>
					<td></td><td></td>
					<th style="text-align:right;">Subtotal</th>
					<td style="text-align:right;">{{$totals.Subtotal}}</td>
				</tr>
				<tr>
					<td></td><td></td>
					<th style="text-align:right;">Tax Total</th>
					<td style="text-align:right;">{{$totals.Tax}}</td>
				</tr>
				<tr>
					<td></td><td></td>
					<th style="text-align:right;">Order Total</th>
					<td style="text-align:right;">{{$totals.OrderTotal}}</td>
				</tr>
				{{if $totals.Payment}}
				<tr>
					<td></td>
					<th>Payment</th>
					<td style="text-align:right;">{{$totals.Payment}}</td>
				</tr>
				{{/if}}
			</table>
		</form>
		<script>
			$('#cart_form').areYouSure({'addRemoveFieldsMarksDirty':true, 'message': aStr['leavethispage'] });
			$('#cart_form').on('dirty.areYouSure', function() {
				$('#cart_update').removeClass('invisible');
			});
		</script>
	</div>
	<!-- basic_checkout_*.tpl -->
