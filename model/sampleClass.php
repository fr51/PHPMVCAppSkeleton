<?php
	class sampleClass implements JsonSerializable
	{
		private int $sampleProperty;

		public function __construct (int $sampleProperty)
		{
			$this->setSampleProperty ($sampleProperty);
		}

		public function getSampleProperty (): int
		{
			return ($this->sampleProperty);
		}

		public function setSampleProperty (int $newSampleProperty): void
		{
			$this->sampleProperty=$newSampleProperty;
		}

		public function jsonSerialize (): object
		{
			return ((object) get_object_vars ($this));
		}
	}
?>