<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" action="{{route('admin.users.update',$user)}}" method="post">
            @csrf
            @method('put')
            <div class="align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                        <input name="name" value="{{$user->name}}" type="text" class="form-control">
                        @error('name')
                        <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="d-flex align-items-center">
                    <div>
                        <input name="email" value="{{$user->email}}" type="text" class="form-control">
                        @error('email')
                        <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                        @enderror
                    </div>
                </div>
            </div>
        <button type="submit">change</button>
        </form>
        @can('resetPassword',$user)
            <form action="{{route('admin.users.resetPassword',$user)}}" method="post">
            @method('put')
                <div class="d-flex align-items-center">
                    <div>
                        currentPassword:
                        <input type="password" name="currentPassword" type="text" class="form-control">
                        @error('currentPassword')
                        <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        password:
                        <input type="password" name="password" type="text" class="form-control">
                        @error('password')
                        <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        confirm password:
                        <input type="password" name="password_confirmation" type="text" class="form-control">
                    </div>
                </div>
                <button type="submit">submit</button>
            </form>
        @endcan
    </div>
</div>
<hr>
