<style type="text/css">
<!--
    a.main-notif-item:link {
      color: black !important; 
    }
    a.main-notif-item:visited {
      color: black !important; 
      background: #eeeeee !important;
    }
    a.main-notif-item:hover {
      color: #43488A !important; 
    }
    a.main-notif-item:focus {
      color: green !important; 
    }
    a.main-notif-item:active {
      color: green !important; 
    }
    -->
</style>    

			<tr>
                    <td rowspan="2">
					<img src="{{$photo}}" style="width: 2.7rem;height: 2.7rem;">

				</td>
                    <td class="table-primary" style="padding-top: 2px;padding-bottom: 2px;"><span class="pull-right text-muted small" style="text-align: right;">{{$when}}<br></span><small style="text-align: left;">{{$msg}}</small></td>
                </tr>
                <tr>
				
                    <td>
				<a href="{{$link}}" class="main-notif-item">
				<span class="pull-right text-muted" style="text-align: right;">
	      			{{if $unseen == 1}}
						<span class="badge bg-danger">{{$new}}</span>
					{{/if}}	
					<button type="button" class="btn btn-primary btn-sm">View</button>
					</span>
					<i class="fa fa-comments-o"></i><strong>&nbsp;{{$xname}}</strong>
					{{if $title != '' }}
						<br>{{$title}} 
					{{/if}}
				
					<br>{{$body}}
				</a>	
				</td>
				
                </tr>