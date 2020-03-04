<!DOCTYPE html>
<html lang="en">
<head>
  <title>Print Preview</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <style type="text/css" media="print">
    @page { size: landscape; }
  </style>
  
</head>
<body>
  
<div class="container-fluid text-center">    
  <div class="row content">

        @yield('content')

  </div>
</div>

</body>
</html>
