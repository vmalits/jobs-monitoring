<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacansy extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'organization',
        'requirements',
        'salary',
        'salary_from',
        'salary_to',
        'vacancy_link'
    ];
}
