<?php
/* @noinspection ALL */
// @formatter:off
// phpcs:ignoreFile

/**
 * A helper file for Laravel, to provide autocomplete information to your IDE
 * Generated for Laravel 12.6.0.
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 * @see https://github.com/barryvdh/laravel-ide-helper
 */
namespace App\Facades {
    /**
     * 
     *
     */
    class DecimalHelper {
        /**
         * 
         *
         * @static 
         */
        public static function decimalToNumberWithoutPrecision($value, $precision)
        {
            /** @var \App\Helpers\DecimalHelper $instance */
            return $instance->decimalToNumberWithoutPrecision($value, $precision);
        }

        /**
         * 
         *
         * @static 
         */
        public static function numberWithoutPrecisionToDecimal($value, $precision)
        {
            /** @var \App\Helpers\DecimalHelper $instance */
            return $instance->numberWithoutPrecisionToDecimal($value, $precision);
        }

        /**
         * 
         *
         * @static 
         */
        public static function toString($decimal, $maxDigitsAfterComa = 18)
        {
            /** @var \App\Helpers\DecimalHelper $instance */
            return $instance->toString($decimal, $maxDigitsAfterComa);
        }

            }
    }

namespace Illuminate\Http {
    /**
     * 
     *
     */
    class Request {
        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param array $rules
         * @param mixed $params
         * @static 
         */
        public static function validate($rules, ...$params)
        {
            return \Illuminate\Http\Request::validate($rules, ...$params);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestValidation()
         * @param string $errorBag
         * @param array $rules
         * @param mixed $params
         * @static 
         */
        public static function validateWithBag($errorBag, $rules, ...$params)
        {
            return \Illuminate\Http\Request::validateWithBag($errorBag, $rules, ...$params);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $absolute
         * @static 
         */
        public static function hasValidSignature($absolute = true)
        {
            return \Illuminate\Http\Request::hasValidSignature($absolute);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @static 
         */
        public static function hasValidRelativeSignature()
        {
            return \Illuminate\Http\Request::hasValidRelativeSignature();
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $ignoreQuery
         * @param mixed $absolute
         * @static 
         */
        public static function hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
        {
            return \Illuminate\Http\Request::hasValidSignatureWhileIgnoring($ignoreQuery, $absolute);
        }

        /**
         * 
         *
         * @see \Illuminate\Foundation\Providers\FoundationServiceProvider::registerRequestSignatureValidation()
         * @param mixed $ignoreQuery
         * @static 
         */
        public static function hasValidRelativeSignatureWhileIgnoring($ignoreQuery = [])
        {
            return \Illuminate\Http\Request::hasValidRelativeSignatureWhileIgnoring($ignoreQuery);
        }

            }
    }


namespace  {
    class DecimalHelper extends \App\Facades\DecimalHelper {}
}





