<?php

namespace Pmc\CommandBus;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
interface Handler
{
    public function getSupportedCommands(): array;
    public function handleCommand($command): void;
}
