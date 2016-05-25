<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CalendarController extends Controller
{
    const MOMO_SEARCH = 'http://www.momoshop.com.tw/mosearch/'; //add .html in the back
    const PCHOME_SEARCH = 'http://ecshweb.pchome.com.tw/search/v3.3/?q=';
    const YAHOO_SHOPPING = 'https://tw.search.buy.yahoo.com/search/shopping/product?p';
    const BOOKS_TW_SHOPPING = 'http://search.books.com.tw/exep/prod_search.php?key=';

    //
    public function index()
    {   
        return view('calendar');
    }

    public function try_data()
    {
        echo 'Trying this shit now.';

        //Now here is the sample:
        $data_string = '米森 蔓越莓麥片';
        $data_string_momo = '%E7%B1%B3%E6%A3%AE-%E8%94%93%E8%B6%8A%E8%8E%93%E9%BA%A5%E7%89%87'; //Momo can't take chinese char.

        $momo_url   = Self::MOMO_SEARCH . $data_string_momo . '.html'; //MOMO site
        $pchome_url = Self::PCHOME_SEARCH . $data_string; //pchome_works
        $yahoo_url  = Self::YAHOO_SHOPPING . $data_string; //Yahoo also works.
        $books_url  = Self::BOOKS_TW_SHOPPING . $data_string;  //Books.com also works

        //Fetch the page content
        $momo_content   = file_get_contents($momo_url);
        $pchome_content = file_get_contents($pchome_url);
        $yahoo_content  = file_get_contents($yahoo_url);
        $books_content  = file_get_contents($books_url);


        //$yahoo_url = 'http://www.asap.com.tw/item/201604AM060001091';

        //CURL method
        // $ch = curl_init();
        // $timeout = 5;
        // curl_setopt($ch, CURLOPT_URL, $momo_search_url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        // $data = curl_exec($ch);
        // curl_close($ch);

        //HERE then Do the regex.
        //$patt = "/https*:\/\/[a-zA-Z0-9\.\/_]+/";
        //$patt = "/[Pp][Rr][Ii][Cc][Ee]+/";
        //preg_match($patt, $momo_content, $output_array);

        // $patt = '/<div id="searchResults">(.*?)<\/div>/';
        // preg_match_all($patt, $momo_content, $match);


        // $momo_dom = new \DOMDocument();
        // $momo_dom->load($yahoo_url);

        // echo $momo_dom->saveHTML();

        $momo_dom = file_get_html($yahoo_url);

        //preg_match_all('#<span class="money"[^>]*>#i', $momo_content, $match);







        var_dump($momo_dom);

    }

}
