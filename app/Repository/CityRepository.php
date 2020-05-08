<?php

namespace App\Repository;

use Illuminate\Validation\Rule;

class CityRepository extends AbstractRepository
{

    public function validationUpdate($request, $id) {
        return $request->validate([
            'name'   =>[
                "required",
                "max:200",
                "min:2",
                Rule::unique("city")->ignore($id),
            ],
            "country_id" => ["required", "int"]
        ]);
    }

}
