#Banckle.Chat for Laravel

This is a Laravel Package to use Banckle.Chat SDK for PHP in Laravel applications quickly and easily. 


Installation
----------------------------------

Add the following line to your composer.json file.

<pre>
require: {
	"banckle/chat-laravel": "dev-master"
}
</pre>


Run from terminal.

<pre>
composer update
</pre>


Add package to the list of providers. In config/app.php, add the following line to the providers array.
<pre>
'Banckle\Chat\ChatServiceProvider',
</pre>

Publish config files from the terminal.
<pre>
php artisan config:publish banckle/chat-laravel
</pre>

Edit the new config file in the config/packages/banckle/chat-laravel and enter your Banckle API Key, email & password.
<pre>
return array(
    'banckleAccountUri' => 'https://apps.banckle.com/api/v2',
    'banckleChatUri' => 'https://chat.banckle.com/v3',    
    'apiKey' => '',
    'email' => '',
    'password' => ''
);
</pre>

In config/packages/banckle, rename chat-laravel to chat

Usage
----------------------------------

Anywhere in your application when you need to access class, just do:
<pre>
// To Generate token
BanckleChat::getToekn();

BanckleChat::get($apiName, $token);
</pre>

This will return you object of class and you can access properties and methods of class.