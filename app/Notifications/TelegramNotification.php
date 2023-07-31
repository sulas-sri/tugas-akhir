<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Telegram\Bot\Api;

class TelegramNotification extends Notification
{
    use Queueable;

    public $bill;
    public $kategori_tagihan;
    public $id_telegram;

    /**
     * Create a new notification instance.
     *
     * @param string $bill
     * @param string $kategori_tagihan
     * @param string $id_telegram
     */
    public function __construct(string $bill, string $kategori_tagihan, string $id_telegram)
    {
        $this->bill = $bill;
        $this->kategori_tagihan = $kategori_tagihan;
        $this->id_telegram = $id_telegram;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the Telegram representation of the notification.
     */
    public function toTelegram($notifiable): TelegramMessage
    {
        // Create a new instance of the Telegram API with your bot token
        $telegram = new Api(config('services.telegram.bot_token'));

        // Chat ID to which the notification will be sent
        $chatId = $this->id_telegram;

        // Content of the notification message
        $content = "Tagihan Anda sebesar {$this->bill} dengan kategori {$this->kategori_tagihan}.";

        // Send the message to the specified chat_id
        $response = $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $content,
        ]);

        // Optionally, you can retrieve the message ID from the response
        $messageId = $response->getMessageId();

        // Return the TelegramMessage object
        return TelegramMessage::create()->content($content);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
