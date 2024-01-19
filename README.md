# Datasheet Search, *Quick Start*

**Note**: This project was started as a school assignment. The days of PHP web applications on LAMP stack are done, and so is this project. Please don't use this project for an actual web application.

---

![Demo GIF](demo.gif)

**Datasheet Search** is a web application designed for efficient electronic component information retrieval, featuring a user-friendly interface and robust backend processing.

## Key Features:
- **Dynamic Page Composition**: Uses MVC pattern for dynamic page rendering.
- **User Authentication**: Supports user registration with robust validation, enabling secure login/logout functionalities.
- **Security Measures**: Implements stringent security protocols to safeguard user inputs and database interactions.
- **Database Interaction**: Allows logged-in users to view, search, and manage database contents.
- **Admin Exclusive Access**: Limits access to special content and control features to admin users.
- **Efficient Searching**: Leverages advanced searching algorithms for quick and accurate results.
- **Custom Design**: Incorporates a unique design with inspirations from various tutorials for an appealing UI.

## Backend Details:
- **User Data Storage**: Users are stored in a database with comprehensive details including username, email, and securely hashed passwords.
- **Session Management**: Custom session ID generation and validation mechanism ensures secure and unique session handling.
- **Database Schema**: Uses MySQL/MariaDB with a well-structured schema, accommodating various entities like users, components, datasheets, and favorites.
- **Style Framework**: Employs [Tailwind CSS](https://tailwindcss.com/) for a responsive and modern UI design.
- **Iconography**: Leverages the open-source [MingCute](https://www.mingcute.com/) icon collection.

## Security Protocols:
- Implements industry-standard security practices to prevent common vulnerabilities like SQL Injection, PHP Code Injection, Session Hijacking, and more.
- Uses `openssl_random_pseudo_bytes()` for secure random value generation.

## AJAX Integration:
- Incorporates AJAX for seamless client-server interactions, enabling features like infinite scrolling for performance-optimized search results.

---

This TL;DR version captures the essence of the web app's capabilities, design, and security features. For detailed information, please refer to `ITALIANO.md.old`.
