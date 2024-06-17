<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    protected $jsonData;
    protected $cars;
    public function __construct()
    {
        $this->jsonData = json_decode(file_get_contents(storage_path() . "/cars.json"), true);
        $this->cars = $this->jsonData['cars'];
    }

    public function index()
    {
        $searchResults = $this->cars;
        if (request()->has('search_text')) {
            $searchResults = $this->performSearch(request()->input('search_text'));
        }
        return view('home.userpage', ['cars' => $searchResults]);
    }

    public function searchSuggestions(Request $request)
    {
        $searchResults = $this->performSearch($request->input('search_text'));
        return response()->json($searchResults);
    }

    public function performSearch($search_text)
    {
        // Check if search_text is empty
        if (empty($search_text)) {
            return $this->cars;
        }

        // Normalize the search text by replacing multiple spaces with a single space
        $search_text = $this->normalizeString($search_text);

        // Split the search text into characters
        $searchChars = str_split($search_text);

        // Find exact matches first
        $exactMatches = array_filter($this->cars, function ($car) use ($search_text) {
            $normalizedCar = $this->normalizeString($car['type']) . ' '
                . $this->normalizeString($car['brand']) . ' '
                . $this->normalizeString($car['model']);
            return stripos($normalizedCar, $search_text) !== false;
        });

        // If exact matches are found, return them
        if (!empty($exactMatches)) {
            return array_values($exactMatches);
        }

        // If no exact matches, find partial matches
        $partialMatches = array_filter($this->cars, function ($car) use ($searchChars) {
            $normalizedCar = $this->normalizeString($car['type']) . ' '
                . $this->normalizeString($car['brand']) . ' '
                . $this->normalizeString($car['model']);

            // Check if any search character is in the normalized car string
            $matchCount = 0;
            foreach ($searchChars as $char) {
                if (stripos($normalizedCar, $char) !== false) {
                    $matchCount++;
                }
            }
            return $matchCount > 0;
        });

        // Rank partial matches based on the number of characters that match
        usort($partialMatches, function ($a, $b) use ($searchChars) {
            $normalizedCarA = $this->normalizeString($a['type']) . ' '
                . $this->normalizeString($a['brand']) . ' '
                . $this->normalizeString($a['model']);
            $normalizedCarB = $this->normalizeString($b['type']) . ' '
                . $this->normalizeString($b['brand']) . ' '
                . $this->normalizeString($b['model']);

            $matchCountA = 0;
            $matchCountB = 0;

            foreach ($searchChars as $char) {
                if (stripos($normalizedCarA, $char) !== false) {
                    $matchCountA++;
                }
                if (stripos($normalizedCarB, $char) !== false) {
                    $matchCountB++;
                }
            }

            return $matchCountB <=> $matchCountA; // Sort in descending order of match count
        });

        // Convert to array values to reindex the array
        return array_values($partialMatches);
    }

    private function normalizeString($string)
    {
        return preg_replace('/\s+/', ' ', strtolower(trim($string)));
    }
}
