<?php

/**
 * Created by PhpStorm.
 * User: Khant Naing Set
 * Date: 8/22/2016
 * Time: 10:44 PM
 */

namespace DataOperation;



class DataTransaction{

    function encodeFeedDatatoJSON($data){

        $prices = [
            'rice_prices' => [
                'riceType1' => $data['r_type1'],
                'riceType2' => $data['r_type2'],
                'riceType3' => $data['r_type3']
            ],
            'oil_prices' => [
                'oilType1' => $data['o_type1'],
                'oilType2' => $data['o_type2'],
                'oilType3' => $data['o_type3']
            ],
            'onion_prices' => [
                'onionType1'=> $data['on_type1'],
                'onionType2'=> $data['on_type2'],
                'onionType3'=> $data['on_type3']
            ],
            'garlic_prices' => [
                'garlicType1' => $data['g_type1'],
                'garlicType2' => $data['g_type2'],
                'garlicType3' => $data['g_type3']
            ],
            'pepper_prices' => [
                'pepperType1' => $data['p_type1'],
                'pepperType2' => $data['p_type2'],
                'pepperType3' => $data['p_type3'],
            ]
        ];
        //$zaee = new Zaee($data['id'],$data['date'],$data['update_time'],$data['p_id']);
      //  echo $zaee->toString();
    //    echo $prices['rice_prices']['riceType1'];

        $zaee = [
            'id' => $data['id'],
            'date' => $data['date'],
            'updatetime' => $data['update_time'],
            'productprices' => $prices
        ];
        return json_encode($zaee);
    }

    function decodePostDatatoArray($postdata){

        $postdata = json_decode($postdata,true);
        $riceprices = [
            'type1' => $postdata['riceprices']['type1'],
            'type2' => $postdata['riceprices']['type2'],
            'type3' => $postdata['riceprices']['type3'],
            'division' => $postdata['division']
        ];
        $oilprices = [
            'type1' => $postdata['oilprices']['type1'],
            'type2' => $postdata['oilprices']['type2'],
            'type3' => $postdata['oilprices']['type3'],
            'division' => $postdata['division']
        ];
        $onionprices = [
            'type1' => $postdata['onionprices']['type1'],
            'type2' => $postdata['onionprices']['type2'],
            'type3' => $postdata['onionprices']['type3'],
            'division' => $postdata['division']
        ];
        $garlicprices = [
            'type1' => $postdata['garlicprices']['type1'],
            'type2' => $postdata['garlicprices']['type2'],
            'type3' => $postdata['garlicprices']['type3'],
            'division' => $postdata['division']
        ];
        $pepperprices = [
            'type1' => $postdata['pepperprices']['type1'],
            'type2' => $postdata['pepperprices']['type2'],
            'type3' => $postdata['pepperprices']['type3'],
            'division' => $postdata['division']
        ];
        $zaee = [
            "date" => date("Y/m/d"),
            "updatetime" => date("h:i:sa")
        ];

        return $decodedArray = [
            'riceprices' => $riceprices,
            'onionprices' => $onionprices,
            'oilprices' => $oilprices,
            'garlicprices' => $garlicprices,
            'pepperprices' => $pepperprices,
            'zaee' => $zaee,
            'apikey' => $postdata['apikey']
        ];
    }
}

