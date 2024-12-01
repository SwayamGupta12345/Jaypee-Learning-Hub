# Jaypee Learning Hub

**A Web Platform for JIIT Students to Access and Manage Academic Resources**

Welcome to the repository of **Jaypee Learning Hub**, a web application designed for students of Jaypee Institute of Information Technology (JIIT) to access a variety of academic resources including notes, lab materials, previous year question papers, and announcements. The platform features user and admin management systems to ensure seamless interaction and efficient content management.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation Guide](#installation-guide)
- [Usage](#usage)

## Project Overview

The **Jaypee Learning Hub** aims to provide an easy-to-use, secure, and dynamic platform for students at JIIT. It is a one-stop destination for accessing academic materials and interacting with the university's academic ecosystem. The platform includes an admin panel for content management and a responsive design to ensure smooth access on both desktop and mobile devices.

### Features

- **User Authentication**: Students can register and log in to access resources, ensuring that only authorized users can access certain sections.
- **Admin Panel**: Admins can manage the platform's content, including adding, editing, and deleting subjects, resources, and announcements. The admin panel is designed for easy navigation and fast content updates.
- **Resource Management**: The platform supports the addition of various types of resources such as notes, lab materials, and previous year question papers. These resources can be easily accessed and downloaded by students.
- **News & Announcements**: Admins can post news and announcements to keep students up-to-date with the latest information about upcoming events, exam schedules, or other important updates.
- **Responsive Design**: The platform adapts to different screen sizes, ensuring a smooth experience on all devices, including desktops, tablets, and smartphones.
- **Secure User Interaction**: User data is securely managed, with login credentials and sensitive information protected using industry-standard practices.

### Key Pages:

1. **Home Page**: Displays the main features of the platform, such as available academic resources and news.
2. **Login/Registration Page**: Allows users to register or log in to their accounts.
3. **Admin Panel**: Provides functionality for admins to manage subjects, resources, and announcements.
4. **Resource Access Page**: Displays the available resources, categorized by subject, course, or semester.
5. **News and Announcement Page**: Displays the latest news and important announcements.

## Technologies Used

- **Frontend**:
  - **HTML**: Used for the basic structure of the pages.
  - **CSS**: Used for styling the pages, with media queries to make the design responsive.
  - **JavaScript**: Used for adding interactivity and dynamic functionality to the web pages.

- **Backend**:
  - **PHP**: Used for server-side scripting to handle user authentication, resource management, and admin functionalities.
  - **MySQL**: Used for database management, storing user data, resources, and admin information.

- **Version Control**:
  - **Git**: Version control system for tracking changes and collaborating on code.
  - **GitHub**: Hosting platform for managing the project repository.

## Installation Guide

### Prerequisites

To run this project locally, ensure you have the following installed:

- PHP
- MySQL
- A local server like XAMPP or WAMP

### Steps to Set Up

1. **Clone the repository** to your local machine:

   ```bash
   git clone https://github.com/SwayamGupta12345/Jaypee-Learning-Hub.git
   ```

2. **Navigate to the project directory**:

   ```bash
   cd Jaypee-Learning-Hub
   ```

3. **Set up your local database**:
   - Create a new database in MySQL (e.g., `jlh`) at port (`3306`).
 <!---  - Import the provided `.sql` file (located in the project directory) into the database to set up the required tables.--->

4. **Configure the database connection**:
   - Open the `connection.php` file located in the root directory and update the database credentials to match your local environment (e.g., username, password, and database name).

5. **Start your local server** (XAMPP/WAMP) and open the project in your browser:

   ```bash
   http://localhost/Jaypee-Learning-Hub/
   ```

6. **Access the platform**:
   - Use the login page to authenticate as a student or admin.
   - The admin panel can be accessed after login for content management.

## Usage

### For Students:

- **Login**: Students can log in using their credentials to access the platform’s resources.
- **View Resources**: After logging in, students can browse and download resources by subject or course.
- **Check Announcements**: Students can also view important announcements made by the admin.

### For Admins:

- **Login**: Admins can log in to access the admin panel.
- **Manage Resources**: Admins can add new resources, edit existing resources, and delete resources.
- **Manage News and Announcements**: Admins can create, update, or remove news and announcements to keep students informed.
- **Manage Subjects**: Admins can organize the platform’s resources by managing subjects and courses.
