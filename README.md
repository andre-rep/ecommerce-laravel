Select Language: [Portuguese](https://github.com/andrenasc25/ecommerce-laravel/blob/master/README-pt.md), **English**
========

<h1 align="center">Ecommerce Laravel</h1>
<p align="center">An Ecommerce project made with Laravel and Vuejs</p>

<h4 align="center"> 
	🚀 Under construction...  🚧
</h4>

## About the Ecommerce

The project is made with Laravel 8, it is a website for a local store that delivers its products.
There are two types of accounts: Admin and Regular User.
It is not possible to create a new Admin account but it is possible to create a normal account for shopping.

## Technologies used

For the backend, Laravel 8 and Mysql Workbench are being used for database management. For the front end, pure Html, CSS and Javascript are being used, in addition to some libraries for specific functions such as Bootstrap 5, Vue.js and Axios for Http requests.

## How to install

After configuring the .env file, just run the command:
```
php artisan migrate --seed
```
The site will already be installed and populated with some products and with the data of a user and an admin.
It is also necessary to link the storage to the storage folder within public, using the command:
```
php artisan storage:link
```

###### Optional

To do a **new user registration** it is necessary to use the Laravel email sending library. For this it is necessary to configure the .env file with credentials of an smtp server, the following example uses settings for gmail:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.googlemail.com
MAIL_PORT=465
MAIL_USERNAME=address@email.com
MAIL_PASSWORD=emailpassword
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```
You can put your own email credentials in 'MAIL_USERNAME' and 'MAIL_PASSWORD', it works normally. But for security reasons, you can also configure an app password in your gmail account and put it in 'MAIL_PASSWORD', following the [Tutorial](https://support.google.com/mail/answer/185833), it works the same way.

## Login as Admin

Admin already registered\
login: admin@admin.com\
password: 12345

## Login as Regular User

Already registered User\
login: user@user.com\
password: 12345

## Database

The relational database was built with restrictions to link the foreign keys of the tables when necessary.

![Eer Diagram](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/eer-diagram.png)

## Website Images

###### Main Page

![Main Page 1](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/main-page-1.png)
![Main Page 2](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/main-page-2.png)

###### Admin Panel

![Admin Panel](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/admin-panel.png)

###### Control Panel for Regular User

![User Panel](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/user-panel.png)

###### Product

![Product Page](https://raw.githubusercontent.com/andrenasc25/ecommerce-laravel/master/public/andrenasc25/product-page.png)

## Bugs yet to be fixed and new implementations

- The product search page has a filter on the right side of the page that is still not working
- It lacks to add an integration for payment at the end of the purchase. Currently the user can only make payment when receiving the product.