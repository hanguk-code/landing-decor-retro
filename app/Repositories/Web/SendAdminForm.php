<?php


namespace App\Repositories\Web;

use App\Models\Order\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAdminForm extends Mailable
{
    use Queueable, SerializesModels;

	protected $order;
    public $fields;
    public $total;

    /**
     * Create a new message instance.
     * @param $fields array should contain keys: to, from, subject, message
     */
    public function __construct($fields,$idd)
    {
        $this->fields = $fields;
        if(empty($idd)) {$idd='876';}
        $this->iddata = $idd;

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
		//$ordid=Order::orderby('id', 'desc')->first();
		
        return $this
//            ->to('angelorlov@gmail.com')
            ->from(env('EMAIL_FROM'))
			->subject('ДЕКОР - РЕТРО - копия заказа N '.$this->iddata.' от '.$this->fields['userForm']['name'])
            ->view('mails.order_adm')->with('iddata', $this->iddata);
    }
}
