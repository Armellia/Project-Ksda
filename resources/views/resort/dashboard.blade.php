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
            {{-- <div class="row">
                <div class="col-6">
                    <canvas id="doughnut-chart" width="1000" height="900"></canvas>    
                </div>
                <div class="col-6">
                    <canvas id="bar-chart" width="1000" height="900"></canvas>
                </div>    
            </div> --}}
            <div class="modal fade" id="printsemua" role="dialog">
              <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="printsemuaTitle">Serah Satwa</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="{{route('storeResort')}}" method="post" id="formTambah">
                          {{ csrf_field() }}
                            <div class="card-body">
                              <div class="form-group">
                                <label for="namaResort">Nama Resort</label>
                                
                                  <div class="input-group-append">
                                    <input type="text" class="form-control" value="{{$profile->namaResort}}" disabled>
                                  </div>
                                
                              
                              <input type="hidden" class="form-control" id="idResort" placeholder="Nama Latin" name="resort_id" value="{{$profile->id}}">
                              </div>
                              <div class="form-group">
                                <label for="jenisSatwa">Jenis Satwa</label>
                                <select class="form-control select2" style="width: 100%;" name="satwa_id" id="satwa">
                                  <option disabled>--Jenis Satwa--</option>
                                  @foreach ($satwa as $item)
                                      <option value="{{$item->id}}">{{$item->namaSatwa}}({{$item->namaLatin}})</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="namaSatwa">Nama LK</label>
                                <select class="form-control select2" style="width: 100%;" name="lk_id" id="LK">
                                    <option  disabled>--Nama LK--</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->namaLK}}</option>
                                    @endforeach
                                  </select>
                                  
                              </div>
                                <div class="form-group">
                                  <label for="ordo">Jumlah</label>
                                  <input type="text" class="form-control" id="ordo" placeholder="jumlah" name="jumlah" required>
                                </div>
                                <div class="form-group">
                                  <label for="keluarga">No. Serah Terima</label>
                                  <input type="text" class="form-control" id="keluarga" placeholder="No. Serah Terima" name="noSerahterima" required>
                                </div>
                                <div class="form-group">
                                  <label for="tanggalSerah">Tanggal Serah</label>
                                    
                                  <input id="tanggalSerah" class="form-control" type="text" name="tanggalSerah" required>
                                    
                                </div>
                                <p class="text-muted">*jika data satwa atau LK tidak ada, tekan tombol tambah baru</p>
                                  
                              </div>
                          </div>
                      
                      
                      <div class="modal-footer">
                        <a href="{{route('tambahbaru')}}"><button type="button" class="btn btn-success">Tambah Baru</button></a>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                      </form>
                      </div>
                  </div>
              </div>
          </div>  
            <div class="modal fade" id="editSerah" role="dialog" aria-labelledby="printsemua-label" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="printsemuaTitle">Edit Data</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="{{route('editResort')}}" method="post" id="formTambah">
                          {{ csrf_field() }}
                            <div class="card-body">
                              <div class="form-group">
                                <label for="namaResort">Nama Resort</label>
                                <input type="hidden" name="id" id="idRS">
                                  <div class="input-group-append">
                                    <input type="text" class="form-control" value="{{$profile->namaResort}}" disabled>
                                  </div>
                                
                              
                              <input type="hidden" class="form-control" id="idResort" placeholder="Nama Latin" name="resort_id" value="{{$profile->id}}">
                              </div>
                              <div class="form-group">
                                <label for="jenisSatwa">Jenis Satwa</label>
                                <select class="form-control select3" style="width: 100%;" name="satwa_id" id="satwaEdit">
                                  <option disabled>--Jenis Satwa--</option>
                                  @foreach ($satwa as $item)
                                      <option value="{{$item->id}}">{{$item->namaSatwa}}({{$item->namaLatin}})</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="namaSatwa">Nama LK</label>
                                <select class="form-control select3" style="width: 100%;" name="lk_id" id="LKEdit">
                                    <option  disabled>--Nama LK--</option>
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->namaLK}}</option>
                                    @endforeach
                                  </select>
                                  
                              </div>
                                <div class="form-group">
                                  <label for="ordo">Jumlah</label>
                                  <input type="text" class="form-control" id="jumlahEdit" placeholder="jumlah" name="jumlah" required>
                                </div>
                                <div class="form-group">
                                  <label for="keluarga">No. Serah Terima</label>
                                  <input type="text" class="form-control" id="noSerahEdit" placeholder="No. Serah Terima" name="noSerahterima" required>
                                </div>
                                <div class="form-group">
                                  <label for="tanggalSerah">Tanggal Serah</label>
                                    
                                  <input id="tanggalSerahEdit" class="form-control" type="text" name="tanggalSerah" required>
                                    
                                </div>
                                
                                  
                              </div>
                          </div>
                      
                      
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Edit</button>
                      </form>
                      </div>
                  </div>
              </div>
          </div>  
              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                      <h2 class="h2">Semua Data</h2>
                      <button type="button" class="btn btn-primary btn-md mb-4" data-toggle="modal" data-target="#printsemua" id="btnTambah">
                        Serah Satwa
                      </button>
                      <table id="example3" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama LK</th>
                                <th>Nama Satwa</th>
                                <th>Jumlah</th>
                                <th>Tanggal Serah</th>
                                <th>No. Serah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($dataSemua as $row)
                            <?php
                              $newDate = date("d-m-Y", strtotime($row->tanggal));
                            ?>
                                <tr>
                                <td>{{$no}}</td>
                                    <td>{{$row->namaLK}}</td>
                                    <td>{{$row->namaSatwa}} ({{$row->namaLatin}})</td>
                                    <td>{{$row->jumlah}}</td>
                                    <td>{{$newDate}}</td>
                                    <td>{{$row->noSerahterima}}</td>
                                    <td>
                                      <button type="button" class="btn btn-outline-primary" onclick="getDataserah({{$row->idRS}})" data-toggle="modal" data-target="#editSerah">Ubah</button>
                                    </td>
                            @php
                                $no=$no+1;
                            @endphp        
                            @endforeach
        
                        </tbody>
                        <tfoot>
                            <tr>
                              <th>#</th>
                              <th>Nama LK</th>
                              <th>Nama Satwa</th>
                              <th>Jumlah</th>
                              <th>Tanggal Serah</th>
                              <th>No. Serah</th>
                              <th>Aksi</th>
                              
                            </tr>
                        </tfoot>
                    </table>
                    
                  </div>
                </div>
                <!-- /.card -->
              </div>
            
            

        </main>
    </div>
  </div>
  @error('jumlah')
      <script>
        alert('Jumlah tidak boleh minus');
      </script>
  @enderror
  <script>
    $(function() {
      $('input[name="tanggalSerah"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        drops : 'up',
        minYear: 2010,
        maxYear : 2050,
        locale : {
          format: 'DD-MM-YYYY'
        }
        
      });
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function getDataserah(id){
      $.ajax({
                    url: "getDataserah",
                    type    :"POST",
                    cash    : false,
                    data: {'id': id, "_token": $('#token').val()},
                    
                    dataType: "html",
                success: function(data){
                   var data1=JSON.parse(data);
                   
                   $('#idRS').val(data1[0].idRS);
                    $('#jumlahEdit').val(data1[0].jumlah);
                    $('#noSerahEdit').val(data1[0].noSerahterima);
                }
                });
    }
    </script>
</body>
</html>
  
  

    
  