Сделал приложение PWA на наитивном JS. Не требует установки(относительно), подойдет для Iphone и Android. Лучше смотреть на телефоне, т.к. не адаптировал для ПК.

Работает оффлайн, данные берет последние сохраненные из LocalStorage(справа от часов иконка отображающая статус).

Есть настройки, сохраняются тоже в LocalStorage - можно выбрать тему, максимальное количество отображаемых чисел, количество цифр после запятой.

Данные получаю из https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml. Дополняю их валютой EUR и своими данными - привязываю название флага и название валюты на русском - все это делается на бекенде - data.php.

Попытался максимально рассмотреть все варианты развития событий и действий пользователя, но точно все не учел.
Из учтенных - запрет ввода не цифровых символов в валюте, кроме запятой и точки. При вводе точке, заменяю ее на запятую. При вводе двух запятых, оставляю первую с конца.

Подсчет всегда идет относительно евро, поэтому в объекте хранится первоначальное значении. При изменении количества валюты, находится разница между текущей валютой и евро, проставляется новое значение для евро, остальные валюты уже считается относительно евро.

Попытался разделить сущности по MVC, разделил их в коде. Так как модульность не большая, не стал делить JS на модули и использовать сборщики модулей, а оставил все в index.html.
