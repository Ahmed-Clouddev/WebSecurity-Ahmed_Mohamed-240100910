<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Mido Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">All Posts</a>
        </li>
       
       
    
      </ul>
    </div>
  </div>
</nav>
    <h3>Welcome to the blog</h3>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<div class="mt-5">
<div class="text-center"> 
<button type="button" class="btn btn-success">Create Post</button>
</div>
    </div>




<div class="mt-5" class="text-center">
    {{-- @dd($posts) --}}
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">Posted by</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


    @foreach ($posts as $post)
         <tr>
      <th scope="row">{{ $post["id"] }}</th>
      <td>{{ $post["title"] }}</td>
      <td>{{ $post["posted_by"] }}</td>
      <td><button type="button" class="btn btn-info">View</button> 
        <button type="button" class="btn btn-success">Edit</button>
         <button type="button" class="btn btn-danger">Delete</button>

</td>
</tr>
    @endforeach
   
  </tbody>
</table>
</div>
</body>
</html>