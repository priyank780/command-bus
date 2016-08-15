<?php

namespace KP\CommandBus;

/**
 * @author Konrad Podgórski <konrad.podgorski@gmail.com>
 */
class Events
{
    const PRE_COMMAND = 'command_handler.pre_command';
    const POST_COMMAND = 'command_handler.post_command';
}
