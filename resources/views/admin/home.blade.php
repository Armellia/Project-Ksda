<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <!-- insert stylesheets here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('#example').DataTable();
        } );

            </script>
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                Simple Dashboard
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  {{$admin->namaAdmin}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="{{route('profileadmin')}}">Profile</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                </ul>
              </div>
        </div>
      </nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
<div class="position-sticky pt-md-5">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">
          <i class='fas fa-home'></i>
            <span class="ml-2">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('resort')}}">
            <i class='fas fa-user'></i>

            <span class="ml-2">Resort</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('lk')}}">
            <i class='fas fa-building'></i>

            <span class="ml-2">Lembaga Konservasi</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('satwa')}}">
            <i class='fas fa-paw'></i>

            <span class="ml-2">Satwa</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('satwaSerahan')}}">
            <i class='fas fa-clipboard-list'></i>

            <span class="ml-2">Satwa Serahan</span>
          </a>
        </li>

      </ul>
    </div>
        </nav>
        <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
<div class="row my-4">
  <h1 class="h2">Dashboard</h1>
  <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-4">
      <div class="card">
          <h5 class="card-header">Data Resort</h5>
          <div class="card-body">
            <h5 class="card-title">Total</h5>
          <p class="card-text">{{$data[0]}}</p>
          <a href="{{route('resort')}}"><button type="button" class="btn btn-primary btn-sm">Check Data</button></a>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3 mb-lg-4">
      <div class="card">
          <h5 class="card-header">Data LK</h5>
          <div class="card-body">
            <h5 class="card-title">Total</h5>
          <p class="card-text">{{$data[1]}}</p>
          <a href="{{route('lk')}}"><button type="button" class="btn btn-primary btn-sm">Check Data</button></a>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3 mb-lg-4">
      <div class="card">
          <h5 class="card-header">Data Satwa</h5>
          <div class="card-body">
            <h5 class="card-title">Total</h5>
          <p class="card-text">{{$data[2]}}</p>
          <a href="{{route('satwa')}}"><button type="button" class="btn btn-primary btn-sm">Check Data</button></a>
          </div>
        </div>
  </div>
  <div class="col-12 col-md-6 col-lg-3 mb-lg-4">
    <div class="card">
        <h5 class="card-header">Data Satwa Serahan</h5>
        <div class="card-body">
          <h5 class="card-title">Total</h5>
        <p class="card-text">{{$data[3]}}</p>
        <a href="{{route('satwaSerahan')}}"><button type="button" class="btn btn-primary btn-sm">Check Data</button></a>
        </div>
      </div>
</div>
</div>
        </main>

</body>
</html>



