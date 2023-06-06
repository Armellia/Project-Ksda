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
            $('#example').DataTable({
              scrollX:        "300px",
        scrollCollapse: true,
            });
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
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="myModal-label" aria-hidden="true" data-backdrop="static">
              <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title text-dark" id="myModalTitle">Tambah Data LK</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="card card-primary">
                              <!-- /.card-header -->
                              <!-- form start -->
                                <div class="card-body">
                                <form method="post" action="{{route('tambahLK')}}">
                                  {{ csrf_field() }}
                                    <div class="form-group">
                                      <label for="nama">Nama LK</label>
                                      <input id="nama" class="form-control" type="text" name="namaLK" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="alamat">Alamat LK</label>
                                      <textarea id="alamat" class="form-control" type="text" name="alamatLK" required cols="10" rows="3"></textarea>
                                      
                                    </div>
                                    <div class="form-group">
                                      <label for="notelp">No.Telp LK</label>
                                      <input id="notelp" class="form-control" type="text" name="noTelpLK" required>
                                    </div>                
                                </div>
                                <!-- /.card-body -->
                            </div>
                      
                      </div>
                      <div class="modal-footer">
                          <div class="card-footer">
                              <button type="reset" class="btn btn-secondary" id="btnReset">Reset</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModal-label" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="myModalTitle">Edit Data LK</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card card-primary">
                                <!-- /.card-header -->
                                <!-- form start -->
                                  <div class="card-body">
                                  <form method="post" action="{{route('editLK')}}">
                                    {{ csrf_field() }}
                                      <div class="form-group">
                                        <label for="editnama">Nama LK</label>
                                        <input id="editid" class="form-control" type="hidden" name="idLK">
                                        <input id="editnama" class="form-control" type="text" name="namaLK" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="editalamat">Alamat LK</label>
                                        <textarea id="editalamat" class="form-control" type="text" name="alamatLK" required cols="10" rows="3"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="editnotelp">No.Telp LK</label>
                                        <input id="editnotelp" class="form-control" type="text" name="noTelpLK" required>
                                      </div>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                        
                        </div>
                        <div class="modal-footer">
                            <div class="card-footer">
                                <button type="reset" class="btn btn-secondary" id="btnReset">Reset</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                              </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
      
            <h1 class="h2">Data LK</h1>
            <button type="button" class="btn btn-primary btn-md mb-4" data-toggle="modal" data-target="#modelId" id="btnTambah">
                Tambah Data
              </button>
              


<table id="example" class="display" style="width:100%">
  <thead>
      <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>No. Telp</th>
          <th>Aksi</th>
      </tr>
  </thead>
  <tbody>
      @php
          $no=1;
      @endphp
      @foreach ($data as $row)
          <tr>
          <td>{{$no}}</td>
              <td>{{$row->namaLK}}</td>
              <td>{{$row->alamatLK}}</td>
              <td>{{$row->noTelpLK}}</td>
              <td><a href="{{route('hapusLK',$row->id)}}" onclick="confirm('Yakin ingin menghapus data?')"><span class="info-box-icon"><i class="fa fa-trash" aria-hidden="true"></i></i></span></a>
                <a href="#" data-target="#editModal" data-toggle="modal" id="editJurnal" onclick="getIdLK('{{$row->id}}')"><span class="info-box-icon mr-2"><i class="fas fa-edit"></i></i></span></a>
              </td>
      @php
          $no=$no+1;
      @endphp        
      @endforeach

  </tbody>
  <tfoot>
      <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>No. Telp</th>
          <th>Aksi</th>
      </tr>
  </tfoot>
</table>

  

        </main>
    </div>
  </div>
    
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  function getIdLK(id){
    $.ajax({
                  url: "getLK",
                  type    :"POST",
                  cash    : false,
                  data: {'id': id, "_token": $('#token').val()},
                  
                  dataType: "html",
              success: function(data){
                 var data=JSON.parse(data);
                 $('#editid').val(data['id']);
                  $('#editnama').val(data['namaLK']);
                  $('#editalamat').val(data['alamatLK']);
                  $('#editnotelp').val(data['noTelpLK']);
                  
              }
              });
  }
  </script>
</body>
</html>
  
  

    
  