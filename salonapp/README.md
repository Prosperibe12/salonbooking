# salonapp
PHP based booking application for multi-vendor salon management


## Server Requirements

* PHP >= 7.4

## How to run the application

* create a database `salonappdb` and import the `salonappdb.sql` into the database.

* In the `register.php`, `create_account.php`, `reset_password.php`, 
 `forgot-password.php`, `paymentcallback.php`, `checkout.php`, `dashboard/paystackcallback.php` files, fill in the `$mail->Host`, `$mail->Username `, `$mail->Password`, `$mail->setFrom` with your own email credentials that will be used for sending automated emails. This should be done in all files listed above.

* Run `index.php` file from localhost to view the home page.

* You can click `register` to proceed as a user. A working email address is needed for signup email notification.


##Create account as a service provider:
* On the quick link section of the footer, click on `Provider Register` or
   `Provider Login`
* login url: localhost/salonapp/signin_account.php
* Email: prosperibe12@gmail.com
* Password: 1234567890

                                                
**N.B:-** Be carefull about `Email Setting` which is must needed for sending auto email notification. If you don't complete the `Email Setting` some functionalities will not working properly.

