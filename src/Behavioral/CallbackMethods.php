<?php

namespace leocata\M1\Behavioral;

abstract class CallbackMethods implements \SplSubject
{
    private $observers;

    final public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    final public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    final public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        /** @var \SplObserver $observer */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
