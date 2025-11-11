<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddUserWishListNotification extends Notification
{
    use Queueable;

    protected $wishList;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(WishList $wishList, User $user)
    {
        $this->wishList = $wishList;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->view('mails.wish_list_invitation', [
                'user' => $this->user,
                'wishList' => $this->wishList,
                'url' => url(route('wish_lists.show', $this->wishList), false),
            ])
            ->subject('Vous avez été ajouté à une liste')
        ;
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
