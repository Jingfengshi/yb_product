<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Router Class
 *
 * Parses URIs and determines routing
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/routing.html
 */
class CI_Router {

	/**
	 * CI_Config class object
	 *
	 * @var	object
	 */
	//配置类
	public $config;

	/**
	 * List of routes
	 *
	 * @var	array
	 */
	// 路由信息，routes.php中配置的
	public $routes =	array();

	/**
	 * Current class name
	 *
	 * @var	string
	 */
	//当前控制器名或类名
	public $class =		'';

	/**
	 * Current method name
	 *
	 * @var	string
	 */
	//当前控制器方法
	public $method =	'index';

	/**
	 * Sub-directory that contains the requested controller class
	 *
	 * @var	string
	 */
	//控制器目录名
	public $directory;

	/**
	 * Default controller (and method if specific)
	 *
	 * @var	string
	 */
	//默认控制器
	public $default_controller;

	/**
	 * Translate URI dashes 转义 URI 斜线
	 *
	 * Determines whether dashes in controller & method segments
	 * should be automatically replaced by underscores.
	 * 确定控制器和方法段中是否有破折号
	 * 应自动替换下划线。
	 *
	 * @var	bool
	 */
	public $translate_uri_dashes = FALSE;

	/**
	 * Enable query strings flag
	 *
	 * Determines whether to use GET parameters or segment URIs
	 * 决定是否使用得到的参数或段的URI
	 * @var	bool
	 */
	public $enable_query_strings = FALSE;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * Runs the route mapping function.
	 *
	 * @param	array	$routing
	 * @return	void
	 */
	public function __construct($routing = NULL)
	{
		//加载配置类
		$this->config =& load_class('Config', 'core');
		//加载URI类
		$this->uri =& load_class('URI', 'core');

		//判断是否开启 查询字符串
		//条件有两个: 1、不是cli运行方式  2 、配置文件中开启 enable_query_strings  这两个条件是 and 的关系
		$this->enable_query_strings = ( ! is_cli() && $this->config->item('enable_query_strings') === TRUE);

		// If a directory override is configured, it has to be set before any dynamic routing logic
		//判断用户在入口文件中有没有设置控制器目录名,如果设置了 就将控制器目录名设置
		is_array($routing) && isset($routing['directory']) && $this->set_directory($routing['directory']);
		$this->_set_routing();

		// Set any routing overrides that may exist in the main index file
		if (is_array($routing))
		{
			empty($routing['controller']) OR $this->set_class($routing['controller']);
			empty($routing['function'])   OR $this->set_method($routing['function']);
		}

		log_message('info', 'Router Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Set route mapping  设置路由映射
	 *
	 * Determines what should be served based on the URI request,
	 * as well as any "routes" that have been set in the routing config file.
	 * 根据URI请求确定应该送达的内容，
	 * 以及在路由配置文件中设置的任何“路由”。
	 *
	 * @return	void
	 */
	protected function _set_routing()
	{
		// Load the routes.php file. It would be great if we could
		// skip this for enable_query_strings = TRUE, but then
		// default_controller would be empty ...
		if (file_exists(APPPATH.'config/routes.php'))
		{
			//如果路由配置文件存在  就引入
			include(APPPATH.'config/routes.php');
		}

		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
		}

		// Validate & get reserved routes 验证并获得预定路由
		if (isset($route) && is_array($route))
		{

			//1、如果默认控制器存在 就将默认控制设置
			isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
			isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
			unset($route['default_controller'], $route['translate_uri_dashes']);
			$this->routes = $route;
		}

		// Are query strings enabled in the config file? Normally CI doesn't utilize query strings
		// 在配置文件中启用查询字符串吗？通常CI不使用查询字符串
		// since URI segments are more search-engine friendly, but they can optionally be used.
		// 由于URI段更具有搜索引擎友好性，但它们可以任意使用。
		// If this feature is enabled, we will gather the directory/class/method a little differently
		// 如果启用此功能，我们将收集 目录/类/方法 有点不同
		if ($this->enable_query_strings)//如果URL是enable_query_strings
		{
			// If the directory is set at this time, it means an override exists, so skip the checks
			// 如果此时设置目录，则意味着存在重写，因此跳过检查

			// 获取目录名
			if ( ! isset($this->directory))
			{
				$_d = $this->config->item('directory_trigger');
				$_d = isset($_GET[$_d]) ? trim($_GET[$_d], " \t\n\r\0\x0B/") : '';

				if ($_d !== '')
				{
					$this->uri->filter_uri($_d);
					$this->set_directory($_d);
				}
			}
			// 获取控制器名
			$_c = trim($this->config->item('controller_trigger'));
			if ( ! empty($_GET[$_c]))
			{
				$this->uri->filter_uri($_GET[$_c]);
				$this->set_class($_GET[$_c]);
				// 获取方法名
				$_f = trim($this->config->item('function_trigger'));
				if ( ! empty($_GET[$_f]))
				{
					$this->uri->filter_uri($_GET[$_f]);
					$this->set_method($_GET[$_f]);
				}

				$this->uri->rsegments = array(
					1 => $this->class,
					2 => $this->method
				);
			}
			else
			{
				$this->_set_default_controller();
			}

			// Routing rules don't apply to query strings and we don't need to detect
			// directories, so we're done here
			return;
		}

		// Is there anything to parse?
		if ($this->uri->uri_string !== '')
		{
			$this->_parse_routes();
		}
		else
		{
			$this->_set_default_controller();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set request route
	 *
	 * Takes an array of URI segments as input and sets the class/method
	 * to be called.
	 *
	 * @used-by	CI_Router::_parse_routes()
	 * @param	array	$segments	URI segments
	 * @return	void
	 */
	protected function _set_request($segments = array())
	{
		$segments = $this->_validate_request($segments);
		// If we don't have any segments left - try the default controller;
		// WARNING: Directories get shifted out of the segments array!
		if (empty($segments))
		{
			$this->_set_default_controller();
			return;
		}

		if ($this->translate_uri_dashes === TRUE)
		{
			$segments[0] = str_replace('-', '_', $segments[0]);
			if (isset($segments[1]))
			{
				$segments[1] = str_replace('-', '_', $segments[1]);
			}
		}

		$this->set_class($segments[0]);
		if (isset($segments[1]))
		{
			$this->set_method($segments[1]);
		}
		else
		{
			$segments[1] = 'index';
		}

		array_unshift($segments, NULL);
		unset($segments[0]);
		$this->uri->rsegments = $segments;
	}

	// --------------------------------------------------------------------

	/**
	 * Set default controller 设置默认路由
	 *
	 * @return	void
	 */
	protected function _set_default_controller()
	{
		if (empty($this->default_controller))  //如果没有默认控制器，show error
		{
			show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
		}

		// Is the method being specified?
		if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
		{
			$method = 'index';
		}

		if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php'))
		{
			// This will trigger 404 later
			return;
		}

		$this->set_class($class);
		$this->set_method($method);

		// Assign routed segments, index starting from 1
		$this->uri->rsegments = array(
			1 => $class,
			2 => $method
		);

		log_message('debug', 'No URI present. Default controller set.');
	}

	// --------------------------------------------------------------------

	/**
	 * Validate request
	 *
	 * Attempts validate the URI request and determine the controller path.
	 *
	 * @used-by	CI_Router::_set_request()
	 * @param	array	$segments	URI segments
	 * @return	mixed	URI segments
	 */
	protected function _validate_request($segments)
	{
		$c = count($segments);
		$directory_override = isset($this->directory);

		// Loop through our segments and return as soon as a controller
		// is found or when such a directory doesn't exist
		while ($c-- > 0)
		{
			$test = $this->directory
				.ucfirst($this->translate_uri_dashes === TRUE ? str_replace('-', '_', $segments[0]) : $segments[0]);

			if ( ! file_exists(APPPATH.'controllers/'.$test.'.php')
				&& $directory_override === FALSE
				&& is_dir(APPPATH.'controllers/'.$this->directory.$segments[0])
			)
			{
				$this->set_directory(array_shift($segments), TRUE);
				continue;
			}

			return $segments;
		}

		// This means that all segments were actually directories
		return $segments;
	}

	// --------------------------------------------------------------------

	/**
	 * Parse Routes            config/routes.php中路由重定向
	 *
	 * Matches any routes that may exist in the config/routes.php file
	 * against the URI to determine if the class/method need to be remapped.
	 *
	 * @return	void
	 */
	protected function _parse_routes()
	{
		// Turn the segment array into a URI string
		// 将uri的setment数组转换为uri_string
		$uri = implode('/', $this->uri->segments);

		// Get HTTP
		// $_SERVER['REQUEST_METHOD'] 这个变量表示的是表单提交数据的方式，get或者post
		$http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';

		// Loop through the route array looking for wildcards
		foreach ($this->routes as $key => $val)
		{
			// Check if route format is using HTTP verbs
			if (is_array($val))
			{
				$val = array_change_key_case($val, CASE_LOWER);
				if (isset($val[$http_verb]))
				{
					$val = $val[$http_verb];
				}
				else
				{
					continue;
				}
			}

			// Convert wildcards to RegEx
			$key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $uri, $matches))
			{
				// Are we using callbacks to process back-references?
				if ( ! is_string($val) && is_callable($val))
				{
					// Remove the original string from the matches array.
					array_shift($matches);

					// Execute the callback using the values in matches as its parameters.
					$val = call_user_func_array($val, $matches);
				}
				// Are we using the default routing method for back-references?
				elseif (strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE)
				{
					$val = preg_replace('#^'.$key.'$#', $val, $uri);
				}

				$this->_set_request(explode('/', $val));
				return;
			}
		}

		// If we got this far it means we didn't encounter a
		// matching route so we'll set the site default route
		$this->_set_request(array_values($this->uri->segments));
	}

	// --------------------------------------------------------------------

	/**
	 * Set class name  设置类名
	 *
	 * @param	string	$class	Class name
	 * @return	void
	 */
	public function set_class($class)
	{
		$this->class = str_replace(array('/', '.'), '', $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current class
	 *
	 * @deprecated	3.0.0	Read the 'class' property instead
	 * @return	string
	 */
	public function fetch_class()
	{
		return $this->class;
	}

	// --------------------------------------------------------------------

	/**
	 * Set method name
	 *
	 * @param	string	$method	Method name
	 * @return	void
	 */
	public function set_method($method)
	{
		$this->method = $method;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current method
	 *
	 * @deprecated	3.0.0	Read the 'method' property instead
	 * @return	string
	 */
	public function fetch_method()
	{
		return $this->method;
	}

	// --------------------------------------------------------------------

	/**
	 * Set directory name
	 *
	 * @param	string	$dir	Directory name
	 * @param	bool	$append	Whether we're appending rather than setting the full value
	 * @return	void
	 */
	public function set_directory($dir, $append = FALSE)
	{
		if ($append !== TRUE OR empty($this->directory))
		{
			$this->directory = str_replace('.', '', trim($dir, '/')).'/';
		}
		else
		{
			$this->directory .= str_replace('.', '', trim($dir, '/')).'/';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch directory
	 *
	 * Feches the sub-directory (if any) that contains the requested
	 * controller class.
	 *
	 * @deprecated	3.0.0	Read the 'directory' property instead
	 * @return	string
	 */
	public function fetch_directory()
	{
		return $this->directory;
	}

}
