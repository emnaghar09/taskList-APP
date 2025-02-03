<?php

namespace App\EventListener;

use App\Event\TaskListCreatedEvent;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Log\LoggerInterface;

require_once __DIR__.'/../../vendor/autoload.php';  // Adjust the path if needed

class TaskListCreatedListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onTaskListCreated(TaskListCreatedEvent $event): void
    {
        $taskList = $event->getTaskList();
        $this->logger->info('Nouvelle liste de tâches créée : ' . $taskList->getName());

        // RabbitMQ connection setup
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        // Declare the queue
        $channel->queue_declare('task_list_created', false, true, false, false);

        // Prepare message payload
        $data = json_encode([
            'taskListName' => $taskList->getName(),
            'userEmail' => $taskList->getUser()->getEmail(),
        ]);

        // Create and send the message
        $msg = new AMQPMessage($data, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $channel->basic_publish($msg, '', 'task_list_created');

        // Close connections
        $channel->close();
        $connection->close();

        $this->logger->info('Message sent to RabbitMQ: ' . $data);
    }
}
