<?php


namespace App\Services\Fillers;


use App\Lib\Exceptions\FillerException;
use App\Lib\Info\InfoAnswer;

class FillerManager
{

    /** @var \SplObjectStorage|FillerInterface[] */
    private $fillers;

    /**
     * FillerManager constructor.
     */
    public function __construct()
    {
        $this->fillers = new \SplObjectStorage();
    }


    public function addFiller(FillerInterface $filler): void
    {
        $this->fillers->attach($filler);
    }

    /**
     * @param $data
     * @param string $type
     * @param InfoAnswer $answer
     * @throws FillerException
     */
    public function fill($data, string $type, InfoAnswer $answer): void
    {
        $wasFilled = false;
        foreach ($this->fillers as $filler) {
            if ($filler->isSupport($type)) {
                $filler->fill($data, $answer);
                $wasFilled = true;
                break;
            }
        }

        if (!$wasFilled) {
            throw new FillerException(sprintf('No filler was found for %s type', $type));
        }
    }

}