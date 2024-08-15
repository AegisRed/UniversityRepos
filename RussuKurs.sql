-- Создание базы данных
CREATE DATABASE IF NOT EXISTS UniversitySchedule;
USE UniversitySchedule;

-- Таблица Аудитории
CREATE TABLE Audience (
    audience_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    building VARCHAR(50) NOT NULL
);

-- Таблица Преподавателей
CREATE TABLE Teacher (
    teacher_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100),
    id_number VARCHAR(20) NOT NULL
);

-- Таблица Курсов
CREATE TABLE Course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    faculty VARCHAR(50) NOT NULL,
    semester INT NOT NULL
);

-- Таблица Групп студентов
CREATE TABLE StudentGroup (
    group_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    specialty VARCHAR(100) NOT NULL
);

-- Таблица Расписания
CREATE TABLE Schedule (
    schedule_id INT AUTO_INCREMENT PRIMARY KEY,
    day_of_week ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') NOT NULL,
    lesson_number INT NOT NULL,
    start_time TIME NOT NULL,
    audience_id INT NOT NULL,
    course_id INT NOT NULL,
    group_id INT NOT NULL,
    teacher_id INT NOT NULL,
    FOREIGN KEY (audience_id) REFERENCES Audience(audience_id),
    FOREIGN KEY (course_id) REFERENCES Course(course_id),
    FOREIGN KEY (group_id) REFERENCES StudentGroup(group_id),
    FOREIGN KEY (teacher_id) REFERENCES Teacher(teacher_id)
);
