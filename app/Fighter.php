<?php
namespace BattleGame;

abstract class Fighter{
    protected $name;
    protected $health;
    protected $strength;
    protected $defence;
    protected $speed;
    protected $luck;
    protected $skills;


    public function __construct(string $name, array $attr, array $skills)
    {   
        if (!$name) {
            throw new \Exception('Fighter name can not be empty!');
        }
        $this->setName($name);
        $this->configFighter($attr);
        $this->setSkills($skills);
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getHealth(){
        return $this->health;
    }

    public function setHealth($health){
        $this->health = $health;
    }

    public function getStrength(){
        return $this->strength;
    }

    public function setStrength($strength){
        $this->strength = $strength;
    }

    public function getDefence(){
        return $this->defence;
    }

    public function setDefence($defence){
        $this->defence = $defence;
    }

    public function getSpeed(){
        return $this->speed;
    }

    public function setSpeed($speed){
        $this->speed = $speed;
    }
    
    public function getLuck(){
        return $this->luck;
    }

    public function setLuck($luck){
        $this->luck = $luck;
    }

    public function getSkills(){
        return $this->skills;
    }

    public function setSkills($skills){
        $this->skills = $skills;
    }
    public function getMagicShield(){
        return isset($this->getSkills()['magic_shield']) ? $this->getSkills()['magic_shield'] : 0;
    }
    public function getRapidStrike(){
        return isset($this->getSkills()['rapid_strike']) ? $this->getSkills()['rapid_strike'] : 0;
    }

    protected function configFighter($attr = []){
        $method = '';

        if(count($attr) == 0)
            throw new \Exception('The '.$this->getName().' abilities can not be empty!');
        
        foreach ($attr as $key => $value) {
            if (empty($value[0]) || empty($value[1]))
                throw new \Exception("The ".$this->getName()."'s ".$key." ability can not have start range or end range as empty values!");

            if ($value[0] > $value[1])
                throw new \Exception("The ".$this->getName()."'s ".$key." ability can not have start range grater than end range!");

            switch ($key) {
                case 'health':
                    $method = 'setHealth';
                    break;
                case 'strength':
                    $method = 'setStrength';
                    break;
                case 'defence':
                    $method = 'setDefence';
                    break;
                case 'speed':
                    $method = 'setSpeed';
                    break;
                case 'luck':
                    $method = 'setLuck';
                    break;
                
            }
            if ($method) {
                $this->$method($this->getRandom($value[0], $value[1]));
            }
        }
    }

    protected function getRandom($min, $max){
        return mt_rand($min, $max);
    }
}
