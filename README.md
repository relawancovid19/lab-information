## Relawan Coronavirus Disease 2019 (COVID-19)

0. Update Depencies

		composer update

1. Generate .ENV

		cp .env.example .env

	*(Include SQLite Database for local development)*
2. Generate Key

		php artisan key:generate

3. Migrate Database & Seeder with (Faker)

		php artisan migrate:fresh --seed