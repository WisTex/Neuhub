  <form id="cart-hzservices-itemadmin-form" method="GET">
    <div>
      <ul>
      {{foreach $skus as $sku}}
        <button id="deactivatecommands-submit" class="btn btn-primary" type="submit" name="SKU" value="{{$sku.item_sku}}">{{$sku.item_sku}}</button> - {{$sku.item_desc}}<BR>
      {{/foreach}}
    </ul>
    </div>
  </form>
