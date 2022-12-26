<style>
.kims-article {
    font-size: 1rem;
}

article code {
    display: inline;
    background: #eee;
}

article pre code {
    border: none;
    padding: 0px;
}
</style>

<article class="kims-article">
<div class="" style="background: #ffffff;padding-right: 25px;padding-left: 25px;padding-top: 25px;padding-bottom: 25px;border-radius: 1px;border: 1px solid var(--bs-gray-300);border-top-style: solid;border-bottom-width: 1px;border-bottom-style: solid;margin-bottom: 24px;">

    <div>
        <h1 class="text-dark mb-1" style="font-family: 'Roboto Slab', Verdana, Georgia, serif;">{{$ArticleTitle}}</h1>
        <h2 style="font-family: 'Roboto Slab', Verdana, Georgia, serif;">{{$ArticleSubTitle}}</h2>
    </div>
    <p>By <a href="/profile/scott">Scott M. Stolz</a>{{if $ArticleEtAl eq 1}}, <em>et al.</em>{{/if}}</p>

    
    
    
    <div style="margin-top: 24px;">
        <!--
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1" style="font-family: Nunito, sans-serif;">Article &amp; Video</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2" style="font-family: Ubuntu, sans-serif;">Concepts</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#" style="font-family: Ubuntu, sans-serif;">Resources</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#" style="font-family: Ubuntu, sans-serif;">Other Platforms</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3" style="font-family: Ubuntu, sans-serif;">Discussions</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#" style="font-family: Ubuntu, sans-serif;">References</a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#" style="font-family: Ubuntu, sans-serif;">Notes</a></li>
        </ul>
        -->
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                <div style="margin-top: 16px;margin-bottom: 16px;">
                    <p class="lead" style="font-family: Nunito, sans-serif;color: #000000;">{{$ArticleLead}}</p>

                    {{$ArticlePreText}}

                    {{$ArticleVideo}}

                    {{$ArticleBody}}

                    {{$ArticlePostText}}

                </div>
                
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <p>Content for tab 2.</p>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-3">
                <p>Content for tab 3.</p>
            </div>
        </div>
    </div>

</div>
</article>

<!-- 
<div class="" style="background: #ffffff;padding-right: 25px;padding-left: 25px;padding-top: 25px;padding-bottom: 25px;border-radius: 1px;border: 1px solid var(--bs-gray-300);border-top-style: solid;border-bottom-width: 1px;border-bottom-style: solid;margin-bottom: 24px;">

    <h4 class="text-primary" style="font-family: 'Roboto Slab', Verdana, serif;">Related Articles &amp; Videos</h4>
    <ul>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
        <li>Item 4</li>
    </ul>

</div>
-->

<div class="row" style="padding-right: 0px;padding-left: 0px;padding-top: 0px;padding-bottom: 0px;border-radius: 0px;border: 0px solid var(--bs-gray-300);border-top-style: solid;border-bottom-width: 0px;border-bottom-style: solid;margin-bottom: 24px;">
<div class="col" style="border-width: 0px;">

    <div class="card border-white">
        <div class="card-body">
            <h4 class="card-title">{{$ArticleTitle}}</h4>
            <h6 class="text-muted card-subtitle mb-2">{{$ArticleSubTitle}}</h6>
            <a class="card-link" href="/article/{{$ArticleSlug}}">Permalink</a>
            <!-- 
            <a class="card-link" href="#">Add to Bookmarks</a><a class="card-link" href="#">My Notes</a><a class="card-link" href="#">Changelog</a>
            -->
        </div>
    </div>
</div>
<div class="col">
    <div class="card border-white">
        <div class="card-body">
            <ul style="margin-bottom: 0px;">
                <li>Authors:&nbsp;<a href="https://scottstolz.com">Scott M. Stolz</a><br></li>
                <!--
                <li>Contributors:&nbsp;<a href="https:/tejanausland.com">Tejan Ausland</a><br></li>
                <li>Video Credit: <a href="https://demotiger.com">DemoTiger</a><br></li>
                -->
            </ul>
        </div>
    </div>
</div>
</div>
<p class="text-center"><small>This Article:&nbsp;&nbsp;
<i class="far fa-arrow-alt-circle-up" style="color: var(--bs-danger);"></i> Last Major Update: {{$ArticleMajorUpdateDate}}&nbsp;&nbsp;
<i class="far fa-dot-circle" style="color: var(--bs-orange);"></i> Last Minor Update: {{$ArticleMinorUpdateDate}}&nbsp;&nbsp;
<i class="far fa-check-circle" style="color: var(--bs-green);"></i> Last Verified: {{$ArticleVerifiedDate}}<br></small></p>