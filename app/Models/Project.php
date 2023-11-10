<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $datas = ['deleted_at'];

    protected $fillable = ['title', 'content', 'slug', 'cover_image', 'project_link', 'git_link'];

    public function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
}
