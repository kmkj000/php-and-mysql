USE testdb;

-- TRUNCATE TABLE students;
INSERT INTO students(grade,school,name,age,comment) VALUES (
    4,
    "AWT小学校",
    "五虎退",
    "12",
    "おとなしい"
);
INSERT INTO students(grade,school,name,age,comment) VALUES (
    3,
    "AWT小学校",
    "厚藤四郎",
    "11",
    "オレっ子"
);
INSERT INTO students(grade,school,name,age,comment) VALUES (
    4,
    "AWT小学校",
    "鯰尾藤四郎",
    "13",
    "よく髪の毛が跳ねてる"
);
INSERT INTO students(grade,school,name,age,comment) VALUES (
    4,
    "AWT小学校",
    "骨喰藤四郎",
    "13",
    "物静かな子"
);

-- teacher
INSERT INTO teacher(name,age,comment,assessment) VALUES (
    "へし切長谷部",
    "19",
    "熱心な体育教師",
    "とても真面目で良い"
);
INSERT INTO teacher(name,age,comment,assessment) VALUES (
    "一期一振",
    "20",
    "AWT小学校の校長",
    "たまに怖いところがある"
);
