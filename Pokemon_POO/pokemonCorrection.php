<?php
    
class Pokemon 
{
    public string $name;
    public int $maxLife;
    public int $currentLife;
    public int $level;
    public string $type;
    public int $strength;
    public bool $captured=false;

    public function __construct($name, $life, $level, $type, $strength){
        $this->name = $name;
        $this->currentLife = $life;
        $this->maxLife = $life;
        $this->level = $level;
        $this->type = $type;
        $this->strength = $strength;
        return $this;
    }

    public function levelUp(){
	    $this->level += 1;
        $this->life += 5;
        $this->strength += 2;

        $levelUpText = $this->name . ' passe au niveau ' . $this->level . 
        "\nIl gagne 5 pts de vie et 2 pts de force. \n";

        return true;
    }
    
    public function attack($ennemy){
        $damage=$this->strength * (rand(900, 1100) / 1000);
        $ennemy->life-=round($damage, 0);
        return $ennemy;
    }

    public function heat($damage){
        $this->currentLife -= $damage;
        return $this;
    }
}
