<?php

require '../vendor/autoload.php';

use LukeBozek\ApiClient\Exception\ApiException;
use LukeBozek\ApiClient\Util\Collection;
use LukeBozek\ApiClient\Api;

// create api client. You can pass login and password if required
$api = new Api();

try {
    // make request
    $response = $api->get('/posts');

    // make collection from response data
    $posts = Collection::makeFromArray($response->getBody());

    echo 'Number of posts in the database: ' . $posts->count() . '<br>';

    // get post iterator
    $postsIterator = $posts->getIterator();

    for ($postsIterator->rewind(); $postsIterator->valid(); $postsIterator->next()) {
        echo $postsIterator->current()['title'] . '<br>';
    }
} catch (ApiException $e) {
    var_dump($e->getResponse()->getErrorsMessages());
}
