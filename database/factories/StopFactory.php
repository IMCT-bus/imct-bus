<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StopFactory extends Factory
{
    public const STOPS = [
        //ROUTE 1
        ['id' => 1, 'name' => 'Парк победы', 'link' => 'https://go.2gis.com/uv8gl'],
        ['id' => 2, 'name' => 'Проспект 100-летия', 'link' => 'https://go.2gis.com/y0kix'],
        ['id' => 3, 'name' => 'Молодежная', 'link' => 'https://go.2gis.com/kyho7i'],
        ['id' => 4, 'name' => 'Некрасовская', 'link' => 'https://go.2gis.com/ran8d'],
        ['id' => 5, 'name' => 'Студенческая', 'link' => 'https://go.2gis.com/03zce'],
        ['id' => 6, 'name' => 'Фуникулер', 'link' => 'https://go.2gis.com/4hy87'],
        ['id' => 7, 'name' => 'Театр оперы и балета', 'link' => 'https://go.2gis.com/eap0p'],
        ['id' => 8, 'name' => 'Надибаидзе', 'link' => 'https://go.2gis.com/avbc3'],
        ['id' => 9, 'name' => 'Олега Кошевого (Радиоприбор)', 'link' => 'https://go.2gis.com/tcbn06'],
        ['id' => 10, 'name' => 'Бурачка', 'link' => 'https://go.2gis.com/1clmw'],
        ['id' => 11, 'name' => 'Окатовая', 'link' => 'https://go.2gis.com/7j2x0'],
        ['id' => 12, 'name' => 'Кампус ДВФУ', 'link' => 'https://go.2gis.com/5rp1x'],

        //ROUTE 2
        ['id' => 13, 'name' => 'Баляева', 'link' => 'https://go.2gis.com/uhtz0v'],
        ['id' => 14, 'name' => 'Новоивановская', 'link' => 'https://go.2gis.com/db2uj'],
        ['id' => 15, 'name' => 'Спортивная', 'link' => 'https://go.2gis.com/vz6mm'],
        ['id' => 16, 'name' => 'Запорожская', 'link' => 'https://go.2gis.com/1vn8br'],
//        ['id' => 12, 'name' => 'Кампус ДВФУ', 'link' => 'https://go.2gis.com/5rp1x'],

        //ROUTE 3
        ['id' => 17, 'name' => 'Кампус ДВФУ', 'link' => 'https://go.2gis.com/zi9m3'],
        ['id' => 18, 'name' => 'Окатовая', 'link' => 'https://go.2gis.com/jwh7t'],
        ['id' => 19, 'name' => 'Радиоприбор', 'link' => 'https://go.2gis.com/i04vrt'],
        ['id' => 20, 'name' => 'Театр оперы и балета', 'link' => 'https://go.2gis.com/opojb'],
//        ['id' => 6, 'name' => 'Фуникулер', 'link' => 'https://go.2gis.com/4hy87'],
        ['id' => 21, 'name' => 'Некрасовская', 'link' => 'https://go.2gis.com/wc4kc'],
        ['id' => 22, 'name' => 'Молодежная', 'link' => 'https://go.2gis.com/jlsxo'],
        ['id' => 23, 'name' => 'Проспект 100-летия', 'link' => 'https://go.2gis.com/as7e9'],
        ['id' => 24, 'name' => 'Парк Победы', 'link' => 'https://go.2gis.com/nu95l']
    ];

    public function definition(): array
    {
        $selectedStop = $this->faker->randomElement(self::STOPS);

        return [
            'id' => $selectedStop['id'],
            'name' => $selectedStop['name'],
            'link' => $selectedStop['link'],
        ];
    }
}
