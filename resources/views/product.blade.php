@extends("welcome")
@section("content")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                <select name="cate_id" class="form-control select2" id="main">
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
            <div class="col-md-3">
                <div class="form-group">
                    <label for="inputName">Sub Category Name</label><span
                        style="color: red;">*</span>
                    <select name="sub" class="form-control select2" id="sub">
                        <option value="">Select First Main</option>
                      
                    
                    </select>
                    @error('sub')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
    
                </div>  </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="inputName">Sub Sub Category Name</label><span
                            style="color: red;">*</span>
                        <select name="subsub" class="form-control select2" id="subsub">
                            <option value="">Select First Main</option>
                          
                        
                        </select>
                        @error('subsub')
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
                        <th scope="col">Sub</th>
                        <th scope="col">Sub Sub</th>
                        <th scope="col">Name</th>
                        <th scope="col">Url</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($result as $key=>$val)
                        <tr>
                            <th scope="row">{{ $key+1}}</th>
                            <td>{{ $val->main}}</td>
                            <td>{{ $val->sub}}</td>
                            <td>{{ $val->subsub}}</td>
                            <td>{{ $val->name}}</td>
                            <td>{{$url}}/{{$db->clean($val->main)}}/{{$db->clean($val->sub)}}/{{$db->clean($val->subsub)}}/{{$db->clean($val->name)}}</td>
                          
                          </tr>
@empty
<tr>
    <th colspan="5"> <p>No users</p></th>
   
  
  </tr>
   
@endforelse
                     
                   
                    
                    </tbody>
                  </table>
            </div>
        </div>
        <script>
           $(document).ready(function(){

            getcate();
           
           $("#main").change(function() {
               getcate();
           });
           $("#sub").change(function() {
               getsubcate();
           });
           function getsubcate() {
               let cont = $("#sub").val();
               let main = $("#main").val();
               if (cont != '' && main != '') {
                   $.ajax({
                       type: 'POST',
                       url: '/getsubcate',
                       data: {
                           id: cont,main:main
                       },
                       dataType: 'json',
                       success: function(data) {
                           $("#subsub").html("<option value=''>select</option>");
                           for (var i = 0; i < data.length; i++) {
                               $("#subsub").append("<option value='" + data[i]['id'] + "'>" + data[i][
                                   'name'
                               ] + "</option>");
                           }
                           $("#subsub").val('{{ old('subsub')  }}');
                          
                       }
                   })
               }
           }
         
           function getcate() {
               let cont = $("#main").val();
               if (cont) {
                   $.ajax({
                       type: 'POST',
                       url: '/getcate',
                       data: {
                           id: cont
                       },
                       dataType: 'json',
                       success: function(data) {
                           $("#sub").html("<option value=''>select</option>");
                           for (var i = 0; i < data.length; i++) {
                               $("#sub").append("<option value='" + data[i]['id'] + "'>" + data[i][
                                   'name'
                               ] + "</option>");
                           }
                           $("#sub").val('{{ old('sub')  }}');
                           getsubcate();
                       }
                   })
               }
           }
         

});
           
          
        </script>
@endsection