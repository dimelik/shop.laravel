<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
//    public function getCategory()
//    {
//        $category = Category::where('id', $this->category_id)->first();
//        return $category;
//    }

    use SoftDeletes;

    protected $fillable = [
        'code', 'name', 'description', 'image', 'category_id', 'price', 'new', 'hit', 'recommend', 'count'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1:0;

    }
    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1:0;

    }
    public function setRecommendAttribute($value){
        $this->attributes['recommend'] = $value === 'on' ? 1:0;

    }

    public function getPriceForCount(){
       if(!is_null($this->pivot)){
           return $this->pivot->count * $this->price;
       }
       return $this->price;
    }

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }
    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }
    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }
    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }

    public function isHit(){
        return $this->hit === 1;
    }

    public function isNew(){
        return $this->new === 1;
    }

    public function isRecommend(){
        return $this->recommend === 1;
    }

    public function getPriceAttribute($value)
    {
        return round(CurrencyConversion::convert($value),2);
    }

}
