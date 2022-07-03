<?php
namespace common\models;

use Yii;

class Data {


  const CITIES = [
    'msc' => 'Москва',
    'spb' => 'Санкт-Петербург',
    'other' => 'Другой город',
  ];

  const GENDER = [
    0 => 'Женщина',
    1 => 'Мужчина',
    2 => 'Non-binary',
  ];

  const CATEGORIES = [
    0 => [
      'title' => 'Beauty',
      'image' => 'beauty.jpg'
    ],
    1 => [
      'title' => 'Lifestyle',
      'image' => 'lifestyle.jpg'
    ],
    2 => [
      'title' => 'E-Comm',
      'image' => 'e-comm.jpg'
    ],
    3 => [
      'title' => 'Curve',
      'image' => 'curve.jpg'
    ],
    4 => [
      'title' => 'Unique',
      'image' => 'unique.jpg'
    ],
    5 => [
      'title' => 'Fitness',
      'image' => 'fitness.jpg'
    ],
    6 => [
      'title' => 'Swimwear',
      'image' => 'swimwear.jpg'
    ],
    7 => [
      'title' => 'Influencer',
      'image' => 'influencer.jpg'
    ],
  ];

  const ETHNICITY = [
    'Азиатский',
    'Афроамериканский',
    'Европейский',
    'Кавказский',
    'Латинский ',
  ];


  const EYES = [
    'Голубые',
    'Карие',
    'Зеленые',
    'Серые',
    'Черные',
    'Другие',
  ];

  const HAIR = [
    'Блондин(-ка)',
    'Брюнет(-ка)',
    'Шатен(-ка)',
    'Рыжий(-ая)',
    'Седой(-ая)',
    'Другой',
  ];

  const TATTOO = [
    0 => 'Нет',
    1 => 'Есть',
  ];

}
