<?php

class Firebase
{
	protected $config	= array(); // Variable to store the configuration

    private $_baseURI;
    private $_timeout = 10;
    private $_token;

    /**
     * Constructor
     *
     * @param String $baseURI Base URI
     *
     * @return void
     */
    public function __construct($config = array())
    {
		$ci =& get_instance();
		
		// Try to load Phil's curl library
		$ci->load->library('curl');
		
		// Loads the configuration
		$ci->load->config('firebase', TRUE);

		// Store the configuration as array into the variable
		$this->config = $ci->config->item('firebase');
		
		// Override any default configuration
		$this->initialize($config);    
	}
	
	public function initialize($config = array())
	{
		foreach ($config as $key => $value)
		{
			if (isset($this->config[$key]))
			{
				$this->config[$key] = $value;
			}
		}
		 $this->setBaseURI($this->config['app_path']);
		// $this->setTimeOut($this->config['timeout']);
		// $this->setToken($this->config['app_key']);
	}

    /**
     * Sets Token
     *
     * @param String $token Token
     *
     * @return void
     */
    public function setToken($token)
    {
        $this->_token = $token;
    }

    /**
     * Sets Base URI, ex: http://yourcompany.firebase.com/youruser
     *
     * @param String $baseURI Base URI
     *
     * @return void
     */
    public function setBaseURI($baseURI)
    {
        $baseURI .= (substr($baseURI, -1) == '/' ? '' : '/');
        $this->_baseURI = $baseURI;
    }

    /**
     * Returns with the normalized JSON absolute path
     *
     * @param String $path to data
     */
    private function _getJsonPath($path)
    {
        $url = $this->_baseURI;
        $path = ltrim($path, '/');
        $auth = ($this->_token == '') ? '' : '?auth=' . $this->_token;
        return $url . $path . '.json' . $auth;
    }

    /**
     * Sets REST call timeout in seconds
     *
     * @param Integer $seconds Seconds to timeout
     *
     * @return void
     */
    public function setTimeOut($seconds)
    {
        $this->_timeout = $seconds;
    }

    /**
     * Writing data into Firebase with a PUT request
     * HTTP 200: Ok
     *
     * @param String $path Path
     * @param Mixed  $data Data
     *
     * @return Array Response
     */
    public function set($path, $data)
    {
      return $this->_writeData($path, $data, 'PUT');
    }

    /**
     * Pushing data into Firebase with a POST request
     * HTTP 200: Ok
     *
     * @param String $path Path
     * @param Mixed  $data Data
     *
     * @return Array Response
     */
    public function push($path, $data)
    {
      return $this->_writeData($path, $data, 'POST');
    }

    /**
     * Updating data into Firebase with a PATH request
     * HTTP 200: Ok
     *
     * @param String $path Path
     * @param Mixed  $data Data
     *
     * @return Array Response
     */
    public function update($path, $data)
    {
      return $this->_writeData($path, $data, 'PATCH');
    }

    /**
     * Reading data from Firebase
     * HTTP 200: Ok
     *
     * @param String $path Path
     *
     * @return Array Response
     */
    public function get($path)
    {
        try {
            $ch = $this->_getCurlHandler($path, 'GET');
            $return = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $return = null;
        }
        return $return;
    }

    /**
     * Deletes data from Firebase
     * HTTP 204: Ok
     *
     * @param type $path Path
     *
     * @return Array Response
     */
    public function delete($path)
    {
        try {
            $ch = $this->_getCurlHandler($path, 'DELETE');
            $return = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $return = null;
        }
        return $return;
    }

    /**
     * Returns with Initialized CURL Handler
     *
     * @param String $mode Mode
     *
     * @return CURL Curl Handler
     */
    private function _getCurlHandler($path, $mode)
    {
        $url = $this->_getJsonPath($path);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $mode);
        return $ch;
    }

    private function _writeData($path, $data, $method = 'PUT')
    {
        $jsonData = json_encode($data);
        $header = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        );
        try {
            $ch = $this->_getCurlHandler($path, $method);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            $return = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            $return = null;
        }
        return $return;
    }

}
