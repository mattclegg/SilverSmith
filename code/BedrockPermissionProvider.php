<?php

class BedrockPermissionProvider extends SilverSmithNode {

	/**
	 * @var string The iterator class to assign to nodes when looping through this object
	 */
	protected $iteratorClass = "BedrockPermissionProvider_Iterator";

}

class BedrockPermissionProvider_Iterator extends BedrockNode_Iterator {
	protected function createNode($key, $source = null, $path = null) {
		return new BedrockPermissionProvider_DataRecord($key, current($this->source), "{$this->path}.{$key}", $this->list);
	}
}

class BedrockPermissionProvider_DataRecord extends BedrockDataRecord {

	public function getTitle() {
		return ucfirst(strtolower($this->source));
	}

	public function getContent() {
		return strtoupper($this->source . "_" . $this->getModel());
	}

	public function getModel() {
		$parts = explode('.', $this->path);
		return $parts[sizeof($parts) - 3];
	}

	public function ModelNice() {
		$fieldName = $this->getModel();
		if(strpos($fieldName, '.') !== false) {
			$parts = explode('.', $fieldName);
			$label = $parts[count($parts)-2] . ' ' . $parts[count($parts)-1];
		} else {
			$label = $fieldName;
		}
		$label = preg_replace("/([a-z]+)([A-Z])/","$1 $2", $label);

		return $label;
	}

	public function getNamespace() {
		return $this->getModel();
	}

}