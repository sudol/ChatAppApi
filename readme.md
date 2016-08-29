# Chat App Api
This is a small demo API for a chat app. This project was created using Vagrant and the [Laravel Homestead](https://laravel.com/docs/5.3/homestead) image. If you don't use Homestead, you'll need to makes sure that your environment meets the [requirements](https://laravel.com/docs/5.3/installation) for Laravel 5.3.

## Deployment
Clone this repo and configure your web server to serve the <code>/public</code> directory.

#### SQLite
You need a sqlite database in <code>/database</code>. From the application root
<pre>touch database/database.sqllite</pre>

#### Migrate & Seed
<pre>
php artisan migrate
php artisan db:seed
</pre>

## Api methods
All the API methods are server from the /api url. e.g /api/users/register, /api/chats <br/>
Routes for all the api methods are in <code>/routes/api.php</code>

## Sample Data
You may use the following API token to make sample calls right away
<pre>
SM3zSL7BLFDT94owSwP0g4kHbfhniyKh7fMU1OEonWMbPYHm8KrySmmRDNgTB8kdrYQWbSneE4E2FRpFK0MeMRDye5QIKYQWvaVKWQZO2xUUnEhG8EoijAvJOyVaRawr6JumIHGYbIUyjo7BjXGg8M6x2QRXqOHdLH7NpuKQ1jLkEpkYYj8It45PRUWRPOXEoZrd0CJAkYBct9yx1x56iwG3MLh74jrUTUs3zd4cqx3ZizTv8fszMVQMTYGZPst
</pre>
