# PHP API for Indonesia Region
Why this package? Because this is no need to use database, just use this package and you can get all region in Indonesia

# Usage

## PROVINCE
### Get all province
```php
$province = Region::query("all provinces") -> get();
```

### Get a province by id
```php 
$province = Region::query("province with id = 36") -> get();
```

### Get a province with array id
```php
$province = Region::query("provinces with id in array [36, 51, 34, 61, 71]") -> get();
```

## REGENCY
### Get all regency with id province is 36
```php
$regencies = Region::query("regencies with id_province = 33") -> get();
```

### Get all regency with id province is 32, 33
```php 
$regencies = Region::query("regencies with id_province in array [32, 33]") -> get();
```

## DISTRICT
### Get all district with id regency is 3201
```php 
$districts = Region::query("districts with id_regency = 3302") -> get();
```

## VILLAGE
### get all village with id district is 330227
```php 
$villages = Region::query("villages with id_district = 330227") -> get();
```

