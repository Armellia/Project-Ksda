<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row my-4">
                <div class="col-12">
                    <h2 class="h2 text-center">LAPORAN PENYERAHAN SATWA</h2>    
                </div>
                
            </div>
            <div class="row my-2">
                <div class="col-3">
                    Bulan
                </div>
                <div class="col-3">
                    @php
                        $bulan1=$bulan!=null?$bulan:'Semua';
                    @endphp
                    : {{$bulan1}}
                </div>
                <div class="col-3">
                    Satwa
                </div>
                <div class="col-3">
                    @php
                        if(isset($satwa)){
                            $satwa1=DB::table('satwas')->find($satwa);
                            $namaR=$satwa1->namaSatwa;
                        }
                        else{
                            $namaR="Semua";
                        }

                    @endphp
                    : {{$namaR}}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-3">
                    Tahun
                </div>
                <div class="col-3">
                    @php
                        $tahun1=$tahun!=null?$tahun:'Semua';
                    @endphp
                    : {{$tahun1}}
                </div>
                <div class="col-3">
                    Resort
                </div>
                <div class="col-3">
                    @php
                        if(isset($resort)){
                            $resort1=DB::table('resorts')->find($resort);
                            $namaR=$resort1->namaResort;
                        }
                        else{
                            $namaR="Semua";
                        }

                    @endphp
                    : {{$namaR}}
                </div>
            </div>
            <div class="row my-2">
                <div class="col-3">
                    LK
                </div>
                <div class="col-3">
                    @php
                        if(isset($LK)){
                            $LK1=DB::table('lks')->find($LK);
                            $namaR=$LK1->namaLK;
                        }
                        else{
                            $namaR="Semua";
                        }

                    @endphp
                    : {{$namaR}}
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12">
                    <table class="table table-bordered" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Resort</th>
                                <th>Lembaga Konservasi</th>
                                <th>Satwa</th>
                                <th>Jumlah</th>
                                <th>No. Serah Terima</th>
                                <th>Tanggal Serah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                            <?php
                              $newDate = date("d-m-Y", strtotime($row->tanggal));
                            ?>
                            <tr>
                                <td>{{$row->namaResort}}</td>
                                <td>{{$row->namaLK}}</td>
                                <td>{{$row->namaSatwa}} ({{$row->namaLatin}})</td>
                                <td>{{$row->jumlah}}</td>
                                <td>{{$row->noSerahterima}}</td>
                                <td>{{$newDate}}</td>
                            </tr>    
                            @endforeach
                            
                        </tbody>
                    </table>
                    <form method="POST" action="{{route('cetaksemua')}}">
                        {{ csrf_field() }}
                        <input id="bulan" type="hidden" name="bulan" value="{{$bulan2}}">
                        <input id="tahun" type="hidden" name="tahun" value="{{$tahun}}">
                        <input id="resort" type="hidden" name="resort" value="{{$resort}}">
                        <input id="LK" type="hidden" name="LK" value="{{$LK}}">
                        <input id="satwa" type="hidden" name="satwa" value="{{$satwa}}">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>