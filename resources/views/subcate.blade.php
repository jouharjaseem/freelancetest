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
                            <option {{ old('cate_id') == $val->id ? 'selected' : '' }}
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
        <input type="text" id="inputName" class="form-control" name="name" value="{{ old('name') }}">
   
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="col-md-6" >
          <br>
        <a href="/"> <button type="button" class="btn btn-danger">BACK</button></a>
        <input type="submit" value="SAVE" class="btn btn-success">
      </div>

  </div>
        </form>
        <br>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Main</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($result as $key=>$val)
                        <tr>
                            <th scope="row">{{ $key+1}}</th>
                            <td>{{ $val->main}}</td>
                            <td>{{ $val->name}}</td>
                            <td><a href="/subedit/{{$val->id}}">Edit</a></td>
                          
                          </tr>
@empty
<tr>
    <th colspan="4"> <p>No users</p></th>
   
  
  </tr>
   
@endforelse
                     
                   
                    
                    </tbody>
                  </table>
            </div>
        </div>
@endsection