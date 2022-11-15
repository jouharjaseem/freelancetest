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
        <div class="col-md-3">
            <div class="form-group">
                <label for="inputName">Main Category Name</label><span
                    style="color: red;">*</span>
                <select name="cate_id" class="form-control select2">
                    @if (!empty($category))
                        <option value="">Select</option>
                        @foreach ($category as $val)
                            <option {{ $result[0]->master_id == $val->id ? 'selected' : '' }}
                                value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    @endif
                
                </select>
                @error('cate_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            </div>  </div>
    <div class="col-sm-3">
        <label for="">Name</label><span class="text-danger">*</span>
        <input type="text" id="inputName" class="form-control" name="name" value="{{ $result[0]->name }}">
   
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6" >
          <br>
        <a href="/subcate"> <button type="button" class="btn btn-danger">BACK</button></a>
        <input type="submit" value="SAVE" class="btn btn-success">
      </div>

  </div>
        </form>
        <br>
        
@endsection