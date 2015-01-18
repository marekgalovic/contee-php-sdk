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

## Accessing API route
Api routes are currently allowed from **Pro plan**. Sdk has method for accessing them. When the route has an option you can pass the parameter in options array and it will be automatically replaced. Every api call returns `Contee\Response\Response` object, which has methods to get content back as raw output, json string, array or object.

```
$contee->get("/site/visits/:option, array(":option"=>"perpage"))->toObject();
```

## Serving content
To match the right content for every one of your customers and rise your earns we need to get it first. The easiest way to do this is use this Sdk. Returns `Contee\Response\Response` which has methods to display as mentoied above.

```
$matched = $contee->createMatched();

$item = $contee->createItem();
$item->setTags(array("tag1", "tag2", "tag3")); //required item to correctly matching
$item->setData(array("name"=>"FOO")); //whatever data you want to get back and display

$matched->setItem($item);
$matched->setResource("email@service.com"); //if resource is not passed contee cookie is used or blank

$contee->getMatched($matched)->toObject();
```

## Emails
Matched emails are similar than the way of serving content mentoied above. Each of thoose emails has content perfectly matched for everyone of your customers. This funcionality requires authorization with **client_id** and **client_secret**.

```
$newsletter = $contee->createNewsletter();

$item = $contee->createItem();
$item->setTags(array("tag1", "tag2", "tag3")); //required item to correctly matching
$item->setData(array("name"=>"FOO")); //whatever data you want to get back and display

$message = $contee->createMessage();
$message->setCustom(array("message" => "Hi there."));
$message->setFromEmail("mail@server.com");
$message->setFromName("Jhon Doe");
$message->setReplyTo("mail@server.com");
$message->setSubject("Whatever subject you want.");
$message->setRecipients(array("recipient@server.com", "another@server.com"));
$message->setTemplate("basic"); //layout must be uploaded and selected.

$newsletter->setMessage($message);
$newsletter->setItem($item);

$contee->sendNewsletter($newsletter)->toObject();
```
