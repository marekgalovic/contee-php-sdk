# contee-sdk
Software development kit for Contee service. Allows to send newsletters, working with matched data and accessing API routes.

## Instalation
Sdk is developed as composer package. To instal just run:
```
composer install
```
To access API routes, that require authorization you have to pass **client_id** and **client_secret** credentials by **app_id** parameter.

```
$contee = new Contee\Contee(new Contee\Auth\ApiAuth("app_id", "client_id", "client_secret"));
```

## Accessing api route
Api routes are currently allowed from **Pro plan**. Sdk has method for accessing them. When the route has an option you can pass the parameter in options array and it will be automatically replaced. Every api call returns `Contee\Response\Response` object, which has many types of getting the content back.

```
$contee->get("/site/visits/:option, array(":option"=>"perpage"))->toObject();
```

