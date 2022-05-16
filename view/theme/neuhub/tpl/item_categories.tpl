{{if $categories}}
<!--div class="categorytags"-->
{{foreach $categories as $cat}}
<span class="item-category badge !rounded-pill bg-light !text-dark text-info"><i class="fa fa-tag"></i>&nbsp;{{if $cat.url}}<a class="!text-dark text-secondary" href="{{$cat.url}}">{{$cat.term}}</a>{{else}}{{$cat.term}}{{/if}}</span>
{{/foreach}}
<!--/div-->
{{/if}}

