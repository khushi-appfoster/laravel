<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 CRUD </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
   <div class = "bg-dark py-3">
    <h3 class="text-white text-center">Laravel 11 CRUD OPERATION</h3>
</div>
 <div class = "container">
 <div class = "row justofy-content-cemter mt-4">
    <div class = "col-md-10 d-flex  justify-content-end">
      <a href="{{route('products.index')}}" class = "btn btn-dark">Back</a>
</div>
</div>
  <div class = "row d-flex justify-content-center">
    <div class = "col-md-10">
   <div class = "card border-0 shadow-lg my-4">
    <div class = "crad-header bg-dark">
      <h3 class = "text-white"> Edit Project</h3>
    </div>
    <form  enctype = "multipart/form-data" action = "{{ route('products.update',$product->id) }}"method ="post">
      @method('put')
      @csrf
    <div class = "card-body">
      <div class = "mb-3">
        <label for = "" class = "form-label h5">Name</label>
        <input value = "{{ old('uname',$product->uname) }}" type = "text" class ="@error('uname') is-invalid @enderror 
        form-control form-control-lg"  placeholder = "Name" name = "uname">
        @error('uname')
        <p class = "invalid-feedback">{{ $message }}</p>
        @enderror
</div>
<div class = "mb-3">
        <label for = "" class = "form-label h5">ProjectName</label>
        <input value = "{{ old('pname',$product->pname) }}" type = "text" class = "@error('pname') is-invalid @enderror form-control form-control-lg"  placeholder = "ProjectName" name = "pname">
        @error('pname')
        <p class = "invalid-feedback">{{ $message }}</p>
        @enderror
</div>
<div class = "mb-3">
        <label for = "" class = "form-label h5">ProjectID</label>
        <input value = "{{ old('projectid',$product->pid) }}"type = "text" class = "@error('projectid') is-invalid @enderror form-control form-control-lg"  placeholder = "ProjectID" name = "pid">
        @error('projectid')
        <p class = "invalid-feedback">{{ $message }}</p>
        @enderror
</div>
<div class = "mb-3">
        <label for = "" class = "form-label h5">Description</label>
        <textarea placeholder = "Description"  class = "form-control" name = "description" cols="30" rows ="5">{{old('description',$product->description)}}</textarea>
</div>
<div class = "mb-3">
        <label for = "" class = "form-label h5">Image</label>
        <input type = "file" class = "form-control form-control-lg"  placeholder = "Image" name = "image">
        @if($product->image!="")
    <img class="w-50 my-3" src = "{{asset('uploads/products/' .$product->image)}}" alt="">
    @endif
</div>

<div class = "d-grid">
<button class = "btn btn-lg btn-primary">Update</button> 
</div>
    </div>
</form>

   </div>
</div>
</div>
</div>
  </body>
</html>