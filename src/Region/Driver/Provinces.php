<?php

namespace Teguh02\PhpIndonesiaRegion\Region\Driver;

trait Provinces {

    /**
     * Get all province
     *
     * @param array $options
     * @return void
     */
    public static function get_all_province(Array $options = [])
    {
        try {
            // read all csv 
            $province = (array) csv_reader(self::$province_file)['data'];

            if ($options['sort'] != 'none') {
                // sort array
                $province = (array) sort_array($province, $options['sort'], $options['order']);
            }
            
            // limit array
            if ($options['limit'] != 'all') {
                $province = (array) limit_array($province, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($province);
            } 

            return (array) $province;

        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Get province with id
     *
     * @param integer $id
     * @param Array $options
     * @return void
     */
    public static function get_province_with_id(int $id, Array $options)
    {
        try {
            // read all csv 
            $province = (array) csv_reader(self::$province_file)['data'];

            // filter array
            $province = (array) filter_array($province, 'id', $id);

            if ($options['sort'] != 'none') {
                // sort array
                $province = (array) sort_array($province, $options['sort'], $options['order']);
            }
            
            // limit array
            if ($options['limit'] != 'all') {
                $province = (array) limit_array($province, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($province);
            } 

            return (array) $province;

        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Get province with id in array
     *
     * @param Array $id
     * @param Array $options
     * @return void
     */
    public static function get_provinces_with_id_in_array(Array $id, Array $options)
    {
        try {
            // read all csv 
            $province = (array) csv_reader(self::$province_file)['data'];

            // filter array
            $province = (array) filter_array_by_array($province, 'id', $id);

            // sort array
            $province = (array) sort_array($province, $options['sort'], $options['order']);
            
            // limit array
            if ($options['limit'] != 'all') {
                $province = (array) limit_array($province, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($province);
            } 

            return (array) $province;

        } catch (\Throwable $th) {
            return [];
        }
    }
}