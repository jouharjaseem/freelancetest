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
                            <option {{ $result[0]->master_id == $val->id ? 'selected' : '' }}
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
        <script>
            $(document).ready(function(){
 
             getcate();
            
            $("#main").change(function() {
                getcate();
            });
           
          
            function getcate() {
                let cont = $("#main").val();
                let res = "<?= $result[0]->sub_master_id ?>";
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
                                $("#sub").append("<option  value='" + data[i]['id'] + "'>" + data[i][
                                    'name'
                                ] + "</option>");
                            }
                            $("#sub").val(res);
                           
                        }
                    })
                }
            }
          
 
 });
            
           
         </script>    
@endsection