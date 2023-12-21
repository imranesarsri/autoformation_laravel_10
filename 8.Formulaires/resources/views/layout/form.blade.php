    <form action="{{ $blog->id ? route('update', ['blog' => $blog->id]) : route('store') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="form-control mb-4 mt-2"
                id="title" placeholder="Enter Title">
            @error('title')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" class="form-control mb-4 mt-2"
                id="slug" placeholder="Enter slug">
            @error('slug')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control mb-4 mt-2" name="content" id="content" cols="30" rows="10"
                placeholder="Enter content">{{ old('content', $blog->content) }}</textarea>
            @error('content')
                <p class="text-danger">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary form-control mb-4 mt-2">
            @if ($blog->id)
                Update
            @else
                Create
            @endif
        </button>
    </form>
