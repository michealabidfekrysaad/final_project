# ToFind Project

This Project was created as Graduation Project for 

## Information Technology Institute ITI
### Intake 1

##### Built Using
 PHP
  Laravel
   @laravel Framework,
     Bootstrap, 
       HTML5,
        CSS3 
        JavaScript,
        JQuery,
        and 
        AJAX

### Team Members

##### From Open Source Application Development Track
* Islam Abdelfattah Mohamed (Team Leader) 
* Micheal Abid​
* Islam Mohamed​
* Mohamed Ebrahim​
* Abdelrahman Fahmy​


### All Needed Files and Installation Steps


for Details of ToFind Project In Documentation The Following Link
**_[here](https://drive.google.com/file/d/1Uv2DrqzeGG6YvfsqojHr4OqQHax2WKfk/view)_**

Presentation Of Project In The Following Link
**_[here](https://drive.google.com/file/d/1ugbNoPF3Ad1MwnHtQ2xfn-VjvnyQKg9c/view)_**

### Hardware Requirements
-	PHP > 7.2
-   Composer
-	Laravel 6.2

### Installation
first
```
$ git clone https://github.com/michealabidfekrysaad/final_project.git
```
```
cd final_project
```
1. Install composer dependencies
```
$ composer install
```

2. rename .env.example file to .env 
then edit in .env file with
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
And edit  in .env file
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=tofind.family@gmail.com
MAIL_PASSWORD=tofindfamily1
MAIL_ENCRYPTION=ssl
```
then edit Aws Key
```
AWS_ACCESS_KEY_ID=AKIA5WVDM6FIA5253O7V
AWS_SECRET_ACCESS_KEY=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
AWS_DEFAULT_REGION=us-east-2
```
then edit 
```
QUEUE_DRIVER=database
```
3. Generate APP_KEY
```
$ php artisan key:generate
```
4.Run migrations
```
$php artisan migrate
```
4.Run seeds
```
$php artisan db:seed
```
6. Run server
```
$ php artisan serve
```

