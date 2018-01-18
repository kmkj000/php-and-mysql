DROP DATABASE IF EXISTS testdb;

CREATE DATABASE testdb;
USE testdb;

CREATE TABLE students(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255),
  age INT,
  comment TEXT
);

CREATE TABLE teacher(
  id SERIAL PRIMARY KEY,
  name VARCHAR(255),
  age INT,
  comment TEXT
);