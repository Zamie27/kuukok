<?php

namespace App\Mail;

use App\Models\CashbackWithdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CashbackWithdrawalProcessed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public CashbackWithdrawal $withdrawal)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pencairan Cashback Anda Telah Diproses - Kuukok',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cashback_withdrawal_processed',
        );
    }
}
