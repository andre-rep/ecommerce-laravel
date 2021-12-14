Selecionar Idioma: [Português](https://github.com/andre-rep/laravel-ecommerce-project/blob/master/README-pt.md), **English**
========

## About the Ecommerce

The project is made with Laravel 8, it is a website for a local store that delivers its products.
There are two types of accounts: Admin and Normal User.
It is not possible to create a new Admin account but it is possible to create a normal account for shopping.

## Stack used

For the backend, Laravel 8 and Mysql Workbench are being used for database management. For the front end pure HTML, CSS and Javascript are being used, as well as some libraries for specific functions like Bootstrap 5, Vue.js and Axios for Http requests.

## How to install

After configuring the .env file, just run the command:
```
php artisan migrate --seed
```
The site will already be installed and populated with some products and with the data of a user and an admin.
It is also necessary to link the storage to the storage folder inside public, using the command:
```
php artisan storage:link
```

###### Optional

To **register a new user** it is necessary to use Laravel's mailing library. For this it is necessary to configure the .env file with credentials from an SMTP server, the following example uses settings for gmail:
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
You can put in 'MAIL_USERNAME' and in 'MAIL_PASSWORD' your own email credentials, it works normally. But for security reasons you can also set an app password on your gmail account and put it in 'MAIL_PASSWORD', following the [Tutotial](https://support.google.com/mail/answer/185833?hl=en) , works the same way.

## Login as Admin

Admin already registered\
login: admin@admin.com\
password: 12345

## Login as a Regular User

User already registered\
login: user@user.com\
password: 12345

## Database

The relational database was made with restrictions to link the foreign keys of the tables when necessary.

![alt text](http://andrenascimento.com/external_images/ecommerce/eer-diagram.png)

## Site images

###### Main page

![alt text](http://andrenascimento.com/external_images/ecommerce/main-page-1.png)
![alt text](http://andrenascimento.com/external_images/ecommerce/main-page-2.png)

###### Admin Panel

![alt text](http://andrenascimento.com/external_images/ecommerce/admin-panel.png)

###### Regular User Control Panel

![alt text](http://andrenascimento.com/external_images/ecommerce/user-panel.png)

###### Product

![alt text](http://andrenascimento.com/external_images/ecommerce/product-page.png)
![alt text](http://andrenascimento.com/external_images/ecommerce/product-page-2.png)

## Bugs yet to be fixed and new implementations

- The product search page has a filter on the right side of the page that isn't working yet.
- It remains to add an integration for payment at the end of the purchase. Currently, the user can only make payment when receiving the product.