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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/1.4.5/numeral.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript" class="init">

        $(document).ready(function() {
            $("table.display").DataTable({

      scrollX:        "300px",
        scrollCollapse: true,
    });
    $("#satwa").select2();
        });
        let currentYear = new Date().getFullYear();

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
                  {{$profile->namaPerlindungan}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="{{route('profileperlindungan')}}">Profile</a></li>
                <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                </ul>
              </div>
        </div>
      </nav>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-12 ml-sm-auto col-lg-12 px-md-4 py-4">

                <div class="modal fade" id="printsemua" role="dialog" aria-labelledby="printsemua-label" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="printsemuaTitle">Export Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{route('printsemua')}}" method="get" target="_blank">
                                {{ csrf_field() }}
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="resort">Resort</label>
                                            <select class="form-control" id="resort" name="resort">
                                                <option disabled>--Nama Resort--</option>
                                                <option value="">Semua</option>
                                                @foreach ($dataResort as $row)
                                                    <option value="{{$row->id}}">{{$row->namaResort}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="LK">LK</label>
                                            <select class="form-control" id="LK" name="LK">
                                                <option disabled>--Nama LK--</option>
                                                <option value="">Semua</option>
                                                @foreach ($dataLK as $row)
                                                    <option value="{{$row->id}}">{{$row->namaLK}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="satwa">Satwa</label>
                                            <select class="form-control" id="satwa" name="satwa" style="width: 100%;">
                                                <option disabled>--Nama Resort--</option>
                                                <option value="">Semua</option>
                                                @foreach ($dataSatwa as $row)
                                                    <option value="{{$row->id}}">{{$row->namaSatwa}} ({{$row->namaLatin}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="bulan">Pilih Bulan</label><br>
                                            <select class="form-control" id="bulan" name="bulan">
                                                <option disabled>--Nama Bulan--</option>
                                                <option value="">Semua</option>
                                                <option value="1">Januari</option>
                                                <option value="2">Februari</option>
                                                <option value="3">Maret</option>
                                                <option value="4">April</option>
                                                <option value="5">Mei</option>
                                                <option value="6">Juni</option>
                                                <option value="7">Juli</option>
                                                <option value="8">Agustus</option>
                                                <option value="9">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun">Tahun</label>
                                            <select class="form-control" id="tahun" name="tahun">
                                                <option disabled>--Tahun--</option>
                                                <option value="">Semua</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Export</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

              <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <label for="tahun">Tahun</label>
                                            <select class="form-control" id="tahun2" name="tahun2">
                                                <option value="Pilih Tahun">Pilih Tahun</option>
                                                <option value="Semua">Semua</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>
                        </div>
                    </div>

                    <canvas id="bar-chart" width="800" height="250"></canvas>

                      <h2 class="h2">Semua Data</h2>
                      <button type="button" class="btn btn-danger mb-4" data-toggle="modal" data-target="#printsemua">Export/Cetak</button>
                      <table id="example3" class="table table-bordered table-hover display" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Resort</th>
                                <th>Nama LK</th>
                                <th>Nama Latin Satwa</th>
                                <th>Jumlah</th>
                                <th>Tanggal Serah</th>
                                <th>No. Serah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($dataSemua ?? '' as $row)
                            <?php
                              $newDate = date("d F Y", strtotime($row->tanggal));

                            ?>
                                <tr>
                                <td>{{$no}}</td>
                                    <td>{{$row->namaResort}}</td>
                                    <td>{{$row->namaLK}}</td>
                                    <td>{{$row->namaSatwa}} ({{ $row->namaLatin }})</td>
                                    <td>{{$row->jumlah}}</td>
                                    <td>{{$newDate}}</td>
                                    <td>{{$row->noSerahterima}}</td>

                                </tr>
                            @php
                                $no=$no+1;
                            @endphp
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nama Resort</th>
                                <th>Nama LK</th>
                                <th>Nama Latin Satwa</th>
                                <th>Jumlah</th>
                                <th>Tanggal Serah</th>
                                <th>No. Serah</th>

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
    <script>
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var value;
        var tahun=new Date().getFullYear();

        $('#tahun2').change(function(){
            tahun=$(this).val();
            alert(tahun);
            $.ajax({
                url: "getJumlah",
                type    :"GET",
                cash    : false,
                async: false,
                data: {'tahun': tahun, "_token": $('#token').val()},

                dataType: "html",
            success: function(data){

              value=JSON.parse(data);


            }
            });

            new Chart(document.getElementById("bar-chart"), {
                type: 'bar',
                data: {
                  labels: ["Januari", "Februari", "Maret", "April", "Mei","juni","Juli","Agustus", "September", "Oktober", "November", "Desember"],
                  datasets: [
                    {
                      label: "Data Serah Satwa",
                      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45850","#c45850","#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                      data: value
                    }
                  ]
                },
                options: {
                  legend: { display: false },
                  title: {
                    display: true,
                    text: 'Data serah satwa pada '+tahun
                  }
                }
            });

        })

        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
              labels: ["Januari", "Februari", "Maret", "April", "Mei","juni","Juli","Agustus", "September", "Oktober", "November", "Desember"],
              datasets: [
                {
                  label: "Data Serah Satwa",
                  backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#c45850","#c45850","#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                  data: value
                }
              ]
            },
            options: {
              legend: { display: false },
              title: {
                display: true,
                text: 'Data serah satwa'
              }
            }
        });



        let dateDropdown = document.getElementById('tahun');


       let earliestYear = 2000;
       while (currentYear >= earliestYear) {
         let dateOption = document.createElement('option');
         dateOption.text = currentYear;
         dateOption.value = currentYear;
         dateDropdown.add(dateOption);
         currentYear -= 1;
       }

    </script>
</body>
</html>




