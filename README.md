


# What it has to do? #

Коллекция объектов `Highlight` хранится в базе данных.

Формируется из файла в kindle-формате




Хочу сделать веб-приложения типа SPA.
Бекенд используется как API.




# Пример использования #



## Страница загрузки ##

Загружаю киндловский файл на страницу (дропдаун!). Выводит список
слов. Предлагает сохранить в базу (не сохраняет автоматически). Должен
проверять на повторные значения и не сохранять их.

После загрузки файла выглядит как основная страница. (Те же функции и
данные (из файла)).



## Основная страница ##

Основная страница -- список уже имеющихся слов (на ней работает
дропдаун, если загружен файл -- перенаправляет на страницу загрузки с
распарсенными словами.


### Функции ###

Отбор слов по книгам.

Подсчет сколько раз 



Поиск по словам ( так ли нужно? ).


--------------------------------------------------

## Организация класса коллекции (Collection) ##

How to store Highlights:

* On one level of array




* Group highlights with simular text


It will be harder to get highlights from specific book.



Should I have subclasses for Highlight? Like Word, Phrase?












--------------------------------------------------

illuminate/filesystem suggests installing league/flysystem (Required to use the Flysystem local and FTP drivers (~1.0).)




## Where I stopped ##

Implement diff method in DatabaseCollectionManager! 
