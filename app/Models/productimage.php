<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image'];

    // image belongs to product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }                       
public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->string('image')->nullable();
    });
}
public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
}