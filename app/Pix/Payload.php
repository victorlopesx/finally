<?php

namespace App\Pix;

class Payload
{
    const ID_PAYLOAD_FORMAT_INDICATOR = '00';
    const ID_POINT_OF_INITIATION_METHOD = '01';
    const ID_MERCHANT_ACCOUNT_INFORMATION = '26';
    const ID_MERCHANT_ACCOUNT_INFORMATION_GUI = '00';
    const ID_MERCHANT_ACCOUNT_INFORMATION_KEY = '01';
    const ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION = '02';
    const ID_MERCHANT_ACCOUNT_INFORMATION_URL = '25';
    const ID_MERCHANT_CATEGORY_CODE = '52';
    const ID_TRANSACTION_CURRENCY = '53';
    const ID_TRANSACTION_AMOUNT = '54';
    const ID_COUNTRY_CODE = '58';
    const ID_MERCHANT_NAME = '59';
    const ID_MERCHANT_CITY = '60';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE = '62';
    const ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID = '05';
    const ID_CRC16 = '63';

    private $pixKey;
    private $description;
    private $merchantName;
    private $merchantCity;
    private $txid;
    private $amount;
    private $uniquePayment = false;
    private $url;

    public function setPixKey(string $pixKey): self
    {
        $this->pixKey = $pixKey;
        return $this;
    }

    public function setUniquePayment(bool $uniquePayment): self
    {
        $this->uniquePayment = $uniquePayment;
        return $this;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setMerchantName(string $merchantName): self
    {
        $this->merchantName = $merchantName;
        return $this;
    }

    public function setMerchantCity(string $merchantCity): self
    {
        $this->merchantCity = $merchantCity;
        return $this;
    }

    public function setTxid(string $txid): self
    {
        $this->txid = $txid;
        return $this;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = number_format($amount, 2, '.', '');
        return $this;
    }

    private function getValue(string $id, string $value): string
    {
        $size = str_pad(mb_strlen($value), 2, '0', STR_PAD_LEFT);
        return $id . $size . $value;
    }

    private function getMerchantAccountInformation(): string
    {
        $gui = $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_GUI, 'br.gov.bcb.pix');
        $key = $this->pixKey ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_KEY, $this->pixKey) : '';
        $description = $this->description ? $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION_DESCRIPTION, $this->description) : '';

        return $this->getValue(self::ID_MERCHANT_ACCOUNT_INFORMATION, $gui . $key . $description);
    }

    private function getAdditionalDataFieldTemplate(): string
    {
        $txid = $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE_TXID, $this->txid);
        return $this->getValue(self::ID_ADDITIONAL_DATA_FIELD_TEMPLATE, $txid);
    }

    private function getUniquePayment(): string
    {
        return $this->uniquePayment ? $this->getValue(self::ID_POINT_OF_INITIATION_METHOD, '12') : '';
    }

    public function getPayload(): string
    {
        $payload = $this->getValue(self::ID_PAYLOAD_FORMAT_INDICATOR, '01') .
            $this->getUniquePayment() .
            $this->getMerchantAccountInformation() .
            $this->getValue(self::ID_MERCHANT_CATEGORY_CODE, '0000') .
            $this->getValue(self::ID_TRANSACTION_CURRENCY, '986') .
            $this->getValue(self::ID_TRANSACTION_AMOUNT, $this->amount) .
            $this->getValue(self::ID_COUNTRY_CODE, 'BR') .
            $this->getValue(self::ID_MERCHANT_NAME, $this->merchantName) .
            $this->getValue(self::ID_MERCHANT_CITY, $this->merchantCity) .
            $this->getAdditionalDataFieldTemplate();

        return $payload . $this->getCRC16($payload);
    }

    private function getCRC16(string $payload): string
    {
        $payload .= self::ID_CRC16 . '04';
        $polinomio = 0x1021;
        $resultado = 0xFFFF;

        if (($length = strlen($payload)) > 0) {
            for ($offset = 0; $offset < $length; $offset++) {
                $resultado ^= (ord($payload[$offset]) << 8);
                for ($bitwise = 0; $bitwise < 8; $bitwise++) {
                    if (($resultado <<= 1) & 0x10000) $resultado ^= $polinomio;
                    $resultado &= 0xFFFF;
                }
            }
        }

        return self::ID_CRC16 . '04' . strtoupper(dechex($resultado));
    }
}