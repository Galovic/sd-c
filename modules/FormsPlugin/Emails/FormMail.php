<?php

namespace Modules\FormsPlugin\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\FormsPlugin\Models\Configuration;
use Modules\FormsPlugin\Models\Response;

class FormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Response
     */
    private $response;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, Response $response)
    {
        $this->response = $response;
        $this->subject($subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->view('module-formsplugin::email.default')
            ->with([
                'values' => $this->response->getNamedValues()
            ]);

        foreach($this->response->getFiles() as $file){
            $mail->attach($file->file, [ 'as' => $file->name ]);
        }

        return $mail;
    }
}
