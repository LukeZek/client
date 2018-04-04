<?php

require '../vendor/autoload.php';

use LukeBozek\ApiClient\Exception\ApiException;
use LukeBozek\ApiClient\Model\Post;
use LukeBozek\ApiClient\Api;


$api = new Api();

try {
    $result = $api->post('/posts', [
            'title' => 'testTitle',
            'body' => 'testBody',
            'userId' => 1

    ]);

    echo 'Added post id:';
    print_r($result->getBody()['id']);

    echo 'Added producer id:';
    // you can use query to get array node
    print_r($result->getDataByQuery('id'));
} catch (ApiException $e) {
    print_r($e->getResponse()->getErrorsMessages());
}

// create post from array
$post = Post::make([
    'title' => 'testTitle',
    'body' => 'testBody',
    'userId' => 1
]);

// use setter
$post->setTitle('new Title');

try {
    $result = $api->post('/posts', $post->getAsArray());

    echo 'Added post id:';
    print_r($result->getBody()['id']);
} catch (ApiException $e) {
    print_r($e->getResponse()->getErrorsMessages());
}
