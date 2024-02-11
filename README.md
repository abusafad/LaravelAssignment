# Laravel Assignment Solved By Mahmood alsafadi

This Laravel project provides CRUD (Create, Read, Update, Delete) functionality for managing users. It includes features to save details for each user and is accompanied by test cases to ensure the functionality works as expected.

The project allows users to:

Create new users with their details such as firstname, email, and password...
Read and view a list of users with their details.
Update existing user details.
Delete users from the system.
Additionally, the project includes functionality to save additional details for each user, such as full name, middle initial, avatar, and gender.

To ensure the correctness of the application, comprehensive test cases have been implemented using Laravel's testing framework. These test cases cover various scenarios for creating, reading, updating, and deleting users, as well as verifying the functionality to save user details.


### ✎ Notes

- if you run a test case all data in databace will deleted, If you don't want this to happen please change the DB_DATABASE inside phpunit.xml file to your test Database.
- it_can_upload_photo test case Not Complete.


## Table of Contents

- [Installation](#installation)
- [Testing](#testing)

## Installation

To use this project, follow these steps:

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/abusafad/LaravelAssignment.git
    ```

2. Install the composer dependencies:

    ```bash
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:

    ```bash
    cp .env.example .env
    ```

4. Create a database and configure your `.env` file with the appropriate database credentials.

5. Run the database migrations:

    ```bash
    php artisan migrate
    ```

6. (Optional) Seed the database with initial data:

    ```bash
    php artisan db:seed
    ```
   ** you can login the project use these data **

    email: example@test.com ,
    password: 123456789

7. Start the development server:

    ```bash
    php artisan serve
    ```

Now you can access the application at `http://localhost:8000`.

## Testing

To run the tests for this project, use the following command:

```bash
php artisan test
```

To run the tests for the UserServiceTest, use the following command:

```bash
php artisan test --filter=UserServiceTest
```

To run the tests for the ListenersTest, use the following command:

```bash
php artisan test --filter=ListenersTest
```
