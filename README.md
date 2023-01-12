## Payload Validator

This documentation demonstrates how to validate the request payload, it uses the rules params to validate the payload. The avaliable rules to be validated are alpha, required, email, number

## Exercise Requirements
The following requirements exists for the endpoint

1. Implement the endpoint to validate the payload, use the rules as the avaliable rules to be validated. IMPLEMENT THE RULES MANULLAY without using standard laravel validation library
2. Your custom validation engine should only support the following rule keys: alpha, required, email, number
3. Add support for multiple validation per key, as each validation rule can be separated by pipe character |
4. Response with a {"status" : true} if validation passes for the payload
5. Respond with standard validation error payload that laravel would hve responded if this validation fails.

## Running the app
* Clone the app:
```
https://github.com/Eazybright/payload-validator.git
```
* `cd payload-validator` into the project folder
* `composer install` to install the dependencies
* `php artisan serve` to serve the application at port 8000
* Open your favourite API testing tool to access the endpoints

## API Documentation

The Postman Collection can be found at: [https://documenter.getpostman.com/view/12783380/2s8ZDR8Rn7](https://documenter.getpostman.com/view/12783380/2s8ZDR8Rn7)

## Running Test

To test the application using PHPUnit, run:
```
./vendor/bin/phpunit 
```
