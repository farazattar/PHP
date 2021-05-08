<form action="" method="post">
<input type="text" class="url" name="url">
<button>import</button>
</form>

<?php
if($_SERVER['REQUEST_METHOD'] != "POST") {
    die();
}


include "vendor/autoload.php";
use Goutte\Client;

$client = new Client();

// $productPage = 'https://www.digikala.com/product/dkp-357615/%D8%A7%D8%AF%D9%88-%D9%BE%D8%B1%D9%81%DB%8C%D9%88%D9%85-%D8%B2%D9%86%D8%A7%D9%86%D9%87-%D9%BE%D8%B1%D9%81%DB%8C%D9%88%D9%85-%D8%AF%D9%84%D9%88%DA%A9%D8%B3-%D9%85%D8%AF%D9%84-midnight-deluxe-%D8%AD%D8%AC%D9%85-100-%D9%85%DB%8C%D9%84%DB%8C-%D9%84%DB%8C%D8%AA%D8%B1#/tab-params';
// $productPage = 'https://www.digikala.com/product/dkp-3056905/%D9%85%D8%AA%D8%B1-3-%D9%85%D8%AA%D8%B1%DB%8C-%D8%A7%D8%B3%D8%AA%D9%86%D9%84%DB%8C-%DA%A9%D8%AF-s40#/tab-params';
// $productPage2 = 'https://www.digikala.com/product/dkp-2387248/%D9%BE%D9%88%D8%B4%DA%A9-%D9%85%D8%B1%D8%B3%DB%8C-%D9%85%D8%AF%D9%84-perfect-%D8%B3%D8%A7%DB%8C%D8%B2-4-%D8%A8%D8%B3%D8%AA%D9%87-44-%D8%B9%D8%AF%D8%AF%DB%8C-%D8%A8%D9%87-%D9%87%D9%85%D8%B1%D8%A7%D9%87-%D8%AF%D8%B3%D8%AA%D9%85%D8%A7%D9%84-%D9%85%D8%B1%D8%B7%D9%88%D8%A8#/tab-params';

$productPage = $_POST['url'];
$crawler = $client->request('GET', $productPage);

$productData = [];

$productData['fa-title'] = $crawler->filter('.c-product__title')->text();
try{
    $productData['en-title'] = $crawler->filter('.c-product__title-en')->text();
}catch(Exception $exception){
    $productData['en-title'] = null;
}

$crawler->filter('ul.c-params__list li')->each(function ($node){
    global $productData;
    $key = $node->filter('.c-params__list-key')->text();
    $value = $node->filter('.c-params__list-value')->text();
    $productData['params'][$key] = $value;
});


var_dump($productData);
# insert productData in Database
# or write into json filter
$productDataJson = json_encode($productData);
file_put_contents($productData['fa-title'] . '.json',$productDataJson);