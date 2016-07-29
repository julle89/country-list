<?php

use PHPUnit\Framework\TestCase;
use Tariq86\CountryList\CountryList;
use Tariq86\CountryList\CountryNotFoundException;

class CountryListTest extends TestCase
{
    public $countryList;
    private $_testCountryCode = 'US';
    private $_testCountryName = 'United States';

    public function setUp() {
        $this->countryList = new CountryList();
    }

    /** @test */
    public function class_can_be_instantiated() {
        $this->assertInstanceOf(CountryList::class, $this->countryList);
    }

    /** @test */
    public function constructor_sets_data_directory() {
        $this->assertAttributeNotEmpty('dataDir', $this->countryList);
    }

    /** @test */
    public function it_can_get_one_country() {
        $this->assertEquals($this->_testCountryName, $this->countryList->getOne($this->_testCountryCode, 'en'));
    }

    /** @test */
    public function it_can_return_json() {
        $decoded = json_decode($this->countryList->getList('en', 'json'));
        $this->assertEquals($decoded->{$this->_testCountryCode}, $this->_testCountryName);
    }

    /** @test */
    public function it_can_return_php() {
        $this->assertArrayHasKey($this->_testCountryCode, $this->countryList->getList('en', 'php'));
    }

    /** @test */
    public function it_can_return_csv() {
        $countries = str_getcsv($this->countryList->getList('en', 'csv'), "\n");
        if (is_array($countries)) {
            array_shift($countries);
            $c = [];
            foreach ($countries as $country) {
                $x = explode(',', $country);
                $c[$x[0]] = preg_replace('/\"/', '', $x[1]);
            }
            $countries = $c;
        }
        $this->assertArrayHasKey($this->_testCountryCode, $countries);
    }

    /** @test */
    public function it_can_check_for_a_country() {
        $this->assertTrue($this->countryList->has($this->_testCountryCode));
    }

    /** @test */
    public function it_throws_an_exception_for_invalid_country() {
        $this->expectException(CountryNotFoundException::class);
        $this->countryList->getOne('asdne');
    }

}
