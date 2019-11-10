<?php


    $doc = new DOMDocument;
    $doc->load('public/xml_data/user.xml');
    $xpath = new DOMXPath($doc);
    $products = $xpath->query("/Users/User/EMAIL");
    foreach ($products as $product) {
//                echo $product->nodeValue;
    }

//    print_r($products->nodeValue);


    /**
     * @param $file_path
     * @param array $path_to_node
     * @param $node
     */


?>