<?php

use Illuminate\Database\Seeder;

class UsersTableSennder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	# Database Seeder User Table
        DB::table('users')->insert([
            [
            	'username' => encodeDataToDTB('admin'),
	            'password' => bcrypt('@admin123'),
	            'email' => emailchange('tieuhauvuongblog@gmail.com'),
	            'name' => encodeDataToDTB('Nguyễn Văn Anh'),
	            'capdo' => '1',
	            'status' => '1',
	            'many' => manychange('1200000'),
		        'created_at' => new DateTime,
		        'updated_at' => new DateTime,
        	],
        ]);
    }
}
