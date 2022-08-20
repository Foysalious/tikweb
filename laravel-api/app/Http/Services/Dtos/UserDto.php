<?php namespace App\Http\Services\Dtos;

use phpDocumentor\Reflection\Types\Integer;
use Spatie\DataTransferObject\DataTransferObject;

class UserDto extends DataTransferObject
{
    public ?integer $id;
    public ?string $name;
    public ?string $email;
    public ?string $role;
    public ?string $password;


}
