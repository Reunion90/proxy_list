## Proxy list

### Цель: 
Собирать список публичных прокси серверов и проверять их: 
- доступность, 
- пинг, 
- степень анонимности. 
- Сделать интерфейс для вывода списка серверов, со статусами и фильтрами: (фильтры про стране, доступности, классу анонимности)

### Стек технологий:
- PHP7, 
- Laravel, 
- библиотеки для парсинга [HTML(Goutte)](https://github.com/FriendsOfPHP/Goutte), 
- команды Laravel, 
- [mutex](https://github.com/symfony/lock)  
- Cron для запуска заданий
 ```bash
 * * * * * cd /project/dir && php artisan schedule:run >> /dev/null 2>&1
 ```

- Bootstrap 4 
### +: 
- REST API интерфейс для получения прокси, 
- тесты функциональные и модульные

###Источники проксей:
- https://hidemy.name/ru/proxy-list/ 
- https://free-proxy-list.net/
- http://www.freeproxylists.net/ru/
