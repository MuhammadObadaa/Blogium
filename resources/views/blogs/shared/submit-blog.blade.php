@auth
<h4> Share yours blogs </h4>
<div class="row">
    <form action= "{{ route('blogs.store') }}"  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input class="form-control" name='title' id="title" rows="3" value='title'></input>
            @error('title')
                <spam class="fs-6 text-danger mt-2">{{ $message }}</spam>
            @enderror
            <hr>
            <textarea class="form-control" name='text' id="text" rows="3"></textarea>
            @error('text')
                <spam class="fs-6 text-danger mt-2">{{ $message }}</spam>
            @enderror
            <div class="mt-4">
                <label for='media'>Blog media</label>
                <input name="media[]" class="form-control" type="file" multiple>
                @error('media.*')
                <span class="d-block fs-6 text-danger mt-2"> {{$message}} </span>
                @enderror
            </div>
        </div>
        <div class="">
            <button type="submit" class="btn bg-primary btn-dark"> Share </button>
        </div>
    </form>
</div>
@endauth
@guest
    <h4>Login to share blogs</h4>
@endguest
