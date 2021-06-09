<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a blog post</title>
     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Post</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('posts.index')}}">Back</a>
                </div>
        </div>
    </div>

    @if(session('status'))
      <div class="alert alert-success mb01 mt-1">
          {{ session('status')}}
      </div>
      @endif

      <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Post Title:</strong>
                    <input type="text" name="title"  value="{{ $post->title }}" class="form-control" placeholder="Post Title">
                    @error('title')
                    <div class="alert alert-danger mt-1 mb-1">
                        {{ $message}}
                    </div>
                    @enderror
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Post Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Post Description">{{ $post->description }}</textarea>
                        @error('description')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Post Image:</strong>
                     <input type="file" name="image" class="form-control" placeholder="Post image">
                    @error('image')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                   @enderror
                </div>
                <div class="form-group">
                    <img src="{{ Storage::url($post->image) }}" height="200" width="200" alt=""/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
      </form>
</body>
</html>