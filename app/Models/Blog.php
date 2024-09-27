<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'excerpt', 'slug', 'status', 'category_id', 'author_id', 'user_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function statusLabel()
    {
        return $this->status === 'draft'
            ? "<td style='background-color: #ffc107; color: #856404; padding: 5px 10px; border-radius: 5px; font-weight: bold; text-align: center;'>Draft</td>"
            : "<td style='background-color: #28a745; color: #ffffff; padding: 5px 10px; border-radius: 5px; font-weight: bold; text-align: center;'>Published</td>";
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }


    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    function img() {
        return $this->image ? asset($this->image) : 'https://picsum.photos/1000/1000';
    }

}


