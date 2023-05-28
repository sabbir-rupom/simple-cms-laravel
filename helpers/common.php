<?php

use Carbon\Carbon;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Setting;
use Faker\Core\Number;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}

function verificationCode(int $length = 4)
{
    if ($length == 0) return 0;
    $min = pow(10, $length - 1);
    $max = (int) ($min - 1) . '9';
    return random_int($min, $max);
}

function getNumber(int $length = 8)
{
    $characters = '1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


function getTrx(int $length = 12)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getAmount(int|float $amount, int $length = 2)
{
    $amount = round($amount, $length);
    return $amount + 0;
}

function showAmount(int|float $amount, int $decimal = 2, bool $separate = true, bool $exceptZeros = false)
{
    $separator = '';
    if ($separate) {
        $separator = ',';
    }
    $printAmount = number_format($amount, $decimal, '.', $separator);
    if ($exceptZeros) {
        $exp = explode('.', $printAmount);
        if ($exp[1] * 1 == 0) {
            $printAmount = $exp[0];
        }
    }
    return $printAmount;
}


function removeElement(array $array, $value)
{
    return array_diff($array, (is_array($value) ? $value : array($value)));
}

function keyToTitle(string $text)
{
    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
}


function titleToKey(string $text)
{
    return strtolower(str_replace(' ', '_', $text));
}


function strLimit(string $title, $length = 10)
{

    return Str::limit($title, $length);
}

function getImage(string $image, $size = null)
{
    try {
        if (file_exists($image) && (is_file($image) || is_file(public_path($image)))) {
            return asset($image);
        } elseif (str_contains($image, 'resources/') && file_exists(base_path($image)) && is_file(base_path($image))) {
            return Vite::asset($image);
        }
        if ($size) {
            return route('placeholder.image', $size);
        }
    } catch (Exception $e) {
    }
    return Vite::asset('resources/images/default.png');
}

if (!function_exists('getSetting')) {
    /**
     * Get Settings value
     *
     * @param string $key
     */
    function getSetting(string $key, $default = '')
    {
        return Setting::getOption($key, $default);
    }
}

if (!function_exists('homeSetting')) {
    /**
     * Get Home Settings value
     *
     * @param string $key
     */
    function homeSetting(string $key, $default = '')
    {
        if ($key === 'all') {
            return HomeSetting::getAll();
        }
        return HomeSetting::getOption($key, $default);
    }
}

if (!function_exists('isTrue')) {
    /**
     * Check value is true or false
     *
     * @param any $value
     * @return bool
     */
    function isTrue($value)
    {
        if (is_string($value)) {
            $value = trim($value);
            return  in_array($value, ['1', 'true', 'ok', 'on']);
        } else if (is_bool($value)) {
            return $value;
        } else if (is_numeric($value)) {
            return intval($value) > 0;
        } elseif (is_array($value)) {
            return count($value) > 0;
        } else {
            return false;
        }
    }
}


function menuActive($routeName, $type = null)
{
    if ($type == 3) {
        $class = 'side-menu--open';
    } elseif ($type == 2) {
        $class = 'sidebar-submenu__open';
    } else {
        $class = 'active';
    }
    if (is_array($routeName)) {
        foreach ($routeName as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routeName)) {
        return $class;
    }
}


/**
 *  Generate upload path
 *
 * @param string $prefix
 * @return string
 */
function genuPath(string $prefix = ''): string
{
    return 'uploads/' . ($prefix ? $prefix . '/'  : '') . date('Ymd');
}

function diffForHumans(string $date)
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->diffForHumans();
}

function showDateTime(string $date, $format = 'Y-m-d h:i A')
{
    $lang = session()->get('lang');
    Carbon::setlocale($lang);
    return Carbon::parse($date)->translatedFormat($format);
}

function urlPath(string $routeName, array $routeParam = null)
{
    if (empty($routeParam)) {
        $url = route($routeName);
    } else {
        $url = route($routeName, $routeParam);
    }
    $basePath = route('home');
    $path = str_replace($basePath, '', $url);
    return $path;
}


function showMobileNumber(string|Number $number)
{
    $length = strlen($number);
    return substr_replace($number, '***', 2, $length - 4);
}

function showEmailAddress(string $email)
{
    $endPosition = strpos($email, '@') - 1;
    return substr_replace($email, '***', 1, $endPosition);
}


