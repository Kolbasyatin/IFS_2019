<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataProviderException;
use App\Services\DataProviders\Clients\GuzzleClient;

class JsonDataProvider implements DataProviderInterface
{

    /** @var GuzzleClient */
    private $client;

    /** @var array */
    private $mappings;

    public function __construct(GuzzleClient $client, array $mappings)
    {
        $this->client = $client;
        $this->mappings = $mappings;
    }

    use ConfigAwareDataProviderTrait;

    /**
     * @return array
     * @throws \App\Lib\Exceptions\DataClientException
     * @throws DataProviderException
     */
    public function getData(): array
    {
        if (!$this->config) {
            throw new DataProviderException('There is no config for current DataProvider.');
        }

        $url = $this->config->getUrl();
        $login = '';
        $password = '';
        $json = $this->client->execute($url, $login, $password);
        if (empty($json) || !$data = json_decode($json, true)) {
            throw new DataProviderException('Bad json from client!');
        }
        $data = json_decode($json, true);

        return $this->parseAndReturnData($data);
    }

    /**
     * @param array $data
     * @return array
     * @throws DataProviderException
     */
    private function parseAndReturnData(array $data): array
    {
        $mapping = $this->mappings[$this->config->getSource()->getName()] ?? null;
        if (null === $mapping) {
            throw new DataProviderException('No required mapping for json data provider.');
        }
        try {
            $raw = reset($data)['source'];

            $result = array_filter(
                $raw,
                function ($data) use ($mapping){
                    return $data['listenurl'] === $mapping;
                }
            );
            $result = array_merge(...$result);

            return $result;
        } catch (\Exception $e) {
            throw new DataProviderException('Error in parse json');
        }

    }



    public function getType(): string
    {
        return DataProviderTypes::JSON_TYPE;
    }

}