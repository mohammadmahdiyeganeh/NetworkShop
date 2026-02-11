<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//class Product extends Model
//{
  //  protected $fillable = ['name', 'description', 'price', 'image'];

    // این متد مسیر درست رو می‌سازه
  //  public function getImageUrlAttribute()
   // {
    //    return asset('storage/' . $this->image);
  //  }
//}



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
{
    return $this->hasMany(Comment::class)->latest();
}
public function orders()
{
    return $this->belongsToMany(Order::class, 'order_product')
                ->withPivot('quantity', 'price', 'image')
                ->withTimestamps();
}
}
