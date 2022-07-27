<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','info','price','category_id','is_selling','image1','image2','image3','image4'];

    public static $rules = array(
        'name' => 'required|max:255',
        'info' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        'is_selling' => 'required'
    );

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stocks::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function scopeAvailableItems($query)
    {
        $stocks = DB::table('stocks')
            ->select('product_id', 
            DB::raw('sum(quantity) as quantity'))
            ->groupBY('product_id')
            ->having('quantity', '>=', 1);
            return $query
            ->joinSub($stocks, 'stock', function($join){
                $join->on('products.id', '=', 'stock.product_id');
            })
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.is_selling', true)
            ->select('products.id as id', 'products.name as name', 'products.price', 'products.info', 'products.image1', 'products.category_id', 'categories.name as catename');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')
        ->withPivot(['id', 'quantity']);
    }
}
