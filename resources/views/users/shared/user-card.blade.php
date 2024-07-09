<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div>
                    <h3 class="card-title mb-0"><a href="#"> {{$user->name}} </a></h3>
                    <span class="fs-6 text-muted">{{"@$user->name"}}</span>
                    <span class="fs-6 text-muted">{{$user->email}}</span>
                </div>
            </div>
            <div>
                @can('update',$user)
                <a href="{{route('admin.users.edit',$user->id)}}"> Edit </a>
                @endcan
            </div>
        </div>
    </div>
</div>
<hr>
