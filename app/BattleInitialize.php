<?php
namespace BattleGame;

class BattleInitialize{
    public static function initialize()
    {   
        try{
            $hero   = new Hero(Defaults::HERO_NAME,Defaults::HERO_ATTR, Defaults::HERO_SKILLS);
            $beast  = new Beast(Defaults::BEAST_NAME,Defaults::BEAST_ATTR, Defaults::BEAST_SKILLS);
            
            $battle = new Battle();
            $battle->initialize($hero, $beast);
            $battle->fight();
        }
        catch(\Exception $e)
        {
            print_r($e->getMessage());
        }
    }
}
