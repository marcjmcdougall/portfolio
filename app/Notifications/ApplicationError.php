<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\BlockKit\Composites\ConfirmObject;
use Illuminate\Notifications\Slack\SlackMessage;

class ApplicationError extends Notification
{
    use Queueable;

    protected $exception;
    protected $request;

    /**
     * Create a new notification instance.
     */
    public function __construct($exception, $request = null)
    {
        $this->exception = $exception;
        $this->request = $request;
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
        $request = $this->request;
        
        // Generate a unique error ID
        $errorId = substr(md5($exceptionClass . $message . $file . $line), 0, 8);
        
        // Get app URL for link back to site
        $appUrl = config('app.url');

        $slackMessage = new SlackMessage();

        $slackMessage->headerBlock(':no_entry: Application Error Detected');
        $slackMessage->contextBlock(function (ContextBlock $block) use ($errorId) {
            $block->text("Error #: {$errorId}");
        });
        $slackMessage->sectionBlock(function (SectionBlock $block) use ($exceptionClass, $file, $line) {
            $block->text('There was an error on your site');
            $block->field("*Error:*\n{$exceptionClass}")->markdown();
            $block->field("*File:*\n{$file}")->markdown();
            $block->field("*Line:*\n{$line}")->markdown();
        });
        $slackMessage->dividerBlock();
        $slackMessage->sectionBlock(function (SectionBlock $block) use ($appUrl) {
            $block->text("Visit site: {$appUrl}");
        });

        return $slackMessage;
        
        // (new SlackMessage)
        //     ->headerBlock(':no_entry: Application Error Detected')
        //     ->contextBlock(function (ContextBlock $block) {
        //         $block->text('Error #: {$errorId}');
        //     })
        //     ->sectionBlock(function (SectionBlock $block) {
        //         $block->text('There was an error on your site');
        //         $block->field("*Error ID:*\n{}")->markdown();
        //         $block->field("*Invoice Recipient:*\ntaylor@laravel.com")->markdown();
        //     })
        //     ->dividerBlock()
        //     ->sectionBlock(function (SectionBlock $block) {
        //         $block->text('Visit site:{SITE_URL}');
        //     });
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
