<?php
/**
 * Created by PhpStorm.
 * User: Khant Naing Set
 * Date: 8/26/2016
 * Time: 2:24 AM
 */
namespace DataOperation;

return $statement = [ "getdatastatement" => "SELECT zaee.id,zaee.date,zaee.update_time,prices.p_id,rice_prices.r_type1, 
rice_prices.r_type2, rice_prices.r_type3, onion_prices.on_type1,onion_prices.on_type2,
onion_prices.on_type3,oil_prices.o_type1,oil_prices.o_type2,
oil_prices.o_type3,garlic_prices.g_type1,garlic_prices.g_type2,g_type3,
pepper_prices.p_type1,pepper_prices.p_type2,pepper_prices.p_type3
From zaeeapidb.prices
Inner Join zaeeapidb.rice_prices
ON zaeeapidb.prices.rice_prices_id = zaeeapidb.rice_prices.rice_prices_id
Inner Join zaeeapidb.onion_prices
ON zaeeapidb.prices.onion_prices_id = zaeeapidb.onion_prices.onion_prices_id
Inner Join zaeeapidb.zaee
ON zaeeapidb.zaee.p_id = zaeeapidb.prices.p_id
Inner Join zaeeapidb.oil_prices
ON  zaeeapidb.prices.oil_prices_id = zaeeapidb.oil_prices.oil_prices_id
Inner Join zaeeapidb.garlic_prices
ON zaeeapidb.prices.garlic_prices_id = zaeeapidb.garlic_prices.garlic_prices_id 
Inner Join zaeeapidb.pepper_prices
ON zaeeapidb.prices.pepper_prices_id = zaeeapidb.pepper_prices.pepper_prices_id 
Where date = :currentdate AND rice_prices.division = :division
AND onion_prices.division = :division AND oil_prices.division = :division AND garlic_prices.division = :division AND pepper_prices.division = :division  Order by id DESC limit 1 "];