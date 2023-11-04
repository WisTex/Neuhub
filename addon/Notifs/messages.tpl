<!-- Add category button -->
<div>
    <ul class="nav nav-tabs" role="tablist">

        <!-- All category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 0}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=0&page=1">
                All Notifications <span class="badge bg-danger">{{$total_count}}</span>
            </a>
        </li>

        <!-- New category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 100}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=100&page=1">
                New <span class="badge bg-danger">{{$new_count}}</span>
            </a>
        </li>

        <!-- Posts category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 1}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=1&page=1">
                Posts <span class="badge bg-primary">{{$post_count}}</span>
            </a>
        </li>

        <!-- Forums category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 2}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=2&page=1">
                Forums <span class="badge bg-primary">{{$forum_count}}</span>
            </a>
        </li>

        <!-- Messages category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 3}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=3&page=1">
                Messages <span class="badge bg-success">{{$message_count}}</span>
            </a>
        </li>

        <!-- Connections category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 4}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=4&page=1">
                Connections <span class="badge bg-info">{{$connection_count}}</span>
            </a>
        </li>

        <!-- Likes category -->
        <li class="nav-item" role="presentation">
            <a class="nav-link {{if $type == 5}} active {{/if}}" role="tab" href="{{$base_url}}/messages?type=5&page=1">
                Likes <span class="badge bg-secondary">{{$like_count}}</span>
            </a>
        </li>
    </ul>
</div> <br>

<!-- table rows and pagination -->
<div class="table-responsive" style="background: #f8f9fc;">
    {{$tablerows}}

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <!-- Previous Button -->
            <li class="page-item {{if $page == 1}} disabled {{/if}}">
                <a class="page-link" href="{{$base_url}}/messages?type={{$type}}&page={{$page - 1}}">Previous</a>
            </li>

            <!-- Number Buttons -->
            {{for $i=1 to $max_page}}
                <li class="page-item {{if $i == $page}} active {{/if}}"><a class="page-link" href="{{$base_url}}/messages?type={{$type}}&page={{$i}}">{{$i}}</a></li>
            {{/for}}

            <!-- Next Button -->
            <li class="page-item {{if $page == $max_page}} disabled {{/if}}">
                <a class="page-link" href="{{$base_url}}/messages?type={{$type}}&page={{$page + 1}}">Next</a>
            </li>
        </ul>
    </nav>
</div>
    
