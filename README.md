Project Name:
"Laravel and Neo4j CRUD Operations for School Management System"

Description:
This project involves implementing a comprehensive CRUD (Create, Read, Update, Delete) system for managing School, Subject, and Student entities using Laravel and Neo4j. The implementation follows the repository-service pattern to ensure a clean separation of concerns and scalable architecture.

Requirements:
CRUD Operations:

Implement CRUD operations for each entity (School, Subject, Student) in two ways:
Using Eloquent ORM: Utilize Laravel's Eloquent ORM for database interactions.
Using Cypher Queries: Use Neo4j's Cypher query language for operations on Neo4j.
Entity Relationships:

Student-School: Each student is enrolled in exactly one school.
Student-Subject: A student can register for multiple subjects.
Subject-Student: A subject can be registered by multiple students.
Implementation Details:

Pattern: Use the repository-service pattern for a structured and maintainable codebase.
Pagination: Implement pagination for queries using Cypher to handle large datasets efficiently.
Reporting: Generate a report listing students and their registered subjects using Cypher queries.
Bonus Task:

Docker: Set up the project to run in a Docker container for consistent development and deployment environments.
Summary of Work Done:
CRUD Implementations:

Developed CRUD operations for School, Subject, and Student entities using both Eloquent ORM and Cypher queries.
Implemented relationships where students are linked to a single school and can register for multiple subjects, while subjects can be associated with multiple students.
Pagination and Reporting:

Integrated pagination for Cypher queries to manage large datasets.
Created a report to list students and their enrolled subjects using Cypher.
Docker Setup (Bonus):

Configured Docker to containerize the Laravel and Neo4j environment for consistent setup and deployment.
Documentation:

Created a comprehensive README file detailing the project setup, functionality, and usage.
