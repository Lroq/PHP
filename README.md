# TP - CV Project

## Context
As part of the PHP course, we will develop a web project. The goal is to create multiple pages and persist data while following best practices.

- **Red**: High Priority
- **Magenta**: Do not prioritize for now

## Instructions
You need to create a CV/Portfolio website consisting of several pages with various features to manage CVs/Portfolios.

## Submission Guidelines
To evaluate the quality of your work, you must submit a GitHub link in the following format: `https://github.com/Lroq/PHP`.
Someone who has never worked with PHP should be able to start your project.

## Expected Content

### Website Pages
Your website must include at least the following pages:
- A static landing page (homepage)
- A contact page
- An editable CV page (see code examples from the course)
- A projects listing page
- A login page (see code examples from the course)
- A logout page (see code examples from the course)
- A profile page
- An "Admin Panel" page

### Website Features
To have your project validated, the following features must be implemented:

#### General
- Your site must have a header and footer.
- Navigation should be done through a menu.
- Once logged in, the user’s first and last name should appear on the interface.

#### Contact
- The contact page should display a form that sends emails.
- The contact page should also show a map representing your city.

#### Authentication
- Users should be able to log in and log out.
- Users should be able to add other users (with roles).

#### CV
- When logged in, users should see their CV information.
- Logged-in users should be able to edit their CV information.
- Logged-in users should be able to customize the CV page style.
- Any user should be able to select a CV to display.
- Any user should be able to download a CV as a PDF.

#### Projects/Portfolio
- Logged-in users should be able to add projects.
- Admins should be able to customize the style of the Projects/Portfolio page.
- Users should be able to mark projects as favorites.
- Users should be able to search through projects.
- Users should be able to add comments to projects.
- Projects must be approved by an admin before they are visible.

#### Profile
- Logged-in users should be able to edit their profile information.

#### Admin Panel
- Admins should be able to manage users.
- Admins should be able to manage projects.

### Objects
Below are the minimum expected objects and associated data:

- **User**:
  - email
  - first_name
  - last_name
  - password
  - role

- **CV**:
  - title
  - description
  - skills (skill: title, description, years_of_experience)
  - experiences (experience: title, start_date, end_date)
  - education (education: school, start_date, end_date)

- **Project**:
  - title
  - description
  - image

## Tools

### Bootstrap
A CSS framework providing ready-to-use components and utility classes.
Alternative: Tailwind

### jQuery
A simplified JavaScript library for interacting with the DOM.

### SweetAlert2
A JavaScript library for creating beautiful alerts.

### Notie / Toastr
JavaScript libraries for creating stylish toast notifications.
