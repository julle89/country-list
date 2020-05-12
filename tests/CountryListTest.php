<?php
declare(strict_types=1);

namespace Tariq86\CountryList\Tests;

use RuntimeException;
use Tariq86\CountryList\CountryList;
use Tariq86\CountryList\CountryNotFoundException;
use PHPUnit\Framework\TestCase;

class CountryListTest extends TestCase
{
    /**
     * @var CountryList
     */
    private $countryList;

    protected function setUp(): void
    {
        $this->countryList = new CountryList('vendor/umpirsky/country-list/data');
    }

    protected function tearDown(): void
    {
        unset($this->countryList);
        $this->countryList = null;
    }

    /**
     * Test that the data dir will default to the correct path if it is not given
     * @test
     */
    public function constructorWithoutPathTest(): void
    {
        $countryList = new CountryList();
        $this->assertEquals($countryList->getDataDir(), $this->countryList->getDataDir());
    }

    /**
     * Test that an exception is thrown if an invalid data dir is given
     * @test
     */
    public function constructorWithInvalidPathTest(): void
    {
        $this->expectException(RuntimeException::class);
        new CountryList('../blah/blah');
    }

    /**
     * @test
     */
    public function getDataDirTest(): void
    {
        $this->assertEquals(realpath('vendor/umpirsky/country-list/data'), $this->countryList->getDataDir());
    }

    /**
     * @test
     * @throws CountryNotFoundException
     */
    public function getOneTest(): void
    {
        $this->countryList->setList('xx', [
            'php' => [
                'C' => 'Country C',
                'B' => 'Country B',
                'A' => 'Country A',
            ]
        ]);
        $this->assertEquals('Country B', $this->countryList->getOne('B', 'xx'));

        $this->expectException(CountryNotFoundException::class);
        $this->countryList->getOne('D', 'xx');
    }

    /**
     * @test
     */
    public function getListPHPTest(): void
    {
        $this->countryList->setList('xx', [
            'php' => [
                'C' => 'Country C',
                'B' => 'Country B',
                'A' => 'Country A',
            ]
        ]);

        $this->assertEquals(array_keys([
            'A' => 'Country A',
            'B' => 'Country B',
            'C' => 'Country C',
        ]), array_keys($this->countryList->getList('xx')));

        $this->assertNotEquals(array_keys([
            'C' => 'Country C',
            'A' => 'Country A',
            'B' => 'Country B',
        ]), array_keys($this->countryList->getList('xx')));
    }

    /**
     * @test
     */
    public function getListJSONTest(): void
    {
        $this->countryList->setList('xx', [
            'json' => '{"A":"Country A","B":"Country B","C":"Country C"}'
        ]);

        $this->assertEquals(
            '{"A":"Country A","B":"Country B","C":"Country C"}',
            $this->countryList->getList('xx', 'json')
        );
    }

    /**
     * @test
     */
    public function hasTest(): void
    {
        $this->countryList->setList('xx', [
            'php' => [
                'A' => 'Country A',
                'B' => 'Country B',
                'C' => 'Country C',
            ]
        ]);

        $this->assertTrue($this->countryList->has('A', 'xx'));
        $this->assertFalse($this->countryList->has('D', 'xx'));
    }

    /**
     * Test that an exception is thrown if an invalid ISO code is given
     * @test
     */
    public function invalidCountryCodeTest(): void
    {
        $this->expectException(CountryNotFoundException::class);
        $this->countryList->getOne(':)');
    }

    /**
     * Test that an exception is thrown if an invalid locale is given
     * @test
     */
    public function invalidLocaleTest(): void
    {
        $this->expectException(RuntimeException::class);
        $this->countryList->getOne('US', 'BAD_LOCALE');
    }

    public function sortFallbackTest(): void
    {
    }
}