function getRealIP()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    //Deep detect ip
    if (filter_var(@$_SERVER['HTTP_FORWARDED'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    }
    if (filter_var(@$_SERVER['HTTP_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_X_REAL_IP'];
    }
    if (filter_var(@$_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    if ($ip == '::1') {
        $ip = '127.0.0.1';
    }

    return $ip;
}


function appendQuery(string $key, $value)
{
    return request()->fullUrlWithQuery([$key => $value]);
}


function dateSort($a, $b)
{
    return strtotime($a) - strtotime($b);
}

function dateSorting(array $arr)
{
    usort($arr, "dateSort");
    return $arr;
}

function dataConvert($data)
{
    $type = $data->data_type ?? ($data->type ?? 'string');

    if (empty($data->value)) {
        return dataDefault($type);
    }

    if ($type === 'int' || $type === 'integer') {
        return intval($data->value);
    } elseif ($type === 'float') {
        return floatval($data->value);
    } elseif ($type === 'json') {
        return json_decode(trim($data->value));
    } elseif ($type === 'serialize') {
        return unserialize(trim($data->value));
    } elseif ($type === 'bool') {
        return (intval($data->value) > 0) || $data->value === 'true';
    } else {
        return $data->value;
    }
}

function dataDefault(string $type)
{
    if ($type === 'int' || $type === 'integer') {
        return 0;
    } elseif ($type === 'float') {
        return 1.0;
    } elseif ($type === 'json') {
        return json_decode(json_encode([]));
    } elseif ($type === 'serialize') {
        return [];
    } elseif ($type === 'bool') {
        return false;
    } elseif ('string' === $type) {
        return '';
    } else {
        return null;
    }
}

function badgeHtml(int $status): string
{
    $html = '';

    if ($status > 0) {
        $html = '<span class="badge badge--success">' . trans('Enabled') . '</span>';
    } else {
        $html = '<span><span class="badge badge--danger">' . trans('Disabled') . '</span></span>';
    }

    return $html;
}

if (!function_exists('slugify')) {
    /**
     * Get code / slug from string
     *
     * @param string $string
     * @param integer $length
     * @return void
     */
    function slugify(string $string, int $length = 50)
    {
        $length = $length < 5 ? 5 : $length;

        if (strlen($string) > $length) {
            $string = fewWords($string, $length);
        }

        $string = preg_replace('/\s+/', ' ', strtolower($string));

        return trim(str_replace(' ', '-', $string));
    }
}

if (!function_exists('fewWords')) {
    /**
     * Get 1st n characters of words
     *
     * @param string $message Original message text
     * @param integer $K Number of characters
     * @return string Truncated words
     */
    function fewWords(string $message, int $K = 20, string $postFix = '')
    {

        if ($K < 1) {
            return '';
        }

        if (strlen($message) <= $K) {
            return trim($message);
        }

        if ($message[$K] === " ") {
            return trim(substr($message, 0, $K));
        }

        while ($message[--$K] !== ' ');

        return trim(substr($message, 0, $K)) . $postFix;
    }
}

/**
 * Get default language info
 *
 * @return Language
 */
function defaultLanguage(): Language
{
    return Language::getDefault();
}

/**
 * Get language info
 *
 * @return Language
 */
function getLanguage(string $code = null): Language
{
    $language = null;
    if ($code) {
        $language = Language::where('code', $code)->first();
    }
    return $language ? $language : defaultLanguage();
}

/**
 * Get All Languages
 *
 * @return Illuminate\Support\Collection
 */
function allLanguage(): Collection
{
    return Language::get()->pluck('name', 'code');
}

/**
 * Current language in session
 *
 * @return string
 */
function currentLang(): string
{
    return session('lang', defaultLanguage()->code);
}

/**
 * Get main menu items
 *
 * @return array
 */
function menuItems(): array
{
    return Menu::getMainMenu(currentLang());
}

/**
 * Get quick link items
 *
 * @return array
 */
function quickLinks(): array
{
    return Menu::footerQuickLinks(currentLang());
}

/**
 * Hex color code to RGB code
 *
 * @param string $color
 * @return string
 */
function hex2rgb($color)
{
    list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
    return "$r, $g, $b";
}

/**
 * Transform Language text other than default (english) resource IF available
 *
 * @param string $key
 * @param string $defaultText
 * @return string
 */
function __lti(string $key, string $defaultText = null): string
{
    if (currentLang() !== 'en') {
        return __($key);
    }

    return $defaultText ?? $key;
}

/**
 * Profile Image Url
 *
 * @param string|null $image
 * @return string
 */
function profileImage(string $image = null): string
{
    return empty($image) ? Vite::asset('resources/images/user-profile.png') : getImage($image);
}

/**
 * Prepare rating star html
 *
 * @param integer $rating
 * @return string
 */
function ratingHtml(int $rating): string
{
    $html = '';
    $rating = $rating > 5 ? 5 : ($rating < 0 ? 0 : $rating);
    for ($i = 0; $i <  5; $i++) {
        $active = $rating > 0 ? 'active' : '';
        $html .= "<i class='fas fa-star {$active}'></i>";
        $rating--;
    }

    return $html;
}

/**
 * CURL POST request api call
 *
 * @param string $url
 * @param array|object|string $params
 * @return object|string|null
 */
function callApi(string $url, $params)
{
    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($params),
        'accept:application/json'
    ));

    $response = curl_exec($ch);

    curl_close($ch);

    return $response;
}

/**
 * Generate unique ticket ID
 *
 * @param \Illuminate\Database\Eloquent\Model|object $model
 * @param string $column
 * @return string
 */
function generateTicketId(object $model, string $column)
{
    $ticketID = random_int(1000000, 9999999);
    $i = 0;
    try {
        while ($model->where($column, $ticketID)->exists()) {
            $ticketID = random_int(1000000, 9999999);
            $i++;
            if ($i > 10) {
                throw new Exception('Failed to generate Ticket ID');
            }
        }
    } catch (\Throwable | ModelNotFoundException $e) {
        abort(500, $e->getMessage());
    }
    return $ticketID;
}

/**
 * Get cookie data
 *
 * @param string $key
 * @param any $default
 * @return any
 */
function getCookie(string $key, $default = null)
{
    return Cookie::get($key, $default);
}
