<?php
class Config {
	private $data = array();

	public function get($key, $original = false) {
		if ($original) {
			return (isset($this->data[$key]) ? $this->data[$key] : null);
		} else {
			$valid = array(
				'config_name',
				'config_owner',
				'config_address',
				'config_geocode',
				'config_email',
				'config_telephone',
				'config_fax',
				'config_welcome',
				'config_about_us'
			);
			
			if (in_array($key, $valid)) {
				$language_id = $this->data['config_language_id'];
				
				if (isset($this->data[$key][$language_id])) {
					return $this->data[$key][$language_id];
				} else {
					return (isset($this->data[$key]) ? $this->data[$key] : null);
				}
			} else {
				return (isset($this->data[$key]) ? $this->data[$key] : null);
			}
		}
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function has($key) {
		return isset($this->data[$key]);
	}

	public function load($filename) {
		$file = DIR_CONFIG . $filename . '.php';

		if (file_exists($file)) {
			$_ = array();

			require($file);

			$this->data = array_merge($this->data, $_);
		} else {
			trigger_error('Error: Could not load config ' . $filename . '!');
			exit();
		}
	}
}