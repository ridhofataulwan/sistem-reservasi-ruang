<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- SEMENTARA -->
  <script>
    alert(
      <?php foreach ($overlapped as $ov) : ?> '<?= $ov['acara_nama'] ?>'
      <?php endforeach ?>
    )
    document.location.href = '/reservasi/opd'
  </script>
</body>

</html>