# Lost and Found System

## Team Members
- Marja
- WirraWi
- Jimmy

## Project Overview
This Lost and Found System aims to centralize the process of reporting and finding lost items for students. Traditionally, students would post on platforms like Dcard or Facebook groups, which made the search process inconvenient. This system allows registered users to report lost/found items, manage posts, and search for lost items more efficiently.

## Features

1. **User Registration and Login**:
   - Users must register and log in to the platform to post and manage lost/found items.
   - Admins can verify user identities for security.

2. **Post Lost/Found Items**:
   - Users can post details such as item descriptions, lost/found location, and contact information.

3. **Search Posts (Upcoming Feature)**:
   - A keyword search feature will allow users to search for posts based on item details, time, and location.

4. **Respond to Posts**:
   - Users can respond to posts, either browsing by categories or directly interacting with posts.

5. **Personal Dashboard**:
   - Users can view and manage their own lost/found posts, with options to edit, update, or delete them.

6. **Item Categorization**:
   - Items are categorized (e.g., electronics, personal documents, books) to facilitate search and management.

7. **Matching and Notification System (Partially Implemented)**:
   - The system can automatically match lost and found items and notify users via email.

8. **Admin Post Management**:
   - Admins can manage posts, including editing or deleting inappropriate content.

9. **Automatic Updates**:
   - Once an item is retrieved, the system automatically updates the item's status.

## Data Analysis
The system uses the following data structure:

### Users
- User ID
- Role (Admin, User)
- Personal Info (Name, Contact Details)
- Password

### Items
- Item ID
- Post ID
- Item Status (Searching, Pending Retrieval, Resolved)
- Item Details (Name, Category, Photo)

### Posts
- Post ID
- Poster ID
- Post Purpose (Lost, Found)
- Item Details
- Time of Occurrence (Lost/Found time)

### Notifications
- Notification ID
- Recipient ID
- Content
- Timestamp

### Responses
- Response ID
- Responder ID
- Post ID
- Content

### Locations
- Location ID
- Location Name
- Campus
- Building

## System Installation and Execution

1. Install a local web server, such as XAMPP.
2. Clone the project from GitHub:
   ```bash
   git clone https://github.com/marjasback2bedge/Db_project.git
   ```
3. Locate the `php.ini` file and enable the GD library:
   ```ini
   ;extension=gd → extension=gd
   ```
4. Place the project in the `/XAMPP/htdocs` directory.
5. Open XAMPP and activate Apache and MySQL.
6. Create a database named `project` and execute the `project_DDL.sql` file in `phpMyAdmin`.
7. Access the system via `http://localhost/db_project/`.

### Default Admin Credentials:
- **Username**: `admin`
- **Password**: `adminpassword`

## Interface Usage

- **User Page**: Users can post lost/found items, respond to posts, and manage their contributions.
- **Admin Page**: Admins can manage users, posts, and items, ensuring that the system runs smoothly.

## Planned Improvements
- Add search functionality based on item details.
- Allow users to batch-add multiple items at once.
- Introduce a notification system for responses.
- Allow email notifications in case of failed username verification.

## Team Contributions
- marjasback2bedge: Frontend user interface and system integration.
- WirraWi: Admin interface and system management.
- Jimmy: Database design and backend logic.


## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
```


