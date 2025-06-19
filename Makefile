ENV_FILE ?= .env

check-env:
	@if [ ! -f $(ENV_FILE) ]; then \
	    cp .env.dist $(ENV_FILE); \
	    echo "Created $(ENV_FILE) from .env.dist"; \
	fi

check-docker:
	@command -v docker >/dev/null 2>&1 || { echo "Docker is not installed"; exit 1; }
	@docker compose version >/dev/null 2>&1 || { echo "Docker Compose is required"; exit 1; }

# Start Docker containers in interactive mode
up: check-docker check-env
	docker compose up

# Start Docker containers in background mode
upd: check-docker check-env
	docker compose up -d

# Stop containers
down: check-docker check-env
	docker compose down

# Pull latest images
pull: check-docker check-env
	docker compose -f docker-compose.yml pull

# Build containers
build: check-docker check-env
	docker compose build

# Open shell inside moodle container
shell: check-docker check-env
	docker compose exec moodle sh

# Clean environment
clean: check-docker check-env
	docker compose down -v --remove-orphans
