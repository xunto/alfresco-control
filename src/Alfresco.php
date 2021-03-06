<?php
namespace AlfrescoControl;

use AlfrescoControl\Workflow\WorkflowManager;

class Alfresco
{
    private static $adapterMap = array(
        'guzzle' => GuzzleAlfrescoApi::class,
    );

    private $api;
    private $workflowManager;

    public function __construct(AlfrescoApiInterface $api)
    {
        $this->api = $api;
    }

    public static function create($adapter, $config = [])
    {
        $class = self::$adapterMap[$adapter];
        return new self(new $class($config));
    }

    /**
     * @return AlfrescoApiInterface
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return WorkflowManager
     */
    public function getWorkflowManager()
    {
        if ($this->workflowManager === null)
            $this->workflowManager = new WorkflowManager($this->api);

        return $this->workflowManager;
    }
}