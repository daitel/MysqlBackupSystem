<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */

?>
<div class="jumbotron">
    <h1>Backup System</h1>

    <p>This page is the user interface of the backups system</p>

    <?php if ($status) { ?>
        <p>
        <div class="panel panel-primary">
            <div class="panel-heading">Backups Status</div>
            <div class="panel-body">
                <?php if ($status['green'] || $status['red']) { ?>
                <?php if($error_mysql){ ?>
                    <div class="alert alert-danger" role="alert">
                        Unable to connect mysql database. Check config data!
                    </div>
                <?php } ?>
                    <div class="progress">
                        <?php if ($status['green']) { ?>
                            <div class="progress-bar progress-bar-success"
                                 style="width: <?php echo $status['percent']['green'] ?>%">
                                <span class="sr-only"><?php echo $status['percent']['green'] ?></span>
                            </div>
                        <?php } ?>

                        <?php if ($status['red']) { ?>
                            <div class="progress-bar progress-bar-danger"
                                 style="width: <?php echo $status['percent']['red'] ?>%">
                                <span class="sr-only"><?php echo $status['percent']['red'] ?></span>
                            </div>
                        <?php } ?>
                    </div>

                    <ul class="list-group">
                        <?php if ($status['green']) { ?>
                            <li class="list-group-item list-group-item-success"><?php echo $status['green'] ?>
                                relevant
                            </li>
                        <?php } ?>

                        <?php if ($status['red']) { ?>
                            <li class="list-group-item list-group-item-danger"><?php echo $status['red'] ?> not
                                relevant
                            </li>
                        <?php } ?>
                    </ul>

                <?php } else { ?>
                    <div class="alert alert-danger" role="alert">
                            Backup Folder not found. Please start script or check backup path
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php if ($tables) { ?>
        <p>
        <?php foreach ($tables as $name => $table) { ?>

            <div class="panel panel-<?php echo $table['status'] ?>">
                <div class="panel-heading"><?php echo $name ?></div>
                <div class="panel-body">
                    Last upload time: <?php echo $table['edit'] ?>
                    <?php if ($table['download_link']) { ?>
                        <a class="btn btn-info"
                           href="<?php echo $table['download_link'] ?>"
                           role="button">Download</a>
                    <?php } ?>
                    <?php if ($table['download_link_gz']) { ?>
                        <a class="btn btn-info"
                           href="<?php echo $table['download_link_gz'] ?>"
                           role="button">Download(.gz)</a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        </p>
    <?php } ?>
</div>
