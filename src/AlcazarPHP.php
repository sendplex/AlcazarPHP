<?php

class AlcazarPHP
{
    /**
     * Pulls the configuration from the config.php file
     *
     * @var mixed $config
     */
    public $config;

    /**
     * Telephone number you would like to retrieve LNP records for.
     *
     * Valid Values: 11-digit telephone number starting with 1
     *
     * @var $telephoneNumber
     */
    public $telephoneNumber;

    /**
     * @var $options AlcazarAPIOptions
     */
    protected $options;

    /**
     * AlcazarPHP constructor.
     * @param $telephoneNumber int
     */
    public function __construct(int $telephoneNumber)
    {
        if(!is_int($telephoneNumber) && (strlen((string)$telephoneNumber) === 11)) {
            throw new \http\Exception\InvalidArgumentException('please make sure that this number is integer and is 11 digits');
        }
        $this->config = include 'config.php';
        $this->options = new AlcazarAPIOptions();
        $this->options
            ->setApiKey($this->config['api-key'])
            ->setOutput('json')
            ->setExtended('true');

        $this->telephoneNumber = $telephoneNumber;
    }

    /**
     * Following the documentation, this can include all the variables in the query as an associative array
     *
     * @param array $params
     * @return $this
     */
    public function querySetup($params = [])
    {
        $this->options->addToOptionsQuery('tn', $this->telephoneNumber);
        foreach($params as $key => $value){
            $this->options->addToOptionsQuery($key, $value);
        }
        return $this;
    }

    /**
     * build the url to consume the api for guzzle to use
     *
     * @return string
     */
    public function urlBuilder(): string
    {
        return $this->config['server'].'/api/'.$this->config['version'].'/lrn';
    }

    /**
     * Creates a guzzle object and wraps it.
     *
     * @param string $method defaults to GET
     * @param string $url required
     * @param array $queryParams required
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function guzzleWrapper(string $url, array $queryParams, string $method = 'GET'){
        $client = new GuzzleHttp\Client();
        $res = $client->request($method, $url, [
            'query' => $queryParams
        ]);
        return $res->getBody()->getContents();
    }

    /**
     * returns the response as array
     *
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function ArrayResponse($params = [])
    {
        $this->querySetup($params);
        try {
         $response = $this->guzzleWrapper($this->urlBuilder(), $this->options->getOptionsQuery());
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        print_r(json_decode($response, true));
    }

    /**
     * returns the response of the query based
     *
     * @param string $typeOfResponse
     * @param bool $trueForArrayFalseForJson
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return mixed
     */
    public function response(string $typeOfResponse = 'json')
    {
        $this->querySetup(['output' => $typeOfResponse]);
        try {
         return $this->guzzleWrapper($this->urlBuilder(), $this->options->getOptionsQuery())->getBody();
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


}
