DROP DATABASE IF EXISTS testdb;

CREATE DATABASE testdb;
USE testdb;

CREATE TABLE students(
  id SERIAL NOT NULL AUTO_INCREMENT,
  grade INT,
  school VARCHAR(255),
  name VARCHAR(255),
  age INT,
  comment TEXT,
  PRIMARY KEY (id)
);

CREATE TABLE students_record(
  students_id SERIAL NOT NULL,
  FOREIGN KEY(students_id) REFERENCES students(id) ON UPDATE CASCADE ON DELETE RESTRICT ,
  japanese INT,
  english INT,
  science INT,
  mathematics INT,
  PRIMARY KEY (students_id)
);

CREATE TABLE teacher(
  id SERIAL NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  age INT,
  comment TEXT,
  assessment TEXT,
  PRIMARY KEY (id)
);