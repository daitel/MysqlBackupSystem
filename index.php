<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */

error_reporting(0);

set_time_limit(2400);

require_once('app/framework/DfBase.php');

require_once('app/config.php');

require_once('app/models/dump.php');

$mysql = new DfMysql($config);

if ($mysql->getErrors()) {
    $error_mysql = true;
}
if ($_GET['c'] == 'script') {
    if (!$error_mysql) {
        $res = $mysql->query("SHOW TABLES");

        if (!file_exists($config['dump']['dir'])) {
            mkdir($config['dump']['dir'], 0777, true);
        }

        while ($table = mysql_fetch_row($res)) {

            $path = $config['dump']['dir'] . '/' . $table[0] . '/' . $config['dump']['name'];

            if (!file_exists($config['dump']['dir'] . '/' . $table[0])) {
                mkdir($config['dump']['dir'] . '/' . $table[0], 0777, true);
            }

            $dump_model = new dump($path);
            $dump_model->DROP_TABLE_IF_EXISTS($table[0]);

            $dump_model->SHOW_CREATE_TABLE(mysql_fetch_row($mysql->query("SHOW CREATE TABLE " . $table[0])));

            $table_select = $mysql->query('SELECT * FROM `' . $table[0] . '`');
            if (mysql_num_rows($table_select) > 0) {

                $dump_model->INSERT_INTO_TABLE($table[0]);

                $i = 1;
                while ($row = mysql_fetch_row($table_select)) {
                    $query = "";

                    foreach ($row as $field) {
                        if (is_null($field)) {
                            $field = "NULL";
                        } else {
                            $field = "'" . mysql_escape_string($field) . "'";
                        }

                        if ($query == "") {
                            $query = $field;
                        } else {
                            $query = $query . ', ' . $field;
                        }
                    }

                    if ($i > $config['dump']['insert_records']) {
                        $dump_model->INSERT_INTO_TABLE($table[0]);
                        $i = 1;
                    }

                    if ($i == 1) {
                        $q = "(" . $query . ")";
                    } else {
                        $q = ",(" . $query . ")";
                    }

                    $dump_model->write($q . "\n");

                    if ($i == $config['dump']['insert_records']) {
                        $dump_model->line_end();
                    }
                    $i++;
                }

                $dump_model->line_end();

                if ($config['dump']['gzip']) {
                    if (file_exists($path . '.gz.old')) {
                        unlink($path . '.gz.old');
                    }

                    if (file_exists($path . '.gz')) {
                        rename($path . '.gz', $path . '.gz.old');
                    }

                    $data = gzencode(file_get_contents($path), 9);

                    $file = fopen($path . '.gz', "w");
                    fwrite($file, $data);
                    fclose($file);
                }
            }
        }
    } else {
        echo "Error with mysql connector";
    }
} else {
    require_once('app/controllers/admin.php');
}