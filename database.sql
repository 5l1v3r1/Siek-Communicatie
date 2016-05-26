-- Add user
CREATE USER 'siek'@'localhost' IDENTIFIED BY '';

-- Create the database
create database if not exists `Siek`;
use `Siek`;

-- Permissions
GRANT INSERT ON `Siek`.* TO 'siek'@'localhost';
GRANT SELECT ON `Siek`.* TO 'siek'@'localhost';
GRANT DELETE ON `Siek`.* TO 'siek'@'localhost';
GRANT UPDATE ON `Siek`.* TO 'siek'@'localhost';

-- Credits
-- The credits are shown in the source
-- There might alternatively be a page with credits later on during development.
-- Status: currently in use [all pages]
create table if not exists `tblCredits` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `email` varchar(45) NOT NULL,
    `description` varchar(128) DEFAULT '',
    PRIMARY KEY (`id`)
);


-- The team
-- All team members with their corresponding titles with text
-- Status: currently in use [index, team]
create table if not exists `tblTeam` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `url` varchar(32) NOT NULL,
    `name` varchar(32) NOT NULL,
    `title` varchar(32) DEFAULT '',
    `text` TEXT,
    primary key (`id`)
);


-- References
-- All reference quotes.
-- Status: currently in use [index]
create table if not exists `tblReferences` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `quote` varchar(64) NOT NULL,
    `author` varchar(32) NOT NULL ,
    `source` varchar(64) DEFAULT NULL,
    `date` datetime default null,
    primary key (`id`)
);


-- Content
-- Text related content for the pages.
-- This will contain NO HTML.
-- Status: currently in use [all pages]
create table if not exists `tblContent` (
    `id` int(11) not null auto_increment,
    `text` text not null,
    `page` varchar(32) not null,
    `section` varchar(32) not null,
    `textarea` TINYINT(1) ZEROFILL NOT NULL DEFAULT 1,
    `lastUpdated` timestamp default now() on update now(),
    `lastUpdatedBy` int(11),
    primary key (`id`)
);


-- Contact
-- This is for the main contact form on the homepage, or any forms that are EXACTLY the same as on the homepage.
-- All other forms of contact like bug reports or tickets should be stored somewhere else.
-- Status: currently in use [homepage]
create table if not exists `tblContact` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ip` varchar(45) NOT NULL,
    `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `email` varchar(45) NOT NULL,
    `subject` varchar(45) NOT NULL,
    `message` text NOT NULL ,
    PRIMARY KEY (`id`)
);


-- Blog
-- All blog posts, using the easyStyle markup
-- Contains NO HTML
-- Status: in use [blog]
create table if not exists `tblBlog` (
    `id` int(11) not null auto_increment,
    `url` varchar(32) not null,
    `title` varchar(64) not null,
    `text` text not null,
    `author` varchar(64),
    `date` datetime not null,
    `lastUpdated` timestamp default now() on update now(),
    `lastUpdatedBy` int(11),
    primary key (`id`)
);


-- Users
-- All login users etc
-- Password hash format: sha256(password.sha256(username));
create table if not exists `tblUsers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(45) NOT NULL,
    `admin` int(1) NOT NULL DEFAULT 0,
    `email` varchar(45) NOT NULL UNIQUE,
    `password` varchar(64) NOT NULL, -- SHA256 hash (64 bits)
    PRIMARY KEY (`id`)
);
