<?php

use PHPUnit\Framework\TestCase;
use Teguh02\PhpIndonesiaRegion\Region;

class RegionTest extends TestCase {

    protected $region;

    public function setUp(): Void
    {
        $this->region = new Region();
    }

    public function testGetAllProvince() {
        $province = $this->region->query("all provinces")->get();
        $this->assertIsArray($province);
    }

    public function testGetProvinceWithLimit()
    {
        $province = $this->region->query("all provinces")->get([
            'limit' => 5
        ]);
        $this->assertIsArray($province);
        $this->assertCount(5, $province);
    }

    public function testGetProvinceWithId() {
        $province = $this->region->query("province with id = 36")->get();
        $this->assertIsArray($province);
    }

    public function testGetProvinceWithIdInArray()
    {
        $province = $this->region->query("provinces with id in array [36, 51, 34, 61, 71]")->get();
        $this->assertIsArray($province);
        $this->assertCount(5, $province);
    }

    public function testGetRegencyByProvinceId()
    {
        $regencies = $this->region->query("regencies with id_province = 33")->get();
        $this->assertIsArray($regencies);
    }

    public function testGetRegencyByProvinceIdInArray()
    {
        $regencies = $this->region->query("regencies with id_province in array [32, 33]")->get();
        $this->assertIsArray($regencies);

        // sum of regencies in province 32 and 33 is 62
        $this->assertCount(62, $regencies);
    }

    public function testGetDistrictByRegencyId()
    {
        $districts = $this->region->query("districts with id_regency = 3302")->get();
        $this->assertIsArray($districts);
    }

    public function testGetVillageByDistrictId()
    {
        $villages = $this->region->query("villages with id_district = 330227")->get();
        $this->assertIsArray($villages);
    }
    
}