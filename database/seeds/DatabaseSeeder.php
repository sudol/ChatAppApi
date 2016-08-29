<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'         => 1,
            'name'       => 'Paul Sudol',
            'email'      => 'paulsudol@gmail.com',
            'password'   => 'b345b70f73e46dd37c01a71063f8b75c5b8df6eb8b6e52a229034392dc532d3e',
            'api_token'  => 'SM3zSL7BLFDT94owSwP0g4kHbfhniyKh7fMU1OEonWMbPYHm8KrySmmRDNgTB8kdrYQWbSneE4E2FRpFK0MeMRDye5QIKYQWvaVKWQZO2xUUnEhG8EoijAvJOyVaRawr6JumIHGYbIUyjo7BjXGg8M6x2QRXqOHdLH7NpuKQ1jLkEpkYYj8It45PRUWRPOXEoZrd0CJAkYBct9yx1x56iwG3MLh74jrUTUs3zd4cqx3ZizTv8fszMVQMTYGZPst',
            'created_at' => '2016-01-01 00:00:00',
            'updated_at' => '2016-01-01 00:00:00'
        ]);

        DB::table('users')->insert([
            'id'         => 2,
            'name'       => 'Saul Pudol',
            'email'      => 'saulpudol@gmail.com',
            'password'   => '81e24f9c7427b8795df6b448d6061e4be8ee36f162141c1773dc564cde246755',
            'api_token'  => '4UMhnI2BOWrnoTzD8c2n2yeLdawuacON3MsgDcxzQZFmx0hB9wJcTe11OKjKB4z52BYKZpE9AZdnKS9nyaBVWWxkE0N1Ic9NKr3qpgwDBmFJqNQ3ViJMVxS3Wl9YCrqVQroxFCDAVQDevgoXRfCo16fJ9muTR788fBjZeHPEs0VWgpU9uTtT9FRM3RXwYaBTcWQSnIaY6CWynH4p8pgk91hBLNmAZlUySo1Y9uy7ByQqvynJToiX1P6f1u9KWrc',
            'created_at' => '2016-01-02 00:00:00',
            'updated_at' => '2016-01-02 00:00:00'
        ]);

        DB::table('chats')->insert([
            "id"      => 1,
            "user_id" => 1,
            "name"    => "Let's Chat",
            "created" => "2016-01-03T00:00:00Z"
        ]);

        DB::table('chats')->insert([
            "id"      => 2,
            "user_id" => 2,
            "name"    => "No Time to Chat",
            "created" => "2016-01-04T00:00:00Z"
        ]);

        DB::table('messages')->insert([
            "id"      => 1,
            "chat_id" => 1,
            "user_id" => 1,
            "message" => "Hello!",
            "created" => "2016-01-05T00:00:00Z",
        ]);

        DB::table('messages')->insert([
            "id"      => 2,
            "chat_id" => 1,
            "user_id" => 2,
            "message" => "Oh Hi",
            "created" => "2016-01-06T00:00:00Z",
        ]);
    }
}
