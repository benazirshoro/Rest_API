PHP Basic Restful API
==============================

#About Project  
The project is developed using:  
Laravel  
PP 7.2.*  
MySql 5.7.*  
Composer 1.7.2  

#API Requirements:  
The API allows its users to:  
list all products  
retrieve a single product  
create a product  
delete a product  
list all product categories  

#Database Requirements:  
The seed data is written in JSON and has translated into SQL before being inserted into MySQL.  

#REST API URLs  
To get list of products  
GET /path/api/products  

To get a single product  
GET /path/api/product/{id}  

To add a new product  
POST /path/api/product  

To update a product  
PUT /path/api/product  

To delete a product  
DELETE /path/api/product/{id}  

To get list of categories  
GET /path/api/categories  

#Where to find code:  
You can find most of the code written by me inside the below folders/files:  
api/Http/Controllers  
api/Http/Resources  
database/seeds  
routes/api.php  
