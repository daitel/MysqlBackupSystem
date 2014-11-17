<?php
/**
 * Mysql Backup System
 *
 * @author Nikita Fedoseev <agent.daitel@gmail.com>
 * @link https://github.com/daitel/MysqlBackupSystem
 */

class dump
{

    /**
     * @var resource
     */
    public $file;

    /**
     * constructor
     *
     * @param string $path
     */
    public function __construct($path)
    {


        if (file_exists($path . '.old')) {
            unlink($path . '.old');
        }
        if (file_exists($path)) {
            rename($path, $path . '.old');
        }

        $this->file = fopen($path, "w");
    }

    /**
     * DROP_TABLE_IF_EXISTS
     *
     * @param string $table
     */
    public function DROP_TABLE_IF_EXISTS($table)
    {
        $this->write("DROP TABLE IF EXISTS `" . $table . "`");
        $this->line_end();
    }

    /**
     * SHOW_CREATE_TABLE
     *
     * @param array $data
     */
    public function SHOW_CREATE_TABLE($data)
    {
        $this->write($data[1]);
        $this->line_end();
    }

    /**
     * INSERT_INTO_TABLE
     *
     * @param string $table
     */
    public function INSERT_INTO_TABLE($table)
    {
        $this->write("INSERT INTO `" . $table . "` VALUES\n");
    }

    /**
     * LineEnd
     */
    public function line_end()
    {
        $this->write(";\n");
    }

    /**
     * Write Into FIle
     *
     * @param $line
     */
    public function write($line)
    {
        fwrite($this->file, $line);
    }

}