# Star Wars API Explorer
A web application for viewing *People* data from the [Star Wars API](https://swapi.co/).

## Table of Contents
- [Introduction](#Introduction)
- [Installation](#Installation)
- [Usage](#Usage)

## Introduction
The API Explorer is front-ended by a [React](https://reactjs.org/) application that retrieves data from the back-end [PHP](http://www.php.net/) service.

This service is implemented on the [Lumen](https://lumen.laravel.com/) framework and wraps the [Star Wars API](https://swapi.co/) with a [GraphQL](https://github.com/facebook/graphql) interface.

## Installation
### Prerequisites
* [PHP](http://www.php.net/)
* [Composer](https://getcomposer.org/)
* [Yarn](https://yarnpkg.com/)

### API Service
1. Navigate into the `/star_wars_graphql` directory.
2. Install dependencies via composer:
```
composer install
```
3. 
Start the local PHP server:
```
php -S localhost:8000 -t public
```

### User Interface
1. Navigate into the `/star_wars_ui` directory.
2. Install dependencies via yarn:
```
yarn install
```
3. Create an `.env` file with the following content:
```
REACT_APP_SWAPI_GRAPHQL=http://localhost:8000/api/graphql
```
4.
Start the web application:
```
yarn start
```

## Usage
Once both the API and UI are running, open your browser and navigate to:
```
http://localhost:3000/
```

This will open the Star Wars API Explorer application, upon which you'll be presented with a list of characters to peruse.