<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Carbon\Carbon;

class UserStoreDto
{
    public string $firstName;
    public string $lastName;
    public Carbon $birthday;
    public string $gender;
    public string $zipCode;
    public ?Country $country;
    public ?State $state;
    public ?City $city;

    public function __construct(
        string $firstName,
        string $lastName,
        string $birthday,
        string $gender,
        string $zipCode,
        string $country,
        string $state,
        string $city
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthday = Carbon::parse($birthday);
        $this->gender = $gender;
        $this->zipCode = $zipCode;
        $this->country = Country::where('name', $country)->first();
        $this->state = State::where('name', $state)->first();
        $this->city = City::where('name', $city)->first();
    }

    public function toArrayForStore(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'zip_code' => $this->zipCode,
        ];
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['first_name'],
            $data['last_name'],
            $data['birthday'],
            $data['gender'],
            $data['zip_code'],
            $data['country'],
            $data['state'],
            $data['city'],
        );
    }
}
