<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang', 150)->default('')->collate('utf8mb4_general_ci')->nullable();
            $table->string('satuan', 50)->default('')->collate('utf8mb4_general_ci')->nullable();
            $table->string('jumlah', 50)->default('')->collate('utf8mb4_general_ci')->nullable();
            $table->string('harga_satuan', 50)->default('')->collate('utf8mb4_general_ci')->nullable();
            $table->string('keterangan', 50)->default('')->collate('utf8mb4_general_ci')->nullable();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_barang');
    }
}
