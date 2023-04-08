<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

// load class
use Teguh02\PhpIndonesiaRegion\Region;

# PROVINCE
// get all province
$province = Region::query("all provinces") -> get();
// $province = Region::query("all provinces") -> get([
//     'sort' => 'id',
//     'order' => 'desc',
//     // 'limit' => 5,
//     'output' => 'json'
// ]);

// get a province
// $province = Region::query("province with id = 36") -> get();

// get a province with array id
// $province = Region::query("provinces with id in array [36, 51, 34, 61, 71]") -> get();

# REGENCY
// get all regency with id province is 36
// $regencies = Region::query("regencies with id_province = 33") -> get();

// get all regency with id province is 32, 33
// $regencies = Region::query("regencies with id_province in array [32, 33]") -> get();

# DISTRICT
// get all district with id regency is 3201
// $districts = Region::query("districts with id_regency = 3302") -> get();

# VILLAGE
// get all village with id district is 330227
// $villages = Region::query("villages with id_district = 330227") -> get();

echo json_encode($province);