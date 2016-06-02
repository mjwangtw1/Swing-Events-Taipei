<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Guzzle\Http\Client;

use App\Http\Requests;
use Symfony\Component\DomCrawler\Crawler;

class CalendarController extends Controller
{
    const MOMO_SEARCH = 'http://www.momomall.com.tw/mmlsearch/searchEg.jsp'; //add .html in the back
    const MOMO_SEARCH_STR = "http://www.momomall.com.tw/mmlsearch/searchEg.jsp?data=米森 蔓越莓麥片searchEngine%22%2C%22data%22%3A%7B%22crossDomain%22%3A%221%22%2C%22dispCnt%22%3A%225%22%2C%22curPage%22%3A%221%22%2C%22cateLevel%22%3A%220%22%2C%22searchGb%22%3A%220%22%2C%22searchType%22%3A%221%22%2C%22searchValue%22%3A%22%25E7%25B1%25B3%25E6%25A3%25AE%2520%25E8%2594%2593%25E8%25B6%258A%25E8%258E%2593%25E9%25BA%25A5%25E7%2589%2587%22%7D%7D&_=1464169808700";


    const PCHOME_SEARCH = 'http://ecshweb.pchome.com.tw/search/v3.3/all/results';
    const YAHOO_SHOPPING = 'https://tw.search.buy.yahoo.com/search/shopping/product?p=';
    const BOOKS_TW_SHOPPING = 'http://search.books.com.tw/exep/prod_search.php?key=';
    const ASAP_SEARCH = 'http://www.asap.com.tw/search';

    //
    public function index()
    {   
        return view('calendar');
    }

    public function try_data($data_string = '米森 蔓越莓麥片')
    {
        //echo 'Trying this shit now.';
        
        $encoded_string = urlencode($data_string); //Only books use encoded string.


        //Now here is the sample:
        $data_string_momo = '%E7%B1%B3%E6%A3%AE-%E8%94%93%E8%B6%8A%E8%8E%93%E9%BA%A5%E7%89%87'; //Momo can't take chinese char.

        $momo_url   = Self::MOMO_SEARCH . $data_string; //MOMO site
        $pchome_url = Self::PCHOME_SEARCH . $data_string; //pchome_works
        $yahoo_url  = Self::YAHOO_SHOPPING . $data_string; //Yahoo also works.

        $books_url  = Self::BOOKS_TW_SHOPPING . $encoded_string;  //Books.com also works

        //$books_url = "http://search.books.com.tw/exep/prod_search.php?key=%E7%B1%B3%E6%A3%AE+%E8%94%93%E8%B6%8A%E8%8E%93%E9%BA%A5%E7%89%87&cat=all";

        //Fetch the page content
        //$momo_content   = file_get_contents($momo_url);
        $pchome_content = file_get_contents($pchome_url);
        $yahoo_content  = file_get_contents($yahoo_url);
        $books_content  = file_get_contents($books_url);

        //Data From Books 
        $crawler = new Crawler($books_content);
        $price_books = $crawler->filter('.cntlisearch08 > .result > .searchbook > .item > .price > b')->text();


        //Data From Yahoo
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', Self::YAHOO_SHOPPING , [
                    'query' => ['p' => $data_string]
                ]);
        $body = $response->getBody();

        $yahoo_crawler = new Crawler($body->getContents());
        $yahoo_price = $yahoo_crawler->filter('#srp_sl_result > #sr > #srp_result_list > .item > .srp-pdcontent >.yui3-g > .yui3-u > .srp-pdmaininfo > .srp-pdprice >em')->text();
        

        //Data From PCHOME
        $pchome_client = new \GuzzleHttp\Client();
        $pchome_response = $pchome_client->request('GET', Self::PCHOME_SEARCH , [
                    'query' => ['q' => $data_string]
                ]);

        $pchome_body = $pchome_response->getBody()->getContents();

        $pchome_result = json_decode($pchome_body, TRUE);

        $pchome_price = $pchome_result['range']['min'];

        //Above this one works
        // array_push(array, var)

        //Data From MOMO
        //$momo_try = file_get_contents($momo_url);
        $momo_client = new \GuzzleHttp\Client(); 
        $momo_response = $momo_client->request('GET', 
            'http://www.momomall.com.tw/mmlsearch/searchEg.jsp?data=%7B%22flag%22%3A%22searchEngine%22%2C%22data%22%3A%7B%22crossDomain%22%3A%221%22%2C%22dispCnt%22%3A%225%22%2C%22curPage%22%3A%221%22%2C%22cateLevel%22%3A%220%22%2C%22searchGb%22%3A%220%22%2C%22searchType%22%3A%221%22%2C%22searchValue%22%3A%22%25E7%25B1%25B3%25E6%25A3%25AE%2520%25E8%2594%2593%25E8%25B6%258A%25E8%258E%2593%25E9%25BA%25A5%25E7%2589%2587%22%7D%7D&_=1464169808700' , [
                    // 'query' => [
                    // "flag"=>"searchEngine",
                    // "data"=>["crossDomain"=>"0","dispCnt"=>"5","curPage"=>"1","cateLevel"=>"0","searchGb"=>"0","searchType"=>"1","searchValue"=> $data_string ]
                    // ],

                ]);

        $momo_body = $momo_response->getBody()->getContents();

        //dd($momo_body);

        $special_patt = '';
        //$result_momo = preg_replace($special_patt, '', $momo_body);

        //$momo_result = json_decode($momo_body);
        //dd($result_momo);


        //$data = 'this is shit man';

        $data[0]['name'] = '博客來';
        $data[0]['price'] = (int) $price_books;
        
        $data[1]['name'] = 'Yahoo';
        $data[1]['price'] =  (int) $yahoo_price;

        $data[2]['name'] = 'PCHOME';
        $data[2]['price'] = (int) $pchome_price;

        //$data[3]['name'] = 'MOMO';

        return view('crawler_demo', compact('data'));

    }

}
