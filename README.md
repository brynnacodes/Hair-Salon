# _Scissorhands Salon_

#### _A web app build to manage, edit, and delete stylist and client information using a msql database.  02/24/17_

#### By _**Brynna Klamkin-McCarter**_

## Description

_This web app allows salon owners to add new stylists, view the clients associated with each stylist, and edit and/or delete information about both._

## Database Setup Commands
* _In the msql shell run the following commmands_
* _CREATE DATABASE hair_salon;_
* _USE hair_salon;_
* _CREATE TABLE stylists(id serial PRIMARY KEY, name VARCHAR (255), description VARCHAR (255));_
* _CREATE TABLE clients(id serial PRIMARY KEY, name VARCHAR (255), phone INT, stylist_id INT);_
* _Navigate to localhost:8888/phpmyadmin and click on hair_salon, then operations, then copy the database to a new database named hair_salon_test;_

## Setup/Installation Requirements

* _Clone this repository to your device_
* _Start MAMP or other combination of Apache server and MySQL, and make sure the port is set to localhost:8889_
* _Install composer in the project folder_
* _Navigate to the web folder and start a development server at localhost:8000_
* _Navigate to localhost:8000 in your preferred web browser_

## Known Bugs

_No known bugs_

## Support and contact details

_Please contact Brynna Klamkin-McCarter for questions, support, or suggestions_

## Technologies Used

* _PHP_
* _Twig_
* _Silex_
* _MySQL_
* _Composer_
* _phpUnit_
* _Bootstrap/CSS_

### License

*This software is licensed under the MIT license*

Copyright (c) 2017 **_Brynna Klamkin-McCarter_**
