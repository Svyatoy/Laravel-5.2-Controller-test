define({ "api": [
  {
    "type": "delete",
    "url": "/api/v1.1/albums/:id",
    "title": "Delete Album",
    "group": "Albums",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user_with_permission"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"Successfully deleted\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Album not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Forbidden to delete this album\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/AlbumController.php",
    "groupTitle": "Albums",
    "name": "DeleteApiV11AlbumsId"
  },
  {
    "type": "get",
    "url": "/api/v1.1/albums",
    "title": "All Albums information",
    "group": "Albums",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ],
        "Admin": [
          {
            "group": "Admin",
            "type": "String",
            "optional": false,
            "field": "AdminMiddleware",
            "description": "<p>Only admins can see this. In generated documentation a separate &quot;Admin&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n     \"public\": \"1\",\n     \"user_id\": \"112\",\n     \"created_at\": \"2016-04-10 13:51:21\",\n     \"updated_at\": \"2016-04-10 13:51:21\"\n },\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n     \"public\": \"1\",\n     \"user_id\": \"112\",\n     \"created_at\": \"2016-04-10 13:51:21\",\n     \"updated_at\": \"2016-04-10 13:51:21\"\n },\n]",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/AlbumController.php",
    "groupTitle": "Albums",
    "name": "GetApiV11Albums"
  },
  {
    "type": "get",
    "url": "/api/v1.1/albums/:id",
    "title": "Request Album information",
    "group": "Albums",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Album name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Album description.</p>"
          },
          {
            "group": "Success 200",
            "type": "Bool",
            "optional": false,
            "field": "public",
            "description": "<p>Album visibility attribute.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>Album creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>Album updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n     \"public\": \"1\",\n     \"user_id\": \"112\",\n     \"created_at\": \"2016-04-10 13:51:21\",\n     \"updated_at\": \"2016-04-10 13:51:21\"\n }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Album not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Not Authorized\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/AlbumController.php",
    "groupTitle": "Albums",
    "name": "GetApiV11AlbumsId"
  },
  {
    "type": "post",
    "url": "/api/v1.1/albums",
    "title": "Create Album",
    "group": "Albums",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ],
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory Album name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Mandatory Album description.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "public",
            "description": "<p>Mandatory Album visibility attribute.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"name\": \"Dolor blanditiis aliquid velit nulla quo id velit.\",\n  \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n  \"public\": 0\n}",
          "type": "json"
        }
      ]
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Album name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Album description.</p>"
          },
          {
            "group": "Success 200",
            "type": "Bool",
            "optional": false,
            "field": "public",
            "description": "<p>Album visibility attribute.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>Album creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>Album updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n[\n {\n     \"id\": 103,\n     \"name\": \"Dolor blanditiis aliquid velit nulla quo id velit.\",\n     \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n     \"public\": \"1\",\n     \"user_id\": \"112\",\n     \"created_at\": \"2016-04-10 13:51:21\",\n     \"updated_at\": \"2016-04-10 13:51:21\"\n }\n]",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/AlbumController.php",
    "groupTitle": "Albums",
    "name": "PostApiV11Albums"
  },
  {
    "type": "put",
    "url": "/api/v1.1/albums/:id",
    "title": "Update Album",
    "group": "Albums",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory Album name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Mandatory Album description.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "public",
            "description": "<p>Mandatory Album visibility attribute.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"name\": \"Dolor blanditiis aliquid velit nulla quo id velit.\",\n  \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n  \"public\": 0\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user_with_permission"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Album name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Album description.</p>"
          },
          {
            "group": "Success 200",
            "type": "Bool",
            "optional": false,
            "field": "public",
            "description": "<p>Album visibility attribute.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>Album creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>Album updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n {\n     \"id\": 103,\n     \"name\": \"Dolor blanditiis aliquid velit nulla quo id velit.\",\n     \"description\": \"Eos voluptatem adipisci fuga tempore.\",\n     \"public\": \"1\",\n     \"user_id\": \"112\",\n     \"created_at\": \"2016-04-10 13:51:21\",\n     \"updated_at\": \"2016-04-10 13:51:21\"\n }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Album not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Forbidden to see this album\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/AlbumController.php",
    "groupTitle": "Albums",
    "name": "PutApiV11AlbumsId"
  },
  {
    "type": "get",
    "url": "/authenticate/user",
    "title": "Get authenticated user",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        },
        {
          "title": "Unauthorized Error Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n  \"error\": \"token_expired\"\n}",
          "type": "json"
        },
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_absent\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/TokenController.php",
    "groupTitle": "Authentication",
    "name": "GetAuthenticateUser"
  },
  {
    "type": "get",
    "url": "/logout",
    "title": "Invalidate token",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "token",
            "optional": false,
            "field": "token",
            "description": "<p>New token for authenticated user.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n    \"token\": \"token_value\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_absent\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/TokenController.php",
    "groupTitle": "Authentication",
    "name": "GetLogout"
  },
  {
    "type": "get",
    "url": "/refresh",
    "title": "Refresh token",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n    \"success\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_invalid\"\n}",
          "type": "json"
        },
        {
          "title": "Bad Request Error Response:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token_absent\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/TokenController.php",
    "groupTitle": "Authentication",
    "name": "GetRefresh"
  },
  {
    "type": "post",
    "url": "/authenticate",
    "title": "Create new token",
    "group": "Authentication",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users password</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"email\": \"example@example.com\",\n  \"password\": \"secret\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "token",
            "optional": false,
            "field": "token",
            "description": "<p>New token for user.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"token\": \"token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Unauthorized Error Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n  \"error\": \"invalid_credentials\"\n}",
          "type": "json"
        },
        {
          "title": "Internal Server Error Response:",
          "content": "HTTP/1.1 500 Internal Server Error\n{\n  \"error\": \"could_not_create_token\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/TokenController.php",
    "groupTitle": "Authentication",
    "name": "PostAuthenticate"
  },
  {
    "type": "delete",
    "url": "/api/v1.1/photos/:id",
    "title": "Delete Photo",
    "group": "Photos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user_with_permission"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"Successfully deleted\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Photo not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Not Authorized\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PhotoController.php",
    "groupTitle": "Photos",
    "name": "DeleteApiV11PhotosId"
  },
  {
    "type": "get",
    "url": "/api/v1.1/photos",
    "title": "Get the all photos information",
    "group": "Photos",
    "permission": [
      {
        "name": "admin"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n     {\n         \"id\": 27,\n         \"album_id\": \"168\",\n         \"user_id\": \"109\",\n         \"src\": \"/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png\",\n         \"description\": \"Some dummy description\",\n         \"size\": \"34508\",\n         \"created_at\": \"2016-05-14 17:42:18\",\n         \"updated_at\": \"2016-05-12 16:47:04\"\n     },\n     {\n         \"id\": 28,\n         \"album_id\": \"195\",\n         \"user_id\": \"108\",\n         \"src\": \"/home/user/www/rest-api.com/resources/images/photos/1463062535-postthumb-5-600x400.png\",\n         \"description\": \"Some dummy description\",\n         \"size\": \"34508\",\n         \"created_at\": \"2016-05-14 17:43:07\",\n         \"updated_at\": \"2016-05-12 17:15:35\"\n     },\n]",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PhotoController.php",
    "groupTitle": "Photos",
    "name": "GetApiV11Photos"
  },
  {
    "type": "get",
    "url": "/api/v1.1/photos/:id",
    "title": "Request Photo information",
    "group": "Photos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Photo unique ID.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": 27,\n     \"album_id\": \"168\",\n     \"user_id\": \"109\",\n     \"src\": \"/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png\",\n     \"description\": \"Some dummy description\",\n     \"size\": \"34508\",\n     \"created_at\": \"2016-05-14 17:42:18\",\n     \"updated_at\": \"2016-05-12 16:47:04\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Photo not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Not Authorized\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PhotoController.php",
    "groupTitle": "Photos",
    "name": "GetApiV11PhotosId"
  },
  {
    "type": "get",
    "url": "/api/v1.1/photos/:id/resized",
    "title": "Request Photo resized miniatures information",
    "group": "Photos",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Photo unique ID.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "owner"
      },
      {
        "name": "admin"
      },
      {
        "name": "related_user"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "  HTTP/1.1 200 OK\n[\n   {\n       \"id\": 36,\n       \"size\": \"\",\n       \"photo_id\": \"27\",\n       \"src\": \"/home/user/www/rest-api.com/resources/images/photos/resized_photos/1001463060824-postthumb-5-600x400.png\",\n       \"status\": \"complete\",\n       \"comment\": \"dksdhglkadshgkjhdasghladsg\",\n       \"created_at\": \"2016-05-12 16:47:40\",\n       \"updated_at\": \"2016-05-12 16:47:40\"\n   },\n   {\n       \"id\": 37,\n       \"size\": \"\",\n       \"photo_id\": \"27\",\n       \"src\": \"/home/user/www/rest-api.com/resources/images/photos/resized_photos/4001463060824-postthumb-5-600x400.png\",\n       \"status\": \"complete\",\n       \"comment\": \"dksdhglkadshgkjhdasghladsg\",\n       \"created_at\": \"2016-05-12 16:48:35\",\n       \"updated_at\": \"2016-05-12 16:48:35\"\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Photo not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Resized not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Not Authorized\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PhotoController.php",
    "groupTitle": "Photos",
    "name": "GetApiV11PhotosIdResized"
  },
  {
    "type": "post",
    "url": "/api/v1.1/photos",
    "title": "Create Photo",
    "group": "Photos",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "File",
            "optional": false,
            "field": "image",
            "description": "<p>Photo image.</p>"
          },
          {
            "group": "Parameter",
            "type": "Integer",
            "optional": false,
            "field": "album_id",
            "description": "<p>Photo album id.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Photo description.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n {\n     \"id\": 27,\n     \"album_id\": \"168\",\n     \"user_id\": \"109\",\n     \"src\": \"/home/user/www/rest-api.com/resources/images/photos/1463060824-postthumb-5-600x400.png\",\n     \"description\": \"Some dummy description\",\n     \"size\": \"34508\",\n     \"created_at\": \"2016-05-14 17:42:18\",\n     \"updated_at\": \"2016-05-12 16:47:04\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PhotoController.php",
    "groupTitle": "Photos",
    "name": "PostApiV11Photos"
  },
  {
    "type": "post",
    "url": "/api/v1.1/reset",
    "title": "Generate new reset token",
    "group": "Reset_password",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User's email</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success Response:",
          "content": "HTTP/1.1 201 Created\n{\n    \"data\" : {\n         \"reset password token has been successfully sent to your email\"\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Email Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Email not found\",\n  \"code\": \"404\"\n}",
          "type": "json"
        },
        {
          "title": "Validation Error Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n   \"error\": {\n       \"email\": [\n           \"The email field is required.\"\n       ]\n   },\n   \"code\": 406\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PasswordResetController.php",
    "groupTitle": "Reset_password",
    "name": "PostApiV11Reset"
  },
  {
    "type": "put",
    "url": "/api/v1.1/reset",
    "title": "Change the user's password",
    "group": "Reset_password",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User email</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Users reset token</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>New password</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Reset Token Exists:",
          "content": "HTTP/1.1 200 Ok\n{\n    \"data\" : {\n        \"password successfully updated\"    \n    } \n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "User Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        },
        {
          "title": "Token Not Found:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"token not found\"\n}",
          "type": "json"
        },
        {
          "title": "Token Does not match:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"bed request\"\n}",
          "type": "json"
        },
        {
          "title": "Reset Token Is Expired:",
          "content": "HTTP/1.1 400 Bad Request\n{\n  \"error\": \"token expired\"\n}",
          "type": "json"
        },
        {
          "title": "Validation Error Response:",
          "content": "HTTP/1.1 406 Not Acceptable\n{\n   \"error\": {\n       \"password\": [\n           \"The password field is required.\"\n       ]\n   }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/PasswordResetController.php",
    "groupTitle": "Reset_password",
    "name": "PutApiV11Reset"
  },
  {
    "type": "delete",
    "url": "/api/v1.1/users/:id",
    "title": "Delete User",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ],
        "Admin": [
          {
            "group": "Admin",
            "type": "String",
            "optional": false,
            "field": "AdminMiddleware",
            "description": "<p>Only admins can delete this. In generated documentation a separate &quot;Admin&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"Successfully deleted\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "DeleteApiV11UsersId"
  },
  {
    "type": "get",
    "url": "/api/v1.1/users",
    "title": "All Users information",
    "group": "Users",
    "parameter": {
      "fields": {
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can see this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "admin"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n },\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n }\n]",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "GetApiV11Users"
  },
  {
    "type": "get",
    "url": "/api/v1.1/users/:id",
    "title": "Request User information",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "pass",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "admin"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Forbidden to see this user\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "GetApiV11UsersId"
  },
  {
    "type": "get",
    "url": "/api/v1.1/users/:id/albums",
    "title": "Request User Albums list",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "pass",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ]
      }
    },
    "permission": [
      {
        "name": "admin"
      },
      {
        "name": "owner"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Album unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Album name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Album description.</p>"
          },
          {
            "group": "Success 200",
            "type": "Bool",
            "optional": false,
            "field": "public",
            "description": "<p>Album visibility attribute.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>Album creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>Album updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"availableAlbums\":[\n         {\n            \"id\": 185,\n            \"name\": \"Eligendi voluptas ex qui deserunt in.\",\n            \"description\": \"Quia esse esse laudantium labore itaque autem vitae.\",\n            \"public\": \"0\",\n            \"user_id\": \"110\",\n            \"created_at\": \"2016-04-10 13:51:21\",\n            \"updated_at\": \"2016-04-10 13:51:21\"\n         },\n     ],\n     \"ownAlbums\": [\n         {\n            \"id\": 185,\n            \"name\": \"Eligendi voluptas ex qui deserunt in.\",\n            \"description\": \"Quia esse esse laudantium labore itaque autem vitae.\",\n            \"public\": \"0\",\n            \"user_id\": \"110\",\n            \"created_at\": \"2016-04-10 13:51:21\",\n            \"updated_at\": \"2016-04-10 13:51:21\"\n         },\n     ]\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Forbidden to see albums of this user\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "GetApiV11UsersIdAlbums"
  },
  {
    "type": "post",
    "url": "/api/v1.1/users",
    "title": "Create User",
    "group": "Users",
    "parameter": {
      "fields": {
        "Validation": [
          {
            "group": "Validation",
            "type": "String",
            "optional": false,
            "field": "UserRequest",
            "description": "<p>Only passed validation requests can go here. In generated documentation a separate &quot;Validate&quot; Block will be generated.</p>"
          }
        ],
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory User name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Mandatory Email of the User.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Mandatory User password.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"name\": \"John\",\n  \"email\": \"example@example.com\",\n  \"password\": \"secret\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "201": [
          {
            "group": "201",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "201",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "201",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "201",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "201",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "PostApiV11Users"
  },
  {
    "type": "put",
    "url": "/api/v1.1/users/:id",
    "title": "Update User information",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Mandatory User name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Mandatory Email of the User.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Mandatory User password.</p>"
          }
        ],
        "Login": [
          {
            "group": "Login",
            "type": "String",
            "optional": false,
            "field": "TokenController",
            "description": "<p>Only logged in users can post this. In generated documentation a separate &quot;Login&quot; Block will be generated.</p>"
          }
        ],
        "Validation": [
          {
            "group": "Validation",
            "type": "String",
            "optional": false,
            "field": "UserRequest",
            "description": "<p>Only passed validation requests can go here. In generated documentation a separate &quot;Validate&quot; Block will be generated.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n  \"name\": \"John\",\n  \"email\": \"example@example.com\",\n  \"password\": \"secret\"\n}",
          "type": "json"
        }
      ]
    },
    "permission": [
      {
        "name": "admin"
      },
      {
        "name": "owner"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>Authorization token in bearer format</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Headers Example",
          "content": "{\n   \"Authorization\": \"Bearer token_value\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User unique ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User unique email.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "created_at",
            "description": "<p>User creation ts.</p>"
          },
          {
            "group": "Success 200",
            "type": "Timestamp",
            "optional": false,
            "field": "updated_at",
            "description": "<p>User updating ts.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": 103,\n     \"name\": \"Prof. Carole Schoen MD\",\n     \"email\": \"Gibson.Angelita@example.org\",\n     \"created_at\": \"2016-04-10 13:43:16\",\n     \"updated_at\": \"2016-04-10 13:43:16\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"user not found\"\n}",
          "type": "json"
        },
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 403 Forbidden\n{\n  \"error\": \"Forbidden to update this user\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/app/Http/Controllers/UserController.php",
    "groupTitle": "Users",
    "name": "PutApiV11UsersId"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "/home/svyatoy/www/rest-api.com/public/docs/main.js",
    "group": "_home_svyatoy_www_rest_api_com_public_docs_main_js",
    "groupTitle": "_home_svyatoy_www_rest_api_com_public_docs_main_js",
    "name": ""
  }
] });
