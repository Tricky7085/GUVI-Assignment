# GUVI-Assignment
This is a web application that allows users to register, log in, and manage their profiles. The application uses HTML, CSS, JavaScript, PHP, and databases such as MySQL for user registration data and MongoDB for user profiles.

## Features

- User Registration: Users can sign up with a username, email, and password. The registration data is stored in a MySQL database using prepared statements for security.

- User Login: Registered users can log in using their credentials, and their session is managed with Redis. The login data is validated against the MySQL database.

- User Profile: Upon successful login, users are directed to a profile page where they can view and update their profile information. User profile data, including age, date of birth (DOB), and contact information, is stored in a MongoDB collection.

- **index.html**: Home page.
- **login.html**: Login page.
- **profile.html**: User profile page.
- **register.html**: Registration page.

## Setup

1. **Database Setup**:
   - MySQL: Create a MySQL database for user registration data.
   - MongoDB: Create a MongoDB collection for user profiles.

2. **Redis Setup**: Install and configure Redis for session management.

3. **Deployment**:
   - Host your web application on a server with PHP and the necessary extensions.
   - Ensure the database connections and configurations are set up.

## Usage

1. Access the application via the `index.html` page.
2. Register a new user with a valid username, email, and password.
3. Log in with the registered credentials.
4. Update your user profile information on the `profile.html` page.
