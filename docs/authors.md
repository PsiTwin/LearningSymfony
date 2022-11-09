# Authors endpoints

## Create Author

Create new author.

**URL** : `/api/authors/`

**Method** : `POST`

**Auth required** : YES

**Permissions required** : None

**Data constraints** :

```json
{
  "name": "[1 to 255 chars]"
}
```

**Data example**

```json
{
  "name": "test_test"
}
```

## Success Response

**Code** : `201 CREATED`

**Content** : No content

# Show Author

Get the details of author by id.

**URL** : `/api/authors/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Author in the
database.

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

## Success Response

**Code** : `200 OK`

**Content** : 

```json
{
  "name": "[1 to 255 chars]",
  "isBanned": bool
}
```

**Content examples**

```json
{
  "name": "test_test",
  "isBanned": true
}
```

# Show Authors list

Show list of Author's with id and name (without banned state)

**URL** : `/api/authors/`

**Method** : `GET`

**Auth required** : YES

**Permissions required** : None

## Success Responses

**Code** : `200 OK`

**Content** : `[]`

**Content examples**

```json
[
  {
    "id": 1,
    "name": "callback_test1"
  },
  {
    "id": 2,
    "name": "qwer_rewq1_3"
  },
  {
    "id": 4,
    "name": "qwer_rewq12_3"
  }
]
```

# Update Author

Update author's attributes. You can change any amount of attributes except "id"

**URL** : `/api/authors/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Author in the
database.

**Method** : `PATCH`

**Auth required** : YES

**Permissions required** : None

**Data constraints**

```json
{
  "name": "[1 to 255 chars]",
  "isBanned": bool
}
```

**Data example**

```json
{
  "name": "callback_test1",
  "isBanned": true
}
```

## Success Responses

**Code** : `200 OK`

**Content** : No content

# Delete Author

Delete selected author

**URL** : `/api/authors/{id}`

**Method** : `DELETE`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Author in the
database.

**Auth required** : YES

**Permissions required** : None

## Success Response

**Code** : `204 NO CONTENT`

**Content** : No content



