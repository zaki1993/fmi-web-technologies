<!DOCTYPE html>
<html>
    <head>
        <title>Homework 1.3</title>
    </head>
    <body>
        <?php
            /*
				Documentation: http://php.net/manual/en/reserved.variables.server.php
    		*/
        	class Request {

        		private $method;
        		private $path;
        		private $url;
        		private $userAgent;

        		/*
					Set the constructor to be protected which will basically make Request as an abstract class allowing to create
					instance of Request only if there is a concrete class extending it(Such as GetRequest).
        		*/
        		protected function __construct($request) {
        			$this->__init($request);
        		}

        		private function __init($request) {
        			$this->method=$request['REQUEST_METHOD'];
        			$pathArray=explode('?', $request['REQUEST_URI']); // Set as variable because we get Notice otherwise.
        			$this->path=array_shift($pathArray); // Не съм сигурен дали под path се има в предвид тази часто от URL. В момента връща URL без QUERY_STRING-а
        			$this->url=(isset($request['HTTPS']) && $request['HTTPS'] === 'on' ? "https" : "http") . "://$request[HTTP_HOST]$request[REQUEST_URI]";
        			$this->userAgent=$request['HTTP_USER_AGENT'];
        		}

        		/*
					Explicitly set the function modifiers to public
        		*/
        		public function getMethod() {
        			return $this->method;
        		}

        		public function getPath() {
        			return $this->path;
        		}

        		public function getURL() {
        			return $this->url;
        		}

        		public function getUserAgent() {
        			return $this->userAgent;
        		}
        	}

        	class GetRequest extends Request {

        		private $data;

        		public function __construct($request) {
        			parent::__construct($request);
        			$this->__init($request);
        		}

        		private function __init($request) {
        			$this->data=$request['QUERY_STRING'];
        		}

        		/*
					Не съм правил валидация дали QUERY_STRING-а е валиден
        		*/
        		public function getData() {
        			$queryArray = explode("&", $this->data);
        			$result;
        			foreach($queryArray as $attribute) {
        				$values=explode("=", $attribute);
        				$result[$values[0]] = $values[1];
        			}
        			return $result;
        		}
        	}

        	function test() {
        		$request = new GetRequest($_SERVER);
        		echo "<p>Method: " . $request->getMethod() . "</p>";
        		echo "<p>Path: " . $request->getPath() . "</p>";
        		echo "<p>URL: " . $request->getURL() . "</p>";
        		echo "<p>UserAgent: " . $request->getUserAgent() . "</p>";
        		echo "<p>Data: " . json_encode($request->getData()) . "</p>"; // Принтя ги под формата на JSON, но може и по друг начин чрез print_r(...). Функцията връща масив, просто така реших да го обработя.;
        	}

        	test();
        ?>
    </body>
</html>