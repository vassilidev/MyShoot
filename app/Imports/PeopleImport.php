<?php

namespace App\Imports;

use App\Models\People;
use App\Models\Role;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeopleImport implements ToCollection, WithHeadingRow
{
    public function __construct()
    {
        ini_set('memory_limit', '1024M');
    }

    /**
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {
            $speciality = $row['specialite'];
            $gender = Str::lower($row['genre']);
            $name = Str::replace('-', ' ', Str::lower($row['prenom']));
            $surname = Str::replace('-', '', Str::upper($row['nom']));

            if (empty($speciality) || empty($name) || empty($surname)) {
                continue;
            }

            $role = Role::query()->firstOrCreate(['name' => $speciality]);

            People::query()->firstOrCreate([
                'role_id' => $role->id,
                'gender'  => (!empty($gender) ? $gender : null),
                'name'    => $name,
                'surname' => $surname,
                'bip'     => $row['bip'] ?? null,
                'phone'   => $row['phone'] ?? null,
                'email'   => $row['mail'] ?? null,
            ]);
        }
    }
}
