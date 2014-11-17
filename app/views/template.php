<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mysql Backup System</title>
    <link rel="stylesheet" href="<?php echo $config['bootstrap_path'] . $config['bootstrap_theme'] ?>/css/bootstrap.css"
          type="text/css" media="screen"/>
    <link rel="stylesheet"
          href="<?php echo $config['bootstrap_path'] . $config['bootstrap_theme'] ?>/css/bootstrap.min.css"
          type="text/css" media="screen"/>
</head>
<body>
<?php include('menu.php'); ?>


<div class="container">
    <?php
    include('main.php');
    ?>
</div>
</body>
</html>
