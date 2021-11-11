<?php
namespace BattleGame;

class Defaults{
    const HERO_NAME = 'Orderus';
    const HERO_ATTR = [
        'health'    => [70,100],
        'strength'  => [70,80],
        'defence'   => [45,55],
        'speed'     => [40,55],
        'luck'      => [10,30],
    ];
    const HERO_SKILLS = [
        'rapid_strike' => 10,
        'magic_shield'  => 20,
    ];

    const BEAST_NAME = 'Wild Beast';
    const BEAST_ATTR = [
        'health'    => [60,90],
        'strength'  => [60,90],
        'defence'   => [40,60],
        'speed'     => [40,60],
        'luck'      => [25,40],
    ];

    const BEAST_SKILLS = [
    ];

    const MAX_ROUNDS = 20;
}
