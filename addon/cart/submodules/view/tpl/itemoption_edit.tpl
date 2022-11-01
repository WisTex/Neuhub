<div id="cart-itemoptions-wrapper"><div class="panel panel-default">
    <div class="panel-heading"><div class="panel-title">
      <h2><a data-toggle="collapse" data-bs-parent="#cart-itemoptions-wrapper" href="#itemoptdetails"> {{$sectitle}} </a></h2>
    </div></div>
    <div id="itemoptdetails" class="panel-collapse collapse"><div id="cart-itemoptions-form-wrapper">
      <form id="cart-itemoptions-edit-form" method="post">
      <input type=hidden name="form_security_token" value="{{$security_token}}">
      <input type=hidden name="cart_posthook" value="edit_itemoptions_post">
      <input type=hidden name="item_sku" value="{{$sku}}">
      <input type=hidden name="itemoptorder" value="">
<ul id="ItemOptions">
      {{$curopts}}
</ul>
      <button id="itemopt-submit" class="btn btn-primary" type="submit" name="submit" >{{$formelements.submit}}</button>
      </form>
  <div>
	<H4>Add new option</h4>
	<select id="newitemopttype" name="newitemopttype">
		{{foreach from=$itemtypeopts key=k item=v}}
		<option value="{{$k}}">{{$v}}</option>
		{{/foreach}}
	</select>
      <button id="add-itemopt" class="btn btn-primary" type="submit" name="submit" onClick='itemoptadd();'>Add</button>
  </div>
    </div></div>
</div></div>
<script type="text/javascript">
    $(function() {
        $( "#ItemOptions" ).sortable({
	    delay: 200,
            placeholder: "ui-state-highlight",
            cursor: 'crosshair',
            update: function(event, ui) {
			var Order = $("#ItemOptions").sortable('toArray').toString();
        		$( "#ItemOptions" ).disableSelection();
			$( ".form-control").click(function() { $("#ItemOptions").sortable('disable'); $(this).focus(); });
			$( ".form-control input").focus(function() { $("#ItemOptions").enableSelection(); $(this).setSelectionRange(($this).value.length,$(this).value.length); });
			$( ".form-control").blur(function() { $("#ItemOptions").sortable('enable'); });
			$('#itemoptorder').val(Order);
 			}
    		});
        $( "#sortable" ).disableSelection();
	});
</script>

<div style='display:none'>
{{$templates}}
</div>

<script type="text/javascript">
	newitemcount = 0;
	function itemoptadd() {
		opttype = $('#newitemopttype').val();
		templateid = '#opttemplate-' + opttype;
		templatedata = $(templateid).html();
		itemidx = 'new_' + newitemcount;
		newitemcount = newitemcount + 1
		newopt = eval(templatedata);
		$('#ItemOptions').append(newopt);
		return false;
	}
</script>
