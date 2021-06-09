<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> blog post application</title>
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
                    <h2>Laravel Post Crud Application</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('posts.create') }}">Create New Post</a>
                </div>
        </div>
    </div>

    @if($message = Session::get('success'))
      <div class="alert alert-success">
         <p> {{ $message}}</p>
      </div>
      @endif

      <table class="table table-bordered">
          <tr>
              <th>S.No</th>
              <th>Image</th>
              <th>Title</th>
              <th>Description</th>
              <th width="280px">Action</th>
          </tr>
          @foreach($posts as $post)
          <tr>
              <td>{{ $post->id}}</td>
              <td><img src="{{ Storage::url($post->image) }}"  alt="" /></td>
              <td>{{ $post->title }}</td>
               <td>{{ $post->description }}</td>
               <td>
                   <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

               </td>
          </tr>
              
          @endforeach
      </table>
      {!! $posts->links() !!}
</body>
</html>