<?php

namespace WooUkrainianPaymentGateways\App\DB;

if(!defined('ABSPATH')){
    die;
}

/**
 * Class for working with DB
 */
class WUPG_DB{

    /**
     * $db - property for working with db
     *
     * @var [wpdb]
     */
    private $db;

    public function __construct(){

        global $wpdb;
        $this->db = $wpdb;

    }

    /**
     * Create table
     *
     * @param [type] $table_name
     * @param [type] $sql_table_params
     * @param [type] $sql_table_conditions
     * @return void
     */
    public function create_table($table_name, $sql_table_params, $sql_table_conditions){

        $cahrset_collate = "DEFAULT CHARACTER SET {$this->db->charset} COLLATE {$this->db->collate}";

        $table_prefix = $this->db->prefix;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $sql = "
            CREATE TABLE $sql_table_conditions $table_prefix"."$table_name (
                $sql_table_params
            ) {$cahrset_collate};
        ";

        dbDelta($sql);

    }

    /**
     * Drop table
     *
     * @param [type] $table_name
     * @return void
     */
    public function drop_table($table_name){
        $_table_name = $this->db->prefix . $table_name;

        $this->db->query("DROP TABLE IF EXISTS $_table_name");

    }

    /**
     * Method for getting data from DB
     *
     * @param [type] $data
     * @return void
     */
    public function get_data($data, $from, $conditions = null){

        $sql = "SELECT $data FROM $from";

        if(!empty($conditions)){
            $sql .= $conditions;
        }

        $result = $this->db->get_row($sql, ARRAY_A);

        return $result;

    }

    /**
     * Inserting data
     *
     * @param [type] $table
     * @param array $data
     * @param array $format
     * @return void
     */
    public function insert_data($table, $data = array(), $format = array()){

        $this->db->insert($table, $data, $format);

    }

    /**
     * Updating data
     *
     * @param [string] $table
     * @param array $data
     * @param array $where
     * @param array $format
     * @return void
     */
    public function update_data($table, $data = array(), $where = array() ,$format = array()){

        $this->db->update($table, $data, $where, $format);

    }

}