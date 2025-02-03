<?php

namespace App\Consumer;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Psr\Log\LoggerInterface;

require_once __DIR__.'/../../vendor/autoload.php';  // Adjust the path if needed

class TaskListCreatedConsumer
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function consume()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        // Declare the queue
        $channel->queue_declare('task_list_created', false, true, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $callback = function ($msg) {
            $data = json_decode($msg->body, true);
            echo " [x] Received Task List: " . $data['taskListName'] . " by " . $data['userEmail'] . "\n";
        };

        $channel->basic_consume('task_list_created', '', false, true, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }
}
