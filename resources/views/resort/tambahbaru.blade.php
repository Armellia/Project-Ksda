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
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $('#example3').DataTable({
              scrollX:        "300px",
        scrollCollapse: true,
            });
            $('.select2').select2({
              dropdownParent: $('#printsemua')

            });
            $('.select3').select2({
              dropdownParent: $('#editSerah')

            });
        });

            </script>
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                Simple Dashboard
            </a>
        </div>

        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  {{$profile->namaResort}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="{{route('profileresort')}}">Profile</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                </ul>
              </div>
        </div>
      </nav>

<div class="container-fluid">

    <div class="row">

        <main class="col-md-12 ml-sm-auto col-lg-12 px-md-4 py-4">
            <button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Back</button>
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-6">
                            <div class="card" style="height: 100%;">
                                <div class="card-header">
                                    Data LK
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tambah Data LK</h5>
                                    <form action="{{ route('tambahbarustore') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="nama">Nama LK</label>
                                            <input id="nama" class="form-control" type="text" name="namaLK"  placeholder="Nama Lembaga Konservasi">
                                          </div>
                                          <div class="form-group">
                                            <label for="alamat">Alamat LK</label>
                                            <textarea id="alamat" class="form-control" type="text" name="alamatLK"  cols="10" rows="3" placeholder="Nama Lembaga Konservasi">

                                            </textarea>

                                          </div>
                                          <div class="form-group">
                                            <label for="notelp">No.Telp LK</label>
                                            <input id="notelp" class="form-control" type="text" name="noTelpLK"  placeholder="Nama Lembaga Konservasi">
                                          </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card" style="height:100%;">
                                <div class="card-header">
                                    Data Satwa
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Tambah Data Satwa</h5>
                                    <div class="form-group">
                                        <label for="namaLatin">Nama Latin</label>
                                        <input type="text" class="form-control" id="namaLatin" placeholder="Nama Latin" name="namaLatin" >
                                      </div>
                                      <div class="form-group">
                                        <label for="namaSatwa">Nama Satwa</label>
                                        <input type="text" class="form-control" id="namaSatwa" placeholder="Nama Satwa" name="namaSatwa" >
                                      </div>
                                      <div class="form-group">
                                        <label for="jenisSatwa">Jenis Satwa</label>
                                          <select class="form-control" id="jenisSatwa" name="jenisSatwa">
                                            <option>--Jenis Satwa--</option>
                                            <option value="Mamalia">Mamalia</option>
                                            <option value="Aves">Aves</option>
                                            <option value="Amfibia">Amfibia</option>
                                            <option value="Reptilia">Reptilia</option>
                                            <option value="Fish">Fish</option>
                                            <option value="Artropoda">Artropoda</option>
                                            <option value="Moluska">Moluska</option>
                                          </select>
                                      </div>

                                </div>

                            </div>

                        </div>
                        <div class="container">
                            <button type="submit" class="btn btn-primary my-2">Tambah</button>
                        </form>
                        </div>

                    </div>
                  </div>

                </div>
                <p class="text-muted">*kosongkan jika tidak ingin ditambah</p>
                <!-- /.card -->
              </div>



        </main>
    </div>
  </div>
</body>
</html>




