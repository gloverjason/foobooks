<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        # Because `books` will be associated with `authors`,
        # authors should be seeded first
        # Each author must be related to, at least, one book
        $this->call(AuthorsTableSeeder::class);
        # tags must go before books table
        $this->call(TagsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
    }
}
