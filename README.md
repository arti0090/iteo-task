1. Run the app with symfony serve
2. Change the services.yaml services to development ready services, current ones are using dummy URL which will not work.

Routes:
/client/new - create new client
/order/new - create new order
/client/{id} - get info about client and its balance


TODO / further improvements:
- ApiClients:
  1. Create a real clients to use the API
  2. Create an env variable (can use env files) and resolve the URL of ERP api for example in constructors

- Testing: Currently the tested services are Validators with specs, it would be advisable to write
Unit tests and make API test cases to check if they work fine

- Saving the entities: I was unsure if this is required by the task (it looks that app is like midleware)
but I think it could be nice to save the entities also on app site, and use Caching (to improve performance between app and ERP)

- It might be better to name ...ApiClient classes to Consumers but it is a thing to discuss

One more note to ApiClients: it could be advisable to use multiple HTTPClients - see https://symfony.com/doc/current/http_client.html#scoping-client