<?php

namespace Teguh02\PhpIndonesiaRegion\Region\Driver;

trait Villages {

    /**
     * Get all villages by id district
     *
     * @param integer $id
     * @param array $options
     * @return void
     */
    public static function get_villages_with_id_district(int $id, array $options = [])
    {
        try {
            // read all csv 
            $villages = (array) csv_reader(self::$villages_file)['data'];

            // filter array
            $villages = (array) filter_array($villages, 'district_id', $id);
            
            // limit array
            if ($options['limit'] != 'all') {
                $villages = (array) limit_array($villages, $options['limit']);
            }
            
            // output
            if ($options['output'] == 'json') {
                return json_response($villages);
            } 

            return (array) $villages;

        } catch (\Throwable $th) {
            return [];
        }
    }

}