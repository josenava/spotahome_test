# spotahome_test
I used docker to have a development environment

To  start just run

`make dev` then
`make create-db` (it will ask for the password, check `docker-compose.yml`)

and then

`make ssh-be` and inside you can run the migration `php bin/console d:m:m`
and right after the import command
`php bin/console app:apartments:import`

Once you have the environment ready just `php -S 0.0.0.0:8000 -t public`

and navigate to `http://localhost:8000`.

