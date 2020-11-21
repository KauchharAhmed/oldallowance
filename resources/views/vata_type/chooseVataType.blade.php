<!DOCTYPE html>
<html lang="en">
<head>
  <title>ভাতার প্রকারভেদ নির্বাচন করুন</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>ভাতার প্রকারভেদ নির্বাচন করুন</h2>
  <?php foreach($result as $value){ ?>
  <a href="{{ URL::to('onlineApplication') }}/{{ $value->id }}" class="btn btn-info"><?php echo $value->type_name; ?></a>
  <?php } ?>
</div>

</body>
</html>
