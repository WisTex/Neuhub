<div class="dm42cart orderlist" style="width:100%;">
  <div class='section-title-wrapper'>
    <div class="title">{{if $title}}{{$title}}{{else}}Orders{{/if}}</div>
  </div>
  <div class='section-content-wrapper' style="width:100%;">
    <table style="width:100%;">
    {{foreach $orders as $order}}
        <tr>
            <td rowspan=2>
            <form method="get" action="{{$urlprefix}}/{{$order.order_hash}}"><button class="btn btn-primary" type="submit" name="Confirm" id="cart-submit-button">View Order</button></form>
            </td>
            <th>{{$order.buyer_channelname}} / {{$order.buyer_altid}} <span class="order-flags">
                {{if $order.flags.exception}} <span class="order-flags-exception">**EXCEPTION**</span> {{/if}}
                {{if $order.flags.fulfilled}} Fulfilled {{else}}
                  {{if $order.flags.confirmed}} Confirmed {{/if}}
                {{/if}}</span>
            </th>
            <th style="text-align:right;">
            Order Total: {{$order.totals.OrderTotal}}</td>
            </th>
            <th style="text-align:right;">
            Paid: {{$order.totals.Payment}}</td>
            </th>
        </tr>
        <tr>
            <td colspan=3>
            {{if $order.order_paid}}Paid: {{$order.order_paid}}{{else}}UNPAID{{/if}}
            {{if $order.order_checkedout}}Checkout Date: {{$order.order_checkedout}}{{else}}Checkout Not Complete{{/if}}
            </td>
        </tr>
    {{/foreach}}
    </table>
  </div>
</div>
