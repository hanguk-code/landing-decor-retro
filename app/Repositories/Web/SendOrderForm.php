<?php


namespace App\Repositories\Web;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrderForm extends Mailable
{
    use Queueable, SerializesModels;

    public $fields;
    public $total;

    /**
     * Create a new message instance.
     * @param $fields array should contain keys: to, from, subject, message
     */
    public function __construct($fields)
    {
        $this->fields = $fields;

//        if ($this->fields['userForm']['email']) {
//            $this->to($this->fields['userForm']['email']);
//        }

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
//            ->to('angelorlov@gmail.com')
            ->from(env('EMAIL_FROM', 'order@decor-retro.ru'))
            ->subject('Оформлен заказ на сайте decor-retro.ru')
            ->view('mails.order');
    }
}
