<html>
<body>
<?php
/*
    Uses mod-geoip to query the
    MaxMind GeoLite City
    binary database and returns
    geographic information based
    on the client's IP address
*/
$country_code = apache_note("GEOIP_COUNTRY_CODE");
$country_name = apache_note("GEOIP_COUNTRY_NAME");
$city_name = apache_note("GEOIP_CITY");
$region = apache_note("GEOIP_REGION");
$metro_code = apache_note("GEOIP_DMA_CODE");
$area_code = apache_note("GEOIP_AREA_CODE");
$latitude = apache_note("GEOIP_LATITUDE");
$longitude = apache_note("GEOIP_LONGITUDE");
$postal_code = apache_note("GEOIP_POSTAL_CODE");
echo 'Country code: '.$country_code.'<br>';
echo 'Country name: '.$country_name.'<br>';
echo 'City name: '.$city_name.'<br>';
echo 'Region: '.$region.'<br>';
echo 'Metro code: '.$metro_code.'<br>';
echo 'Area code: '.$area_code.'<br>';
echo 'Latitude: '.$latitude.'<br>';
echo 'Longitude: '.$longitude.'<br>';
echo 'Postal code: '.$postal_code.'<br>';
?>
</body>
</html>