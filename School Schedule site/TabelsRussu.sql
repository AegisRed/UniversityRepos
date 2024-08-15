-- Вставка данных в таблицы
INSERT INTO Audience (name, capacity, building) VALUES
('307', 30, 'Адмін'),
('207', 25, 'Лабор'),
('301', 20, 'Навчальний'),
('304', 20, 'Навчальний');

INSERT INTO Teacher (name, department, id_number) VALUES
('Івлєв В.С.', 'Кафедра ТК', '1234567'),
('Петров А.І.', 'Кафедра Фізики та хімії', '2345678'),
('Єфімов А.В.', 'Кафедра Математики', '3456780');

INSERT INTO Course (name, description, faculty, semester) VALUES
('Бази даних', 'Курс по базах даних', 'КС', 6),
('Фізика', 'Курс по физике', 'МП', 1),
('Вич техніка', 'Курс по вичислительной технике', 'МП', 1),
('Теорія множ', 'Курс по теории множин', 'КС', 6);

INSERT INTO StudentGroup (name, specialty) VALUES
('3, 4 КС', 'Інф технол'),
('1, 2, 3, 4 МП', 'Механ порт'),
('1, 2, 3, 4 КС', 'Інф технол');

INSERT INTO Schedule (day_of_week, lesson_number, start_time, audience_id, course_id, group_id, teacher_id) VALUES
('Monday', 1, '08:30:00', 1, 1, 1, 1),
('Monday', 1, '08:30:00', 1, 2, 2, 2),
('Tuesday', 1, '08:30:00', 2, 3, 2, 1),
('Monday', 2, '10:00:00', 3, 4, 1, 3),
('Thursday', 1, '08:30:00', 4, 4, 3, 3);

-- Создание представления для расписания
CREATE VIEW ScheduleView AS
SELECT 
    s.schedule_id,
    s.day_of_week,
    s.lesson_number,
    s.start_time,
    a.name AS audience_name,
    a.building AS audience_building,
    c.name AS course_name,
    c.faculty,
    c.semester,
    sg.name AS group_name,
    sg.specialty,
    t.name AS teacher_name,
    t.department,
    t.id_number
FROM 
    Schedule s
JOIN 
    Audience a ON s.audience_id = a.audience_id
JOIN 
    Course c ON s.course_id = c.course_id
JOIN 
    StudentGroup sg ON s.group_id = sg.group_id
JOIN 
    Teacher t ON s.teacher_id = t.teacher_id;