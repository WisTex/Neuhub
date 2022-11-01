<h1>CART CONTENTS</h1>

<div class="dm42cart catalog" style="width:100%;">
  <div class='section-title-wrapper'>
    <div class="title">{{if $title}}{{$title}}{{else}}Order{{/if}}</div>
  </div>
  <div class='section-content-wrapper' style="width:100%;">
    <table style="width:100%;">
        <tr>
            <th width=60%>Description</th>
            <th width=20% style="text-align:right;">Price each {{if $currencysymbol}}({{$currencysymbol}}){{/if}}</th>
            <th width=20% style="text-align:right;">Extended</th>
        </tr>
    {{foreach $items as $item}}
        <tr {{if $item.item_exeption}} class="cart-item-exception"{{/if}}>
            <td {{if $item.item_exeption}} class="cart-item-exception"{{/if}}>{{$item.item_desc}}
            </td>
            <td style="text-align:right;" {{if $item.item_exeption}} class="cart-item-exception"{{/if}}>{{$item.item_price}}</td>
            <td style="text-align:right;" {{if $item.item_exeption}} class="cart-item-exception"{{/if}}>{{$item.extended}}</td>
        </tr>
        <tr><td colspan=3>
            {{include "./myshop_order_item_xtrahtml.tpl"}}
            </td>
        </tr>
    {{/foreach}}
    <tr>
        <td></td>
        <th style="text-align:right;">Subtotal</th>
        <td style="text-align:right;">{{$totals.Subtotal}}</td>
    </tr>
    <tr>
        <td></td>
        <th style="text-align:right;">Tax Total</th>
        <td style="text-align:right;">{{$totals.Tax}}</td>
    </tr>
    <tr>
        <td></td>
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
    {{if $orderextras}}
    <div>
    <div style="font-weight:bold;color:#fff;background-color:#0d0d0d;width:100%;">Additional Order Data</div>

    <div style="color:#000;background-color:#e0e0e0;width:100%;padding:10px;">
	{{$orderextras}}
    </div>
    </div>
    {{/if}}
    <div>
      {{if !$order_paid}}
      <form method="post">
        <input type=hidden name="form_security_token" value="{{$security_token}}">
        <input type=hidden name="cart_posthook" value="myshop_order_markpaid">
        <input type=hidden name="orderhash" value="{{$order_hash}}">
        <input type=hidden name="action" value="markpaid">
        <button class="btn btn-primary" type="submit" name="Confirm" id="cart-payment-button" class="cart-payment-button" value="Confirm">Mark Paid</button>
      </form>
      {{/if}}
      <hr>
      <h3>Order Notes</h3>
      <ul>
      {{foreach $order_meta.notes as $note}}
        <li>{{$note}}</li>
      {{/foreach}}
      </ul>
      <hr>
      <h3>Add Order Note</h3>
      <div class="cart-myshop-ordernotes-form">
      <form method="post">
      <input type=hidden name="form_security_token" value="{{$security_token}}">
      <input type="hidden" name="cart_posthook" value="myshop_add_ordernote">
      <textarea name="notetext" rows=3 cols=80></textarea>
      <button class="btn btn-primary" type="submit" name="add" id="cart-myshop-add-item-note" value="add">Add Note</button>
      </form>
      </div>

    </div>

    <div>
    {{$added_display.content}}
    </div>
  </div>
</div>
