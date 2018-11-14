Имате база от данни със следната таблица и данни:

CREATE TABLE electives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  description VARCHAR(1024),
  lecturer VARCHAR(128)
);

INSERT INTO electives (title, description, lecturer)
VALUES
  ("Programming with Go", "Let's learn Go", "Nikolay Batchiyski"),
  ("AKDU", "Let's Graduate", "Svetlin Ivanov"),
  ("Web technologies", "Let's learn the web", "Milen Petrov");

Имплементирайте php страница с форма и валидация за добавяне на избираема дисциплина.

Добавете колона created_at на таблицата electives, коята да сочи момента на добавяне на реда.
