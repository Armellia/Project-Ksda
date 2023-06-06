<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style type="text/css">
            div{
                margin-top: -30%;
                margin-bottom: -30%;
            },
            h2{
                font-size:15pt;
                text-decoration: 
            },
            table tr td{
                text-align: center;
                font-size: 11pt;
            },
            table tr th{
                font-size: 15pt;
                text-align: center;
            },
            
        </style>
    </head>
    <body>
        
            
                    <b><h2 class="text-center">LAPORAN PENYERAHAN SATWA</h2><b><br><br>
                
            <p>
                Bulan : {{$bulan}} <br>
                Resort : 
                @php
                        if(isset($resort)){
                            $resort1=DB::table('resorts')->find($resort);
                            $namaR=$resort1->namaResort;
                        }
                        else{
                            $namaR="Semua";
                        }
                    @endphp
                    {{$namaR}}<br>
                Tahun : {{$tahun}} <br>
                LK 
                @php
                        if(isset($LK)){
                            $LK1=DB::table('lks')->find($LK);
                            $namaR=$LK1->namaLK;
                        }
                        else{
                            $namaR="Semua";
                        }

                    @endphp
                    : {{$namaR}}<br>
                Satwa
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
            </p>
            <br>
                    <table width="100%" border="1">
                        <thead>
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
                </div>
            </div>
        
    </body>
</html>