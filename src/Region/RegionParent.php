<?php

namespace Teguh02\PhpIndonesiaRegion\Region;

use Exception;

// load all db driver class
use Teguh02\PhpIndonesiaRegion\Region\Driver\{
    Districts,
    Provinces,
    Regencies,
    Villages
};

class RegionParent {

    use Provinces, Regencies, Districts, Villages;
    
    protected static $query;
    protected static $options = [
        'limit' => 'all',
        'output' => 'array'
    ];

    protected static $csv_path;
    protected static $province_file;
    protected static $districts_file;
    protected static $regencies_file;
    protected static $villages_file;

    public function __construct()
    {
        self::$csv_path = dirname(__DIR__) . "/csv/";
        self::$province_file = self::$csv_path . "provinces.csv";   
        self::$districts_file = self::$csv_path . "districts.csv";
        self::$regencies_file = self::$csv_path . "regencies.csv";
        self::$villages_file = self::$csv_path . "villages.csv";
    }

    /**
     * Set query
     *
     * @param string $query
     * @return void
     */
    public static function query(String $query = "all province")
    {
        $query = format_query($query);
        self::$query = (string) $query;

        return new static;
    }

    /**
     * Get data
     *
     * @return void
     */
    public static function get(Array $options = [])
    {
        if (empty($options)) {
            $options = self::$options;
        } else {
            $options = array_merge(self::$options, $options);
        }

        $query = (string) remove_special_character(strtolower(self::$query));

        # PROVINCES
        // all provinces
        if (is_string_contains($query, "all provinces")) {
            return self::get_all_province($options);
        }

        // province with id = ?
        if (is_string_contains($query, "province with id = ")) {
            $id = (int) get_id_from_query(self::$query);
            return self::get_province_with_id($id, $options);
        }

        // provinces with id in array [?]
        if (is_string_contains($query, "provinces with id in array [")) {
            $id = (array) get_id_from_query(self::$query);
            return self::get_provinces_with_id_in_array($id, $options);
        }

        # REGENCIES
        // regencies with id_province = ?
        if (is_string_contains($query, "regencies with id_province = ")) {
            $id = (int) get_id_from_query(self::$query);
            return self::get_regencies_with_id_province($id, $options);
        }

        // regencies with id_province in array [?]
        if (is_string_contains($query, "regencies with id_province in array [")) {
            $id = (array) get_id_from_query(self::$query);
            return self::get_regencies_with_id_province_in_array($id, $options);
        }

        # DISTRICTS
        // districts with id_regency
        if (is_string_contains($query, "districts with id_regency = ")) {
            $id = (int) get_id_from_query(self::$query);
            return self::get_districts_with_id_regency($id, $options);
        }

        # VILLAGES
        // villages with id_district = ?
        if (is_string_contains($query, "villages with id_district = ")) {
            $id = (int) get_id_from_query(self::$query);
            return self::get_villages_with_id_district($id, $options);
        }

        throw new Exception("Unknown query [" . self::$query . "]");
    }
}