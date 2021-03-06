# Тестовое задание

## 1. Отличаете ли вы Тома Круза от Тома Хэнкса?

> Да.

## 2. Покажите пример своего кода (PHP). Возможно, профиль на GitHub. Стек, который используете в работе. Ссылки на проекты

> [GitHub](https://github.com/danilin-em) пока пустой, но я работаю над этим.

## 3. Тест задание PHP

- Написать класс для доступа к базе данных

> [Листинг](./src/DataBase/DataBase.php) [Пример](./examples/DataBase.php)

- Написать метод, который построит select box из массива

> [Листинг](./src/SelectBox/SelectBox.php) [Пример](./examples/SelectBox.php)

- Написать регулярное выражение, которое с [html страницы](https://ru.kinorium.com/) соберет все id, русское и оригинальное названия фильмов

```regexp

/<a\s+class="link-info-movie-type-film"\s+data-id="(\d+)"[^<]+<h3>([^<]+)<[^<]+<h4>([^<]+)/gm

```

## 4. Тест задание MySQL

Есть две таблицы (фильмы и кадры к ним)

```sql

CREATE TABLE movie (
    movie_id int(5) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (movie_id)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED KEY_BLOCK_SIZE=8;

CREATE TABLE pictures (
    picture_id int(5) unsigned NOT NULL AUTO_INCREMENT,
    movie_id int(5) unsigned NOT NULL,
    PRIMARY KEY (picture_id)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

```

Нужно сделать два запроса:

- 10 фильмов без фото

```sql

SELECT
    movie_id,
    title
FROM movie
WHERE movie_id NOT IN (
    SELECT movie_id
    FROM pictures
    WHERE movie.movie_id = pictures.movie_id
    GROUP BY movie_id
) LIMIT 10;

```

- количество фильмов без фото

```sql

SELECT
    COUNT(movie_id) AS count
FROM movie
WHERE movie_id NOT IN (
    SELECT movie_id
    FROM pictures
    WHERE movie.movie_id = pictures.movie_id
    GROUP BY movie_id
);

```

## 5. Тест задание JavaScript: Написать раскрывающееся дерево любым способам

> [Пример JS](./public/example-tree.html) и [Пример CSS](./public/example-tree-css.html)

## 6. Все собрать в работающую страницу, выводящую дерево с перечнем фильмов с кадрами и без

> [Пример](./public/index.html) 

```text
фильмы|
      |
      - фильмы с кадрами |
                         |
                         - Терминатор
                         - Троя
                         - Матрица
      - фильмы без кадров|
                         |
                         - Силиконовая долина
                         - Вавилон 5
```

### Data

```sql
DROP TABLE IF EXISTS movie;
DROP TABLE IF EXISTS pictures;

CREATE TABLE movie (
    movie_id int(5) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    PRIMARY KEY (movie_id)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED KEY_BLOCK_SIZE=8;

CREATE TABLE pictures (
    picture_id int(5) unsigned NOT NULL AUTO_INCREMENT,
    movie_id int(5) unsigned NOT NULL,
    PRIMARY KEY (picture_id)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO movie (title) VALUES ('Jazz'),
    ('Never on Sunday (Pote tin Kyriaki)'),
    ('Total Recall'),
    ('Nutcracker, The'),
    ('Buying the Cow'),
    ('Dad Savage'),
    ('No Strings Attached'),
    ('Your Sister\'s Sister'),
    ('Pretty in Pink'),
    ('On His Own (a.k.a. My Apprenticeship) (V lyudyakh)');

INSERT INTO pictures (movie_id) VALUES (1), (1), (1), (2), (3), (10), (10);
```
