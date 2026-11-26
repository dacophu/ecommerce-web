<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $data = [];
    public function __construct($data)
    {
        //
        $this->data = $data;
    }
    /**
     * @return $this 
     */
    public function build()
    {
        // dd($this->data);
        return $this->from('testshoppe52@gmail.com', "test")->subject($this->data['subject'])->view("emails.index")->with("data", $this->data);
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope 
    // {
    //     return new Envelope(
    //         subject: 'Mail Notify',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
