
<?php

class Pokeball 
{
    public string $name;
    public int $level;

    public function __construct($name, $level){
        $this->name = $name;
        $this->level = $level;
        return $this;
    }

    public function capture($pokemon):bool{
        $luck=((($pokemon->maxLife - $pokemon->currentLife) / $pokemon->maxLife) * (1 + ($this->level - $pokemon->level)) / 25);
        echo $luck;
        if($luck>0.6){
            $pokemon->captured=true;
            echo "Congrutulation";
            return true;
        }else{
            echo "RIP";
            return false;
        }
    }
}