<?php 

use Ikonc\PhpMvc\View\View;
use Ikonc\PhpMvc\Application;
use Ikonc\PhpMvc\Http\Request;
use Ikonc\PhpMvc\Support\Hash;
use Ikonc\PhpMvc\Http\Response;
use Ikonc\PhpMvc\Validation\Validator;

//check that .env key exists
if (!function_exists('env')) {
    function env($key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            return $_ENV[$key];
        }
        return $default;
    }
} 


//project base/root  folder
if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__DIR__) . '/../';
    }
}

//get model name from model path
if (!function_exists('class_basename')) {
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}


//view path, to redirect to views folder
if (!function_exists('view_path')) {
    function view_path()
    {
        return  base_path() . 'views/';
    }
}

//to get/set config keys and values
if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app()->config;
        }
        if (is_array($key)) {
            return app()->config->set($key);
        }
        return app()->config->get($key, $default);
    }
} 

// get config path 
if (!function_exists('config_path')) {
    function config_path()
    {
        return base_path() . 'config/';
    }
}

//
if (!function_exists('value')) {
    function value($value) {
        return $value instanceof Closure ? $value() : $value;
    }
}

//redirect to public folder
if (!function_exists('public_path')) {
    function public_path()
    {
        return base_path() . 'public/';
    }
}

// parsing view and params
if (!function_exists('view')) {
    function view($view, $params = [])
    {
        echo View::make($view, $params);
    }
}

//redirect to previous route 
if (!function_exists('back')) {
    function back()
    {
        return (new Response())->back();
    }
}

//instance of app
if (!function_exists('app')) {
    function app() {
        static $instance = null;
        if (!$instance) {
            $instance = new Application();
        }
        return $instance;
    }
}

// request inputs from form 
if (!function_exists('request')) {
    function request($key = null)
    {
        $instance = new Request();

        if (!$instance) {
            return new Request();
        }

        if ($key) {
            if (is_string($key)) {
                return $instance->get($key);
            }

            if (is_array($key)) {
                return $instance->only($key);
            }
        }

        return $instance;
    }
}


//check that form inputs are validated 
if (!function_exists('validator')) {
    function validator()
    {
        return (new Validator());
    }
}

// hash password
if (!function_exists('bcrypt')) {
    function bcrypt($data)
    {
        return Hash::make($data);
    }
}


//database_path
if (!function_exists('database_path')) {
    function database_path()
    {
        return base_path() . 'database/';
    }
}

// keep old input in form
if (!function_exists('old')) {
    function old($key)
    {
        if (app()->session->hasFlash('old')) {
            return app()->session->getFlash('old')[$key];
        }
    }
}







// setEnv
//  function setEnv($key, $val){
//     $path = base_path('.env');
//     if (file_exists($path)) {

//         file_put_contents($path, str_replace(
//             $key . '=' . env($key), $key . '=' . $val, file_get_contents($path)
//         ));
//     }
// }

//updateEnv
// function envUpdate($flag, $value)
// {
//     //dd($flag,$value);
//     $allow_flags = ["MAIL_REPORT", "SMS_REPORT"];

//     if (in_array($flag, $allow_flags)) {
//         setEnv((string)$flag, (string)$value);
//         return env(env((string)$flag));
//     }
// }

//
// function env($key, $default = null)
// {
//     $value = getenv($key);

//     if ($value === false) {
//         return value($default);
//     }

//     switch (strtolower($value)) {
//         case 'true':
//         case '(true)':
//             return true;

//         case 'false':
//         case '(false)':
//             return false;

//         case 'empty':
//         case '(empty)':
//             return '';

//         case 'null':
//         case '(null)':
//             return;
//     }

//     if (Str::startsWith($value, '"') && Str::endsWith($value, '"')) {
//         return substr($value, 1, -1);
//     }

//     return $value;
// }