<div class="card mt-3">
    <div class="card-header pb-0 border-0">
        <h5 class="">Search</h5>
    </div>
    <div class="card-body">
        <form action="{{ route(Route::currentRouteName()) }}" method="GET">
            <input value="{{request('search','')}}" name = "search" placeholder="..." class="form-control w-100" type="text" >
            <button type ="submit" class="btn btn-dark mt-2 bg-primary">Search</button>
        </form>
    </div>
</div>
