<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Project Management</title>
</head>
<style>
  body{
    font-family: Arial, Sans-serif, Helvetica !important;
  }
  table{
    width: 100%;
  }
  table thead, thead tr, tr th{
    border:1px solid #222;
  }
  table, table tr, table tr td{
    border:1px solid #222;
    border-collapse: collapse;
  }
  thead{
    background: blue;
    color: #fff;
    border-color: blue;
  }
  .ctr{
    text-align: center;
  }
</style>
<body>
  <div class="container">
    <div class="row">
      <h1>DATA PROJECT</h1>
      <table class="table table-bodered table-responsive" cellpadding="5" cellspacing="0">
        <thead>
          <tr>
            <th class="ctr">No.</th>
            <th>No. Project</th>
            <th>Spesifikasi</th>
            <th class="ctr">Tanggal terima</th>
            <th class="ctr">Deltime</th>
            <th class="ctr">QTY</th>
            <th>Customer</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($projects as $pro) : ?>
            <tr>
              <td class="ctr"><?php echo $no++; ?></td>
              <td><?php echo $pro->no; ?></td>
              <td><?php echo $pro->spesifikasi; ?></td>
              <td class="ctr"><?php echo $pro->tanggal_terima; ?></td>
              <td class="ctr"><?php echo $pro->deltime; ?></td>
              <td class="ctr"><?php echo $pro->qty; ?></td>
              <td><?php echo $pro->customer; ?></td>
              <td><?php echo $pro->status; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>