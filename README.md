# Symfony5-Task-Project
This project implement a RESTFUL API for user, project and task management. A Docker (https://www.docker.com) environment was used for development.

## Available Scripts

In the project directory, you can run:

### `make build`
### `make run`
### `make prepare`

To set up Swagger run
### `make ssh-be`
### composer require api


Runs the app in the development mode.<br />
Open [http://localhost:200/api/v1/docs](http://localhost:200/api/v1/docs) to view it in the browser.

To add a user send a request to: [http://localhost:200/api/v1/user/register]

Example:

{
  "name" : "Name User",
  "email" : "emailuser@email.com",
  "password" : "pasword"
}

