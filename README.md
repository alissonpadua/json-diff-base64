## Goal
Create a webservice that provide a service to compare two base64 encoded JSONs.
## Running

 **Step 1** 
 
     git clone https://github.com/alissonpadua/json-diff-base64.git

**Step 2**

    cd json-diff-base64 && composer install

**Step 3**

    cp .env.example .env

**Step 4** Configure the database credentials according to **docker-compose.yml**

## Running Tests

    vendor/bin/phpunit --testdox tests
    or
    php artisan test

## Routes
| Method | URI | Action | Body
|--|--|--|--
| POST | api/v1/diff/{id}/left | App\Http\Controllers\JsonLeftController@store | `{"json_base64": "string"}`
| POST |api/v1/diff/{id}/right|App\Http\Controllers\JsonRightController@store| `{"json_base64": "string"}`
| GET | api/v1/diff/{id} | App\Http\Controllers\JsonCompareController@compare | -
## The Assignment

 1. Provide 2 http endpoints that accepts JSON base64 encoded binary data on both endpoints:
 
			 <host>/v1/diff/<ID>/left
			 <host>/v1/diff/<ID>/right
			 
2. The provided data needs to be diff-ed and the results shall be available on a third end point:

			 <host>/v1/diff/<ID>

3. The results shall provide the following info in JSON format:

- If equal return that
- If not of equal size just return that
- If of same size provide insight in where the diffs are, actual diffs are not needed. So mainly offsets + length in the data
- Make assumptions in the implementation explicit, choices are good but need to be communicated.

4. Must haves
- Internal logic shall be under unit test
- Functionality shall be under integration test
- Documentation in code
- Clear and to the point readme on usage


## Applied Improvements

 1. Relationship between the JSONs (entities)
 2. Validation Unique ID to avoid databases inconsistency 

## Stack / Resources

 - GNU Privacy Guard
 - Git / Github
 - Docker
 - Insomnia
 - Laravel Framework 8.12
 - MySQL
 - API Layer
 - Form Request Validation
 - Custom Validation Rules
 - Services Layer