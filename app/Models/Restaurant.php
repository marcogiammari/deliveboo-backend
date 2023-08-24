<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "name",
        "vat_number",
        "note",
        "thumb",
        "city",
        "street_name",
        "street_number",
        "zip_code"
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
