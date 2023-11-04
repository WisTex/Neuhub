<!-- message with card Style -->
<div class="card mb-2 p-0 position-relative">
    <div class="row g-0">

        <!-- Photo -->
        <div class="col-3 col-sm-2 col-md-2 col-lg-1 align-self-center p-1 px-2">
            <img class="img-fluid rounded-circle" src="{{$photo}}"/>
        </div>

        <!-- Name and messaged time -->
        <div class="col-9 col-sm-10 col-md-10 col-lg-11">
            <div class="card-body">
                <h5 class="card-title text-primary text-uppercase">{{$xname}}</h5>
                <div class="card-text">{{$msg}}</div>
                <p class="card-text mt-2"><small class="text-muted">{{$when}}</small></p>
            </div>
        </div>
    </div>

    <!-- Check if the notification is new or not -->
    <div class="position-absolute" style="top: 10px; right: 10px;">
        {{if $seen == 0}}
            <span class="badge bg-danger">{{$new}}</span>
        {{/if}}
    </div>

    <!-- View Button -->
    <div class="position-absolute" style="bottom: 10px; right: 10px;">
        <button type="button" class="btn btn-sm btn-outline-primary">View</button>
    </div>

</div>
