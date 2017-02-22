<?php

namespace Pmc\CommandBus;

/**
 * @author Paul Court <paul@pmcnetworks.co.uk>
 */
class CommandBus
{
    /**
     * @var Handler[]
     */
    private $handlers;
    
    
    public function __construct()
    {
        $this->handlers = [];
    }
    
    public function dispatch(Command $cmd)
    {
        $commandClassName = get_class($cmd);
        if (!isset($this->handlers[$commandClassName])) {
            throw new Exception\HandlerNotFound(sprintf(
                    "No handler has been registered for %s commands.",
                    $commandClassName));
        }
        
        $this->handlers[$commandClassName]->handleCommand($cmd);
    }
    
    public function addHandler(Handler $handler)
    {
        foreach ($handler->getSupportedCommands() as $commandClassName) {
            if (array_key_exists($commandClassName, $this->handlers)) {
                throw new Exception\HandlerAlreadyRegistered(sprintf(
                        "A handler has already been registered for %s commands.",
                        $commandClassName));
            }
            $this->handlers[$commandClassName] = $handler;
        }
    }
}