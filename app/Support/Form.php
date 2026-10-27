<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class Form
{
    public static function label($name, $value = null, $options = []): HtmlString
    {
        if (!is_array($options)) {
            $options = [];
        }

        $for = null;
        if ($value === null) {
            $value = $name;
        } else {
            $for = $name;
        }

        if (isset($options['for'])) {
            $for = $options['for'];
            unset($options['for']);
        }

        $attrs = self::attributes($options);
        $forAttr = $for !== null ? ' for="' . e($for) . '"' : '';

        return new HtmlString('<label' . $forAttr . $attrs . '>' . e($value) . '</label>');
    }

    public static function text($name, $value = null, $options = []): HtmlString
    {
        return self::input('text', $name, old($name, $value), $options);
    }

    public static function password($name, $options = []): HtmlString
    {
        return self::input('password', $name, null, $options);
    }

    public static function textarea($name, $value = null, $options = []): HtmlString
    {
        $attrs = self::attributes($options);
        $content = old($name, $value ?? '');

        return new HtmlString(
            '<textarea name="' . e($name) . '"' . $attrs . '>' . e($content) . '</textarea>'
        );
    }

    public static function radio($name, $value = null, $checked = null, $options = []): HtmlString
    {
        $resolved = old($name, $checked);
        $isChecked = (string) $resolved === (string) $value;

        return self::input('radio', $name, $value, array_merge($options, $isChecked ? ['checked' => true] : []));
    }

    public static function checkbox($name, $value = 1, $checked = null, $options = []): HtmlString
    {
        $resolved = old($name, $checked);
        $isChecked = is_array($resolved)
            ? in_array((string) $value, array_map('strval', $resolved), true)
            : (bool) $resolved;

        return self::input('checkbox', $name, $value, array_merge($options, $isChecked ? ['checked' => true] : []));
    }

    public static function date($name, $value = null, $options = []): HtmlString
    {
        return self::input('date', $name, old($name, $value), $options);
    }

    public static function select($name, $list = [], $selected = null, $options = []): HtmlString
    {
        $attrs = self::attributes($options);
        $current = old($name, $selected);
        $selectedValues = is_array($current) ? array_map('strval', $current) : [(string) $current];

        $html = '<select name="' . e($name) . '"' . $attrs . '>';
        foreach ($list as $optionValue => $optionLabel) {
            $isSelected = in_array((string) $optionValue, $selectedValues, true) ? ' selected' : '';
            $html .= '<option value="' . e($optionValue) . '"' . $isSelected . '>' . e($optionLabel) . '</option>';
        }
        $html .= '</select>';

        return new HtmlString($html);
    }

    private static function input(string $type, string $name, $value = null, array $options = []): HtmlString
    {
        $attrs = self::attributes($options);
        $valueAttr = $value !== null ? ' value="' . e($value) . '"' : '';

        return new HtmlString('<input type="' . e($type) . '" name="' . e($name) . '"' . $valueAttr . $attrs . '>');
    }

    private static function attributes(array $options): string
    {
        $attrs = '';
        foreach ($options as $key => $value) {
            if (is_int($key)) {
                continue;
            }

            if (is_bool($value)) {
                if ($value) {
                    $attrs .= ' ' . e($key);
                }

                continue;
            }

            if ($value === null) {
                continue;
            }

            $attrs .= ' ' . e($key) . '="' . e($value) . '"';
        }

        return $attrs;
    }
}
