<?php

namespace Teguh02\PhpIndonesiaRegion\Region\Driver;

trait Districts {

    /**
     * Get all districts by id regency
     *
     * @param integer $id
     * @param array $options
     * @return void
     */
    public static function get_districts_with_id_regency(int $id, array $options = [])
    {
        try {
            // read all csv 
            $districts = (array) csv_reader(self::$districts_file)['data'];

            // filter array
            $districts = (array) filter_array($districts, 'regency_id', $id);
            
            // limit array
            if ($options['limit'] != 'all') {
                $districts = (array) limit_array($districts, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($districts);
            } 

            return (array) $districts;

        } catch (\Throwable $th) {
            return [];
        }
    }

}