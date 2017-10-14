<?php

namespace leocata\M1\Behavioral;

class CallbackObserver implements \SplObserver
{
    private static $callbacks = [];
    private $calledMethod;

    public static function doCallback($name, array $arg = null)
    {
        //В цикле вызов переданных функций обратного вызова
        foreach (self::$callbacks as $callback) {
            /*
             * Проверяем существование функций повешенных на событие
             * Ключ массива ($callback) должен совпадать с названием события ($name)
             */
            if (array_key_exists($name, $callback)) {
                //Проверка возможности вызова анонимной функции
                if (!is_callable($callback[$name])) {
                    throw new \Exception("Функция обратного вызова - невызываемая ! ");
                }
                $result = call_user_func($callback[$name], $arg);
                if (isset($result)) {
                    return $result;
                }
            }
        }

        return null;
    }

    public function update(\SplSubject $subject)
    {
        $this->calledMethod = clone $subject;
    }

    public function getCalledMethods()
    {
        echo get_class($this->calledMethod) . ' : callback method registry' . "\n";
    }
}
