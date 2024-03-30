<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // $table->id();
    //         $table->string('nik');
    //         $table->string('kk');
    //         $table->string('name');
    //         $table->string('phone');
    //         $table->string('email')->nullable();
    //         $table->string('gender');
    //         $table->string('birth_place');
    //         $table->string('birth_date');
    //         $table->string('is_deceased')->default('false');
    //         $table->string('address_line');
    //         $table->string('city');
    //         $table->string('city_code');
    //         $table->string('province');
    //         $table->string('province_code');
    //         $table->string('district');
    //         $table->string('district_code');
    //         $table->string('village');
    //         $table->string('village_code');
    //         $table->string('rt');
    //         $table->string('rw');
    //         $table->string('postal_code');
    //         $table->string('marital_status');
    //         $table->string('relationship_name')->nullable();
    //         $table->string('relationship_phone');

    use HasFactory;
    protected $fillable = [
        "nik",
        "kk",
        "name",
        "phone",
        "email",
        "gender",
        "birth_place",
        "birth_date",
        "is_deceased",
        "address_line",
        "city",
        "city_code",
        "province",
        "province_code",
        "district",
        "district_code",
        "village",
        "village_code",
        "rt",
        "rw",
        "postal_code",
        "marital_status",
        "realtionship_name",
        "realtionship_phone",
    ] ;
}
