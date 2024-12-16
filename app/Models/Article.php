<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $appends = [
        'shortened_title',
        'shortened_subtitle',
    ];

    protected $fillable = [
        'banner',
        'title',
        'subtitle',
        'content',
        'slug',
        'status',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->format('d/m/Y H:i');
    }

    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->attributes['status']);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }

    public function getAssetBannerAttribute()
    {
        $banner = $this->attributes['banner'];
        return str_contains($banner, 'https://media') ? $banner : asset("storage/{$banner}");
    }

    public function setSubtitleAttribute($value)
    {
        $this->attributes['subtitle'] = ucfirst($value);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = ucfirst($value);
    }

    public function getShortenedTitleAttribute()
    {
        return Str::limit($this->attributes['title'], 30);
    }

    public function getShortenedSubtitleAttribute()
    {
        return Str::limit($this->attributes['subtitle'], 80);
    }

    public function getFillable(): array
    {
        $fillable = $this->fillable;
        $fillable[] = 'created_at';
        return $fillable;
    }
}
