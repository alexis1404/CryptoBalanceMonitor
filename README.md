## README

Endpoints:

`host://wallets GET `- wallet list

`host://wallet/{walletId} GET`- wallet by ID

`host://wallets POST`- Create new wallet

_Exapmle:_


`curl -X POST "http://your_host/api/wallets" \
-H "Content-Type: application/json" \
-d '{
"assetTicker": "LTC",
"walletId": "RRUZ67",
"address": "ltc1qfawcr04985w4cc8qdpv9adyr6aq2sp7ku3hevy"
}'`

* assetTicker - BTC, ETH or LTC supported
* walletId - unique wallet identifier (for example, RRUZ67) (string)
* address - network address
