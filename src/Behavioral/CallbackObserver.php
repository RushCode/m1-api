<?php

namespace leocata\M1\Behavioral;

class CallbackObserver implements \SplObserver
{
    private static $callbacks = [];
    private $calledMethod;

    public static function doCallback($name, array $arg = null)
    {
        foreach (self::$callbacks as $callback) {
            if (array_key_exists($name, $callback)) {
                if (!is_callable($callback[$name])) {
                    throw new \BadFunctionCallException();
                }
                $result = call_user_func($callback[$name], $arg);
                if (isset($result)) {
                    return $result;
                }
            }
        }
    }

    public function update(\SplSubject $subject)
    {
        $this->calledMethod = clone $subject;
    }

    public function getCalledMethods()
    {
        echo get_class($this->calledMethod).' : callback method registry'."\n";
    }
}
