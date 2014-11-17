<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */


$temp = scandir($config['dump']['dir']);

$tables = array();
$status = array(
    'counter' => 0,
    'green'   => 0,
    'red'     => 0,
    'percent' => array(
        'green' => 0,
        'red'   => 0
    )
);

function checkEditTime($time, $config)
{
    $time += $config['dump']['cron_time'] + $config['dump']['script_time'];
    $cur_time = microtime(true);

    return ($cur_time - $time < 0 ? true : false);
}

function valveToPercent($all, $valve)
{
    return $valve * 100 / $all;
}

foreach ($temp as $table) {
    if (($table != ".") && ($table != "..")) {
        $path = $config['dump']['dir'] . '/' . $table . '/' . $config['dump']['name'];
        $edit_time = date("F d Y H:i:s", filemtime($path));

        $tables[$table] = array(
            'edit'             => $edit_time,
            'status'           => (checkEditTime(filemtime($path), $config) ? 'info' : 'danger'),
            'download_link'    => (file_exists($path) ? $path : false),
            'download_link_gz' => (file_exists($path . '.gz') ? $path . '.gz' : false)
        );

        if (checkEditTime(filemtime($path), $config)) {
            $status['green']++;
        } else {
            $status['red']++;
        }

        $status['counter']++;
    }
}


$status['percent']['green'] = valveToPercent($status['counter'], $status['green']);
$status['percent']['red'] = valveToPercent($status['counter'], $status['red']);

require('app/views/template.php');