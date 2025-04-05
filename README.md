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

**WARNING!**
Cron debug disabling: add to .env this:

`CRON_DEBUG_DISABLE=true`

**Add to .env:**

BTC_EXPLORER=https://blockchain.info
LTC_EXPLORER=https://api.blockcypher.com

ETH_EXPLORER=https://api.etherscan.io
ETH_EXPLORER_API_KEY=YOUR_API_KEY

**Примерчание:**
Blockchain и blockcypher использованы потому, что на https://blockchair.com/ мой IP давным-давно в блэклисте (очевидно, нагрузку на свой API они восприняли как попытку из задудосить)
