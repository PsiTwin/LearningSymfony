# Tags endpoints

## Create Mashup

Create new Mashup.

**URL** : `POST /api/mashups/`

**Auth required** : YES

**Permissions required** : None

**Data constraints** :

```json
{
  "name": "[1 to 255 chars]",
  "authors": ["array of integers"],
  "tags":["array of integers"]
}
```

**Data example**

```json
{
  "name": "songname",
  "authors": [4, 5],
  "tags": [1, 2]
}
```

## Success Response

**Code** : `201 CREATED`

**Content** : No content

# Show Mashup

Get the details of mashup by id.

**URL** : `GET /api/mashups/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Tag in the
database.

**Auth required** : YES

**Permissions required** : None

## Success Response

**Code** : `200 OK`

**Content** :

```json
{
  "name": "[1 to 255 chars]",
  "authors": [
    {
      "id" : "[integer]",
      "name" : "[1 to 255 chars]"
    },
    ...
  ],
  "tags": [
    {
      "id" : "[integer]",
      "name": "[1 to 255 chars]",
      "is_hidden": bool                                    
    },
    ...
  ]
}
```

**Content examples**

```json
{
  "name": "testsong",
  "authors": [
    {
      "id": "1",
      "name" : "Vasyan"
    },
    {
      "id": "2",
      "name" : "Kolyan"
    }
  ],
  "tags": [
    {
      "id" : 2,
      "name": "fridayshitpost",
      "is_hidden": false
    }
  ]
}
```

# Search Mashups

Search mashups by flags

**URL** : `GET /api/mashups?name={name}&author={author}&tag={tag}`

**URL Parameters** :   
**name**: optional, string.
**author**: optional, string.
**tag**: optional, string. Tag shouldn't be hidden.

**Auth required** : YES

**Permissions required** : None

## Success Responses

**Code** : `200 OK`

**Content** :

```json
{
  "id": "[integer]",
  "name": "[1 to 255 chars]",
  "authors": [
    {
      "id" : "[integer]",
      "name" : "[1 to 255 chars]"
    },
    ...
  ],
  "tags": [
    {
      "id" : "[integer]",
      "name": "[1 to 255 chars]",
      "is_hidden": bool
    },
    ...
  ]
}
```

**Content examples**

```json
[
  {
    "id" : "3",
    "name": "testsong",
    "authors": [
      {
        "id": "1",
        "name" : "Vasyan"
      }
    ],
    "tags": [
      {
        "name": "fridayshitpost",
        "is_hidden": false
      }
    ]
  }
]
```

# Update Mashup

Update mashup's attributes. You can change any amount of attributes except "id"

**URL** : `PATCH /api/mashup/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Mashup in the
database.

**Auth required** : YES

**Permissions required** : None

**Data constraints**

```json
{
  "name": "[1 to 255 chars]",
  "authors": ["array of integers"],
  "tags":["array of integers"]
}
```

**Data example**

```json
{
  "name": "testmashup",
  "authors": [4, 5],
  "tags": [1, 2]
}
```

## Success Responses

**Code** : `200 OK`

**Content** : No content

# Delete Tag

Delete selected mashup

**URL** : `DELETE /api/mashups/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Mashup in the
database.

**Auth required** : YES

**Permissions required** : None

## Success Response

**Code** : `204 NO CONTENT`

**Content** : No content

# Get Mashup Link

Get the details of mashup by id.

**URL** : `GET /api/mashups/download/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Tag in the
database.

**Auth required** : YES

**Permissions required** : None

## Success Response

Provide mediafile by application/octet-stream 