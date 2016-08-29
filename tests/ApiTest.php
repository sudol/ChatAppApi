<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }

    /**
     * Redirect unauthenicated users
     */
    public function testMustBeAuthenticated()
    {
        $response = $this->call('GET', '/api/users/me');
        $this->assertResponseStatus(302);
    }

    public function testLogin()
    {

        $postData = ["email" => "saulpudol@gmail.com", "password" => "test124"];
        $response = $this->call('POST', '/api/users/login', $postData);

        $seededData = (object) [
            'id' => 2,
            'name'       => 'Saul Pudol',
            'email'      => 'saulpudol@gmail.com',
            'api_token'  => '4UMhnI2BOWrnoTzD8c2n2yeLdawuacON3MsgDcxzQZFmx0hB9wJcTe11OKjKB4z52BYKZpE9AZdnKS9nyaBVWWxkE0N1Ic9NKr3qpgwDBmFJqNQ3ViJMVxS3Wl9YCrqVQroxFCDAVQDevgoXRfCo16fJ9muTR788fBjZeHPEs0VWgpU9uTtT9FRM3RXwYaBTcWQSnIaY6CWynH4p8pgk91hBLNmAZlUySo1Y9uy7ByQqvynJToiX1P6f1u9KWrc'
        ];

        $jsonData = json_decode($response->getContent());
        $this->assertEquals($jsonData->data, $seededData);
    }


}
