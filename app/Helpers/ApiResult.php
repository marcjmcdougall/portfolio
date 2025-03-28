<?php

namespace App\Helpers;

class ApiResult implements \JsonSerializable
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_FAIL = 'fail';
    public const STATUS_ERROR = 'error';
    
    protected $value;
    protected $status;
    protected $error;
    protected $attempts;
    
    public function __construct($value = null, $status = self::STATUS_PENDING, $error = null, $attempts = 0)
    {
        $this->value = $value;
        $this->status = $status;
        $this->error = $error;
        $this->attempts = $attempts;
    }
    
    public static function pending()
    {
        return new self(null, self::STATUS_PENDING);
    }
    
    public static function success($value)
    {
        return new self($value, self::STATUS_SUCCESS);
    }

    public static function fail($value, $error, $attempts = 1)
    {
        return new self($value, self::STATUS_FAIL, $error, $attempts);
    }
    
    public static function error($error, $attempts = 1)
    {
        return new self(null, self::STATUS_ERROR, $error, $attempts);
    }
    
    public function getValue() { return $this->value; }
    public function getStatus() { return $this->status; }
    public function getError() { return $this->error; }
    public function getAttempts() { return $this->attempts; }
    
    public function isPending() { return $this->status === self::STATUS_PENDING; }
    public function isSuccess() { return $this->status === self::STATUS_SUCCESS; }

    public function isFail() { return $this->status === self::STATUS_FAIL; }
    public function isError() { return $this->status === self::STATUS_ERROR; }
    
    public function canRetry($maxAttempts = 3) 
    { 
        return ($this->isError() || $this->isFail()) && $this->attempts < $maxAttempts; 
    }

    // For JSON serialization
    public function jsonSerialize(): mixed
    {
        return [
            'value' => $this->value,
            'status' => $this->status,
            'error' => $this->error,
            'attempts' => $this->attempts
        ];
    }
    
    // For casting from JSON
    public static function fromJson($json)
    {
        $data = json_decode($json, true);
        return new self(
            $data['value'] ?? null,
            $data['status'] ?? self::STATUS_PENDING,
            $data['error'] ?? null,
            $data['attempts'] ?? 0
        );
    }
}