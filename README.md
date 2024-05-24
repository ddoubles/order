<p align="center">
    <h1 align="center">Модуль создания заказов</h1>
    <br>
</p>

## Гайд по настройке

-   Устанавливаем Docker c [официального сайта](https://www.docker.com/products/docker-desktop) и [Docker Compose](https://docs.docker.com/compose/install/);
-   Для пользователей Windows дополнительно необходимо установить виртуальное ядро Linux, следуя данной [инструкции](https://docs.docker.com/desktop/install/windows-install/);
-   Собираем контейнер командой в папке проекта `docker-compose up -d`;
-   Инициализируем проект:
-   при запущенном контейнере в папке проекта запускаем команду `docker-compose exec backend bash`;
-   запускаем сборку `composer install`.
-   запускаем миграции и заполняем таблицы данными: `php yii migrate`

### Таблица с заказами
- Доступна по адресу http://localhost:8181/

### Endpoint создания заказа
- POST: `http://localhost:8181/api/orders/create`
- Пример тела запроса: `{
  "counterpartyId": 2,
  "orderDate": "2024-05-28",
  "productsIds": [{"id": 3, "quantity": 2}, {"id": 4, "quantity": 2}]
  }`