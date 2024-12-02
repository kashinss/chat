up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f

bash:
	docker exec -it support-chat_php bash

composer-install:
	docker exec support-chat_php composer install

migrate:
	docker exec support-chat_php php app/console doctrine:schema:update --force

cache:
	docker exec support-chat_php php app/console cache:clear

fixtures:
	docker exec support-chat_php php app/console doctrine:fixtures:load