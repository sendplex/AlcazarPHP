<?php

class AlcazarAPIOptions
{
    /**
     * Valid key to your Alcazar Network’s account.
     *
     * Valid Values: uuid key
     *
     * @var $APIkey
     */
    private $ApiKey;

    /**
     * Controls the output formatting for the data LRN query.
     *
     * Valid Values: json, xml, text as per the document it defaults to text, however this has been updated here to reflect json as default
     *
     * @var $output
     */
    private $output = 'json';

    /**
     * Controls whether the additional fields are displayed (OCN, LATA, CITY, STATE,
    JURSIDICTION, LEC, WIRELESS)
     *
     * Valid Values: true, false
     *
     * @var $extended
     */
    private $extended = false;

    /**
     * Ani represents the caller-id number of the call. If provided the query tool will try and make a jurisdictional determination of the call and return one of the 3 values
    (interstate, interstate, indeterminate)
     *
     * Valid Values: 10 or 11 digit telephone number
     *
     * @var $ani
     */
    private $ani;

    /**
     * includes the options in an array
     *
     * @var $optionsQuery array
     */
    public $optionsQuery;

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->ApiKey;
    }

    /**
     * @param mixed $ApiKey
     * @return AlcazarAPIOptions
     */
    public function setApiKey($ApiKey)
    {

        $this->ApiKey = $ApiKey;
        $this->addToOptionsQuery('key', $ApiKey);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param mixed $output
     * @return AlcazarAPIOptions
     */
    public function setOutput($output)
    {
        $this->output = $output;
        $this->addToOptionsQuery('output', $output);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExtended()
    {
        return $this->extended;
    }

    /**
     * @param mixed $extended
     * @return AlcazarAPIOptions
     */
    public function setExtended($extended)
    {
        $this->extended = $extended;
        $this->addToOptionsQuery('extended', $extended);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAni()
    {
        return $this->ani;
    }

    /**
     * @param mixed $ani
     * @return AlcazarAPIOptions
     */
    public function setAni($ani)
    {
        $this->ani = $ani;
        $this->addToOptionsQuery('ani', $ani);
        return $this;
    }

    /**
     * @return array
     */
    public function getOptionsQuery(): array{
        return $this->optionsQuery;
    }

    /**
     * adds to the query array
     *
     * @param $key
     * @param $value
     */
    public function addToOptionsQuery($key, $value) : void{
        $this->optionsQuery[$key] = $value;
    }

    public function removeFromOptionsQuery($key): void{
        unset($this->optionsQuery[$key]);
    }
}