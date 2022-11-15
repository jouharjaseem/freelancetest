@extends("welcome")
@section("content")
<br>
@if(Session::has('error'))
<div class="alert alert-danger">
  {{ Session::get('error')}}
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-success">
  {{ Session::get('success')}}
</div>
@endif
<br> <form action="" enctype="multipart/form-data" method="post" enctype="multipart/form-data">
   
<div class="row">
        @csrf  
    <div class="col-sm-6">
        <label for="">Name</label><span class="text-danger">*</span>
        <input type="text" id="inputName" class="form-control" name="name" value="{{ $result[0]->name ?? 0 }}">
   
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6" >
          <br>
        <a href="/main"> <button type="button" class="btn btn-danger">BACK</button></a>
        <input type="submit" value="SAVE" class="btn btn-success">
      </div>

  </div>
        </form>
       
@endsection