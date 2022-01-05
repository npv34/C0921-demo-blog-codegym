<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new Type();
        $type->name = "Lập trình web";
        $type->save();

        $type = new Type();
        $type->name = "Lập trình PHP";
        $type->save();

        $type = new Type();
        $type->name = "Lập trình Java";
        $type->save();

        $type = new Type();
        $type->name = "Cơ sở dữ liệu";
        $type->save();
    }
}
