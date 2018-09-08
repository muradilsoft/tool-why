all: setup

setup: prepare-docs-json

prepare-docs-json:
	php artisan util:yamltojson

prepare-database:
	php artisan migrate