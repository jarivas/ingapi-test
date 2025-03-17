certPath="/app/" # path of the downloaded certificates and keys
# httpHost="https://api.ing.com" # production host
httpHost="https://api.sandbox.ing.com" # sandbox host

reqPath="/oauth2/token"

# clientId path param required for mtls flow
clientId="e77d776b-90af-4684-bebc-521e5b2614dd" # client_id as provided in the documentation
reqDate=$(LC_TIME=en_US.UTF-8 date -u "+%a, %d %b %Y %H:%M:%S GMT")

# You can also provide scope parameter in the body E.g. "grant_type=client_credentials&scope=greetings%3Aview"
# scope is an optional parameter. The downloaded certificate contains all available scopes. If you don't provide a scope, the accessToken is returned for all scopes available in certificate
payload="grant_type=client_credentials"
payloadDigest=`echo -n "$payload" | openssl dgst -binary -sha256 | openssl base64`
digest=SHA-256=$payloadDigest
httpMethod="post"
reqPath="/oauth2/token"
signingString="(request-target): $httpMethod $reqPath
date: $reqDate
digest: $digest"
signature=`printf %s "$signingString" | openssl dgst -sha256 -sign "${certPath}example_client_signing.key" -passin "pass:changeit" | openssl base64 -A`

# Curl request method must be in uppercase e.g "POST", "GET"
curl -k -X POST "${httpHost}${reqPath}" \
-H 'Accept: application/json' \
-H 'Content-Type: application/x-www-form-urlencoded' \
-H "Digest: ${digest}" \
-H "Date: ${reqDate}" \
-H "authorization: Signature keyId=\"$clientId\",algorithm=\"rsa-sha256\",headers=\"(request-target) date digest\",signature=\"$signature\"" \
-d "${payload}" \
--cert "${certPath}example_client_tls.cer" \
--key "${certPath}example_client_tls.key"
