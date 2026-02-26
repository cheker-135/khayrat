<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddShippedToOrdersStatusEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For MySQL, we can use ALTER TABLE to modify the enum
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('new', 'process', 'shipped', 'delivered', 'cancel') DEFAULT 'new'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('new', 'process', 'delivered', 'cancel') DEFAULT 'new'");
    }
}
