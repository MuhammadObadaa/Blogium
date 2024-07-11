<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div>
                    <h5>{{$blog->owners()->first()->name ?? 'guest'}} and {{count($blog->owners) - 1}} others</h5>
                </div>
            </div>
            <div class="d-flex mt-2">
                <a href="{{ route('blogs.show',$blog->id )}}"> View </a>
                @can('update',$blog)
                @if(!($editing ?? false))
                <a class='mx-1' href="{{ route('blogs.edit',$blog->id )}}"> Edit </a>
                @endif
                @endcan
                @can('destroy',$blog)
                <form method="POST" action="{{ route('blogs.destroy',$blog->id) }}">
                    @csrf
                    @method('delete')
                    <button class="ms-2 btn btn-danger btn-sm"> X </button>
                </form>
                @endcan
            </div>
        </div>
    </div>
    <div class="card-body">
        @if($editing ?? false)
        <form action="{{ route('blogs.update',$blog) }}"method="POST">
            @csrf
            @method('put')
            <div class="mb-3">
                <input class="form-control" name='title' id="title" rows="3" value="{{$blog->title}}"</input>
                @error('title')
                    <spam class="fs-6 text-danger mt-2">{{ $message }}</spam>
                @enderror
                <hr>
                <textarea class="form-control" name='text' id="text" rows="3">{{ $blog->text }}</textarea>
                @error('text')
                <spam class="fs-6 text-danger mt-2">{{ $message }}</spam>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark mb-2 btn-sm"> Update </button>
            </div>
        </form>
        @else
        <p class="fs-1 fw-bold text-muted">
            {{ $blog->title }}
        </p>
        <p class="fs-4 text-muted">
            {{ $blog->text }}
        </p>
            @forelse($blog->media as $m)
                @if($m->type === 'video')
                    <video width="320" height="240" controls>
                      <source src="{{$m->getURL()}}" type="video/mp4">
                    </video>
                @else
                    <img src="{{$m->getURL()}}" class="rounded mx-auto d-block" style="height:50%;width:50%">
                @endif
            @empty
            @endforelse
        @endif
        <div class="d-flex justify-content-between">
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $blog->created_at->diffForHumans() }} </span>
            </div>
        </div>
    </div>
</div>
