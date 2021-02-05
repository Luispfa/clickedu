Command
```
app:grades
```

You need install docker and docker-compose
Install and run the application.
```
docker/composer install
docker/up
```

Examples of the use of the application.
```
docker/console app:grades student1 2
docker/console app:grades STUDENT2 2
docker/console app:grades student1 2 -d
docker/console app:grades STUDENT1 1 -d
docker/console app:grades student2 2 --description
docker/console app:grades STUDENT3 1 --description
```

Run tests
```
docker/test
```
