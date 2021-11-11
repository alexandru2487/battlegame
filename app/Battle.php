<?php
namespace BattleGame;

class Battle{
    private $hero   = null;
    private $beast  = null;

    private $fighterOne = null;
    private $fighterTwo = null;

    private $battles = 0;


    public function getHero(){
        return $this->hero;
    }
    public function setHero(Fighter $hero){
        $this->hero = $hero;
    }

    public function getBeast(){
        return $this->beast;
    }
    public function setBeast(Fighter $beast){
        $this->beast = $beast;
    }

    public function getFighterOne(){
        return $this->fighterOne;
    }
    public function setFighterOne($fighter){
        $this->fighterOne = $fighter;
    }

    public function getFighterTwo(){
        return $this->fighterTwo;
    }
    public function setFighterTwo($fighter){
        $this->fighterTwo = $fighter;
    }




    public function initialize($hero, $beast)
    {   
        $this->setHero($hero);
        $this->setBeast($beast);
    }

    public function fight(){
        $this->getInitialAbilities();
        $this->setFirstStriker();

        for ($i=0; $i < Defaults::MAX_ROUNDS; $i++) { 
            if ($this->checkEndBattle()) {
                break;
            }
            $this->battles++;
            $this->manageRounds();
        }

        if ($this->battles == Defaults::MAX_ROUNDS) {
            echo "The battle ended with a tie.";
            return;
        }
        $this->getResults();
    }

    public function getInitialAbilities(){
        $hero = $this->getHero();
        $beast = $this->getBeast();

        echo '<b class="text-center">Begin battle!</b>'.'</br>';
        echo $hero->getName()." health: ".$hero->getHealth()."</br>";
        echo $hero->getName()." strength: ".$hero->getStrength()."</br>";
        echo $hero->getName()." speed: ".$hero->getSpeed()."</br>";
        echo $hero->getName()." defence: ".$hero->getDefence()."</br>";
        echo $hero->getName()." luck: ".$hero->getLuck()."</br>";
        echo "</br>";

        echo $beast->getName()." health: ".$beast->getHealth()."</br>";
        echo $beast->getName()." strength: ".$beast->getStrength()."</br>";
        echo $beast->getName()." speed: ".$beast->getSpeed()."</br>";
        echo $beast->getName()." defence: ".$beast->getDefence()."</br>";
        echo $beast->getName()." luck: ".$beast->getLuck()."</br>";
        echo "</br>";
    }
    public function getResults(){
        echo '<div class="battle--results">The battle ended in <b>round '.$this->battles. '</b> and the winner is: <b>'.$this->getVictoryFighter()->getName().'</b></div>';
    }

    public function setFirstStriker(){
        $hero   = $this->hero;
        $beast  = $this->beast;

        if ($hero->getSpeed() > $beast->getSpeed()) {
            $this->fighterOne = $hero;
            $this->fighterTwo = $beast;
            return;
        }

        if ($hero->getSpeed() < $beast->getSpeed()) {
            $this->fighterOne = $beast;
            $this->fighterTwo = $hero;
            return;
        }

        if ($hero->getLuck() > $beast->getLuck()) {
            $this->fighterOne = $hero;
            $this->fighterTwo = $beast;
            return;
        }

        if ($hero->getLuck() < $beast->getLuck()) {
            $this->fighterOne = $beast;
            $this->fighterTwo = $hero;
            return;
        }


        $this->fighterOne = $hero;
        $this->fighterTwo = $beast;
    }

    public function getVictoryFighter(){
        $one    = $this->fighterOne;
        $two    = $this->fighterTwo;
        if($one->getHealth() > $two->getHealth())
        {
            return $one;
        }

        return $two;
    }

    public function checkEndBattle(){
        $one    = $this->fighterOne;
        $two    = $this->fighterTwo;

        if ($one->getHealth() <= 0 || $two->getHealth() <= 0 ) {
            return true;
        }
        return false;
    }

    public function manageRounds(){
        $this->getRoundDetails();
        $this->setDefenseHealth();
        $rapid_random   = mt_rand(0,100);
        $attacker_rapid_strike = $this->fighterOne->getRapidStrike();
        if ($rapid_random <= $attacker_rapid_strike && $attacker_rapid_strike != 0) {
            $this->setDefenseHealth();
            echo $this->fighterOne->getName()." uses his rapid strike!</br>";
        }
        $this->getRoundDetailsAfter();
        $this->switchFighters();
    }

    public function setDefenseHealth(){
        $luck           = false;
        $luck_random    = mt_rand(0,100);
        $magic_random   = mt_rand(0,100);

        if ($luck_random <= $this->fighterTwo->getLuck()) {
            $luck = true;
        }
        if ($luck) {
            $damageFighter = 0;
            echo $this->fighterTwo->getName()." was lucky and his health is intact!</br>";
        }else{
            $damageFighter = $this->manageFighterDamage();
        }
        $defender_shield = $this->fighterTwo->getMagicShield();
        if ($magic_random <= $defender_shield && $defender_shield != 0) {
            $damageFighter = round($damageFighter/2);
            echo $this->fighterTwo->getName()." uses his magic shield!</br>";
        }

        $new_health = $this->fighterTwo->getHealth() - $damageFighter;
        $new_health = ($new_health < 0) ? 0 : $new_health;
        $this->fighterTwo->setHealth($new_health);
    }
    public function switchFighters(){
        $fighter = $this->fighterOne;
        $this->fighterOne = $this->fighterTwo;
        $this->fighterTwo = $fighter;
    }

    public function manageFighterDamage(){
        $damage = 0;
        
        if($this->fighterOne->getStrength() > $this->fighterTwo->getDefence())
        {
            return $this->fighterOne->getStrength() - $this->fighterTwo->getDefence();
        }

        return $damage;
    }

    public function getRoundDetails(){
        echo '<b class="text-center">Round '.$this->battles."</b></br>";
        echo "<div>Attacker is ".$this->fighterOne->getName()."(health: <b>".$this->fighterOne->getHealth()."</b>, defence: <b>".$this->fighterOne->getDefence()."</b>)"."</div>";
        echo "<div>Defender is ".$this->fighterTwo->getName()."(health: <b>".$this->fighterTwo->getHealth()."</b>, defence: <b>".$this->fighterTwo->getDefence()."</b>)"."</div>";
        echo "</br>";
    }
    public function getRoundDetailsAfter(){
        echo "<div>".$this->fighterOne->getName()." has after fight health: <b>".$this->fighterOne->getHealth()."</b>, defence: <b>".$this->fighterOne->getDefence()."</b>"."</div>";
        echo "<div>".$this->fighterTwo->getName()."has after fight health: <b>".$this->fighterTwo->getHealth()."</b>, defence: <b>".$this->fighterTwo->getDefence()."</b>"."</div>";
        echo "</br>";
    }
}
