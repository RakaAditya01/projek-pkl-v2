<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER update_stock after INSERT ON peminjams
            FOR EACH ROW
            BEGIN UPDATE barangs set
            stock = stock - NEW.jumlah
            WHERE nama_barang = NEW.nama_barang;
            END'
        );

        DB::unprepared('CREATE TRIGGER delete_stock after DELETE ON peminjams
            FOR EACH ROW
            BEGIN UPDATE barangs set
            stock = stock + OLD.jumlah
            WHERE nama_barang = OLD.nama_barang;
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger');
    }
};
