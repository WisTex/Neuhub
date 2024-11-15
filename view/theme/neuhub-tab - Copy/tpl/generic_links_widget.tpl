<div class="widget{{if $class}} {{$class}}{{/if}}">

    <div class="card">
        <div class="card-body">
    {{if $title}}<h3 class="card-title">{{$title}}</h3>{{/if}}
            {{if $desc}}<p class="text-secondary">{{$desc}}</p>{{/if}}
            <ul class="nav nav-pills flex-column">
                {{foreach $items as $item}}
                    <li class="nav-item"><a href="{{$item.url}}" class="nav-link{{if $item.selected}} active{{/if}}">{{$item.label}}</a></li>
                {{/foreach}}
            </ul>
        </div>
    </div>

</div>