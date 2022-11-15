<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Commenmodel extends Model
{
    
   
    public function get_a_field(String $select, String $table, array $where = []): String
    {
        $db = DB::table($table);
        $db->selectRaw($select);

        if (!empty($where)) {

            foreach ($where as $key => $tbl) {
                $val =  explode(",", $key);
                $db->where("$val[0]", "$val[1]",  "$tbl");
            }
        }
        $rs = $db->get()->toArray();
        return  $rs[0]->$select ?? '';
    }

    public function get_selected_data(String $select, String $table, array $where = [], array $other = []): array
    {
        $db = DB::table($table);
        $db->selectRaw($select);

        if (!empty($where)) {

            foreach ($where as $key => $tbl) {
                $val =  explode(",", $key);
                $db->where("$val[0]", "$val[1]",  "$tbl");
            }
        }
        if (!empty($other)) {

            foreach ($other as $key => $tbl) {
                $val =  explode(",", $key);
                if ($val[0] == 'order')
                    $db->orderBy("$val[1]", "$tbl");
                else if ($val[0] == 'group')
                    $db->groupBy("$tbl");
                else if ($val[0] == 'limit')
                    $db->limit("$val[1]", "$tbl");
            }
        }

        return  $db->get()->toArray();
    }
    public function jointbl(String $select, String $master, array $table, array $where = [], array $other = []): array
    {
        $db = DB::table($master);
        $db->selectRaw($select);


        foreach ($table as $tbl) {

            $val = explode(",", $tbl);

            $db->join("$val[0]", "$val[1]", "$val[2]", "$val[3]");
        }

        if (!empty($where)) {

            foreach ($where as $key => $tbl) {
                $val =  explode(",", $key);
                $db->where("$val[0]", "$val[1]",  "$tbl");
            }
        }
        if (!empty($other)) {

            foreach ($other as $key => $tbl) {
                $val =  explode(",", $key);
                if ($val[0] == 'order')
                    $db->orderBy("$val[1]", "$tbl");
                else if ($val[0] == 'group')
                    $db->groupBy("$tbl");
                else if ($val[0] == 'limit')
                    $db->limit("$val[1]", "$tbl");
            }
        }
        return $db->get()->toArray();;
    }
    function password_cov($password)
    {
        $algorithm = 'sha256';
        $salt      = '@#$@@*YUH$%%';
        $count     = '3';
        $key_length = '20';
        $raw_output = false;

        $algorithm = strtolower($algorithm);
        if (!in_array($algorithm, hash_algos(), true))
            trigger_error('PBKDF2 ERROR: Invalid hash algorithm.', E_USER_ERROR);
        if ($count <= 0 || $key_length <= 0)
            trigger_error('PBKDF2 ERROR: Invalid parameters.', E_USER_ERROR);

        if (function_exists("hash_pbkdf2")) {
            // The output length is in NIBBLES (4-bits) if $raw_output is false!
            if (!$raw_output) {
                $key_length = $key_length * 2;
            }
            return hash_pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output);
        }

        $hash_length = strlen(hash($algorithm, "", true));
        $block_count = ceil($key_length / $hash_length);

        $output = "";
        for ($i = 1; $i <= $block_count; $i++) {
            // $i encoded as 4 bytes, big endian.
            $last = $salt . pack("N", $i);
            // first iteration
            $last = $xorsum = hash_hmac($algorithm, $last, $password, true);
            // perform the other $count - 1 iterations
            for ($j = 1; $j < $count; $j++) {
                $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
            }
            $output .= $xorsum;
        }

        if ($raw_output)
            return substr($output, 0, $key_length);
        else
            return bin2hex(substr($output, 0, $key_length));
    }
    public function update_data(string $table, array $where, array $data)
    {
        $db = DB::table($table);
        if (!empty($where)) {

            foreach ($where as $key => $tbl) {
                $val =  explode(",", $key);
                $db->where("$val[0]", "$val[1]",  "$tbl");
            }
        }
        $db->update($data);
    }
    public function delete_data(string $table, array $where)
    {

        $db = DB::table($table);
        if (!empty($where)) {

            foreach ($where as $key => $tbl) {
                $val =  explode(",", $key);
                $db->where("$val[0]", "$val[1]",  "$tbl");
            }
        }


        $db->delete();
    }
    public function insert_data(string $table, array $data): string
    {
        return  DB::table($table)->insertGetId($data);
    }
    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }
}
