certPath="/app/" # path of the downloaded certificates and keys
# httpHost="https://api.ing.com" # production host
httpHost="https://api.sandbox.ing.com" # sandbox host

reqPath="/oauth2/token"

# clientId path param required for mtls flow
clientId="e77d776b-90af-4684-bebc-521e5b2614dd" # client_id as provided in the documentation

# You can also provide scope parameter in the body E.g. "grant_type=client_credentials&scope=greetings%3Aview"
# scope is an optional parameter. The downloaded certificate contains all available scopes. If you don't provide a scope, the accessToken is returned for all scopes available in certificate
payload="grant_type=client_credentials&client_id=${clientId}"

# Curl request method must be in uppercase e.g "POST", "GET"
response=$(curl -k -X POST "${httpHost}${reqPath}" \
-H 'Accept: application/json' \
-H 'Content-Type: application/x-www-form-urlencoded' \
-d "${payload}" \
--cert "${certPath}example_client_tls.cer" \
--key "${certPath}example_client_tls.key")

echo $response
