use cv_db;

create table IF NOT EXISTS personal_info(
    id int primary key auto_increment,
    name varchar(100) not null,
    title varchar(150) not null,
    email varchar(100) not null,
    phone varchar(20) not null,
    profile_description text not null,
    education text  not null,
    experience_pro text  not null,
    hobbies text  not NULL,
    skills text  not NULL
);

insert into personal_info(name, title, email, phone, profile_description, education, experience_pro, hobbies, skills)
values('Louis Rock', 'Web Developer | Embeded system', 'louis.roques@ynov.com', '0642475418', 'I am, so you are', 'ynov campus', 'insert solutions', 'Jeux video', 'HTML, CSS, JavaScript, PHP, MySQL');

create table IF NOT EXISTS admins(
    id int primary key auto_increment,
    username varchar(50) not null UNIQUE,
    email varchar(100) not null UNIQUE,
    password varchar(255) not null,
    role varchar(50) not null default 'admin'
);

insert into admins(username, email, password, role)
values('admin', 'email@truc.com','$2y$10$ybOP3hulir7vLGAC4A8xUe9nAEAVnGZHsPWcdo7.EWUANkcKwFVLi', 'admin');

CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    last_login DATETIME DEFAULT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'user'
);

INSERT INTO user (username, email, password, role)
VALUES ('example_user', 'user@example.com', 'user_password_hash', 'user');
