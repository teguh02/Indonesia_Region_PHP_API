<?php

namespace Teguh02\PhpIndonesiaRegion\Region\Driver;

trait Regencies {

    /**
     * Get regencies with id province
     *
     * @param integer $id
     * @param array $options
     * @return void
     */
    public static function get_regencies_with_id_province(int $id, Array $options = [])
    {
        try {
            // read all csv 
            $regencies = (array) csv_reader(self::$regencies_file)['data'];

            // filter array
            $regencies = (array) filter_array($regencies, 'province_id', $id);

            if ($options['sort'] != 'none') {
                // sort array
                $regencies = (array) sort_array($regencies, $options['sort'], $options['order']);
            }
            
            // limit array
            if ($options['limit'] != 'all') {
                $regencies = (array) limit_array($regencies, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($regencies);
            } 

            return (array) $regencies;

        } catch (\Throwable $th) {
            return [];
        }
    }    

    /**
     * Get regencies with id province in array
     *
     * @param integer $id
     * @param array $options
     * @return void
     */
    public static function get_regencies_with_id_province_in_array(Array $id, Array $options = [])
    {
        try {
            // read all csv 
            $regencies = (array) csv_reader(self::$regencies_file)['data'];

            // filter array
            $regencies = (array) filter_array_by_array($regencies, 'province_id', (array) $id);

            if ($options['sort'] != 'none') {
                // sort array
                $regencies = (array) sort_array($regencies, $options['sort'], $options['order']);
            }
            
            // limit array
            if ($options['limit'] != 'all') {
                $regencies = (array) limit_array($regencies, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($regencies);
            } 

            return (array) $regencies;

        } catch (\Throwable $th) {
            return [];
        }
    }
}