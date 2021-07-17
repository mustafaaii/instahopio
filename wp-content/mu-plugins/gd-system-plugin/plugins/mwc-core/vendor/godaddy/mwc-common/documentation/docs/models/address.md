---
id: address
title: Address
---

The `Address` model is a representation of an address as an object.

### Methods

The address object uses the following _private_ properties, which can be accessed via corresponding public getters and setters methods. 

The setters will always return an instance of the address.

| Parameter                	| Type      | Description                                                       |
|--------------------------	|--------	|-------------------------------------------------------------------|
| administrativeDistricts   | string[]  | Administrative districts, if any                                  |
| businessName              | string    | The name of the business at the address, if any                   |
| countryCode               | string    | A 3-letter Unicode CLDR country code                              |
| firstName                 | string    | The first name of the recipient at the address                    |
| lastName                  | string    | The last name of the recipient at the address                     |
| lines                     | string[]  | An array with address lines                                       |
| locality                  | string    | The locality, if any                                              |
| postalCode                | string    | The postcode                                                      |
| subLocalities             | string[]  | Any sub-localities, if applicable                                 |

#### Traits

Additionally, the `Address` model uses the following traits, to handle its properties as arrays:

* [CanBulkAssignPropertiesTrait](/traits/can-bulk-assign-properties)
* [CanConvertToArrayTrait](/traits/can-convert-to-array-trait)