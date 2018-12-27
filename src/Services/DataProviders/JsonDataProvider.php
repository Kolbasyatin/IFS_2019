<?php


namespace App\Services\DataProviders;


use App\Lib\DataProviderTypes;
use App\Lib\Exceptions\DataProviderException;
use App\Services\DataProviders\Clients\ClientMaps\ClientMapInterface;
use App\Services\DataProviders\Clients\ClientMaps\JsonClientMap;

class JsonDataProvider implements DataProviderInterface
{

    /** @var array */
    private $mappings;

    /** @var ClientMapInterface */
    private $clientMap;

    public function __construct(JsonClientMap $clientMap, array $mappings)
    {
        $this->mappings = $mappings;
        $this->clientMap = $clientMap;
    }

    /**
     * @param string $sourceName
     * @return array
     * @throws DataProviderException
     * @throws \App\Lib\Exceptions\DataClientException
     */
    public function getData(string $sourceName): array
    {

        $json = $this->clientMap->getClient($sourceName)->execute();
        if (empty($json) || !$data = json_decode($json, true)) {
            throw new DataProviderException('Bad json from client!');
        }
        $data = json_decode($json, true);
        $mapping = $this->mappings[$sourceName] ?? null;
        
        return $this->parseAndReturnData($data, $mapping);
    }

    /**
     * @param array $data
     * @param string|null $mapping
     * @return array
     * @throws DataProviderException
     */
    private function parseAndReturnData(array $data, ?string $mapping): array
    {
        if (null === $mapping) {
            throw new DataProviderException('No required mapping for json data provider.');
        }
        try {
            $raw = reset($data)['source'];

            $result = array_filter(
                $raw,
                function ($data) use ($mapping) {
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