<?php
declare(strict_types=1);

namespace Tariq86\CountryList;

/**
 * CountryNotFoundException
 *
 * @author Yohann Bianchi<yohann.b@lahautesociete.com>
 * @copyright 2015 La Haute Société - http://www.lahautesociete.com/
 */
class CountryNotFoundException extends \Exception
{
	/**
	 * Constructor.
	 *
	 * @param string $countryCode A 2-letter country code
	 */
	public function __construct($countryCode)
	{
		parent::__construct("Country '{$countryCode}' not found.");
	}
}
