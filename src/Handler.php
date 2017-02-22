<?php

namespace Pmc\CommandBus;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
interface Handler
{
    public function getSupportedCommands(): array;
    public function handleCommand(Command $command): void;
}
