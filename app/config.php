<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */

$config = array(
    #Database Host
    'db_host'         => 'localhost',
    #Database User
    'db_user'         => 'web',
    #Database Password
    'db_pass'         => 'web',
    #Database Name
    'db_name'         => 'test',
    #Dump Settings
    'dump'            => array(
        #Directory for save
        'dir'            => 'backups',
        #File Name
        'name'           => 'dump.sql',
        #Records in one mysql insert
        'insert_records' => 50,
        #whether packaged in gzip
        'gzip'           => true,
        #cron time in seconds(script for checking the relevance)
        'cron_time'      => 60 * 60,
        #approximate time of execution of the script(script for checking the relevance)
        'script_time'    => 5 * 60,
    ),
    #Twitter Bootstrap Path
    'bootstrap_path'  => 'http://maxcdn.bootstrapcdn.com/',
    #Twitter Bootstrap Folder
    'bootstrap_theme' => 'bootstrap/3.3.1',
);