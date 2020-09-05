<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
      *{
            font-family:sans-serif;
        }
        .text-center
        {
          text-transform: uppercase;
        }
    </style>
    <title><?= $titleTag.' Dicetak Oleh '.$this->session->userdata('username') ?></title>
  </head>
  <body class="small" style="text-transform: uppercase;">
    <h1 class="text-right"><b>YAYASAN CINTA ILMU</b></h1>
    <p class="text-right">Jl. Raya Pendidikan No. 7F Cinangka, Sawangan, Kabupaten Depok-Jawa Barat</p>
    <hr>
    <br>
    <br>
    <h5 class="text-center"><strong><u>Laporan Bulan <?= bulan($bulan) ?>  <?= $tahun ?></u></strong></h5>

    <h5 class="m-fix text-left" style="margin-top:40px"><strong>JURNAL UMUM</strong></h5>
    <table class="table table-striped table-bordered">
      <thead class="text-center">
        <tr>
          <th width="5">No</th>
          <th>Tanggal</th>
          <th>Nama Akun</th>
          <th width="6">Reff</th>
          <th>Debit</th>
          <th>Kredit</th>
        </tr>
      </thead>
      <tbody style="font-size: 8pt">
        <?php
            $i=1;
            foreach($jurnals as $row):
                if($row->jenis_saldo=='debit'):
        ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= date_indo($row->tgl_transaksi) ?></td>
                    <td class="text-left"><i><?= $row->keterangan ?></i></td>
                    <td class="text-center"><?= $row->no_reff ?></td>
                    <td class="text-left"><?= 'Rp. '.number_format($row->saldo,0,',','.') ?></td>
                    <td class="text-left">Rp. 0</td>
                </tr>
        <?php 
                endif;
                if($row->jenis_saldo=='kredit'):
        ?>
                <tr>
                    <td class="text-center"><?= $i++ ?></td>
                    <td class="text-center"><?= date_indo($row->tgl_transaksi) ?></td>
                    <td class="text-right"><i><?= $row->keterangan ?></i></td>
                    <td class="text-center"><?= $row->no_reff ?></td>
                    <td class="text-left">Rp. 0</td>
                    <td class="text-left"><?= 'Rp. '.number_format($row->saldo,0,',','.') ?></td>     
                </tr>  
        <?php 
                endif;
            endforeach;
        ?>
        <?php if($totalDebit->saldo != $totalKredit->saldo){ ?>
        <tr>
            <td colspan="4" class="text-center"><b>Jumlah Total</b></td>
            <td class="text-danger"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
            <td class="text-danger"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
        </tr>
        <tr  class="text-center bg-danger ">
            <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
        </tr>
        <?php }else{  ?>
        <tr>
            <td colspan="4" class="text-center"><b>Jumlah Total</b></td>
            <td class="text-success"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
            <td class="text-success"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
        </tr>
        <tr class="text-center bg-success">
            <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <h5 class="m-fix text-left" style="margin-top:40px"><strong>Buku Besar</strong></h5>
    <?php 
        $a=0;
        $debit = 0;
        $kredit = 0;
        
        for($i=0;$i<$jumlah;$i++) :                          
        $a++;
        $s=0;
        $deb = $saldo[$i];
    ?>
    <div class="d-flex" style="margin-top:20px;">
        <div class="text-left w-100 font-bold"><?= $data[$i][$s]->nama_reff ?></div>
        <div class="text-right w-100 font-bold">No.<?= $data[$i][$s]->no_reff ?></div>
    </div>
    <table class="table table-striped table-bordered" style="margin-bottom:10px;margin-bottom:10px;">
      <thead class="text-center">
        <tr>
          <th rowspan="2">No.</th>
          <th rowspan="2">Tanggal</th>
          <th rowspan="2">Keterangan</th>
          <th rowspan="2">Debit</th>
          <th rowspan="2">Kredit</th>
          <th colspan="2" class="text-center">Saldo</th>
        </tr>
        <tr class="text-center font-bold">
            <td>Debit</td>
            <td>Kredit</td>
        </tr>
      </thead>
      <tbody style="font-size: 8pt">
        <?php
            $o=1;
            for($j=0;$j<count($data[$i]);$j++):
                $timeStampt = strtotime($data[$i][$j]->tgl_transaksi);
                $bulan = date('m',$timeStampt);

                $tahun = date('Y',$timeStampt);
                $tgl = date('d',$timeStampt);
                $bulan = medium_bulan($bulan);
        ?>
            <tr>
                <td class="text-center"><?= $o++; ?></td>
                <td class="text-center"><?= $tgl.' '.$bulan.' '.$tahun ?></td>
                <td><?= $data[$i][$j]->keterangan ?></td>
                <?php 
                    if($data[$i][$j]->jenis_saldo=='debit'){
                ?>
                <td><?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?></td>
                <td>Rp. 0</td>
                <?php 
                    }else{
                ?>
                <td>Rp. 0</td>
                <td><?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?></td>
                <?php } ?>
                <?php
                    if($deb[$j]->jenis_saldo=="debit"){
                        $debit = $debit + $deb[$j]->saldo;
                    }else{
                        $kredit = $kredit + $deb[$j]->saldo;
                    }
                    $hasil = $debit-$kredit;
                ?>
                <?php if($hasil>=0){ ?>
                <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                <td> - </td>
                <?php }else{ ?>
                <td> - </td>
                <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                <?php } ?>
            </tr>
        <?php endfor ?>
        <?php
            $debit = 0;
            $kredit = 0;
        ?>
            <td class="text-center" colspan="5"><b>Total</b></td>
            <?php if($hasil>=0){ ?>
            <td class="text-center font-bold"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
            <td class="text-center"> - </td>
            <?php }else{ ?>
            <td class="text-center"> - </td>
            <td class="text-center font-bold"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
            <?php } ?>
      </tbody>
    </table>
    <?php endfor; ?>

    <h5 class="m-fix text-left" style="margin-top:10px"><b>Neraca Saldo</b></h5>
    <table class="table table-bordered table-striped">
      <thead class="text-centers">
        <tr>
          <th width="5">No</th>
          <th width="6">Reff</th>
          <th>Nama Akun</th>
          <th>Debit</th>
          <th>Kredit</th>
        </tr>
      </thead>
      <tbody style="font-size: 8pt">
        <?php
                $totalDebit=0;
                $totalKredit=0;
                $o=1;                        
                for($i=0;$i<$jumlah;$i++) :  
                    $a++;
                    $s=0;
                    $deb = $saldo[$i];
            ?>
            <tr>
                <td><?= $o++ ?></td>
                <td>
                    <?= $data[$i][$s]->no_reff ?>
                </td>
                <td>
                    <?= $data[$i][$s]->nama_reff ?>
                </td>
                <?php 
                    for($j=0;$j<count($data[$i]);$j++):
                        if($deb[$j]->jenis_saldo=="debit"){
                            $debit = $debit + $deb[$j]->saldo;
                        }else{
                            $kredit = $kredit + $deb[$j]->saldo;
                        }
                        $hasil = $debit-$kredit;
                    endfor 
                ?>
                <?php 
                    if($hasil>=0){ ?>
                        <td class="text-success"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                        <td> - </td>
                        <?php $totalDebit += $hasil; ?>
                    <?php }else{ ?>
                        <td> - </td>
                        <td class="text-danger"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                        <?php $totalKredit += $hasil; ?>
                <?php } ?>
                <?php
                    $debit = 0;
                    $kredit = 0;
                ?>
            </tr>
            <?php endfor ?>
            <?php if($totalDebit != abs($totalKredit)){ ?>
            <tr>
                <td class="text-center" colspan="3"><b>Total</b></td>
                <td class="text-danger"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                <td class="text-danger"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
            </tr>
            <tr class="bg-danger text-center">
                <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
            </tr>
            <?php }else{ ?>
                <tr>
                <td class="text-center" colspan="3"><b>Total</b></td>
                <td class="text-success"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                <td class="text-success"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
            </tr>
            <tr class="bg-success text-center">
                <td colspan="5" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
            </tr>
            <?php } ?>  
      </tbody>
    </table>

        <p class="text-right" style="margin-top:50px;">Dicetak Oleh <?= $this->session->userdata('username') ?> Pada Tanggal 
        <?= date('d').' '.bulan(date('m')).' '.date('Y').' Pukul '.date('H:i:s').' WIB'?></p>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>