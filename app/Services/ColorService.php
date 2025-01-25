<?php

namespace App\Services;

class ColorService
{
    protected $colors;

    public function __construct()
    {
        // Obtains the colors from the configuration file
        $this->colors = config('colors');
    }

    // Converts a hex color to its name
    public function hexToColorName($hex)
    {
        $colors = config('colors');             // obtains the colors from the configuration file
        $invertedMap = array_flip(array_map('strtolower', $colors));
        $hex = strtolower($hex);
        return $invertedMap[$hex] ?? 'Unknown Color';
    }

    public function getColorName(array $hex)
    {
        // Check if the array is not empty
        if (empty($hex)) {
            return response()->json(['error' => 'No hex colors provided'], 400);
        }
    
        // Create an associative array with color names as keys and hex values as values
        $colorMapping = array_reduce($hex, function($result, $hexValue) {
            $colorName = $this->hexToColorName($hexValue);  // Convert hex to color name
            $result[$hexValue] = $colorName;  // Set the hex as the key and color name as the value
            return $result;
        }, []);
    
        // Return the color mapping as a JSON response
        return response()->json($colorMapping);
    }

}
