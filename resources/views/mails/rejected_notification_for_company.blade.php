<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account Rejected</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container my4">
        
        <h3>Hello {{$name}}</h3>
        <br><p>We are sorry to announce that your profile was rejected by Admin</p>
        <br><p>Also your account will be deleted and you cannot login now. You can try to register again by creating new profile from <a href="{{route('registerCompany')}}">here</a></p>
        <br><p>For any queries, please contact our site administrator</p>
        <br><br><br>

        <h5>Regards,<br>CRS Admin</h5>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>