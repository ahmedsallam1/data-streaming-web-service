##Json Data Streamer
-
This repository contains a `Symfony` project act as web service
and provide open API to consume data providers `json` files

**Download Project**

`Clone the repository to your local directory`

`cd my-projec/`

**Project Setup**

Normally it will be up and running at `http://127.0.0.1:8080`
in case you prefer another port, please configure `docker-compose.yaml`
```
docker-compose build
docker-compose exec php composer install
docker-compose up
```

**Project Configuration**

please add your own parameters to these file `.env`, `.env.environment`
if you have another `json` file directory, update `PROVIDER_X_JSON_PATH` & `PROVIDER_Y_JSON_PATH`

**Project Testing**
```
docker-compose exec php ./vendor/bin/phpunit
```
**End-point**
```
{
  "/api/users": {
    "get": {
      "parameters": [
        {
          "name": "provider",
          "in": "query",
          "description": "The data provider ex. DataProviderX",
          "type": "string"
        },
        {
          "name": "statusCode",
          "in": "query",
          "description": "Status of user ex. authorised",
          "type": "string"
        },
        {
          "name": "balanceMin",
          "in": "query",
          "description": "minimum balance of user",
          "type": "number"
        },
        {
          "name": "balanceMax",
          "in": "query",
          "description": "maximum balance of user",
          "type": "number"
        }
      ],
      "responses": {
        "200": {
          "description": "Returns list of users",
          "schema": {
            "items": {
              "$ref": "#/definitions/User"
            },
            "type": "array"
          }
        }
      }
    }
  }
}
```
**Example**

`/api/users?statusCode=authorised&provider=DataProviderY&balanceMin=560&balanceMax`

Response
```
[
  {
    "id": "4fc2-a8d1",
    "created_at": "22/12/2018",
    "status": 100,
    "email": "parent200@parent.eu",
    "currency": "USD",
    "balance": 1000.0
  }
]
```

