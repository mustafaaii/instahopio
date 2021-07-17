<?php

namespace GoDaddy\WordPress\MWC\Common\Models;

use GoDaddy\WordPress\MWC\Common\Traits\CanBulkAssignPropertiesTrait;
use GoDaddy\WordPress\MWC\Common\Traits\CanConvertToArrayTrait;

/**
 * An object representation of an address.
 *
 * @since x.y.z
 */
class Address
{
    use CanBulkAssignPropertiesTrait;
    use CanConvertToArrayTrait;

    /** @var string[] array of administrative districts */
    private $administrativeDistricts;

    /** @var string business name */
    private $businessName;

    /** @var string 2-letter Unicode CLDR country code */
    private $countryCode;

    /** @var string first name */
    private $firstName;

    /** @var string last name */
    private $lastName;

    /** @var string[] address lines */
    private $lines;

    /** @var string locality */
    private $locality;

    /** @var string postcode */
    private $postalCode;

    /** @var string[] sub-localities */
    private $subLocalities;

    /**
     * Gets the administrative districts.
     *
     * @since x.y.z
     *
     * @return string[]
     */
    public function getAdministrativeDistricts() : array
    {
        return is_array($this->administrativeDistricts) ? $this->administrativeDistricts : [];
    }

    /**
     * Gets the business name.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getBusinessName() : string
    {
        return is_string($this->businessName) ? $this->businessName : '';
    }

    /**
     * Gets the country code.
     *
     * @since x.y.z
     *
     * @return string 2-letter Unicode CLDR country code
     */
    public function getCountryCode() : string
    {
        return is_string($this->countryCode) ? $this->countryCode : '';
    }

    /**
     * Gets the first name.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return is_string($this->firstName) ? $this->firstName : '';
    }

    /**
     * Gets the last name.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getLastName() : string
    {
        return is_string($this->lastName) ? $this->lastName : '';
    }

    /**
     * Gets the address lines.
     *
     * @since x.y.z
     *
     * @return string[]
     */
    public function getLines() : array
    {
        return is_array($this->lines) ? $this->lines : [];
    }

    /**
     * Gets the locality.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getLocality() : string
    {
        return is_string($this->locality) ? $this->locality : '';
    }

    /**
     * Gets the postcode.
     *
     * @since x.y.z
     *
     * @return string
     */
    public function getPostalCode() : string
    {
        return is_string($this->postalCode) ? $this->postalCode : '';
    }

    /**
     * Gets the sub-localities.
     *
     * @since x.y.z
     *
     * @return string[]
     */
    public function getSubLocalities() : array
    {
        return is_array($this->subLocalities) ? $this->subLocalities : [];
    }

    /**
     * Sets the administrative districts.
     *
     * @since x.y.z
     *
     * @param array $administrativeDistricts
     * @return self
     */
    public function setAdministrativeDistricts(array $administrativeDistricts) : Address
    {
        $this->administrativeDistricts = $administrativeDistricts;

        return $this;
    }

    /**
     * Sets the business name.
     *
     * @since x.y.z
     *
     * @param string $businessName
     * @return self
     */
    public function setBusinessName(string $businessName) : Address
    {
        $this->businessName = $businessName;

        return $this;
    }

    /**
     * Sets the country code.
     *
     * @since x.y.z
     *
     * @param string $countryCode a 2-letter Unicode CLDR country code
     * @return self
     */
    public function setCountryCode(string $countryCode) : Address
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Sets the first name.
     *
     * @since x.y.z
     *
     * @param string $firstName
     * @return self
     */
    public function setFirstname(string $firstName) : Address
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Sets the last name.
     *
     * @since x.y.z
     *
     * @param string $lastName
     * @return self
     */
    public function setLastName(string $lastName) : Address
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Sets the address lines.
     *
     * @since x.y.z
     *
     * @param string[] $lines
     * @return self
     */
    public function setLines(array $lines) : Address
    {
        $this->lines = $lines;

        return $this;
    }

    /**
     * Sets the locality.
     *
     * @since x.y.z
     *
     * @param string $locality
     * @return self
     */
    public function setLocality(string $locality) : Address
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Sets the postcode.
     *
     * @since x.y.z
     *
     * @param string $postalCode
     * @return self
     */
    public function setPostalCode(string $postalCode) : Address
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Set the sub-localities.
     *
     * @since x.y.z
     *
     * @param array $subLocalities
     * @return self
     */
    public function setSubLocalities(array $subLocalities) : Address
    {
        $this->subLocalities = $subLocalities;

        return $this;
    }
}
