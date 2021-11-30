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
  <br>
  <a href="{{ route('dashboard') }}" class="btn btn-info">Dashboard</a>
  <br>
  <h2>Kirim Uang - Saldo Anda {{ !empty($rekening) ? $rekening : '0' }}</h2>
  <div class="row">
      <div class="col-md-6">
  <form action="{{ route('transfer_action') }}" method="POST">
      @csrf
    <div class="form-group">
      <label for="name">Jumlah Uang:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="transfer">
    </div>
    <!-- <div class="form-group">
      <label for="name">Transfer Ke (Nama Harus Betul):</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="transfer_to">
    </div> -->
    <div class="form-group">
    <label for="name">Tranfer Ke:</label>
    <select class="form-control" name="transfer_to">
      @foreach($user_lain as $us)
      <option value="{{ $us->id }}">{{ $us->name }}</option>
      @endforeach
    </select>
  </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
</div>
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