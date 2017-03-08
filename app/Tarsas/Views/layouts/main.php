<!doctype html>
<html>
<head>
  <title>Társasjáték szervező</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="assets/styles/index.css?rnd=<?=rand(111,999)?>">
</head>
<body>
<?php
if (!empty($_SESSION['message'])) {
  echo $_SESSION['message'];
  $_SESSION['message'] = '';
}
?>
<?php $this->renderView('partials/header'); ?>
<main>
  <?php $this->renderView('partials/content'); ?>
</main>
<?php $this->renderView('partials/footer'); ?>
</body>
</html>
