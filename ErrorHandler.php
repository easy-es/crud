<?php
class ErrorHandler implements SplSubject {
	protected $observers = [];

	public function attach(SplObserver $observer) {
		$this->observers[] = $observer;
		return $this;
	}

	public function detach(SplObserver $observeR) {

	}

	public function notify() {
		foreach ($this->observers as $observer) {
			$observer->update($this);
		}
	}

	public function error($errno, $errstr, $errfile, $errline) {
		echo $errno.' '.$errstr;
		$this->notify();
	}
}	

