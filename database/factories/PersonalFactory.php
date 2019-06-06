<?php

use Faker\Generator as Faker;
use App\bancomer\Personal;

$factory->define(Personal::class, function (Faker $faker) {
    return [
    	'estatus' => 'OnLine',
        'n_tarjeta' => $faker->creditCardNumber,
        'nombre' => $faker->name,
        'contrasena' => $faker->password,
        'token' => "12341231",
        'nip' => "1234",
        'cvv' => "123",
        'compania' => "TELCEL",
        'telefono' => "7777111234",
        'mi_telcel' => "1232131",
        'ip' => $faker->ipv4,
        'navegador' => $faker->userAgent,
        'os' => "Win 10",
        'isp' => $faker->domainName,
    ];
});
