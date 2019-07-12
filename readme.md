<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About AdvancedMessenger

This is a realtime chatting application built with laravel framework and vue js.This application also include dependencies such as 
        1."@fortawesome/fontawesome-free": "^5.9.0",
        2."emoji-mart-vue-fast": "^5.4.14",
        3."laravel-echo": "^1.5.3",
        4."pusher-js": "^4.4.0",
        5."v-toaster": "^1.0.3",
        6."vform": "^1.0.1",
        7."vue-chat-scroll": "^1.3.5",
        8."vue-upload-component": "^2.8.20"
Real time communication made possible by using laravel echo to broadcast messages through specified channels and event/listeners for notification.Pusher js is used to track client events.This application can also be used for file sharing and user can send emoji along with text in real time.

## Installation
        1.Clone the project in your root folder
        2.Update composer
        3.copy .env from .env-example
        4.set up database credential in your .env file
        5.Create a new app in pusher and set up app credentials in your .env file
        6.Install pusher via composer(composer require pusher/pusher-php-server "~4.0")
        7.Install fontawesome via npm(npm i --save @fortawesome/fontawesome-free)
        8.Install v-toaster
        9.Install vform
        10.Instal vue-chat-scroll
        11.Install vue-upload-component
        12.Install emoji-mart-vue-fast
        



## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
