use cv_db;

create table IF NOT EXISTS personal_info(
    id int primary key auto_increment,
    name varchar(100) not null,
    title varchar(150) not null,
    email varchar(100) not null,
    phone varchar(20) not null,
    profile_description text not null
);

insert into personal_info(name, title, email, phone, profile_description)
values('Louis Rock', 'Web Developer | Embeded system', 'louis.roques@ynov.com', '0642475418', 'I am, so you are');

create table IF NOT EXISTS admins(
    id int primary key auto_increment,
    username varchar(50) not null UNIQUE,
    email varchar(100) not null UNIQUE,
    password varchar(255) not null
);

insert into admins(username, email, password)
values('admin', 'email@truc.com','$2y$10$ybOP3hulir7vLGAC4A8xUe9nAEAVnGZHsPWcdo7.EWUANkcKwFVLi');
