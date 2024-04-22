<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome To CRS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container my4">
        
        <h3>Hello {{$name}}</h3>
        <br><p>We have a good news for you. Your account has been verified recently by our Admin. Now you are good to go</p>
        <br><p>You can conduct placement drives at our campus by creating drive from your dashboard. Kindly login to the dashboard from <a href="{{route('login')}}">here</a></p>
        <br><p>For any queries, please contact our site administrator</p>
        <br><br><br>

        <h5>Thanks and Regards,<br>CRS Admin</h5>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>