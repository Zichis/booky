## About this project

This project has API endpoints for CRUD for a book model. 
- Create /api/v1/books POST
- Read /api/v1/books GET
- Update /api/v1/books/:id PATCH
- Show /api/v1/books/:id GET
- Delete /api/v1/books/:id DELETE

It also has an endpoint that gets data from [FireAndIce API](https://anapioficeandfire.com/).
- Read api/external-books GET

### Stack
- [Laravel](https://laravel.com/) (Backend)
- [VueJs](https://vuejs.org/) (Frontend)

### Installation and setup
- Clone the repository  
`git clone https://github.com/Zichis/booky.git`

- CD into the project directory and run composer install  
`composer install`

- Copy .env.example to .env  
`cp .env.example .env`

- Change the MIX_API_URL_ROOT variable in your .env to suit your server. (**IMPORTANT**)

- Generate application key  
`php artisan key:generate`

- Create mysql database with the name **fireandice** (or you can change the name in your .env)

- Also enter your database password in .env

- Run migrations  
`php artisan migrate`

- Run your app  
`php artisan serve`

- Visit localhost:8000 (or the host you configured)

### Testing
- Create a database for testing with the name **fireandice_test** (or you can change the name in your .env)

- Run tests  
`composer app-test`
