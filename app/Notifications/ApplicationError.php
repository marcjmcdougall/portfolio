<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ActionsBlock;
use Illuminate\Notifications\Slack\BlockKit\Composites\ConfirmObject;
use Illuminate\Notifications\Slack\SlackMessage;

class ApplicationError extends Notification
{
    use Queueable;

    protected $exception;
    protected $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($exception, $url = null)
    {
        $this->exception = $exception;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toSlack($notifiable)
    {
        $exceptionClass = get_class($this->exception);
        $message = $this->exception->getMessage();
        $file = $this->exception->getFile();
        $line = $this->exception->getLine();
        $trace = $this->exception->getTraceAsString();
        
        // Generate a unique error ID
        $errorId = substr(md5($exceptionClass . $message . $file . $line), 0, 8);
        
        // Get app URL for link back to site
        $appUrl = config('app.url');
        $url = $this->url;

        $slackMessage = new SlackMessage();

        // Build a robust slack message
        $slackMessage->sectionBlock(function (SectionBlock $block) {
            $block->text('*Application Error Detected*')->markdown();
        });
        $slackMessage->contextBlock(function (ContextBlock $block) use ($appUrl) {
            $block->text("{$appUrl}");
        });
        $slackMessage->sectionBlock(function (SectionBlock $block) use ($exceptionClass, $file, $message, $line, $trace) {
            $block->field("*Error:*\n{$message}")->markdown();
            $block->field("*File:*\n{$file}")->markdown();
            $block->field("*Line:*\n{$line}")->markdown();
        });

        $slackMessage->dividerBlock();
        $truncatedTrace = substr($trace, 0, 1200) . (strlen($trace) > 800 ? "..." : "");
        $slackMessage->sectionBlock(function (SectionBlock $block) use ($truncatedTrace) {
            $block->text("*Stack Trace:*\n```{$truncatedTrace}```")->markdown();
        });

        $slackMessage->dividerBlock();
        $slackMessage->actionsBlock(function (ActionsBlock $block) use ($appUrl, $url) {
            $block->button('View Application')
                ->url($appUrl)
                ->primary();
            // Add a button to go directly to the error URL if it's available
            if ($url) {
                $block->button('Go to Error URL')
                    ->url($url);
            }
        });

        return $slackMessage;
    }

    /**
     * Route notifications for the Slack channel.
     */
    public function routeNotificationForSlack(Notification $notification): mixed
    {
        return config('services.slack.notifications.channel');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
