<?php

namespace Modules\Email\Helpers;

class EmailHelper
{
    /**
     * Replace shortcodes in a given template with dynamic values.
     *
     * @param  string  $template
     * @param  array  $data
     * @return string
     */
    public static function parseShortcodes(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = str_replace('{{' . $key . '}}', $value, $template);
        }
        return $template;
    }
}
