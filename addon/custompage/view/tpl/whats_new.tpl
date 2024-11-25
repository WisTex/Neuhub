<div style="padding: 1rem 0">
    <div class="card" style="padding: 1rem">
        <h2 style="margin: 1rem 0; border-bottom: 1px #ccc solid;">{{$widget_title}}</h2>
        {{foreach $posts as $post}}
            <div class="widget bblock thread-wrapper">
                {{if $post.title}}
                    <h4><a href="{{$post.mid}}">{{$post.title}}</a></h4>
                {{/if}}
                <span class="strong" style="color: #333">{{$post.created}}</span> - {{$post.blurb}} <a href="{{$post.mid}}">READ MORE »</a>
            </div>
        {{/foreach}}
    </div>
</div>