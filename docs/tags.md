# Tags endpoints

## Create Tag

Create new tag.

**URL** : `POST /api/tags/`

**Auth required** : YES

**Permissions required** : None

**Data constraints** :

```json
{
  "name": "[1 to 255 chars]",
  "isHidden": "bool"
}
```

**Data example**

```json
{
  "name": "hyperpop",
  "isHidden": false
}
```

## Success Response

**Code** : `201 CREATED`

**Content** : No content

# Show Tag

Get the details of tag by id.

**URL** : `GET /api/tags/{id}`

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
  "isHidden": "bool"
}
```

**Content examples**

```json
{
  "name": "shoegaze",
  "isHidden": true
}
```

# Show Tags list

Show list of Tag's with id and name (without banned state)

**URL** : `GET /api/tags?hidden={hidden}`

**URL Parameters** :   
    **hidden**: optional, boolean. Can be either true or false

**Auth required** : YES

**Permissions required** : None

## Success Responses

**Code** : `200 OK`

**Content** : 

```json
[
  {
  "id" : "[integer]",
  "name": "[1 to 255 chars]"
  },
  ...
]
```

**Content examples**

```json
[
  {
    "id": 1,
    "name": "hyperpop"
  },
  {
    "id": 2,
    "name": "fridayshitpost"
  },
  {
    "id": 4,
    "name": "Bring The Horizon"
  }
]
```

# Update Tag

Update tag's attributes. You can change any amount of attributes except "id"

**URL** : `PATCH /api/tags/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Tag in the
database.

**Auth required** : YES

**Permissions required** : None

**Data constraints**

```json
{
  "name": "[1 to 255 chars]",
  "isHidden": bool
}
```

**Data example**

```json
{
  "name": "new_tag",
  "isHidden": false
}
```

## Success Responses

**Code** : `200 OK`

**Content** : No content

# Delete Tag

Delete selected tag

**URL** : `DELETE /api/tags/{id}`

**URL Parameters** : `id=[integer]` where `id` is the ID of the Tag in the
database.

**Auth required** : YES

**Permissions required** : None

## Success Response

**Code** : `204 NO CONTENT`

**Content** : No content



