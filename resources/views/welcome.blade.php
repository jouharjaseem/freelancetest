<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Hello Sir </h1>
  <p>Thank you sir for choosing me</p> 
</div>
  
<div class="container">
  <div class="row">
    <div class="col-sm-3">
        <a href="/main">   <button style="border: 1px solid black;width:100%;height:100px" class="btn btn-light"> Category Manage</button></a>
     </div>
     <div class="col-sm-3">
        <a href="/subcate">   <button style="border: 1px solid black;width:100%;height:100px" class="btn btn-light">Sub Category Manage</button></a>
     </div>
     <div class="col-sm-3">
        <a href="/subsubcate">   <button style="border: 1px solid black;width:100%;height:100px" class="btn btn-light">Sub Sub Category Manage</button></a>
     </div>
     <div class="col-sm-3">
        <a href="/product">   <button style="border: 1px solid black;width:100%;height:100px" class="btn btn-light"> Product Manage</button></a>
     </div>
  </div>
  @yield("content")
</div>

</body>
</html>
