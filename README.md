# simdChecker
A simple Web App to check the SIMD(Scottish Index of Multiple Deprivation) by post code or (part of) an address.

## Prerequisites
To make it work for you, you will need:
* A PHP server
* A MySQL server
* A Google API key, which has the following APIs enabled:
  * Distance Matrix API
  * Geocoding API
  * Places API

## Installation
1.  Clone the whole project into the htdoc folder (or public_html folder)
1.  Create a MySQL database named as "simd" and import the simd.sql file into it.
1.  In the project main route, create a file named as apikey.txt, copy and paste your API Key inside it.
1.  Edit classes/dbh.php according to your MySQL settings

## Usage
1.  Visit index.html via the PHP server. (e.g. If you are hosting it in your local machine, the path would likely be http://localhost/simdChecker)
1.  Input a post code or (part of) an address in Scotland in the coresponding field
1.  Click the submit button

## TODO
* Click to view individual distance of each Point of Interest
* Improve Error Handling

## Credits
Front End by [@adalaw](https://github.com/adalaw)

Back End by [@kaitockt](https://github.com/kaitockt)

APIs:
* [Google Maps Platform](https://developers.google.com/maps)
* [Postcode.io](https://postcodes.io)


Data Source: [Government of Scotland - Scottish Index of Multiple Deprivation 2020](https://www.gov.scot/collections/scottish-index-of-multiple-deprivation-2020/)

Under the [Open Governmnet Licence](http://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/)
