create database cv_db;
use cv_db;

create table personnel_info(
    id int primary key auto_increment,
    name varchar(100) not null,
    title varchar(150) not null,
    email varchar(100) not null,
    phone varchar(20) not null,
    profile_description text not null,
    hobbies text not null
);

insert into personal_info(name, title, email, phone, profile_description , hobbies)
values('Louis Rock', 'Web Developer | Embeded system', 'louis.roques@ynov.com', '0642475418', 'I am, so you are', 'Tennis | Footing | Video games');

create table admins(
    id int primary key auto_increment,
    username varchar(50) not null UNIQUE,
    password varchar(255) not null
);

insert into admins(username, password)
values('admin', '$2y$10$ybOP3hulir7vLGAC4A8xUe9nAEAVnGZHsPWcdo7.EWUANkcKwFVLi');
