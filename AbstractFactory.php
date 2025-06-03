<?php

interface Toy {
    public function play(): string;
}

abstract class Car implements Toy {
    public function play() : string {
        return "Play Car";
    }
}

class LittleCarToy extends Car {
}

class MiddleCarToy extends Car {
}

abstract class Doll implements Toy {
    public function play(): string {
        return "Play Doll";
    }
}

class LittleDollToy extends Doll {
}

class MiddleDollToy extends Doll {
}

interface ToyFactory {
    public function makeForKids(): Toy;
    public function makeForChild(): Toy;
}

 class CarFactory implements ToyFactory {
    public function makeForChild(): Toy
    {
        return new LittleCarToy();
    }

    public function makeForKids(): Toy
    {
        return new MiddleCarToy();
    }
 }

 class DollFactory implements ToyFactory {
    public function makeForChild(): Toy
    {
        return new LittleDollToy();
    }

    public function makeForKids(): Toy
    {
        return new MiddleDollToy();
    }
 }



abstract class AbstractToyFactory {
    private static ToyFactory $factory;

    public static function setFactory(ToyFactory $factory): void {
        self::$factory = $factory;
    }

    public static function makeToy(string $type): Toy {
        if (!isset(self::$factory)) {
            self::$factory = new CarFactory();
        }

        if ($type === 'child') {
            return self::$factory->makeForChild();
        }
        return self::$factory->makeForKids();
    }
}


$myToy = AbstractToyFactory::makeToy("child");
echo $myToy->play();

$myToy = AbstractToyFactory::makeToy("kids");
echo $myToy->play();

AbstractToyFactory::setFactory(new DollFactory());

$myToy = AbstractToyFactory::makeToy("child");
echo $myToy->play();

$myToy = AbstractToyFactory::makeToy("kids");
echo $myToy->play();