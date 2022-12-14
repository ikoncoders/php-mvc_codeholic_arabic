<?php 

namespace Ikonc\PhpMvc\View;

class View
{
    public static function make($view, $params = [])
    {
        $baseContent = self::getBaseContent();

        $viewContent = self::getViewContent($view, params: $params);

        return (str_replace('{{content}}', $viewContent, $baseContent));
    }

    protected static function getBaseContent()
    {
        ob_start();

        include view_path() . 'layouts/app.php';  // src/Support/Helpers.php

        return ob_get_clean();
    }

    protected static function getViewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? view_path() . 'errors/' : view_path();  //errors = layouts/errors.404.php

        if (str_contains($view, '.')) {
            $views = explode('.', $view);

            foreach ($views as $view) {
                if (is_dir($path . $view)) {
                    $path = $path . $view . '/';
                }
            }
            $view = $path . end($views) . '.php';
        } else {
            $view = $path . $view . '.php';
        }

        extract($params);

        if ($isError) {
            include $view;
        } else {
            ob_start();

            include $view;

            return ob_get_clean();
        }
    }

    public static function makeErrorView($error)
    {
        self::getViewContent($error, true);
    }

}