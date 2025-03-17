# ASSIGNMENT

## DEV REQUIREMENTS
Docker

## DEV INSTALL
```bash
cp .env.example .env
docker compose up -d
./setup-githook.sh
composer install
```

## DEV RECOMMENDATIONS
* VSCode + Microsoft Dev Containers plugin, so the environment will be configured in the same way, with the same tools

## ING API TEST

### HOW TO RUN
```bash
./vendor/bin/phpunit --stop-on-failure --stop-on-error
```

### USAGE
An example of how the library is use, please check **tests/CreatePaymentRequestTest.php**
* all the config data is passed using a data class
* the data use in the data class comes from a .env file
* a **Psr\Log\LoggerInterface** object should be also injected during object creation, so the user can decide how to log errors
* a CreatePayment data class is used as only parameter on **createPaymentRequest** method so no typing problem will occur

### CHALLENGES
I think more time consuming tasks were first, to format the signing, I have spent a good chunk of time finding the an issue,
2 tabs where added by the IDE and were "invisble", finally I did realize tabs in front of Date: $date and Digest: $digest
and getAccessToken worked, and second realizing that using the signed method to get the access token returns and invalid token.


## TEST TOOLS
* The toolstest class is on src
* The tests are used to show how it works
