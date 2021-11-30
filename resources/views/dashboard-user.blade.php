<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>




<div class="container">
  <h2>Okanemo Atm</h2>

<h1>Selamat Datang {{ !empty($user) ? $user->name : '' }}</h1>
<h2>Total Saldo {{ !empty($rekening+$rekening_transfer) ? $rekening+$rekening_transfer : '0' }}</h2>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('deposite') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-out-alt"></i> Setor Tunai
        </a>
        <a href="{{ route('withdraw') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-out-alt"></i> Tarik Tunai
        </a>
        <a href="{{ route('transfer') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-sign-out-alt"></i> Kirim Tunai
        </a>
    </div>
</div>

<br>
<br>
<a href="{{ route('logout') }}" class="btn btn-primary btn-sm">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>

</div>



@if(Session::has('success'))

<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: "{!!Session::get('success')!!}"
    })
</script>

@endif

</body>
</html>