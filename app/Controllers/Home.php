<?php

namespace App\Controllers;

use \App\Models\DataModel;

class Home extends BaseController
{
    public function index():string 
    {
        return view('home');
    }

    public function getDatabase(): string
    {
        $db = db_connect();
        $result = $db->query('show databases');
        
        return json_encode($result->getResultArray());
    }

    public function getTableName() 
    {
        $request = \Config\Services::request();

        $database = $request->getVar('database');
        $db = db_connect();
        $result = $db->query('select table_name from information_schema.tables 
                                WHERE table_schema ="'.$database.'"');

        return json_encode($result->getResultArray());
    }

    public function getColumnName(){
       // 
       $request = \Config\Services::request();

       $database = $request->getVar('database');
       $tablename = $request->getVar('tablename');
       $db = db_connect();
       $result = $db->query('select `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` 
                                WHERE `TABLE_SCHEMA`="'.$database.'" 
                                AND `TABLE_NAME`="'.$tablename.'";');

       return json_encode($result->getResultArray());
    }

    public function getData(){
        $request = \Config\Services::request();

        $tablename = $request->getVar('tablename');
        $database = $request->getVar('database');
        
        $data = new DataModel();
        $data->setTable($tablename);
        
        $data = $data->findAll();
 
        return json_encode($data);
    }

    public function getTableByDatabase($database): string
    {   
        $data = array('database'=>$database);
        return view("tablename",$data);
    }
}
