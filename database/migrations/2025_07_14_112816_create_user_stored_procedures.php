<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Create stored procedure to insert a new user
        DB::unprepared('
            CREATE PROCEDURE create_user(
                IN p_first_name VARCHAR(100),
                IN p_last_name VARCHAR(100),
                IN p_email VARCHAR(150)
            )
            BEGIN
                INSERT INTO users (first_name, last_name, email, created_at, updated_at)
                VALUES (p_first_name, p_last_name, p_email, NOW(), NOW());
            END
        ');

        // Fetch user by id
        DB::unprepared('
            CREATE PROCEDURE get_user_by_id(IN p_id INT)
            BEGIN
                SELECT * FROM users WHERE id = p_id;
            END
        ');

        // Fetch all users
        DB::unprepared('
            CREATE PROCEDURE get_all_users(
                IN p_limit INT,
                IN p_offset INT
            )
            BEGIN
                SELECT * FROM users LIMIT p_limit OFFSET p_offset;
            END
        ');

        // Update user details by id
        DB::unprepared('
            CREATE PROCEDURE update_user(
                IN p_id INT,
                IN p_first_name VARCHAR(100),
                IN p_last_name VARCHAR(100),
                IN p_email VARCHAR(150)
            )
            BEGIN
                UPDATE users
                SET first_name = p_first_name,
                    last_name = p_last_name,
                    email = p_email,
                    updated_at = NOW()
                WHERE id = p_id;
            END
        ');

        // Delete user by id
        DB::unprepared('
            CREATE PROCEDURE delete_user(IN p_id INT)
            BEGIN
                DELETE FROM users WHERE id = p_id;
            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS create_user');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_user_by_id');
        DB::unprepared('DROP PROCEDURE IF EXISTS get_all_users');
        DB::unprepared('DROP PROCEDURE IF EXISTS update_user');
        DB::unprepared('DROP PROCEDURE IF EXISTS delete_user');
    }
};

