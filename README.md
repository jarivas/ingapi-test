# ING API TEST

## DEV REQUIREMENTS
Docker
```bash
cp .env.example .env
./setup-githook.sh
```

## DEV RECOMMENDATIONS
* VSCode + Microsoft Dev Containers plugin, so the environment will be configured in the same way, with the same tools

## HOW TO RUN
```bash
./vendor/bin/phpunit --stop-on-failure --stop-on-error
```

## CHALLENGES
I think more time consuming task is to format the signing, I have spent a good chunk of time finding the an issue,
2 tabs where added by the IDE and were "invisble", finally I did realize tabs in front of Date: $date and Digest: $digest
and getAccessToken worked.
