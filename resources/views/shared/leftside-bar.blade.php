<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{(Route::is('dashboard')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{route('dashboard')}}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="{{(Request::is('terms')) ? 'text-white bg-primary rounded' : ''}} nav-link" href="{{url('terms')}}"> {{-- if you dont have a route name --}}
                    <span>Terms</span></a>
            </li>
        </ul>
    </div>
</div>
