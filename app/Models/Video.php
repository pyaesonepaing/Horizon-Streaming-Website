<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'uploaded_by',
        'title',
        'slug',
        'description',
        'poster_path',
        'trailer_path',
        'stream_path',
        'download_path',
        'duration_seconds',
        'is_published',
        'published_at',
        'is_downloadable',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_downloadable' => 'boolean',
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // user who uploaded the video (admin)
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // many-to-many with categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // downloads
    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    // video views
    public function views()
    {
        return $this->hasMany(VideoView::class);
    }

    // comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isDownloadAllowed()
    {
        return $this->is_downloadable && $this->download_path;
    }
}