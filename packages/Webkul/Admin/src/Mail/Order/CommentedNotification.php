<?php

namespace Webkul\Admin\Mail\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
<<<<<<< HEAD
use Illuminate\Contracts\Queue\ShouldQueue;
=======
>>>>>>> 6db7346497c8511a570d5e8471c9287634998b61

class CommentedNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  \Webkul\Sales\Contracts\OrderComment  $comment
     * @return void
     */
    public function __construct(public $comment)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
            ->to($this->comment->order->customer_email, $this->comment->order->customer_full_name)
            ->subject(trans('admin::app.emails.orders.commented.subject'))
            ->view('admin::emails.orders.commented');
    }
}
