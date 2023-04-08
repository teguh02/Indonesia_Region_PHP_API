<?php

if (!function_exists('is_string_contains')) {
    /**
     * Check if string contains another string
     *
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    function is_string_contains(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('remove_special_character')) {
    /**
     * Remove special character from string
     *
     * @param String $text
     * @return void
     */
    function remove_special_character(String $text)
    {
        $specialCharacter = ['.', '/', '\\', '(', ')', '{', '}', ':', ';', '"', "'", '!', '?', '@', '#', '$', '%', '^', '&', '*', '+', '|', '~', '`', '<', '>'];
        return str_replace($specialCharacter, '', $text);
    }
}

if (!function_exists('format_query')) {
    /**
     * Format query
     *
     * @param String $query
     * @return void
     */
    function format_query(String $query) {
        $query = strtolower($query);
        $query = remove_special_character($query);
        return $query;
    }
}

if (!function_exists('csv_reader')) {
    /**
     * Read csv file
     *
     * @param String $file
     * @return void
     */
    function csv_reader(String $file) {
        $results = [];
        
        if (($open = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ";")) !== FALSE) {        
                
                if (is_string_contains($data[0], "id")) {
                    // loop and store header
                    $header = [];
                    $header_index = 0;
                    foreach ($data as $key => $value) {
                        $header[$header_index] = remove_special_character($value);
                        $header_index++;
                    }
                    
                    $results['header'] = $header;
                } else {
                    // loop and store data
                    $data_index = 0;
                    $data_array = [];
                    foreach ($data as $key => $value) {
                        $data_array[$header[$data_index]] = $value;
                        $data_index++;
                    }
                    
                    $results['data'][] = $data_array;
                }
            }
      
            fclose($open);
            return $results;
        }

        return [];
    }
}

if (!function_exists('json_response')) {
    /**
     * Json response
     *
     * @param Array $data
     * @return void
     */
    function json_response(Array $data) {
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

if (!function_exists('format_text')) {
    function format_text(String $string): String
    {
        return (string) ucwords(strtolower($string));
    }
}

if (!function_exists('sort_array')) {
    /**
     * Sort multidimensional array
     *
     * @param Array $array
     * @param String $key
     * @param String $order
     * @return void
     */
    function sort_array(Array $array, String $key, String $order = 'asc')
     {
        $sorter = [];
        $ret = [];

        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va[$key];
        }
        if ($order == 'asc') {
            asort($sorter);
        } else {
            arsort($sorter);
        }
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }

        $ret = array_values($ret);

        return (array) $ret;

        // $sorter = [];
        // $ret = [];

        // reset($array);
        // foreach ($array as $ii => $va) {
        //     $sorter[$ii] = $va[$key];
        // }

        // if ($order == 'asc') {
        //     usort($array, function($a, $b) {
        //         // sort array by key asc
        //         return $a['id'] <=> $b['id'];
        //     });
        // } else {
        //     usort($array, function($a, $b) {
        //         // sort array by key desc
        //         return $b['id'] <=> $a['id'];
        //     });
        // }

        // foreach ($sorter as $ii => $va) {
        //     $ret[$ii] = $array[$ii];
        // }

        // $ret = array_values($ret);

        // return (array) $ret;
    }
}

if (!function_exists('limit_array')) {
    /**
     * Limit array
     *
     * @param Array $array
     * @param Integer $limit
     * @return void
     */
    function limit_array(Array $array, Int $limit) {
        $results = [];
        $i = 0;
        foreach ($array as $key => $value) {
            if ($i < $limit) {
                $results[] = $value;
            }
            $i++;
        }
        return (array) $results;
    }
}

if (!function_exists('get_id_from_query')) {
    /**
     * Get id from query
     *
     * @param String $query
     * @return void
     */
    function get_id_from_query($query) {
        if (is_string_contain_array($query)) {
            // get string start from [ sign
            $query = substr($query, strpos($query, '[') + 1);

            // remove ] sign
            $query = str_replace(']', '', $query);

            // explode string
            $query = explode(',', $query);

            // convert all string to integer
            foreach ($query as $key => $value) {
                $query[$key] = (int) $value;
            }

            return $query;
        } else {
            $query = explode('=', $query);
            return (int) $query[1];
        }
    }
}

if (!function_exists('filter_array')) {
    /**
     * Filter array
     *
     * @param Array $array
     * @param String $key
     * @param String $value
     * @return void
     */
    function filter_array(Array $array, String $key, String $value) {
        $results = [];
        foreach ($array as $data) {
            if ($data[$key] == $value) {
                $results[] = $data;
            }
        }
        return (array) $results;
    }
}

if (!function_exists('is_string_contain_array')) {
    /**
     * Check if string contain array
     *
     * @param String $string
     * @return void
     */
    function is_string_contain_array(String $string) {
        return strpos($string, '[') !== false && strpos($string, ']') !== false;
    }
}

// filter_array_by_array
if (!function_exists('filter_array_by_array')) {
    /**
     * Filter array by array
     *
     * @param Array $array
     * @param Array $filter
     * @return void
     */
    function filter_array_by_array(Array $array, String $key, Array $value) {
        $results = [];
        foreach ($array as $data) {
            if (in_array($data[$key], $value)) {
                $results[] = $data;
            }
        }
        return (array) $results;
    }
}